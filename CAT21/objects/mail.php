<?
	class MailMessage 
	{
		var $from;
		var	$subject;
		var	$info;
		var	$filelist;
		var $asfile;
		
		function MailMessage($from)
		{
			$this->from = $from;
			$this->subject = '';
			$this->info = '';
			$this->filelist = array();
			$this->asfile = array();
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
			$a = array();
			$a['filename'] = $filename;
			$a['content'] = $content;
			array_push($this->asfile, $a);
		}
		
		function sendTo($to)
		{

			$un = strtoupper(uniqid(time()));

			$head = "From: ".$this->from."\n";
			// $head .= "To: $to\n";
			// $head .= "Subject: ".$this->subject."\n";
			$head .= "Reply-To: ".$this->from."\n";
			$head .= "Mime-Version: 1.0\n";
			$head .= "Content-Type:multipart/mixed;";
			$head .= "boundary=\"----------".$un."\"\n\n";
		
			$zag = "------------".$un."\nContent-Type:text/html; charset=utf-8\n";
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
				fclose($f);
			}
			
			foreach($this->asfile as $z) {
				$zag .= "------------".$un."\n";
				$zag .= "Content-Type: application/octet-stream;";
				$zag .= "name=\"".$z['filename']."\"\n";
				$zag .= "Content-Transfer-Encoding:base64\n";
				$zag .= "Content-Disposition:attachment;";
				$zag .= "filename=\"".$z['filename']."\"\n\n";
				$zag .= chunk_split(base64_encode($z['content']))."\n";
			}
		
			@mail($to, "=?utf-8?Q?".imap_8bit($this->subject)."?=", $zag, $head);
		}
		
	};


?>