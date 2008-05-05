<?

	define('CAT_MOD_FM_EDIT',1);
	define('CAT_MOD_FM_STORE',2);
	define('CAT_MOD_FM_UPLOAD',3);
	define('CAT_MOD_FM_DELETE',4);
	define('CAT_MOD_FM_CREATE',5);

	class ModFileManager extends ModBase
	{				
		function ModFileManager() 
		{
			$this->ModBase();
			$this->title = $GLOBALS[cat_m_mod_fm];
		}
	
		function makeMenu($user)
		{
			$s = '';
			return $s;
		}

		function showDir()
		{
			global $cat_max_file_size, $cat_dir;
			
			$s = "<table border='0' cellpadding='2' cellspacing='1' width='100%' class='pt9'>";
			
			if(!isset($cat_dir) || strlen($cat_dir) == 0) $cat_dir = '..';
			else $cat_dir = $this->test($cat_dir);

			if(!file_exists($cat_dir) || !is_dir($cat_dir)) $cat_dir = '..';
				
			$d = dir($cat_dir);
			if($d == false) return '';

			$s .= "<tr>";
			$s .= "<td align='left' class='pt9' colspan='7'>";
			$s .= "$GLOBALS[cat_m_fm_dir]: <b>".$d->path."</b>";
			$s .= "</td></tr>";

			$s .= "<tr>";
			$s .= "<td class='header' align='center'>&nbsp;</td>";
			$s .= "<td class='header' align='center' width='60%'>$GLOBALS[cat_m_fm_file]</td>";
			$s .= "<td class='header' align='center'>$GLOBALS[cat_m_fm_time]</td>";
			$s .= "<td class='header' align='center'>$GLOBALS[cat_m_fm_rights]</td>";
			$s .= "<td class='header' align='center'>$GLOBALS[cat_m_fm_size]</td>";
			$s .= "<td align='center' colspan='2'>&nbsp;</td>";
			$s .= "</tr>";

			$fm_f = '';
			$fm_df = '';
	
			$k = '';
			
			while (false !== ($entry = $d->read())) {
				$fm_name = $cat_dir.'/'.$entry;
				$fm_type = filetype($fm_name);
				$fm_time = date("d-m-Y H:i:s", fileatime($fm_name));
				$fm_rights = fileperms($fm_name);
				$fm_size = filesize($fm_name); 
					
				switch($fm_type) {
						case('dir') : {
							if($entry == '.') {
								$url = $this->URL.'&cat_dir='.$d->path;
								// break;
							} else if($entry == '..') {
							        $url = $this->URL.'&cat_dir='.dirname($d->path);
								if(strlen(dirname($d->path)) < 2) $url = $this->URL;
							} else {
								$url = $this->URL.'&cat_dir='.$fm_name;
								$fm_df .= "<option value='$fm_name'>$entry</option>";
							};
							$s .= "<tr>";
							$s .= "<td class='eedit' align='center'><a href='$url'><img src='images/folder.gif' border='0' alt=''></a></td>";
							$s .= "<td class='eedit' align='left' width='40%'><a href='$url'>$entry</a></td>";
							$s .= "<td class='eedit' align='center'><nobr>$fm_time</nobr></td>";
							$s .= "<td class='eedit' align='center'>$fm_rights</td>";
							$s .= "<td class='eedit' align='right'>&nbsp;</td>";							
							$s .= "<td align='center'>&nbsp;</td>";
							$s .= "<td valign='top' align='center' width='15'><a href='#' onClick='if(confirm(\"$GLOBALS[cat_m_delete]?\")) window.location.href = \"".$this->URL."&cat_opt=".CAT_MOD_FM_DELETE."&cat_dir=$cat_dir&cat_file=$entry\"'><img src='images/delete.gif' border='0' alt='$GLOBALS[cat_m_delete]' title='$GLOBALS[cat_m_delete]'></a></td>";
							$s .= "</tr>";
							break;
						};
						case('file') : {
							$fm_df .= "<option value='$fm_name'>$entry</option>";
							$fm_f .= "<option value='$fm_name'>$entry</option>";
							$url = 'ext.php?cat_obj=ModFileManager&cat_method=getFile&cat_file='.$fm_name;
							$k .= "<tr>";
							$k .= "<td class='einfo' align='center'><a href='$url'><img src='images/generic.gif' border='0' alt=''></a></td>";
							$k .= "<td class='einfo' align='left' width='40%'><a href='$url'>$entry</a></td>";
							$k .= "<td class='einfo' align='center'><nobr>$fm_time</nobr></td>";
							$k .= "<td class='einfo' align='center'>$fm_rights</td>";
							$k .= "<td class='einfo' align='right'>".$this->num($fm_size)."</td>";							
							$k .= "<td valign='top' align='center' width='15'><a href='".$this->URL."&cat_opt=".CAT_MOD_FM_EDIT."&cat_dir=$cat_dir&cat_file=$entry'><img src='images/edit.gif' border='0' alt='$GLOBALS[cat_m_edit]' title='$GLOBALS[cat_m_edit]'></a></td>";
							$k .= "<td valign='top' align='center' width='15'><a href='#' onClick='if(confirm(\"$GLOBALS[cat_m_delete]?\")) window.location.href = \"".$this->URL."&cat_opt=".CAT_MOD_FM_DELETE."&cat_dir=$cat_dir&cat_file=$entry\"'><img src='images/delete.gif' border='0' alt='$GLOBALS[cat_m_delete]' title='$GLOBALS[cat_m_delete]'></a></td>";
							$k .= "</tr>";
							break;
						};
						default : {
							$k .= "<tr>";
							$k .= "<td class='einfo' align='center'><img src='images/unknown.gif' border='0' alt=''></td>";
							$k .= "<td class='einfo' align='left' width='60%'>$entry</td>";
							$k .= "<td class='einfo' align='center'><nobr>$fm_time</nobr></td>";
							$k .= "<td class='einfo' align='center'>$fm_rights</td>";
							$k .= "<td class='einfo' align='right'>".$this->num($fm_size)."</td>";							
							$k .= "<td align='center' colspan='2'>&nbsp;</td>";
							$k .= "</tr>";
							break;

						};
				};
			};

			$s .= $k;
			$d->close();

			/*
			$s .= "<tr>";
			$s .= "<td class='eedit' align='right' class='pt8' colspan='5'>";
			$s .= "<b>$GLOBALS[cat_m_fm_free]</b>: ".disk_free_space("../")."<br>";
			$s .= "<b>$GLOBALS[cat_m_fm_total]</b>: ".disk_total_space("../");
			$s .= "</td></tr>";
                        */
			$s .= "</table><br>";

			$s .= "<table border='0' cellpadding='5' cellspacing='1' width='100%' class='pt9'>";
			$s .= "<form enctype='multipart/form-data' action='".$this->URL."&cat_opt=".CAT_MOD_FM_UPLOAD."' method='post'>";
			$s .= "<input type='hidden' name='MAX_FILE_SIZE' value='$cat_max_file_size'>";
			$s .= "<input type='hidden' name='cat_dir' value='$cat_dir'>";
			$s .= "<td class='einfo' align='right' width='50%'>";
			$s .= "$GLOBALS[cat_m_fm_upload] <input type='file' name='fm_upload' size='10'>";
			$s .= " <input type='submit' class='sub' value='$GLOBALS[cat_m_action]'>";
			$s .= " </td></form>";			
			$s .= "<form action='".$this->URL."&cat_opt=".CAT_MOD_FM_CREATE."' method='post'>";
			$s .= "<td class='einfo' align='right' width='50%'>";
			$s .= "<input type='hidden' name='cat_dir' value='$cat_dir'>";
			$s .= "$GLOBALS[cat_m_fm_new] <input type='text' name='cat_file' size='24' maxlegth='255'>";
			$s .= " <input type='submit' class='sub' value='$GLOBALS[cat_m_action]'>";
			$s .= " </td></form></tr>";			
			/*
			$s .= "<form action='".$this->URL."&cat_opt=".CAT_MOD_FM_EDIT."' method='post'>";
			$s .= "<input type='hidden' name='cat_dir' value='$cat_dir'>";
			$s .= "<td class='eedit' align='right' width='50%'>";
			$s .= "$GLOBALS[cat_m_fm_edit] <select name='cat_file' size='1'>$fm_f</select>";
			$s .= " <input type='submit' class='sub' value='$GLOBALS[cat_m_action]'>";
			$s .= " </td></form>";			
			$s .= "<form action='".$this->URL."&cat_opt=".CAT_MOD_FM_DELETE."' method='post'>";
			$s .= "<input type='hidden' name='cat_dir' value='$cat_dir'>";
			$s .= "<td class='eedit' align='right' width='50%'>";
			$s .= "$GLOBALS[cat_m_fm_delete] <select name='cat_file' size='1'>$fm_df</select>";
			$s .= " <input type='submit' class='sub' value='$GLOBALS[cat_m_action]'>";
			$s .= " </td></form></tr>";			
			*/
			$s .= "</table><br><br>";
			return $s;		
		}

		function createFile()
		{
			global	$cat_db, $cat_file, $cat_dir;
			
			$s = '';
			$fl = $this->test($cat_dir.'/'.$cat_file);
			if(substr($fl,-1) == '/' && !file_exists($fl)) {
				@mkdir(substr($fl,0,-1),'1777');
				$cat_db->disconnect();
				header("Location: index.php?cat_pos=control&cat_mod=ModFileManager&cat_dir=$cat_dir");

			};
			if(!file_exists($fl) && is_writable($cat_dir)) {
				$f = @fopen($fl,"a");
				if($f > 0) {
					@fclose($f);
					// @chmod($fl,1666);
					// $cat_file = $fl;
					$s .= $this->editFile();
				};
			};
			return $s;
		}
		
		function editFile()
		{
			global	$cat_file, $cat_dir, $cat_max_file_size; 

			$s = '';
			$fl = $this->test($cat_dir.'/'.$cat_file);
			if(file_exists($fl) && filesize($fl) < $cat_max_file_size) {
				if(!is_writable($fl)) $ea = ' disabled';
				$f = @file($fl);
				$s .= "<table border='0' cellpadding='0' cellspacing='5' width='100%' class='pt9'>"; 	
				$s .= "<form action='".$this->URL."&cat_opt=".CAT_MOD_FM_STORE."' method='post'>";
				$s .= "<input type='hidden' name='cat_dir' value='$cat_dir'>";
				$s .= "<input type='hidden' name='cat_file' value='$cat_file'>";
				$s .= "<tr><td colspan='2'>";
				$s .= "$GLOBALS[cat_m_fm_edit]: <b>$cat_file</b> <br><textarea rows='30' cols='100' name='fm_file' style='WIDTH: 100%;'$ea>";
				for($i = 0; $i < count($f); $i++) $s .= htmlspecialchars($f[$i]);
				$s .= "</textarea></td></tr><tr><td width='100%' align='right'>";
				$s .= "<input type='submit' class='sub' value='$GLOBALS[cat_m_action]'$ea>&nbsp;";
				$s .= "</form></td><td>";						
				$s .= "<form action='".$this->URL."&cat_dir=$cat_dir' method='post'>";
				$s .= "<input type='submit' class='sub' value='$GLOBALS[cat_m_cancel]'$ea>";
				$s .= "</form></td></tr></table>";
			};
			return $s;
		}
		
		function storeFile()
		{
			global	$cat_file, $cat_dir, $fm_file; 

			$s = '';
			$fl = $cat_dir.'/'.$cat_file;
			if(file_exists($fl) && is_writable($fl)) {
				$f = @fopen($fl,"w");
				if($f > 0) {
					$z = explode('\n',$fm_file);
					for($i = 0; $i < count($z); $i++) fputs($f,stripslashes($z[$i]));
					fclose($f);
				};
			};
			return $s;
		}

		function uploadFile()
		{
			global	$cat_dir, $fm_upload, $fm_upload_name; 

			$s = '';
			$fl = $this->test($cat_dir.'/'.$fm_upload_name);
			if(!file_exists($fl)) {
    				@copy($fm_upload, $fl);
				// move_uploaded_file($fm_upload,$fl);
				// @chmod($fl,1666);
			};
			return $s;
			
		}

		function deleteFile()
		{
			global	$cat_file,$cat_dir;
			
			$s = '';
			$fl = $this->test($cat_dir.'/'.$cat_file);
			if(file_exists($fl)) {
				if(is_dir($fl)) @rmdir($fl);
				else @unlink($fl);
			};
			return $s;

		}

		function getFile($user)
		{
			if($user->isEdit('ModFileManager')) {
				global	$cat_file;

				if(file_exists($cat_file)) {
					header('Content-Type: application/octetstream');
        				header('Content-Disposition: attachment; filename="'.basename($cat_file).'"');
	        			header('Expires: 0');
        				header('Pragma: no-cache');
					readfile($this->test($cat_file));
				};
			};
		}

		function test($file)
		{
			// if(substr($file,0,1) == '/') $file = '../'.$file;
			// $s = str_replace("CAT2", "..", $file);
			// $s = str_replace("/..", "", $s);
			return $file;				
		}

		function num($k) 
		{	
			$s = array();

			$n = sprintf("%u",$k);
			$i = strlen($n);			
			do {
				if($i == strlen($n)) $j = $i % 3;
				else $j = 3;
				if($j == 0) $j = 3; 
				
				$t = substr($n, strlen($n) - $i, $j);
				array_push($s,$t);	
				$i = $i - $j;		
			} while($i > 0);
			return (implode(' ',$s));
		}

		
		function execute($user)
		{
			global $cat_opt;			

			$s = '';
			if($user->isEdit('ModFileManager')) {
 				$s = "<font class='title'>$GLOBALS[cat_m_mod_fm]</font><br><br>";
				switch($cat_opt) {
					case(CAT_MOD_FM_CREATE): {
						$s .= $this->createFile();
						break;
					};	
					case(CAT_MOD_FM_EDIT): {
						$s .= $this->editFile();
						break;
					};	
					case(CAT_MOD_FM_STORE): {						
						$s .= $this->storeFile();
						$s .= $this->showDir();
						break;
					};	
					case(CAT_MOD_FM_UPLOAD): {
						$s .= $this->uploadFile();
						$s .= $this->showDir();
						break;
					};	
					case(CAT_MOD_FM_DELETE): {
						$s .= $this->deleteFile();
						$s .= $this->showDir();
						break;
					};	
					default: {
						$s .= $this->showDir();
					};			
				};
							
			} else $s = $GLOBALS[$cat_m_error_ua];
			return $s;
		}
	
	};

?>