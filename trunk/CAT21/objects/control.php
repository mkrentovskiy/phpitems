<?
        //
	//
	//
	class Control
	{
		var	$user;

		function Control($u)
		{
			$this->user = $u;
		}
	
	
		function makeMenu()
		{
			global	$cat_modlist;

			$str = '';
			for($i = 0; $i < count($cat_modlist); $i++) {
				$name = $cat_modlist[$i];				
				if($this->user->isShow($name)) {
					eval('$obj = new '.$name.'();');
					$title = $obj->getTitle(); 
					$str .= "<tr><td valign='top' align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?cat_pos=control&cat_mod=$name' class='wmenu'>$title</a></td></tr>";
					$str .= $obj->makeMenu($this->user);
				};
			};
			return $str;
		}
		
		function execute()
		{
		        global	$cat_mod, $cat_modlist;
		
			$out = true;
			for($i = 0; $i < count($cat_modlist); $i++) {
				if($cat_mod == $cat_modlist[$i]) {
					if($this->user->isShow($cat_mod)) {
						eval('$obj = new '.$cat_mod.'();');
						if(is_object($obj) && $obj->isValid()) $str = $obj->execute($this->user);
						$out = false;
						break;
					};
				};
			};
		        if($out) {
				$str = fileToString('misc/control_help.html');
			};
			return $str;
		}
	};



?>