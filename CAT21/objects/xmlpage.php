<?
	class XMLPage 
	{
		var		$file;
		var     $xml;
		
		function XMLPage($file)
		{
			$this->xml = "";
			$this->file = $file;
		}
		
		function add($xml)
		{
			$this->xml .= $xml;
		}

		function addFile($file)
		{
			if(file_exists($file))
				$this->xml .= implode('',file($file));
		}

		function process($xslt)
		{

			$this->xml = "<?xml version='1.0' encoding='utf-8'?>\n".$this->xml;

			$xsl = implode('',file($xslt));
			
			if(version_compare(PHP_VERSION,'5','>=')) {
				$xh = new XSLTProcessor;
								
				$xmlo = new DOMDocument('1.0','utf-8');
				$xmlo->loadXML($this->xml);
				
				$xslo = new DOMDocument('1.0','utf-8');
    			$xslo->loadXML($xsl);
				
				$xh->importStyleSheet($xslo);
				$res = $xh->transformToXML($xmlo);

			} else {
				$arguments = array(
				     '/_xml' => $this->xml,
			    	 '/_xsl' => $xsl
				);

				$xh = xslt_create();
				xslt_set_base($xh,'file://'.dirname(__FILE__));
				$res = xslt_process($xh, 'arg:/_xml', 'arg:/_xsl', NULL, $arguments); 			
				xslt_free($xh);							
			}
			return $res;
		}				
		
		function toFile($basedir, $xsl)
		{
			if(strlen($this->file) > 0) {
				$f = fopen($basedir.'/'.$this->file, "w");	
				if($f) {
					$s = $this->process($xsl);
					fputs($f, $s);
					fclose($f);
					
					return $this->file;
				}
			}
			return '';
		}
	};


?>