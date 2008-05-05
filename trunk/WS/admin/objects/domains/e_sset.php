<?
	require_once("objects/domains/_base.php");

	class DomSSet extends DomBase
	{
		var	$array;
			
		function DomSSet($str) 
		{
			$this->DomBase($str);

			$this->title = $GLOBALS[cat_m_dom_sset];

			$a = explode(';',$str['addin']);
			for($i = 0; $i < count($a); $i++) {
				list($k,$v) = explode('=',$a[$i]);
				$this->array[$k] = $v;
			};
			
			$this->sql = $this->name.' char('.$str['param'].')';
			$this->valid = true;
		}
		
		//
		//
		//


		function onShow($str)
		{	
			$s = "<tr><td class='einfo' align='right' valign='top'>".$this->info."</td>";
			$s .= "<td class='eedit' align='justify' valign='top'>";
			$n = $str[$this->name];
			$s .= $this->array[$n];
			$s .= "&nbsp;</td></tr>";
			return $s;	
		}

		function onList($str,$class)
		{
			if(!$this->onlist) return '';
			$n = $str[$this->name];
			if($this->onlist) $s = "<td class='$class'>".$this->array[$n]."</td>";
			return $s;
		}

		function onEditForm($str)
		{
			$val = $str[$this->name];
			$s = "<tr><td class='einfo' width='50%' align='right' valign='top'><font class='etitle'>";
			$s .= $this->info;
			$s .= "</font><br><font class='ecomment'>";		
			$s .= $this->comment; 
			$s .= "</font></td><td class='eedit' width='50%' valign='top'><select name='dom_$this->name' size='1' style='width: 200px'>";
			reset($this->array);
			for($i = 0; $i < count($this->array); $i++) {
				$p = each($this->array);
				if($p[value] == $val) 
					$s .= "<option value='$p[key]' selected> ".$p[value];
		   		else 
					$s .= "<option value='$p[key]'> ".$p[value];
			};	
			$s .= "</select></td></tr>";		
			return $s;		
		}

		function onSelect($str)
		{
			$n = $str[$this->name];
			if($this->onselect) $s = $this->array[$n];
			return $s;
		}

	};




?>