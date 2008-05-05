<?
	require_once("objects/domains/_base.php");

	class DomCalendar extends DomBase
	{
		function DomCalendar($str) 
		{
			$this->DomBase($str);
			$this->title = $GLOBALS[cat_m_dom_calendar];

			$this->sql = $this->name.' datetime';
			$this->valid = true;
		}

		function getFromInput()
		{
	    		$dd = $this->name.'_date';
	    		$dh = $this->name.'_hour';
	    		$di = $this->name.'_minute';
	    		$ds = $this->name.'_second';

	   		$d = $GLOBALS['dom_'.$dd];
	    		$h = $GLOBALS['dom_'.$dh];
	    		$i = $GLOBALS['dom_'.$di];
	    		$s = $GLOBALS['dom_'.$ds];
	    
	    		$res = $d." ";
			$res .= sprintf("%d:%02d:%02d",$h,$i,$s);
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
	    		list($ch,$cm,$cs) = explode(':',$tm);

	    		$s .= "<input type='text' name='dom_".$this->name."_date' size='10' value='$dt' id='".$this->name."_date'/><a href='#' onClick='return showCalendar(\"".$this->name."_date\", \"y-mm-dd\");'><img src='images/c.gif' border='0'/></a>";

	    		$s .= "&nbsp;&nbsp;<select name='dom_".$this->name."_hour' size=1>";
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