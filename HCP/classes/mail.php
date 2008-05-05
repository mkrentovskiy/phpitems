<?
	class MailMessage 
	{
		var     $from;
		var	$subject;
		var	$info;
		var	$filelist;
		
		function MailMessage($from)
		{
			$this->from = $from;
			$this->subject = '';
			$this->info = '';
			$this->filelist = array();
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

		function sendTo($to)
		{

			$un = strtoupper(uniqid(time()));

			$head = "From: ".$this->from."\n";
			$head .= "Reply-To: ".$this->from."\n";
			$head .= "Mime-Version: 1.0\n";
			$head .= "Content-Type:multipart/mixed;";
			$head .= "boundary=\"----------".$un."\"\n\n";
		
			$zag = "------------".$un."\nContent-Type:text/html; charset=Windows-1251\n";
			$zag .= "Content-Transfer-Encoding: 8bit\n\n".$this->info."\n\n";

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
			@mail($to, "=?Windows-1251?Q?".imap_8bit($this->subject)."?=", $zag, $head);
		}
		
	};


?>