<?

        //
	//
	//
	define('CAT_INFO_AREA',1);
	define('CAT_INFO_TABLE',2);

	class Info
	{
		var	$user;

		function Info($u)
		{
			$this->user = $u;
		}
	
		function makeMenu()
		{
			global	$cat_db;

			$str = '';
			$res = $cat_db->query("select *,cat_areas.pos as pztn from cat_tables,cat_areas where cat_areas.id_area=cat_tables.area order by cat_areas.pos, cat_tables.pos");			
			for($i = 0; $i < count($res); $i++) {
				$r = $res[$i];
				
				if($r['pztn'] > 99) $k = " bgcolor='#f0f0f0'";
				else $k = "";
				if($this->user->isShow($r[name])) {

					if($p != $r[id_area]) {
						$p = $r[id_area];					
						if($i > 0) {
							$str .=  "</table></td></tr>";
						};
			                        $str .= "<tr><td  style='padding-left: 25px' valign='top' align='left'$k><img id='i$i' src='images/z.gif' border='0' onClick='changeMenu($i)'>&nbsp;<a href='?cat_pos=info&cat_mod=".CAT_INFO_AREA."&cat_obj=$p' class='wmenu'><b>$r[area]</b></a><br>";
						$str .= "<table border='0' cellpadding='2' cellspacing='0' width='100%' class='pt8' id='t$i' style='display: none'>";
					};
					$str .= "<tr><td style='padding-left: 15px' valign='top' align='left'$k><a href='?cat_pos=info&cat_mod=".CAT_INFO_TABLE."&cat_obj=$r[name]' class='emenu'>$r[title]</a>  ";
					if(!$this->user->isEdit($r[name])) $str .= "[<font class='red'>E</font>]";	
					if(!$this->user->isPublish($r[name])) $str .= "[<font class='red'>P</font>]";	
					if($this->user->isLimited($r[name])) $str .= "[<font class='red'>L</font>]";	
					$str .= "</td></tr>";					
				};
			};
			if(count($res) != 0) $str .=  "</table></td></tr>";
			return $str;
		}
		
		function execute()
		{			
			global	$cat_mod, $cat_obj, $cat_db, $cat_session;
			
			$str = '';			
			switch($cat_mod) {
				case(CAT_INFO_AREA) : {
					$res = $cat_db->query("select * from cat_tables,cat_areas where cat_areas.id_area=cat_tables.area and cat_areas.id_area='$cat_obj' order by cat_tables.pos");			
					for($i = 0; $i < count($res); $i++) {
						$r = $res[$i];
						if($this->user->isShow($r[name])) {
							if($p != $r[id_area]) {
								$p = $r[id_area];					
			                        		$str .= "<font class='title'>$GLOBALS[cat_m_area] $r[area]</font><br><ul>";
							};
							$str .= "<li><a href='?cat_pos=info&cat_mod=".CAT_INFO_TABLE."&cat_obj=$r[name]' class='wmenu'><b>$r[title]</b></a> ";
							if(!$this->user->isEdit($r[name])) $str .= "[<font class='red'>E</font>]";	
							if(!$this->user->isPublish($r[name])) $str .= "[<font class='red'>P</font>]";	
							if($this->user->isLimited($r[name])) $str .= "[<font class='red'>L</font>]";	
							$str .= "</li>";					
						};
					};
					$str .= "</ul>";
					break;
				};
				case(CAT_INFO_TABLE) : {
					$res = $cat_db->query("select object from cat_tables where name='$cat_obj'");
					if(count($res) == 1) {
						if($cat_session->isRegistered('cat_table_'.$cat_obj)) {
						 	$obj = $cat_session->get('cat_table_'.$cat_obj);
						 } else {
							eval('$obj = new '.$res[0][object].'($cat_obj);');							
							if(is_object($obj) && $obj->isValid()) $cat_session->register('cat_table_'.$cat_obj);
							if(!(is_object($obj) && $obj->isValid())) return '';
						 };
						
						$str = $obj->execute($this->user);
						$cat_session->set('cat_table_'.$cat_obj, $obj);
					};
					break;
				};
				default: {
					$str = fileToString('misc/info_help.html');
				};
			};
			return $str;
		}

	};

?>