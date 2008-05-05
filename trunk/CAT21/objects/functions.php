<?
   	function dateToStr($value)
    	{
		global $cat_m_month; 
	    
		list($d,$t) = explode(' ',$value);
		$date = explode('-',$d);
		$res = $date[2].' '.$cat_m_month[$date[1]-1].' '.$date[0].' ['.$t.']';
		return $res;
	};

   	function dateToStrDO($value)
    	{
		global $cat_m_month; 
	    
		list($d,$t) = explode(' ',$value);
		$date = explode('-',$d);
		$res = floor($date[2]).'.'.$date[1].'.'.$date[0];
		return $res;
	};

	function fileToString($filename) 
	{
		if(file_exists($filename)) $f = file($filename);
		$s = '';
		for($i = 0; $i < count($f); $i++) $s .= $f[$i];
		return $s;		
	}


?>