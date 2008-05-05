<?
	require_once("objects/modules/_base.php");

	define('CAT_MOD_BACKUP_RETRAIN',1);

	class ModBackup extends ModBase
	{				
		function ModBackup() 
		{
			$this->ModBase();
			$this->title = $GLOBALS[cat_m_mod_backup];
		}
	
		function makeMenu($user)
		{
			$s = '';
                        // if($user->isEdit('ModBackup')) $s .= "<tr><td valign='top' align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='ext.php?cat_obj=ModBackup&cat_method=store' class='emenu'>$GLOBALS[cat_m_backup_save]</a></td></tr>";
                        // $s .= "<tr><td valign='top' align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?cat_pos=control&cat_mod=ModBackup&cat_opt=".CAT_MODULE_BACKUP_RETRAIN."' class='emenu'>$GLOBALS[cat_m_backup_retrain]</a></td></tr>";
			return $s;
		}

		function showForm()
		{
			global $cat_max_file_size;

			$s = "<table border='0' cellpadding='20' cellspacing='1' width='100%' class='pt9'>";
			$s .= "<tr><td class='einfo' align='center' width='50%'>";
			$s .= "<a href='ext.php?cat_obj=ModBackup&cat_method=store'><img src='images/store.gif' border='0' alt=''></a><br>$GLOBALS[cat_m_backup_fsave]&nbsp;&nbsp;";
			$s .= " </td>";			
			$s .= "<form enctype='multipart/form-data' action='".$this->URL."&cat_opt=".CAT_MOD_BACKUP_RETRAIN."' method='post' name='rf'>";
			$s .= "<input type='hidden' name='MAX_FILE_SIZE' value='$cat_max_file_size'>";
			$s .= "<td class='einfo' align='center' width='50%'>";
			$s .= "<a onClick='rf.submit()'><img src='images/retrain.gif' border='0' alt='' style='cursor: pointer'></a><br>$GLOBALS[cat_m_backup_fretrain]<br><input type='file' name='backup_dump'>";
			$s .= "</td></tr></form>";
			$s .= "</table><br><br>";
			return $s;		
		}
		
		function store($user)
		{
			if($user->isEdit('ModBackup')) {
				global $cat_db_name;				

    				header('Content-Type: application/octetstream');
        			header('Content-Disposition: attachment; filename="'.$cat_db_name.'_'.date("Y-m-d").'.sql"');
        			header('Expires: 0');
        			header('Pragma: no-cache');

				$cat_db = new Database;
				$cat_db->connect($cat_db_name);
				$cat_db->dump();
				$cat_db->disconnect();
			};
		} 

		function pack($user)
		{		
			if($user->isEdit('ModBackup')) {
				global $cat_bc_ext, $cat_bc_command;	
    				header('Content-Type: application/octetstream');
        			header('Content-Disposition: attachment; filename="site_'.date("Y-m-d").$cat_bc_ext.'"');
        			header('Expires: 0');
        			header('Pragma: no-cache');
				
				passthru($cat_bc_command);
			};
		} 
		
		function retrain()
		{
		        global	$backup_dump, $cat_db;

			$s = "<table width='100%' border='0' cellpadding='1' cellspacing='0' bgcolor='#a9a9a9'><tr><td align='center'>";
			$s .= "<table width='100%' border='0' cellpadding='10' cellspacing='0' bgcolor='#f0f0f0' class='pt8'><tr><td align='left'>";
			$s .= $cat_db->restore($backup_dump);
			$s .= "Ok";
			$s .= "</td></tr></table>";
			$s .= "</td></tr></table><br>";
			return $s;
		}		

		function execute($user)
		{
			global	$cat_opt;

			$s = '';			
			if($user->isEdit('ModBackup')) {
 				$s = "<font class='title'>$GLOBALS[cat_m_mod_backup]</font><br><br>";
				switch($cat_opt) {
					case(CAT_MOD_BACKUP_RETRAIN): {
						$s .= $this->retrain();
						$s .= $this->showForm();
						break;
					};	
					default: {
						$s .= $this->showForm();
					};			
				};
			};
			return $s;
		}
	
	};

?>