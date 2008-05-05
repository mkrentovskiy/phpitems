<?
	require_once("objects/domains/_base.php");

	class DomEnum extends DomBase
	{
		var	$array;
			
		function DomEnum($str) 
		{
			$this->DomBase($str);

			$this->title = $GLOBALS[cat_m_dom_enum];

			$this->array = explode('|',$str['addin']);
			
			$this->sql = $this->name.' varchar('.$str['param'].')';
			$this->valid = true;
		}
		
		//
		//
		//

		function onEditForm($str)
		{
			$n = $str[$this->name];
			$s = "<tr><td class='einfo' width='50%' align='right' valign='top'><font class='etitle'>";
			$s .= $this->info;
			$s .= "</font><br><font class='ecomment'>";		
			$s .= $this->comment; 
			$s .= "</font></td><td class='eedit' width='50%' valign='top'><select name='dom_$this->name' size='1' style='width: 200px'>";

			foreach($this->array as $n) {
				if($str[$this->name] == $n) 
					$s .= "<option value='".htmlspecialchars($n)."' selected>".htmlspecialchars($n)."</option>";
		   		else 
					$s .= "<option value='".htmlspecialchars($n)."'>".htmlspecialchars($n)."</option>";
			};	
			$s .= "</select></td></tr>";		
			return $s;		
		}

	};




?>