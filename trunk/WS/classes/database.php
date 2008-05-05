<?

 	class Database {

		var $cid;
		var	$dbase;
		var	$result;
		var	$numrows;
  
	  	function DataBase()
		{
      			$this->cid = FALSE;
	      		$this->numrows = 0;
	  	}	
 
	  	function connect($db_host, $db_user, $db_password, $db, $names = 'utf8')
	  	{
	        if(!$this->cid) {
          			$this->cid = @mysql_connect($db_host, $db_user, $db_password);			
				if(mysql_select_db($db)) {
					$this->dbase = $db;
					mysql_query("SET NAMES '$names'");
				} 			
			}
			return $this->cid;
	  	}
  
	  	function disconnect() 
	  	{
			if($this->cid) {
	        	if(mysql_close($this->cid)) {
		      		$this->cid = false;
			      	return true;
				} else return false;
			} else return true;
	  	}
  
	  
		function query($user_query)
	  	{
	      	if($GLOBALS['DEBUG']) print $user_query.'<br>';	
	      	$res = array();

			if($this->numrows != 0) mysql_free_result($this->result);
      		
			$this->result = mysql_query($user_query);
      			
			if($this->result) {
              			$this->numrows = @mysql_num_rows($this->result);
	      			for($i = 0; $i < $this->numrows; $i++) 
					$res[$i] = $this->getNext();
      			} else {
          			$this->numrows=0;
      			};
	      		if($GLOBALS['DEBUG']) {
				print "<pre>";
				print_r($res);	
				print "</pre>";
			}
      			return $res;
  		}
  
  		function getNext()
  		{
      			if($this->numrows != 0)
          			return mysql_fetch_array($this->result);
      			return array();
  		}
    
  		function getErrorString()
  		{
      			return mysql_error();
  		}
  
  		function getResultSize()
  		{
      			return $this->numrows;
  		}

		function dump()
		{

			$d = '';
			$ct = 0;

			$tes = $this->query("show tables");
	
			foreach($tes as $tt) {
				$t = each($tt);
			
				//
				// Struct
				//
				$d .= "\nDROP TABLE IF EXISTS `".$t[value]."`;\nCREATE TABLE `".$t[value]."` (\n";

				$ses = $this->query("show columns from ".$t[value]);

				$ct = count($ses);
				$ad = array();
				$ak = array();

				foreach($ses as $s) {
					$z = "\t$s[Field] $s[Type]";
					$z .= $s['Null'] == 'YES' ? " default NULL" : " not null";
					$z .= strlen($s['Default']) > 0 ? " default '$s[Default]'" : "";
					$z .= strlen($s['Extra']) > 0 ? " $s[Extra]" : "";
					array_push($ad,$z);								
					
					if($s['Key'] == 'PRI') array_push($ak,"\tPRIMARY KEY `$s[Field]`(`$s[Field]`)");								
					// if($s['Key'] == 'MUL') array_push($ak,"\tKEY `$s[Field]`(`$s[Field]`)");									 			
				};			

				$ses = $this->query("show keys from ".$t[value]);
	
				$kn = '';
				$az = array();
			
				foreach($ses as $s) {
					if($s['Key_name'] != $kn && strlen($kn) > 0) {					
						array_push($ak,"\t".($s['Non_unique'] == 0 ? "UNIQUE " : "")."KEY `$kn`(".implode(",",$az).")");
						$kn = $s['Key_name'];		
						$az = array();
					}	
					if(!in_array("`".$s['Column_name']."`",$az)) 
						array_push($az,"`".$s['Column_name']."`");		
				};

				if(strlen($kn) == 0) $kn = $s['Key_name'];			
				if(count($az) > 0) array_push($ak,"\tKEY `$kn`(".implode(",",$az).")");
			
				$d .= implode(",\n",array_merge($ad,$ak)); 
				$d .= ") TYPE=MyISAM;\n\n";
			
				//
				// Info
				//
			
				$des = $this->query("select * from ".$t[value]);

				foreach($des as $da) {
					$a = array();

					for($i = 0; $i < $ct; $i++) {
						$z = addslashes($da[$i]);
						$z = str_replace("\n",'\n',$z);
						$z = str_replace("\r",'\r',$z);
						$z = str_replace("\t",'\t',$z);
						array_push($a,"\"".$z."\"");					
					};
		
					$d .= "INSERT INTO `".$t[value]."` VALUES(";
					$d .= implode(",",$a);
					$d .= ");\n";
				};
			};
			print $d;		
		}

		function restore($file)
		{
			$f = implode("",file($file));
			$qs = explode(";\n",$f);
			
			foreach($qs as $q) {
				if(strlen($q) > 0) {
					$this->query($q);
					if(strlen($this->getErrorString()) > 1) $s .= $this->getErrorString()."<br>";
				};
			}
			return $s;
		}    
 	};


?>
