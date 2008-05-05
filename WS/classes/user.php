<?
    class User 
	{
		var	$login;
		var	$id;

		var	$name;
		var	$price;
		var	$mail;

		var	$group;
		var	$group_id;

		var	$r;
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
				$this->price = 'c';
				return;
			};

			$res = $db->query("select * from r_user where login='$login' and passwd='$password' and enable > 0");
			if(count($res) > 0) {
				$r = $res[0];

				$this->login = $r['login'];
				$this->group = new Group($r['in_group']);
				$this->group_id = $r['in_group'];
				$this->id = $r['id_r_user'];

				$this->name = $r['name'];
				$this->mail = $r['mail'];
				if(isset($r['price']) && strlen($r['price']) == 1) $this->price = $r['price'];
				else $this->price = 'c';

				$this->r = $r;
				$this->r[2] = '';
				$this->r['passwd'] = '';
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

		function getId()
		{
		    	return $this->id;
		}

		function getPrice()
		{
		    	return $this->price;
		}

		function getGroupId()
		{
		    	return $this->group_id;
		}

		function getMail()
		{
		    	return $this->mail;
		}

		function getGroupName()
		{
		    	return $this->group->getGroupName();
		}

		function getUserInfo()
		{
			global $session;
		
			if($this->valid) {
				$s = "<user login='$this->login' group='".$this->group->getName()."' grouptitle='".$this->group->getTitle()."'>";
				$s .= "<name>".$this->name."</name>";
				$s .= "<price>".$this->price."</price>";
				$s .= "</user>";				
			} else {
				$s = "<user><nouser sid='".$session->getId()."'/></user>";
			}
			return $s;
		}

		function getInfo($c)
		{
			$s = "";
			while($p = @each($c)) {
				if(!is_numeric($p['key'])) {
					$s .= "<$p[key]>".htmlspecialchars($p[value])."</$p[key]>";
				};				
			};
			return $s;
		} 
		
		function getRow()
		{
			return $this->r;
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
	};

?>