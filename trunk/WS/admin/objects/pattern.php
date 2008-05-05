<?

	//
	//
	//
	require_once("objects/txtfile.php");
 
    class Pattern extends TxtFile
    {
	var	$resultcode;
	var	$data;
	var	$h;	
    
	function Pattern($pfilename)
	{
	    $this->filename = $pfilename;	    
	    $this->open('r');
	    $this->data = $this->readAll();
	    $this->resultcode = explode('^',$this->data);
	}
	
	function reset()
	{
	    $this->resultcode = explode('^',$this->data);
	}
	
	function addHash($value,$object)
	{
	    $this->h[$value] = $object;
	}
	
	function makeDataCode()
	{
	    for($i = 0; $i < count($this->resultcode); $i++)
		$this->resultcode[$i] = $this->parse($this->resultcode[$i]);
	}
	
	function outDataCodeToFile($filename)
	{
	    $out = new TxtFile($filename);
	    $out->open('w+');
	    for( $i = 0; $i < count($this->resultcode); $i++)
		$out->writeString($this->resultcode[$i]);        
	}
	        
	function outDataCodeToStd()
	{
	    for( $i = 0; $i < count($this->resultcode); $i++)
		print $this->resultcode[$i];        
	}
	        
	function outDataCode()
	{
	    $tmp = '';
	    for( $i = 0; $i < count($this->resultcode); $i++)
		$tmp .= $this->resultcode[$i];
	    return $tmp;        
	}
	
	function parse($str)
	{
	    if(is_object($this->h[$str])) 
		return $this->h[$str]->generateCode($str); 
	    else 
		if(strlen($this->h[$str]) != 0) return $this->h[$str];
	    else 
		return $str;
	}
	
    };
    


?>