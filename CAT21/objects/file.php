<?
	//
	//
	// 	

    class File
    {
	var $filename;
	var $id;
	var $content;
	var $position;
	var $rowcount;
	
	function File($fname)
	{
	    $this->filename = $fname;
	    $this->id = 0;
	}
	
	function open($mode)
	{
	    if(strlen($this->filename) != 0) {
		$this->id = fopen($this->filename,$mode); 
		$this->content = file($this->filename);
		$this->rowcount = 0;
		$this->position = 0;
	    };
	}
	
	function close()
	{
	    if($this->id != 0) fclose($this->id);
	}
	
	function seek($position)
	{
	    return fseek($this->id,$position);
	}
	
	function readString() {}
	function writeString($str) {}
	function readAll() {}
	function writeAll($data) {}
	
	function generateCode()
	{
	    return $this->readAll();
	}

	function getBase64enc()
	{ 
	    return base64_encode($this->readAll()); 
	}
	
	function putBase64dec($data)
	{
	    $this->writeAll(base64_decode($data));
	}
	
	function pass()
	{
	    return fpassthru($this->id);
	}	
	
    };
    

?>