<?
	require_once("objects/domains/_base.php");

	class DomBool extends DomBase
	{
		function DomBool($str) 
		{
			$this->DomBase($str);
			$this->title = $GLOBALS[cat_m_dom_bool];

			$this->sql = $this->name.' bool';
			$this->valid = true;
		}
		function getFromInput()
		{
			if($GLOBALS['dom_'.$this->name] == 'on') return 1;
	        	else return 0;
		}
		
		function onEditForm($str)
		{
			$val = $str[$this->name];
			$s = "<tr><td class='einfo' width='50%' align='right' valign='top'><font class='etitle'><label for='id_$this->name'>";
			$s .= $this->info;
			$s .= "</label></font><br><font class='ecomment'>";		
			$s .= $this->comment; 
			$s .= "</font></td><td class='eedit' width='50%' valign='top'><input type='checkbox' name='dom_$this->name' id='id_$this->name'";
	        	if($val) $s .= " checked"; 
			$s .= "></td></tr>";
			return $s;		
		}

	};




?>