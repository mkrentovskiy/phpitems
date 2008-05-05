<?
	class MailMessage 
	{
		var $from;
		var $subject;
		var $info;
		var $filelist;
		var $fileitem;
		
		function MailMessage($from)
		{
			$this->from = $from;
			$this->subject = '';
			$this->info = '';
			$this->filelist = array();
			$this->fileitem = array();
		}

		function applyInfo($subject,$info)
		{
			$this->subject = $subject;
			$this->info .= $info;
		}

		function attach($filename)
		{
			if(file_exists($filename)) array_push($this->filelist, $filename);
		}

		function attachAsFile($filename, $content)
		{
			$this->fileitem[$filename] = $content;
		}
		
		function sendTo($to)
		{

			$un = strtoupper(uniqid(time()));

			$head = "From: ".$this->from."\n";
			$head .= "Reply-To: ".$this->from."\n";
			$head .= "Mime-Version: 1.0\n";
			$head .= "Content-Type:multipart/mixed;";
			$head .= "boundary=\"----------".$un."\"\n\n";
		
			$zag = "------------".$un."\nContent-Type:text/html; charset=UTF-8\n";
			$zag .= "Content-Transfer-Encoding:base64\n\n".chunk_split(base64_encode($this->info))."\n\n";

			foreach($this->filelist as $fn) {
				$f = fopen($fn,"rb");
				$zag .= "------------".$un."\n";
				$zag .= "Content-Type: application/octet-stream;";
				$zag .= "name=\"".basename($fn)."\"\n";
				$zag .= "Content-Transfer-Encoding:base64\n";
				$zag .= "Content-Disposition:attachment;";
				$zag .= "filename=\"".basename($fn)."\"\n\n";
				$zag .= chunk_split(base64_encode(fread($f,filesize($fn))))."\n";
			}
			
			foreach($this->fileitem as $fn => $c) {
				$zag .= "------------".$un."\n";
				$zag .= "Content-Type: application/octet-stream;";
				$zag .= "name=\"".$fn."\"\n";
				$zag .= "Content-Transfer-Encoding:base64\n";
				$zag .= "Content-Disposition:attachment;";
				$zag .= "filename=\"".$fn."\"\n\n";
				$zag .= chunk_split(base64_encode($c))."\n";
			}
			
			@mail($to, $this->subject, $zag, $head);
		}
		
	};


?>