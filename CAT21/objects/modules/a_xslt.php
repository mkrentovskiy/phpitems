<?
	require_once("objects/modules/_base.php");

	define('CAT_MOD_XSLT_GENERATE',1);

	class ModXSLT extends ModBase
	{				
		function ModXSLT() 
		{
			$this->ModBase();
			$this->title = $GLOBALS[cat_m_mod_xslt];
		}
	
		function show()
		{
			global $cat_max_file_size;

			$s = "<table border='0' cellpadding='5' cellspacing='1' width='100%' class='pt9'>";
			$s .= "<form enctype='multipart/form-data' action='".$this->URL."&cat_opt=".CAT_MOD_XSLT_GENERATE."' method='post' name='rf'>";
			$s .= "<td class='einfo' align='center'>";
			$s .= "<input type='submit' value='$GLOBALS[cat_m_xslt_execute]' class='sub'>";
			$s .= "</td></tr></form>";
			$s .= "</table><br><br>";
			return $s;		
		}
				
		function generate()
		{
			$pb = new PageBuilder();
			
			$s = "<table border='0' cellpadding='5' cellspacing='1' width='100%' class='pt9'>";
			$s .= "<td class='einfo' align='left'>";
			$s .= $pb->execute();
			$s .= "</td></tr>";
			$s .= "</table>";
			return $s;
		}		

		function execute($user)
		{
			global	$cat_opt;

			$s = '';			
			if($user->isEdit('ModXSLT')) {
 				$s = "<font class='title'>$GLOBALS[cat_m_mod_xslt]</font><br><br>";
				switch($cat_opt) {
					case(CAT_MOD_XSLT_GENERATE): {
						$s .= $this->generate();
						break;
					};	
					default: {
						$s .= $this->show();
					};			
				};
			};
			return $s;
		}
	
	};

?>