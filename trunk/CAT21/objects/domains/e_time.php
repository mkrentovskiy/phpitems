<?

	class DomTime extends DomBase
	{
		function DomTime($str) 
		{
			$this->DomBase($str);
			$this->title = $GLOBALS[cat_m_dom_time];

			$this->sql = $this->name.' time';
			$this->valid = true;
		}

		function getFromInput()
		{
	    		$dh = $this->name.'_hour';
	    		$di = $this->name.'_minute';
	    		$ds = $this->name.'_second';

	    		$h = $GLOBALS['dom_'.$dh];
	    		$i = $GLOBALS['dom_'.$di];
	    		$s = $GLOBALS['dom_'.$ds];
	    
	    		$res = sprintf("%d:%02d:%02d",$h,$i,$s);
	    		return $res;
		}

		function onShow($str)
		{
			$s = "<tr><td class='einfo' align='right' valign='top'>".$this->info."</td>";
			$s .= "<td class='eedit' align='justify' valign='top'>";
			$s .= $str[$this->name];
			$s .= "&nbsp;</td></tr>";
			return $s;
		}

		function onList($str,$class)
		{
			if(!$this->onlist) return '';
			$s = "<td class='$class'>".$str[$this->name]."</td>";
			return $s;
		}

		function onInsertForm($str)
		{
			if(strlen($str[$this->name]) == 0) $str[$this->name] = date("H:i:s");
			return $this->onEditForm($str);
		}
		
		function onEditForm($str)
		{
			global 	$cat_m_month, $cat_m_years;			

			$val = $str[$this->name];

			$s = "<tr><td class='einfo' width='50%' align='right' valign='top'><font class='etitle'>";
			$s .= $this->info;
			$s .= "</font><br><font class='ecomment'>";		
			$s .= $this->comment; 
			$s .= "</font></td><td class='eedit' width='50%' valign='top'>";

	    		list($ch,$cm,$cs) = explode(':',$val);

	    		$s .= "<select name='dom_".$this->name."_hour' size=1>";
	    		for($i = 0; $i < 24; $i++) {
				if($i == $ch)
		    			$s .= "<option value='$i' selected> $i";	
				else
		    			$s .= "<option value='$i'> $i";	
	    		};
	    		$s .= "</select>:<select name='dom_".$this->name."_minute' size=1>";
	    		for($i = 0; $i < 60; $i++) {
				if($i == $cm)
		    			$s .= "<option value='$i' selected> $i";	
				else
				    	$s .= "<option value='$i'> $i";	
	    		};
	    		$s .=  "</select>:<select name='dom_".$this->name."_second' size=1>";
	    		for($i = 0; $i < 60; $i++) {
				if($i == $cs)
		    			$s .= "<option value='$i' selected> $i";	
				else
		    			$s .= "<option value='$i'> $i";	
	    		};
	    		$s .= "</select></td></tr>";
			return $s;		
		}


	};




?>