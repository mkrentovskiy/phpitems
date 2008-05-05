<?
    	class User 
	{
		var	$login;
		var	$row;

		var	$group;
		var	$valid;
		
		
		function User($login, $password) 
		{
			global $db;
			
			$this->valid = false;	

			if(ereg("([A-Za-z0-9]*)", $login, $regs)) $login = $regs[0];
			else $login = 'anonymous';
                        
			if(ereg("([A-Za-z0-9]*)", $password, $regs)) $password = $regs[0];
			else $password = '';

			if($login == 'anonymous') {
				$this->login = $login;
				
				$this->group = new Group($login);
				$this->valid = false;
				$this->id = 0;

				return;
			};

 
			$res = $db->query("SELECT * FROM s_users WHERE login='$login' AND passwd=MD5('$password') AND enable > 0");
			if(count($res) > 0) {
				$r = $this->row = $res[0];
				$this->row['passwd'] = "";

				$this->login = $r['login'];
				$this->group = new Group($r['in_group']);

				$this->valid = true;
			} else {
				$this->valid = false;
			};	
		}
	
		function isValid()
		{
		    	return $this->valid;
		}

		function getLogin()
		{
		    	return $this->login;
		}

		function getUserInfo()
		{
			return $this->row;
		}

		function getDefaultUC()
		{
		    	return $this->group->main();
		}

		function allow($usecase)
		{
			if($this->isValid()) return $this->group->allow($usecase);
			else return false;
		}		

		function filter($class, $link)
		{
			if($this->isValid()) return $this->group->filter($class, $link);
			else return false;
		}		
	};

?>