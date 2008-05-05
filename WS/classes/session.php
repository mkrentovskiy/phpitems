<?
	// error_reporting (E_ALL);	

	//
	//
	//

	class Session
    	{
		var		$id;
		var		$name;
	
		function Session()
		{
			session_start();
	    		$this->name = session_name();
	    		$this->id = session_id();
		}
	
		function register($name)
		{
	    		return session_register($name);
		}
	
		function unregister($name)
		{
	    		return session_unregister($name);
		}
	
		function isRegistered($name)
		{
	    		return session_is_registered($name);
		}
	
		function set($name,$value)
		{
			if(!$this->isRegistered($name))	$this->register($name);
			$_SESSION[$name] = $value;
		}
	
		function get($name)
		{
	    		return $_SESSION[$name];
		}

		function getId()
		{
	    		return $this->id;
		}
	
		function getURLAdd()
		{
	    		return $this->name."=".$this->id;
		}
	
		function commit()
		{
	   		session_write_close();
		}
    };

?>