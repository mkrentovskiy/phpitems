<?
    
	//
	//
	// 	
	require_once("objects/file.php");

    class TxtFile extends File
    {
	function TxtFile($fname)
	{
	    $this->File($fname);
	}
	
	function readString()
	{
	    if($this->id != 0) 
		if($this->rowcount < count($this->content)) 
		    return $this->content[$this->rowcount++];   
		else return FALSE;
	}
	
	function writeString($str)
	{
	    if($this->id != 0) {
		fwrite($this->id,$str);
	    } else return FALSE;
	}
	
	function readAll()
	{
	    if($this->id != 0) {
		$i = 0;
		while(!feof($this->id)) $this->content[$i++] = fgets($this->id,1024);
		$all = '';    
		for($i = 0; $i < count($this->content); $i++) 
		    $all .= $this->content[$i];	
		return $all;
	    };
	}
	
	function writeAll($data)
	{
	    if($this->id != 0) {
		$i = 0;
		while($i < count($data)) {
		    writeString($data[$i++]);
		};
	    };
	}
	
    };




?>