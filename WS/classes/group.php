<?

	class Group
    {
		var	$group;
		var $title;
		var $name;
		var	$objects;
	
		function Group($group)
		{
			global $db;
	
			$this->group = $group;
			$this->title = '';
			$this->name = '';
			$this->objects = array();

			$res = $db->query("select * from r_group where id_r_group='$group' and enable > 0");	

			if(count($res) == 1) {
				$r = $res[0];		
				$this->title = $r['title'];
				$this->name = $r['name'];
			
				$res = $db->query("select r_usecase.name as nm from r_usecase, r_usecase_r_group where r_usecase_r_group.r_group='$group' and r_usecase_r_group.r_usecase=r_usecase.id_r_usecase");					

				foreach($res as $r) { 
					$this->objects[trim($r['nm'])] = '1';
				};
			};
		}

		function getName()
		{
			return $this->group;
		}

		function getGroupName()
		{
			return $this->name;
		}

		function getTitle()
		{
			return $this->title;
		}

		function allow($uc)
		{
			$uc = strtolower($uc);
			if(!empty($this->objects[$uc])) return $this->objects[$uc];
			else return false;
		}	
		
		function main()
		{
			while($p = each($this->objects)) {
				if($p['key'] != 'uclogout' && $p['key'] != 'ucstart') {
					return substr($p['key'],2);
				};
			};
		}
    };

?>