<?
	require_once("objects/domains/_base.php");

	class DomImageLink extends DomBase
	{
		function DomImageLink($str) 
		{
			$this->DomBase($str);
			$this->title = $GLOBALS[cat_m_dom_imagelink];
			
			$this->sql = $this->name.' char('.$str['param'].')';
			if(!file_exists("../images")) @mkdir("../images",777);
			if(!file_exists("../images/$this->table")) @mkdir("../images/$this->table",1777);
			$this->valid = true;
		}

		function getFromInput()
		{
			global	$cat_max_fid, $cat_dir_images;

	        	$oname = $GLOBALS['dom_old_'.$this->name];
	        	$tname = $GLOBALS['dom_txt_'.$this->name];
			$fname = $GLOBALS['dom_'.$this->name];
			$cname = $GLOBALS['dom_'.$this->name.'_name'];
			$nname = "$cat_dir_images/$this->table/".$cname;

			if(strlen($oname) > 0) {
				if(strlen($cname) > 0 && $fname != 'none') {
					if(file_exists('../'.$oname)) @unlink('../'.$oname);
					if(file_exists("../$nname")) {
						for($i = 0; $i < $cat_max_fid; $i++) if(!file_exists("../$cat_dir_images/$this->table/".$i."_".$cname)) break;
						$nname = "$cat_dir_images/$this->table/".$i."_".$cname;
					};
    					@move_uploaded_file($fname, "../$nname");
					return $nname;
				} else {
					if($tname != $oname) {
						if(file_exists('../'.$oname)) @unlink('../'.$oname);
						return $tname;
					} else return $tname;
				};
			} else {
				if(strlen($cname) > 0 && $fname != 'none') {
					if(file_exists("../$nname")) {
						for($i = 0; $i < $cat_max_fid; $i++) if(!file_exists("../$cat_dir_images/$this->table/".$i."_".$cname)) break;
						$nname = "$cat_dir_images/$this->table/".$i."_".$cname;
					};
    					@move_uploaded_file($fname, "../$nname");
					return $nname;
				} else return $tname;
			};
		}

		function onShow($str)
		{
		        global $cat_max_show_width,$cat_max_show_height;
			$types = array('?','GIF','JPG','PNG','SWF','PSD','BMP','TIFF','TIFF','JPC','JP2','JPX','JB2','SWC','IFF');			

			$s = "<tr><td class='einfo' align='right' valign='top'>".$this->info."</td>";
			$s .= "<td class='eedit' align='justify' valign='top'>";
			$s .= "<a href='../".$str[$this->name]."' target='_blank'>".basename($str[$this->name])."</a><br>";
			if(file_exists('../'.$str[$this->name]))
			{
				$z = @getimagesize('../'.$str[$this->name]);
				$n = $z[2];
				$x = ceil(filesize('../'.$str[$this->name]) / 1024);
				$s .= "$GLOBALS[cat_m_type]: ".$types[$n]."<br>$GLOBALS[cat_m_size]: $z[0] x $z[1] [$x KB]";
				if($z[0] < $cat_max_show_height && $z[1] < $cat_max_show_height)
					$s .= "<br><img src='../".$str[$this->name]."' border='0' alt='$this->info' title='$this->info'>";
			} else $s .= $GLOBALS[cat_m_notfound];
			$s .= "&nbsp;</td></tr>";
			return $s;	
		}

		function onList($str,$class)
		{
			$s = '';
			if($this->onlist) $s = "<td class='$class'><a href='../".$str[$this->name]."' target='_blank'>".basename($str[$this->name])."</a></td>";
			return $s;
		}
		
		function onEditForm($str)
		{
			global	$cat_max_file_size;

			$val = $str[$this->name];
			$s = "<tr><td class='einfo' width='50%' align='right' valign='top'><font class='etitle'>";
			$s .= $this->info;
			$s .= "</font><br><font class='ecomment'>";		
			$s .= $this->comment; 
			$s .= "</font></td><td class='eedit' width='50%' valign='top'><input type='file' name='dom_$this->name' size='40'><br>$GLOBALS[cat_m_or_path]<br>";
			$s .= "<input type='text' name='dom_txt_$this->name' maxlength='$this->param' size='60' value='$val'></td></tr>";
			$s .= "<input type='hidden' name='dom_old_$this->name' value='$val'>";
			$s .= "<input type='hidden' name='MAX_FILE_SIZE' value='$cat_max_file_size'>";
			return $s;		
		}

		function onDelete($str)
		{
			$val = $str[$this->name];
			if(strlen($val) > 0 && file_exists('../'.$val)) {
				@unlink('../'.$val);
			};
		}	 


	};




?>