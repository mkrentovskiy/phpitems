<?
	//
	//
	//

        define('CAT_STRUCT_INSERT_TABLE',1);
        define('CAT_STRUCT_INSERT_AREA',2);
        define('CAT_STRUCT_EDIT_TABLE',3);
        define('CAT_STRUCT_EDIT_AREA',4);
        define('CAT_STRUCT_UPDATE_TABLE',5);
        define('CAT_STRUCT_UPDATE_AREA',6);
        define('CAT_STRUCT_DELETE_TABLE',7);	
        define('CAT_STRUCT_DELETE_AREA',8);	

        define('CAT_STRUCT_TABLE_INSERT_DOMAIN',31);	
        define('CAT_STRUCT_TABLE_EDIT_DOMAIN',32);	
        define('CAT_STRUCT_TABLE_EDIT_DATA',33);	
        define('CAT_STRUCT_TABLE_DELETE_DOMAIN',34);	
        define('CAT_STRUCT_TABLE_GROUP_ACCESS',35);	

    	class Struct
	{
		var	$URL;

		function Struct()
		{
			global	$cat_pos, $cat_mod;

			$this->URL = "?cat_pos=$cat_pos&cat_mod=$cat_mod";		
		}	

		function showAreas()
		{
			$s = "<font class='title'>$GLOBALS[cat_m_areas]</font><br><br>";
			$s .= "<table border='0' cellpadding='2' cellspacing='1' width='100%' class='pt9'>";
			$s .= $this->showAreasList();		
			$s .= "</table><br>";
			$s .= "<table border='0' cellpadding='2' cellspacing='1' width='100%' class='pt9'>";
			$s .= $this->showInsertFormArea();
			// $s .= $this->showEditListArea();
			// $s .= $this->showDeleteFormArea();
			$s .= "</table><br><br>";
			return $s;
			
		}

		function showAreasList()
		{
			global $cat_db;
			
			$s = "<tr>";
			$s .= "<td class='header' align='center'>$GLOBALS[cat_m_area_name]</td>";
			$s .= "<td class='header' align='center'>$GLOBALS[cat_m_area_pos]</td>";
			$s .= "<td align='center' colspan='2'>&nbsp;</td>";
			$s .= "</tr>";
			
			$res = $cat_db->query("select * from cat_areas order by pos,area");
	
			for($i = 0; $i < count($res); $i++) {
				$r = $res[$i];
				$s .= "<tr><td class='einfo'>$r[area]</td>";
				$s .= "<td class='einfo'>$r[pos]</td>";
				$s .= "<td valign='top' align='center' width='15'><a href='".$this->URL."&cat_opt=".CAT_STRUCT_EDIT_AREA."&id_area=$r[id_area]'><img src='images/edit.gif' border='0' alt='$GLOBALS[cat_m_edit]' title='$GLOBALS[cat_m_edit]'></a></td>";
				$s .= "<td valign='top' align='center' width='15'><a href='#' onClick='if(confirm(\"$GLOBALS[cat_m_delete]?\")) window.location.href = \"".$this->URL."&cat_opt=".CAT_STRUCT_DELETE_AREA."&id_area=$r[id_area]\"'><img src='images/delete.gif' border='0' alt='$GLOBALS[cat_m_delete]' title='$GLOBALS[cat_m_delete]'></a></td>";
				$s .= "</tr>";				
			}; 
			return $s;
		}

		function showInsertFormArea()
		{
			$s = "<form action='".$this->URL."&cat_opt=".CAT_STRUCT_INSERT_AREA."' method='post'><tr><td colspan='2' class='eedit' align='right'>";
			$s .= "$GLOBALS[cat_m_area_name] <input type='text' name='area_name' size='20' maxlength='64'> ";
			$s .= "$GLOBALS[cat_m_area_pos] <input type='text' name='area_pos' size='3' maxlength='3'> ";
			$s .= "<input type='submit' class='sub' value='$GLOBALS[cat_m_insert]'>";
			$s .= "</td></tr></form>";			
			return $s;
		}

		function showEditListArea()
		{
		        global $cat_db;
			
			$s = "<form action='".$this->URL."&cat_opt=".CAT_STRUCT_EDIT_AREA."' method='post'><tr><td class='eedit' align='right'>";
			$s .= "$GLOBALS[cat_m_area_edit] <select name='id_area' size='1'> ";
		        $res = $cat_db->query("select * from cat_areas order by area");
			for($i = 0; $i < count($res); $i++) {
				$r = $res[$i];
				$s .= "<option value='$r[id_area]'>$r[area] [$r[pos]]";
			}; 
			$s .= "</select> ";
			$s .= "<input type='submit' class='sub' value='$GLOBALS[cat_m_edit]'>";
			$s .= "</td></form>";			
			return $s;
		}

		function showDeleteFormArea()
		{
		        global $cat_db;
			
			$s = "<form action='".$this->URL."&cat_opt=".CAT_STRUCT_DELETE_AREA."' method='post'><td class='eedit' align='right'>";
			$s .= "$GLOBALS[cat_m_area_delete] <select name='id_area' size='1'> ";
		        $res = $cat_db->query("select * from cat_areas order by area");
			for($i = 0; $i < count($res); $i++) {
				$r = $res[$i];
				$s .= "<option value='$r[id_area]'>$r[area] [".$r['pos']."]";
			}; 
			$s .= "</select> ";
			$s .= "<input type='submit' class='sub' value='$GLOBALS[cat_m_delete]'>";
			$s .= "</td></tr></form>";			
			return $s;	
		}	

		function insertArea()
		{
			global $cat_db;

			$area = $GLOBALS[area_name];
			$pos = $GLOBALS[area_pos];
			if(strlen($area) > 0) {
				if(empty($pos)) $pos = 0;
				$cat_db->query("insert into cat_areas values(0,'$area','$pos')");
			};
			return '';
		}

		function showEditFormArea()
		{
			global	$cat_db;

			$res = $cat_db->query("select * from cat_areas where id_area='$GLOBALS[id_area]'");
			if(count($res) != 1) return '';
			$r = $res[0];
			
			$s = "<font class='title'>$GLOBALS[cat_m_area_edit]</font><br><br>";
			$s .= "<table border='0' cellpadding='2' cellspacing='1' width='100%' class='pt9'>";
			$s .= "<form action='".$this->URL."&cat_opt=".CAT_STRUCT_UPDATE_AREA."' method='post'><tr><td class='eedit' align='right'>";
			$s .= "<input type='hidden' name='id_area' value='$r[id_area]'>";
			$s .= "$GLOBALS[cat_m_area_name] <input type='text' name='area_name' size='20' maxlength='64' value='$r[area]'> ";
			$s .= "$GLOBALS[cat_m_area_pos] <input type='text' name='area_pos' size='3' maxlength='3' value='$r[pos]'> ";
			$s .= "<input type='submit' class='sub' value='$GLOBALS[cat_m_action]'>";
			$s .= "</td></tr></form>";			
			$s .= "</table><br><br>";
			return $s;
		}

		function updateArea()
		{
			global $cat_db;

			$id_area = $GLOBALS[id_area];
			$area = $GLOBALS[area_name];
			$pos = $GLOBALS[area_pos];
			if(strlen($area) > 0) {
				if(empty($pos)) $pos = 0;
				$cat_db->query("update cat_areas set area='$area',pos='$pos' where id_area='$id_area'");
			};
			return '';
		}

		function deleteArea()
		{
			global $cat_db;

			$id_area = $GLOBALS[id_area];
			$cat_db->query("delete from cat_areas where id_area='$id_area'");
			$cat_db->query("update cat_tables set area='0' where area='$id_area'");
			return '';
		}
	
		//
		//
		//

		function showTables()
		{
			$s = "<font class='title'>$GLOBALS[cat_m_tables]</font><br><br>";
			$s .= "<table border='0' cellpadding='2' cellspacing='1' width='100%' class='pt9'>";
			$s .= $this->showListOfTables();
			$s .= "</table><br>";
			$s .= "<table border='0' cellpadding='2' cellspacing='1' width='100%' class='pt9'>";
			$s .= $this->showInsertFormTable();
			// $s .= $this->showEditListTable();
			// $s .= $this->showDeleteFormTable();
			$s .= "</table><br><br>";
			return $s;
		}

		function showListOfTables()
		{
		        global $cat_db;
			
			$s = "<tr>";
			$s .= "<td class='header' align='center'>$GLOBALS[cat_m_table_name]</td>";
			$s .= "<td class='header' align='center'>$GLOBALS[cat_m_table_title]</td>";
			$s .= "<td class='header' align='center'>$GLOBALS[cat_m_table_object]</td>";
			$s .= "<td class='header' align='center'>$GLOBALS[cat_m_table_pos]</td>";
			$s .= "<td align='center' colspan='2'>&nbsp;</td>";
			$s .= "</tr>";

		        $res = $cat_db->query("select * from cat_tables order by area,pos");
      			$qes = $cat_db->query("select * from cat_areas order by pos,area");

			$a = 0;
			for($i = 0; $i < count($res); $i++) {
				$r = $res[$i];

				if($a != $r['area']) {
					foreach($qes as $q) {
						if($q['id_area'] == $r['area']) {
							$s .= "<tr><td class='einfo' colspan='6'><b>$q[area]</b></td></tr>";
						};
					};
					$a = $r['area'];
				};
				$s .= "<tr><td class='einfo'>$r[name]</td>";
				$s .= "<td class='einfo'>$r[title]</td>";
				eval('$obj = new '.$r[object]."('');");
				if(is_object($obj)) $s .= "<td class='einfo'>".$obj->getTitle()."</td>";	
				else $s .= "<td class='einfo'>&nbsp;</td>";	
				$s .= "<td class='einfo'>$r[pos]</td>";				
				$s .= "<td valign='top' align='center' width='15'><a href='".$this->URL."&cat_opt=".CAT_STRUCT_EDIT_TABLE."&table_name=$r[name]'><img src='images/edit.gif' border='0' alt='$GLOBALS[cat_m_edit]' title='$GLOBALS[cat_m_edit]'></a></td>";
				$s .= "<td valign='top' align='center' width='15'><a href='#' onClick='if(confirm(\"$GLOBALS[cat_m_delete]?\")) window.location.href = \"".$this->URL."&cat_opt=".CAT_STRUCT_DELETE_TABLE."&table_name=$r[name]\"'><img src='images/delete.gif' border='0' alt='$GLOBALS[cat_m_delete]' title='$GLOBALS[cat_m_delete]'></a></td>";
				$s .= "</tr>";				

			}; 
			return $s;
		}

		function showInsertFormTable()
		{
		        global $cat_db, $cat_tablist;

			$s = "<form action='".$this->URL."&cat_opt=".CAT_STRUCT_INSERT_TABLE."' method='post'><tr><td class='eedit' align='right'>";
			$s .= "$GLOBALS[cat_m_table_name] <input type='text' name='table_name' size='24' maxlength='128'> ";
			$s .= "$GLOBALS[cat_m_table_title] <input type='text' name='table_title' size='40' maxlength='255'>
			       $GLOBALS[cat_m_table_do]<input type='checkbox' name='table_do'></td></tr><tr><td colspan='2' class='eedit' align='right'>";
			$s .= "$GLOBALS[cat_m_table_area] <select name='table_area' size='1'> ";
		        $res = $cat_db->query("select * from cat_areas order by area");
			for($i = 0; $i < count($res); $i++) {
				$r = $res[$i];
				$s .= "<option value='$r[id_area]'>$r[area]";
			}; 
			$s .= "</select> ";
			$s .= "$GLOBALS[cat_m_table_object] <select name='table_object' size='1'> ";
			for($i = 0; $i < count($cat_tablist); $i++) {
				eval('$obj = new '.$cat_tablist[$i]."('');");
				if(is_object($obj)) $s .= "<option value='".$cat_tablist[$i]."'>".$obj->getTitle();
			}; 
			$s .= "</select> ";
			$s .= "$GLOBALS[cat_m_table_pos] <input type='text' name='table_pos' size='3' maxlength='3'> ";
			$s .= "<input type='submit' class='sub' value='$GLOBALS[cat_m_insert]'>";
			$s .= "</td></tr></form>";			
			return $s;
		}

		function showEditListTable()
		{
		        global $cat_db;
			
			$s = "<form action='".$this->URL."&cat_opt=".CAT_STRUCT_EDIT_TABLE."' method='post'><tr><td class='eedit' align='right' valign='top'>";
			$s .= "$GLOBALS[cat_m_table_edit] <select name='table_name' size='1'> ";
		        $res = $cat_db->query("select * from cat_tables order by pos");
			for($i = 0; $i < count($res); $i++) {
				$r = $res[$i];
				$s .= "<option value='$r[name]'>$r[title] [$r[name]]";
			}; 
			$s .= "</select> ";
			$s .= "<input type='submit' class='sub' value='$GLOBALS[cat_m_edit]'>";
			$s .= "</td></form>";			
			return $s;
		}

		function showDeleteFormTable()
		{
		        global $cat_db;
			
			$s = "<form action='".$this->URL."&cat_opt=".CAT_STRUCT_DELETE_TABLE."' method='post'><td class='eedit' align='right'>";
			$s .= "$GLOBALS[cat_m_table_delete] <select name='table_name' size='1'> ";
		        $res = $cat_db->query("select * from cat_tables order by pos");
			for($i = 0; $i < count($res); $i++) {
				$r = $res[$i];
				$s .= "<option value='$r[name]'>$r[title] [$r[name]]";
			}; 
			$s .= "</select> ";
			$s .= "<input type='submit' class='sub' value='$GLOBALS[cat_m_delete]'><br>$GLOBALS[cat_m_table_do]<input type='checkbox' name='table_do'>";
			$s .= "</td></tr></form>";			
			return $s;
		}



		function insertTable($user)
		{
			global $cat_db, $cat_session, $table_name, $table_title, $table_area, $table_pos, $table_object, $table_do;

			$res = $cat_db->query("select name from cat_tables where name='$table_name'");
			if(count($res) == 0) {
				$login = $user->getLogin();
				$cat_db->query("insert into cat_tables values('$table_name',$table_area,'$login','$table_object','$table_title','$table_pos')");
				$cat_db->query("insert into cat_domains values(0,'id_$table_name','','','DomKey','','1','0','0','0','$table_name','','0','8')");
				$res = $cat_db->query("select ugroup from cat_groups group by ugroup");
				for($i = 0; $i < count($res); $i++) {
					$g = $res[$i][ugroup];
					$cat_db->query("insert into cat_groups values('$g','$table_name','1','0','0','0')");
				};
				$user->updateObject($table_name);
				$cat_session->set('cat_session_user',$user);				
				if($table_do != 'on') $cat_db->query("create table $table_name(id_$table_name int(8) not null auto_increment, key(id_$table_name))");					
			};
			return '';
		}


		function editTable($user)
		{
			global 	$cat_db, $cat_subopt, $table_name, $cat_session, $table_do;

			$s = '';
			$res = $cat_db->query("select * from cat_tables where name='$table_name'");

			if(count($res) == 1) {
				if($cat_session->isRegistered('cat_table_'.$table_name)) {
					$obj = $cat_session->unregister('cat_table_'.$table_name);
				} 
				eval('$obj = new '.$res[0][object].'($table_name);');							
				if(!is_object($obj)) return "<font class='title'><b>$GLOBALS[cat_m_error]</b></font><br>$GLOBALS[cat_m_error_object]";

				$ti = $res[0];
				$URL = $this->URL.'&cat_opt='.CAT_STRUCT_EDIT_TABLE;

				switch($cat_subopt) {
					case(CAT_STRUCT_TABLE_INSERT_DOMAIN): {
	                                        $res = $cat_db->query("select id_domains from cat_domains where in_table='$table_name' and name='$GLOBALS[domain_name]'");
						if(count($res) > 0) break;
						
						global $cat_domain_def, $domain_name, $domain_title, $domain_comment, $domain_object, $domain_rtable, $domain_list, $domain_select, $domain_parsed, $domain_addin, $domain_param, $domain_pos;
						if($domain_list == 'on') $domain_on_list = '1'; else $domain_on_list = '0';						
						if($domain_select == 'on') $domain_on_select = '1'; else $domain_on_select = '0';						
						if($domain_parsed == 'on') $domain_on_parsed = '1'; else $domain_on_parsed = '0';					
							
						if($domain_param == 0) $domain_param = $cat_domain_def[$domain_name];	

						$cat_db->query("insert into cat_domains values(0,'$domain_name','$domain_title','$domain_comment','$domain_object','$domain_rtable','0','$domain_on_list','$domain_on_select','$domain_on_parsed', '$table_name','$domain_addin','$domain_pos','$domain_param')");				
						
						$z = $cat_db->query("select * from cat_domains where in_table='$table_name' and name='$GLOBALS[domain_name]'");		
						if($table_do != 'on') $obj->insertDomain($z[0]);	
						break;
					};
					case(CAT_STRUCT_TABLE_EDIT_DOMAIN): {
	                                        $res = $cat_db->query("select id_domains from cat_domains where id_domains='$GLOBALS[domain_id]'");
						if(count($res) != 1) break;

						global $domain_name, $domain_title, $domain_comment, $domain_object, $domain_rtable, $domain_list, $domain_select, $domain_parsed, $domain_addin, $domain_param, $domain_pos;
						if($domain_list == 'on') $domain_on_list = '1'; else $domain_on_list = '0';						
						if($domain_select == 'on') $domain_on_select = '1'; else $domain_on_select = '0';						
						if($domain_parsed == 'on') $domain_on_parsed = '1'; else $domain_on_parsed = '0';						

						$cat_db->query("update cat_domains set name='$domain_name',title='$domain_title',comment='$domain_comment',object='$domain_object',r_table='$domain_rtable',is_on_list='$domain_on_list',is_on_select='$domain_on_select',is_parsed='$domain_on_parsed',addin='$domain_addin',pos='$domain_pos',param='$domain_param' where id_domains='$GLOBALS[domain_id]'");				
						
						$z = $cat_db->query("select * from cat_domains where id_domains='$GLOBALS[domain_id]'");		
						if($table_do != 'on') $obj->updateDomain($z[0]);	
						break;
					};
					case(CAT_STRUCT_TABLE_EDIT_DATA): {
						$this->editTableUpdate($ti,$user);	

						global $table_nname;
						$res = $cat_db->query("select * from cat_tables where name='$table_nname'");
						$ti = $res[0];
						break;
					};
					case(CAT_STRUCT_TABLE_DELETE_DOMAIN): {					
						$z = $cat_db->query("select * from cat_domains where id_domains='$GLOBALS[domain_id]'");		
						if(count($z) != 1) break;
						$cat_db->query("delete from cat_domains where id_domains='$GLOBALS[domain_id]'");
						if($table_do != 'on') $obj->deleteDomain($z[0]);
	                                       	break;
					};
					case(CAT_STRUCT_TABLE_GROUP_ACCESS): {
						$res = $cat_db->query("select * from cat_groups where mod_table='$ti[name]' order by ugroup");
						for($j = 0; $j < count($res); $j++) {
							$r = $res[$j];
							$key = 'access_'.md5($r[ugroup]);
							if($GLOBALS[$key.'_show'] == 'on') $is_show = '1'; else $is_show = '0';
							if($GLOBALS[$key.'_edit'] == 'on') $is_edit = '1'; else $is_edit = '0';
							if($GLOBALS[$key.'_publish'] == 'on') $is_publish = '1'; else $is_publish = '0';
							if($GLOBALS[$key.'_limited'] == 'on') $is_limited = '1'; else $is_limited = '0';
							$cat_db->query("update cat_groups set is_show='$is_show',is_edit='$is_edit',is_publish='$is_publish',is_limited='$is_limited' where mod_table='$table_name' and ugroup='$r[ugroup]'");
						};
						$user->updateObject($table_name);
						$cat_session->set('cat_session_user',$user);				
						break;
					};
				};

				$s .= $this->editTableInfoForm($ti,$URL); 
				$s .= $this->editTableStructForm($ti,$URL); 
				$s .= $this->editTableAccessForm($ti,$URL); 
			};		
			return $s;
		}

		function deleteTable($user)
		{
			global $cat_db, $cat_session, $table_name, $table_do;

			$res = $cat_db->query("select name from cat_tables where name='$table_name'");
			if(count($res) != 0) {
				$cat_db->query("delete from cat_tables where name='$table_name'");
				$cat_db->query("delete from cat_domains where in_table='$table_name'");
				$cat_db->query("delete from cat_groups where mod_table='$table_name'");
				$user->updateObject($table_name);
				$cat_session->set('cat_session_user',$user);				
				if($table_do != 'on') $cat_db->query("drop table $table_name");					
			};
			return '';
		}

		function editTableUpdate($ti,$user)
		{
			global $cat_db, $cat_session, $table_name, $table_nname, $table_title, $table_area, $table_pos, $table_object, $table_do;

			if($cat_session->isRegistered('cat_table_'.$table_name)) {
				$obj = $cat_session->unregister('cat_table_'.$table_name);
			};
			if($table_do != 'on') $cat_db->query("alter table $table_name rename $table_nname");;					
			$cat_db->query("update cat_tables set name='$table_nname',area='$table_area',object='$table_object',title='$table_title',pos='$table_pos' where name='$table_name'");
			$cat_db->query("update cat_domains set in_table='$table_nname' where in_table='$table_name'");
			$cat_db->query("update cat_groups set mod_table='$table_nname' where mod_table='$table_name'");
			$user->updateObject($table_name);
			$user->updateObject($table_nname);
			$cat_session->set('cat_session_user',$user);				
			return '';
		}

		function editTableInfoForm($ti,$URL)
		{
		        global $cat_db, $cat_tablist;

			$s = "<font class='title'>$GLOBALS[cat_m_table_info]</font><br><br>";
			$s .= "<table border='0' cellpadding='2' cellspacing='1' width='100%' class='pt9'>";
			$s .= "<form action='".$URL."&cat_subopt=".CAT_STRUCT_TABLE_EDIT_DATA."' method='post'><tr><td colspan='2' class='eedit' align='right'>";
			$s .= "$GLOBALS[cat_m_table_name] <input type='text' name='table_nname' size='24' maxlength='128' value='$ti[name]'> ";
			$s .= "<input type='hidden' name='table_name' value='$ti[name]'> ";
			$s .= "$GLOBALS[cat_m_table_title] <input type='text' name='table_title' size='40' maxlength='255' value='$ti[title]'>
			       $GLOBALS[cat_m_table_do]<input type='checkbox' name='table_do'></td></tr><tr><td colspan='2' class='eedit' align='right'>";
			$s .= "$GLOBALS[cat_m_table_area] <select name='table_area' size='1'> ";
		        $res = $cat_db->query("select * from cat_areas order by area");
			for($i = 0; $i < count($res); $i++) {
				$r = $res[$i];
				if($ti[area] == $r[id_area])
					$s .= "<option value='$r[id_area]' selected>$r[area]";
				else
					$s .= "<option value='$r[id_area]'>$r[area]";
			}; 
			$s .= "</select> ";
			$s .= "$GLOBALS[cat_m_table_object] <select name='table_object' size='1'> ";
			for($i = 0; $i < count($cat_tablist); $i++) {
				eval('$obj = new '.$cat_tablist[$i]."('');");
				if(is_object($obj)) {
					if($ti[object] == $cat_tablist[$i]) 
						$s .= "<option value='".$cat_tablist[$i]."' selected>".$obj->getTitle();
					else
						$s .= "<option value='".$cat_tablist[$i]."'>".$obj->getTitle();
				}
			}; 
			$s .= "</select> ";
			$s .= "$GLOBALS[cat_m_table_pos] <input type='text' name='table_pos' size='3' maxlength='3' value='$ti[pos]'> ";
			$s .= "<input type='submit' class='sub' value='$GLOBALS[cat_m_action]'>";
			$s .= "</td></tr></form>";			
			$s .= "</table><br><br>";
			return $s;
		}

		function editTableStructForm($ti,$URL)
		{
		        global $cat_db, $cat_domlist;

			$s = "<font class='title'>$GLOBALS[cat_m_table_struct]</font><br><br>";
			$s .= "<table border='0' cellpadding='2' cellspacing='1' width='100%' class='pt9'>";
			
			$res = $cat_db->query("select * from cat_domains where in_table='$ti[name]' order by pos");
			
			for($j = 0; $j < count($res); $j++) {
				$r = $res[$j];
				if($r[is_key] > 0) $ea = ' disabled'; 
				else $ea ='';
				$s .= "<form action='".$URL."&cat_subopt=".CAT_STRUCT_TABLE_EDIT_DOMAIN."' method='post'>";
				$s .= "<input type='hidden' name='domain_id' value='$r[id_domains]'>";
				$s .= "<input type='hidden' name='table_name' value='$ti[name]'> ";
				$s .= "<tr><td class='einfo' align='right' valign='top'>";
				$s .= "<table border='0' cellpadding='0' cellspacing='1' width='100%' class='pt9'>";
				$s .= "<tr><td class='einfo' align='right' valign='top'>";

				$s .= "$GLOBALS[cat_m_domain_name]<br><input type='text' name='domain_name' size='30' maxlength='64' value='$r[name]'$ea><br>";
				$s .= "$GLOBALS[cat_m_domain_title]<br><input type='text' name='domain_title' size='30' maxlength='128' value='$r[title]'$ea><br>";
				$s .= "$GLOBALS[cat_m_domain_comment]<br><textarea name='domain_comment' rows='4' cols='30'$ea>$r[comment]</textarea>";

				$s .= "</td><td class='einfo' align='right' valign='top'>";
				$s .= "$GLOBALS[cat_m_domain_object]<br><select name='domain_object' size='1'$ea> ";
				for($i = 0; $i < count($cat_domlist); $i++) {
					eval('$obj = new '.$cat_domlist[$i]."('');");
					if(is_object($obj)) {
						if($r[object] == $cat_domlist[$i]) 
							$s .= "<option value='".$cat_domlist[$i]."' selected>".$obj->getTitle();
						else
							$s .= "<option value='".$cat_domlist[$i]."'>".$obj->getTitle();
					}
				}; 
				$s .= "</select><br>";

				$s .= "$GLOBALS[cat_m_domain_table]<br><select name='domain_rtable' size='1'$ea> ";
				if(strlen($r[r_table]) > 1) $s .= "<option value='' selected>...";
				else $s .= "<option value=''>...";
				$rs = $cat_db->query("select * from cat_tables order by pos");
				for($i = 0; $i < count($rs); $i++) {
					$rt = $rs[$i];
				        if($r[r_table] == $rt[name]) $s .= "<option value='$rt[name]' selected>$rt[title] [$rt[name]]";
					else $s .= "<option value='$rt[name]'>$rt[title] [$rt[name]]";
				}; 
				$s .= "</select><br>";
			        $s .= "$GLOBALS[cat_m_domain_list] <input type='checkbox' name='domain_list'";
				if($r[is_on_list]) $s .= ' checked';
				$s .= "$ea><br>";
			        $s .= "$GLOBALS[cat_m_domain_select] <input type='checkbox' name='domain_select'";
				if($r[is_on_select]) $s .= ' checked';				
				$s .= "$ea><br><br>";
			        /* $s .= "$GLOBALS[cat_m_domain_parsed] <input type='checkbox' name='domain_parsed'";
				if($r[is_parsed]) $s .= ' checked';				
				$s .="$ea><br>"; */
				$s .= "$GLOBALS[cat_m_domain_pos] <input type='text' name='domain_pos' size='5' maxlength='4' value='$r[pos]'$ea><br>";
			
				$s .= "</td><td class='einfo' align='right' valign='top'>";

				$s .= "$GLOBALS[cat_m_domain_addin]<br><textarea name='domain_addin' rows='3' cols='30'$ea>$r[addin]</textarea><br>";
				$s .= "$GLOBALS[cat_m_domain_param]<br><input type='text' name='domain_param' size='30' maxlength='64' value='$r[param]'$ea><br>";
			        $s .= "$GLOBALS[cat_m_table_do]<input type='checkbox' name='table_do'$ea><br>";
				$s .= "<input type='submit' class='sub' value='$GLOBALS[cat_m_action]'$ea>";

				$s .= "</td></tr>";
				$s .= "</table>";
				$s .= "</td></tr></form>";
			
				$s .= "<form action='".$URL."&cat_subopt=".CAT_STRUCT_TABLE_DELETE_DOMAIN."' method='post'>";
				$s .= "<input type='hidden' name='table_name' value='$ti[name]'> ";
				$s .= "<input type='hidden' name='domain_id' value='$r[id_domains]'>";
				$s .= "<tr><td class='eedit' align='right' valign='top'>";
			        $s .= "<img src='images/arrow.gif' border='0' alt=''> $GLOBALS[cat_m_table_do] <input type='checkbox' name='table_do'$ea>";
				$s .= "<input type='submit' class='sub' value='$GLOBALS[cat_m_delete]'$ea>";
				$s .= "</td></tr></form>";			
			};	

			$s .= "<form action='".$URL."&cat_subopt=".CAT_STRUCT_TABLE_INSERT_DOMAIN."' method='post'>";
			$s .= "<tr><td class='ginfo' align='right' valign='top'>";
			$s .= "<table border='0' cellpadding='0' cellspacing='1' width='100%' class='pt9'>";
			$s .= "<tr><td align='right' valign='top'>";

			$s .= "$GLOBALS[cat_m_domain_name]<br><input type='text' name='domain_name' size='30' maxlength='64' value=''><br>";
			$s .= "$GLOBALS[cat_m_domain_title]<br><input type='text' name='domain_title' size='30' maxlength='128' value=''><br>";
			$s .= "$GLOBALS[cat_m_domain_comment]<br><textarea name='domain_comment' rows='4' cols='30'></textarea>";
			$s .= "</td><td align='right' valign='top'>";
			$s .= "$GLOBALS[cat_m_domain_object]<br><select name='domain_object' size='1'> ";
			for($i = 0; $i < count($cat_domlist); $i++) {
				eval('$obj = new '.$cat_domlist[$i]."('');");
				if(is_object($obj)) $s .= "<option value='".$cat_domlist[$i]."'>".$obj->getTitle();
			}; 
			$s .= "</select><br>";

			$s .= "$GLOBALS[cat_m_domain_table]<br><select name='domain_rtable' size='1'>";
			$s .= "<option value=''>...";
			$rs = $cat_db->query("select * from cat_tables order by pos");
			for($i = 0; $i < count($rs); $i++) {
				$rt = $rs[$i];
				$s .= "<option value='$rt[name]'>$rt[title] [$rt[name]]";
			}; 
			$s .= "</select><br>";
			$s .= "$GLOBALS[cat_m_domain_list] <input type='checkbox' name='domain_list'><br>";
			$s .= "$GLOBALS[cat_m_domain_select] <input type='checkbox' name='domain_select'><br><br>";
			// $s .= "$GLOBALS[cat_m_domain_parsed] <input type='checkbox' name='domain_parsed'><br>";
			$s .= "$GLOBALS[cat_m_domain_pos] <input type='text' name='domain_pos' size='5' maxlength='4' value=''><br>";
			$s .= "</td><td align='right' valign='top'>";
        		$s .= "$GLOBALS[cat_m_domain_addin]<br><textarea name='domain_addin' rows='3' cols='30'></textarea><br>";
			$s .= "<b>$GLOBALS[cat_m_domain_param]</b><br><input type='text' name='domain_param' size='30' maxlength='64' value=''><br>";
		        $s .= "$GLOBALS[cat_m_table_do]<input type='checkbox' name='table_do'><br>";
			$s .= "<input type='hidden' name='table_name' value='$ti[name]'> ";
			$s .= "<input type='submit' class='sub' value='$GLOBALS[cat_m_insert]'>";
        		$s .= "</td></tr>";
			$s .= "</table>";
			$s .= "</td></tr></form>";
			$s .= "</table><br><br>";
			return $s;
		}

		function editTableAccessForm($ti,$URL)
		{
		        global $cat_db;

			$s = "<font class='title'>$GLOBALS[cat_m_table_access]</font><br><br>";
			$s .= "<table border='0' cellpadding='2' cellspacing='1' width='100%' class='pt9'>";
			$s .= "<form action='".$URL."&cat_subopt=".CAT_STRUCT_TABLE_GROUP_ACCESS."' method='post'>";
			$s .= "<input type='hidden' name='table_name' value='$ti[name]'> ";
			$s .= "<tr>";
			$s .= "<td class='header' align='center'>$GLOBALS[cat_m_access_group]</td>";
			$s .= "<td class='header' align='center'>$GLOBALS[cat_m_access_show]</td>";
			$s .= "<td class='header' align='center'>$GLOBALS[cat_m_access_edit]</td>";
			// $s .= "<td class='header' align='center'>$GLOBALS[cat_m_access_publish]</td>";
			// $s .= "<td class='header' align='center'>$GLOBALS[cat_m_access_limited]</td>";
			$s .= "</tr>";
			$res = $cat_db->query("select * from cat_groups where mod_table='$ti[name]' order by ugroup");
			for($j = 0; $j < count($res); $j++) {
				$r = $res[$j];
				$key = md5($r[ugroup]);
				$s .= "<tr>";
				$s .= "<td class='einfo' align='left' valign='top'>$r[ugroup]</td>";
				$s .= "<td class='einfo' align='center' valign='middle'><input type='checkbox' name='access_".$key."_show'";
				if($r[is_show] > 0) $s .= " checked></td>"; else $s .= "></td>"; 
				$s .= "<td class='einfo' align='center' valign='middle'><input type='checkbox' name='access_".$key."_edit'";
				if($r[is_edit] > 0) $s .= " checked></td>"; else $s .= "></td>"; 
				$s .= "<input type='hidden' name='access_".$key."_publish' value='on'>";
				// $s .= "<td class='einfo' align='center' valign='middle'><input type='checkbox' name='access_".$key."_publish'";
				// if($r[is_publish] > 0) $s .= " checked></td>"; else $s .= "></td>"; 
				// $s .= "<td class='einfo' align='center' valign='middle'><input type='checkbox' name='access_".$key."_limited'";
				// if($r[is_limited] > 0) $s .= " checked></td>"; else $s .= "></td>"; 
				$s .= "</tr>";
			};
			$s .= "<tr><td colspan='5' class='eedit' align='right'>";
			$s .= "<input type='submit' class='sub' value='$GLOBALS[cat_m_action]'>";
			$s .= "</td></tr></form>";			
			$s .= "</table><br><br>";
			return $s;
		}

	
		function execute($user)
		{
			global $cat_opt;
		
			$s = '';
			switch($cat_opt) {
				case(CAT_STRUCT_INSERT_TABLE) : {
					$s .= $this->insertTable($user);
				        $s .= $this->editTable($user);
					break;
				};
				case(CAT_STRUCT_INSERT_AREA) : {
					$s .= $this->insertArea();
					$s .= $this->showAreas();
					$s .= $this->showTables();
					break;
				};
				case(CAT_STRUCT_EDIT_TABLE) : {
				        $s .= $this->editTable($user);					
					break;
				};
				case(CAT_STRUCT_EDIT_AREA) : {
					$s .= $this->showEditFormArea();
					$s .= $this->showAreas();
					break;
				};
				case(CAT_STRUCT_UPDATE_AREA) : {
				        $s .= $this->updateArea();
					$s .= $this->showAreas();
					$s .= $this->showTables();				
					break;
				};
				case(CAT_STRUCT_DELETE_TABLE) : {
				        $s .= $this->deleteTable($user);					
					$s .= $this->showAreas();
					$s .= $this->showTables();
					break;
				};
				case(CAT_STRUCT_DELETE_AREA) : {
				        $s .= $this->deleteArea();
					$s .= $this->showAreas();
					$s .= $this->showTables();				
					break;
				};
				default : {
					$s .= $this->showAreas();
					$s .= $this->showTables();
				};
			};
			return $s;	
		}
    };

?>