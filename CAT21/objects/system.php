<?
			// $str .= "<tr><td valign='top' align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='#' class='wmenu'><b>wmenu</b></a></td></tr>";
			// $str .= "<tr><td valign='top' align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='#' class='emenu'>emenu</a></td></tr>";
        //
	//
	//

	define('CAT_SYSTEM_UG',1);
	define('CAT_SYSTEM_LOG',2);
	define('CAT_SYSTEM_STRUCT',3);
	//define('CAT_SYSTEM_PATTERNS',4);
	//define('CAT_SYSTEM_XML_R',41);
	//define('CAT_SYSTEM_XML_B',42);
	//define('CAT_SYSTEM_XML_E',43);

	class System
	{
		var	$user;

		function System($u)
		{
			$this->user = $u;
		}
	
		function makeMenu()
		{
			$str = '';			
            $str .= "<tr><td valign='top' align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?cat_pos=system&cat_mod=".CAT_SYSTEM_UG."' class='wmenu'>$GLOBALS[cat_m_ug]</a></td></tr>";
            $str .= "<tr><td valign='top' align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?cat_pos=system&cat_mod=".CAT_SYSTEM_STRUCT."' class='wmenu'>$GLOBALS[cat_m_struct]</a></td></tr>";
            $str .= "<tr><td valign='top' align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?cat_pos=system&cat_mod=".CAT_SYSTEM_LOG."' class='wmenu'>$GLOBALS[cat_m_log]</a></td></tr>";
      		return $str;
		}
		
		function execute()
		{
			global $cat_mod, $cat_session;
			
			$str = '';
			switch($cat_mod) {
				case(CAT_SYSTEM_UG): {
				        $str .= $this->user->execute();
					$cat_session->set('cat_session_user',$this->user);									
					break;
				};
				case(CAT_SYSTEM_LOG): {
					global $cat_log;
		
					$str .= $cat_log->execute();
					break;
				};
				case(CAT_SYSTEM_STRUCT): {
					$obj = new Struct;
					$str .= $obj->execute($this->user);					
					break;
				};
				default: {
					$str = fileToString('misc/system_help.html');
				};
			};
			return $str;
		}

	};


?>