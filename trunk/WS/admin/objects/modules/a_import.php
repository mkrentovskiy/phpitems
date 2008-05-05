<?
	require_once("objects/modules/_base.php");

	define('CAT_MOD_IMPORT',1);

	class ModImport extends ModBase
	{				
		function ModImport() 
		{
			$this->ModBase();
			$this->title = $GLOBALS[cat_m_mod_import];
		}
	
		function show()
		{
			global $cat_max_file_size;
			
			$s .= "<table border='0' cellpadding='5' cellspacing='1' width='100%' class='pt9'>";
			$s .= "<form enctype='multipart/form-data' action='".$this->URL."&cat_opt=".CAT_MOD_IMPORT."' method='post' name='rf'>";
			$s .= "<td class='einfo' align='left'>";
			$s .= "<input type='file' name='i_upload' size='40'>";
			$s .= "<img src='images/spacer.gif' width='10' height='2' border='0' alt=''>";
			$s .= "<input type='submit' class='sub' value='&#9658;'$ea>";
			$s .= "</td></tr></form>";
			$s .= "</table><br>";

			return $s;		
		}
				
		function generate()
		{					

			global	$cat_db;
			
			$s = "<table border='0' cellpadding='15' cellspacing='1' width='100%' class='pt9'>";
			$s .= "<tr><td class='einfo' align='left'><pre>";

			if(strlen($GLOBALS['i_upload']) > 1) {
				@unlink('../files/data.xml');
				move_uploaded_file($GLOBALS['i_upload'],'../data.xml');
				
				$t = new ExcelImport;
    				$s .= $t->parseXMLParams(implode('', file("../data.xml")));		
			};

			$s .= "</pre></td></tr>";
			$s .= "</table>";
			return $s;
		}		



		function execute($user)
		{
			global	$cat_opt;

			$s = '';			
			if($user->isEdit('ModImport')) {
 				$s = "<font class='title'>$GLOBALS[cat_m_mod_import]</font><br><br>";
				switch($cat_opt) {
					case(CAT_MOD_IMPORT): {
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