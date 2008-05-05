<?
	class XMLPage 
	{
		var     $xml;
		
		function XMLPage()
		{
			$this->xml = "";
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
			
			if(strlen($this->xml) < 2) {
				$this->xml = "<simple><relocate url='?'/></simple>";				
			}

			$this->xml = "<?xml version='1.0' encoding='utf-8'?>\n".$this->xml;

			if($GLOBALS['DEBUG']) print "\n".nl2br(htmlspecialchars($this->xml));			
			
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
	};


?>