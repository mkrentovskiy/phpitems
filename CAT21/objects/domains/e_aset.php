<?
	require_once("objects/domains/_base.php");

	class DomASet extends DomBase
	{
		var	$array;
			
		function DomASet($str) 
		{
			$this->DomBase($str);

			$this->title = $GLOBALS[cat_m_dom_aset];

			$this->array = explode(';',$str['addin']);
			
			$this->sql = $this->name.' int('.$str['param'].')';
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
			$s .= $this->array[$n - 1];
			$s .= "&nbsp;</td></tr>";
			return $s;	
		}

		function onList($str,$class)
		{
			if(!$this->onlist) return '';
			$n = $str[$this->name];
			if($this->onlist) $s = "<td class='$class'>".$this->array[$n - 1]."</td>";
			return $s;
		}


		function onEditForm($str)
		{
			$n = $str[$this->name];
			$s = "<tr><td class='einfo' width='50%' align='right' valign='top'><font class='etitle'>";
			$s .= $this->info;
			$s .= "</font><br><font class='ecomment'>";		
			$s .= $this->comment; 
			$s .= "</font></td><td class='eedit' width='50%' valign='top'><select name='dom_$this->name' size='1' style='width: 200px'>";
			for($i = 0; $i < count($this->array); $i++) {
				$j = $i + 1;
				if($j == $n) 
					$s .= "<option value='$j' selected> ".$this->array[$i];
		   		else 
					$s .= "<option value='$j'> ".$this->array[$i];
			};	
			$s .= "</select></td></tr>";		
			return $s;		
		}

		function onSelect($str)
		{
			$n = $str[$this->name];
			if($this->onselect) $s = $this->array[$n - 1];
			return $s;
		}

	};




?>