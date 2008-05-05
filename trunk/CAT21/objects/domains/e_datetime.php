<?
	require_once("objects/domains/_base.php");

	class DomDateTime extends DomBase
	{
		function DomDateTime($str) 
		{
			$this->DomBase($str);
			$this->title = $GLOBALS[cat_m_dom_datetime];

			$this->sql = $this->name.' datetime';
			$this->valid = true;
		}

		function getFromInput()
		{
	    		$ym = $this->name.'_year';
	    		$mm = $this->name.'_month';
	    		$dm = $this->name.'_day';
	    		$dh = $this->name.'_hour';
	    		$di = $this->name.'_minute';
	    		$ds = $this->name.'_second';

	   		$y = $GLOBALS['dom_'.$ym];
	    		$m = $GLOBALS['dom_'.$mm];
	    		$d = $GLOBALS['dom_'.$dm];
	    		$h = $GLOBALS['dom_'.$dh];
	    		$i = $GLOBALS['dom_'.$di];
	    		$s = $GLOBALS['dom_'.$ds];
	    
	    		$res = sprintf("%04d-%02d-%02d %d:%02d:%02d",$y,$m,$d,$h,$i,$s);
	    		return $res;
		}

		function onShow($str)
		{
			$s = "<tr><td class='einfo' align='right' valign='top'>".$this->info."</td>";
			$s .= "<td class='eedit' align='justify' valign='top'>";
			$s .= dateToStr($str[$this->name]);
			$s .= "&nbsp;</td></tr>";
			return $s;
		}

		function onList($str,$class)
		{
			if(!$this->onlist) return '';
			$s = "<td class='$class'>".dateToStr($str[$this->name])."</td>";
			return $s;
		}

		function onInsertForm($str)
		{
			if(strlen($str[$this->name]) == 0) $str[$this->name] = date("Y-m-d H:i:s");
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

	   		list($dt,$tm) = explode(' ',$val);	    
	    		$date = explode('-',$dt);
	    		list($ch,$cm,$cs) = explode(':',$tm);

	    		$s .= "<select name='dom_".$this->name."_day' size=1>";
	    		for($i = 1; $i < 32; $i++) {
				if($i == $date[2])
		    			$s .= "<option value='$i' selected> $i";	
				else
		    			$s .= "<option value='$i'> $i";	
	    		};
	    		$s .= "</select>.<select name='dom_".$this->name."_month' size=1>";
	    		for($i = 1; $i < count($cat_m_month) + 1; $i++) {
				$j = $i - 1;
				if($i == $date[1])
		    			$s .= "<option value='$i' selected> $cat_m_month[$j]";	
				else
		    			$s .= "<option value='$i'> $cat_m_month[$j]";	
	    		};
	    		$s .= "</select>.<select name='dom_".$this->name."_year' size=1>";
	    		for($i = 0; $i < count($cat_m_years); $i++) {
				if($cat_m_years[$i] == $date[0])
		    			$s .= "<option value='$cat_m_years[$i]' selected> $cat_m_years[$i]";	
				else
		    			$s .= "<option value='$cat_m_years[$i]'> $cat_m_years[$i]";	
	    		};
	    		$s .= "</select>&nbsp;<select name='dom_".$this->name."_hour' size=1>";
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