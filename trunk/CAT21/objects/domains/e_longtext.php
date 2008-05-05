<?
	require_once("objects/domains/_base.php");

	class DomLongText extends DomBase
	{
		function DomLongText($str) 
		{
			$this->DomBase($str);
			$this->title = $GLOBALS[cat_m_dom_longtext];

			$this->sql = $this->name.' text';
			$this->valid = true;
		}
		
		function onEditForm($str)
		{
			$val = $str[$this->name];
			$s = "<tr><td class='einfo' width='50%' align='right' valign='top'><font class='etitle'>";
			$s .= $this->info;
			$s .= "</font><br><font class='ecomment' valign='top'>";		
			$s .= $this->comment; 
			$s .= "</font></td><td class='eedit' width='50%'>";
			$s .= "<textarea name='dom_$this->name' rows='30' cols='60'>$val</textarea>";
			$s .= "</td></tr>";
			return $s;		
		}

	};




?>