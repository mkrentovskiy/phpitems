<?
	require_once("objects/domains/_base.php");

	$fck_root = dirname($_SERVER["SCRIPT_FILENAME"]).'/objects/extern/fckeditor/';
	include $fck_root.'fckeditor.php';

	class DomVRichText extends DomBase
	{
		function DomVRichText($str) 
		{
			$this->DomBase($str);
			$this->title = $GLOBALS[cat_m_dom_vrichtext];

			$this->sql = $this->name.' text';
			$this->valid = true;
		}
		
		function onEditForm($str)
		{

			$s = "<tr><td class='einfo' align='center' valign='top' colspan='2'><font class='etitle'>";
			$s .= $this->info;
			$s .= "</font><br><font class='ecomment' valign='top'>";		
			$s .= $this->comment; 
			$s .= "</font></td></tr><tr><td class='eedit' colspan='2'>";
		
			$e = new FCKeditor('dom_'.$this->name);
			$e->BasePath = dirname($_SERVER["PHP_SELF"]).'/objects/extern/fckeditor/';
			$e->Value = $str[$this->name];
			$e->Config['SkinPath'] = $e->BasePath . 'editor/skins/silver/' ;
			$s .= $e->CreateHtml();

			$s .= "</td></tr>";
			return $s;		
		}


		function getFromInput()
		{
			$s =  $GLOBALS['dom_'.$this->name];
	        	return $s;
		}

	};




?>