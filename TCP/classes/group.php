<?

	class Group
    	{
		var	$group;
		var     $title;

		var	$objects;
	
		function Group($group)
		{
			global $db;
	
			$this->group = $group;
			$this->title = '';
			$this->objects = array();

			$res = $db->query("SELECT * FROM s_sections WHERE name='$group' AND enable > 0");	

			if(count($res) == 1) {
				$r = $res[0];		
				$this->title = $r['title'];
			
				$res = $db->query("SELECT usecase AS nm FROM s_sections_usecases WHERE section='$group'");					

				foreach($res as $r) { 
					$this->objects[strtolower(trim($r['nm']))] = true;
				};

				$res = $db->query("SELECT s_objects.class, s_objects.link  
						FROM s_sections_objects, s_objects 
						WHERE s_sections_objects.section='$group' AND 
						s_sections_objects.object=s_objects.id");					

				foreach($res as $r) { 
					$this->objects[strtolower(trim($r['class'].$r['link']))] = false;
				};
			};
		}

		function getName()
		{
			return $this->group;
		}


		function getTitle()
		{
			return $this->title;
		}


		function allow($o)
		{
		    //
			// If usecase name in array - return its value
			//
			$o = strtolower($o);
			if(!empty($this->objects[$o])) return $this->objects[$o];
			else return false;
		}	

		function filter($class, $link)
		{
		    //
			// Default - positive!
			//
			$h = strtolower($class.$link);
		        if(!empty($this->objects[$h]))  return $this->objects[$h];
			else return true;			
		}	
		
    };

?>