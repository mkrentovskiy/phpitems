<?
	require_once("objects/domains/_base.php");

	class DomPhotoLink extends DomBase
	{
		var	$x, $y, $x1, $y1;
		
		function DomPhotoLink($str) 
		{
			$this->DomBase($str);
			$this->title = $GLOBALS[cat_m_dom_photolink];

			$this->x = 0;
			$this->y = 120;
			$this->x1 = 300;
			$this->y1 = 0;

			if(strlen($str['addin']) > 1) {
				list($this->x, $this->y, $this->x1, $this->y1) = explode(':',$str['addin']);
			};
			
			$this->sql = $this->name.' char('.$str['param'].')';
			if(!file_exists("../photo")) @mkdir("../photo",0777);
			if(!file_exists("../photo/tumb")) @mkdir("../photo/tumb",0777);
			$this->valid = true;
		}

		function getFromInput()
		{
			global	$cat_max_fid;

	        	$oname = $GLOBALS['dom_old_'.$this->name];
			$fname = $GLOBALS['dom_'.$this->name];
			$cname = $GLOBALS['dom_'.$this->name.'_name'];
			$nname = "../photo/or_".$cname;
			$sname = "../photo/".$cname;

			if(strlen($oname) > 0) {
				if(strlen($cname) > 0 && $fname != 'none') {
					if(file_exists('../photo/'.$oname)) { 
						@unlink('../photo/'.$oname);
						@unlink('../photo/tumb/'.$oname);
					};

					if(file_exists($nname)) {
						for($i = 0; $i < $cat_max_fid; $i++) 
							if(!file_exists("../photo/".$i."_".$cname)) break;
						$nname = "../photo/or_".$i."_".$cname;
						$sname = "../photo/".$i."_".$cname;
						$cname = $i."_".$cname;
					};

    					@move_uploaded_file($fname, $nname);
                        
					$img = new Image_Toolbox($nname);
					$img->newOutputSize(intval($this->x),intval($this->y));
					$img->save("../photo/tumb/".$cname,'jpg');

					$img = new Image_Toolbox($nname);
					$img->newOutputSize(intval($this->x1),intval($this->y1));
					$img->save($sname,'jpg');

					return $cname;
				};
			} else {
				if(strlen($cname) > 0 && $fname != 'none') {
					if(file_exists($nname)) {
						for($i = 0; $i < $cat_max_fid; $i++) 
							if(!file_exists("../photo/".$i."_".$cname)) break;
						$nname = "../photo/or_".$i."_".$cname;
						$sname = "../photo/".$i."_".$cname;
						$cname = $i."_".$cname;
					};
			
    					@move_uploaded_file($fname, $nname);

					$img = new Image_Toolbox($nname);
					$img->newOutputSize(intval($this->x),intval($this->y));
					$img->save("../photo/tumb/".$cname,'jpg');

					$img = new Image_Toolbox($nname);
					$img->newOutputSize(intval($this->x1),intval($this->y1));
					$img->save($sname,'jpg');

					return $cname;
				};
			};
			return '';
		}

		function onShow($str)
		{
			$s = "<tr><td class='einfo' align='right' valign='top'>".$this->info."</td>";
			$s .= "<td class='eedit' align='justify' valign='top'><a href='../photo/".$str[$this->name]."'>";
			$s .= "<img src='../photo/tumb/".$str[$this->name]."' border='0'></a></td></tr>";
			return $s;	
		}

		function onList($str,$class)
		{
			$s = '';
			if($this->onlist) $s = "<td class='$class'><img src='../photo/tumb/".$str[$this->name]."' border='0'></td>";
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
			$s .= "</font></td><td class='eedit' width='50%' valign='top'><input type='file' name='dom_$this->name' size='40'>";
			if(strlen($str[$this->name]) > 1 && file_exists("../photo/tumb/".$str[$this->name])) $s .= "<br><br><img src='../photo/tumb/".$str[$this->name]."' border='0'></td></tr>";
			$s .= "<input type='hidden' name='dom_old_$this->name' value='$val'>";
			$s .= "<input type='hidden' name='MAX_FILE_SIZE' value='$cat_max_file_size'>";
			return $s;		
		}

		function onDelete($str)
		{
			$val = $str[$this->name];
			if(strlen($val) > 0 && file_exists('../photo/'.$val)) {
				@unlink('../photo/'.$val);
				@unlink('../photo/tumb/'.$val);
			};
		}	 


	};




?>