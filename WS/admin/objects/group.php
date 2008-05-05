<?
	//
	//
	//
        define('CAT_GROUP_INSERT',10);
        define('CAT_GROUP_EDIT_FORM',20);
        define('CAT_GROUP_UPDATE',30);
        define('CAT_GROUP_DELETE',40);	


	class Group
    	{
		var	$group;
		var	$objects;
	
	function Group($group)
	{
		global $cat_db;		

		$this->group = $group;
		$res = $cat_db->query("select * from cat_groups where ugroup='$group'");
		for($i = 0; $i < count($res); $i++) {
			$key = $res[$i][mod_table]; 
			$this->objects[$key][show] = $res[$i][is_show];
			$this->objects[$key][edit] = $res[$i][is_edit];
			$this->objects[$key][publish] = $res[$i][is_publish];
			$this->objects[$key][limited] = $res[$i][is_limited];
		};
	}

	function updateObject($object)
	{
		global $cat_db;		

		$res = $cat_db->query("select * from cat_groups where ugroup='$this->group' and mod_table='$object'");
		if(count($res) == 1) {
			$this->objects[$object][show] = $res[0][is_show];
			$this->objects[$object][edit] = $res[0][is_edit];
			$this->objects[$object][publish] = $res[0][is_publish];
			$this->objects[$object][limited] = $res[0][is_limited];
		} else {
			$this->objects[$object][show] = 0;
			$this->objects[$object][edit] = 0;
			$this->objects[$object][publish] = 0;
			$this->objects[$object][limited] = 0;
		};
		return '';
	}
	
	function isShow($object)
	{
		return $this->objects[$object][show];
	}

	function isEdit($object)
	{
		return $this->objects[$object][edit];
	}

	function isPublish($object)
	{
		return $this->objects[$object][publish];
	}

	function isLimited($object)
	{
		return $this->objects[$object][limited];
	}
	

	//
	//
	//
	function show()
	{
		$s = "<font class='title'>$GLOBALS[cat_m_groups]</font><br><br>";
		$s .= "<table border='0' cellpadding='2' cellspacing='1' width='100%' class='pt9'>";
		$s .= $this->showList();		
		$s .= "</table><br>";
		$s .= "<table border='0' cellpadding='2' cellspacing='1' width='100%' class='pt9'>";
		$s .= $this->showInsertForm();
		// $s .= $this->showEditList();
		// $s .= $this->showDeleteList();
		$s .= "</table><br><br>";
		return $s;		
	}

	function showList()
	{
		global $cat_db;
			
		$s = "<tr>";
		$s .= "<td class='header' align='center'>$GLOBALS[cat_m_group_ugroup]</td>";
		$s .= "<td align='center' colspan='2'>&nbsp;</td>";
		$s .= "</tr>";
		$res = $cat_db->query("select * from cat_groups group by ugroup order by ugroup");
		for($i = 0; $i < count($res); $i++) {
			$r = $res[$i];
			$s .= "<tr><td class='einfo'>$r[ugroup]</td>";
			$s .= "<td valign='top' align='center' width='15'><a href='".$this->URL."&cat_opt=".CAT_GROUP_EDIT_FORM."&group_ugroup=$r[ugroup]'><img src='images/edit.gif' border='0' alt='$GLOBALS[cat_m_edit]' title='$GLOBALS[cat_m_edit]'></a></td>";
			$s .= "<td valign='top' align='center' width='15'><a href='#' onClick='if(confirm(\"$GLOBALS[cat_m_delete]?\")) window.location.href = \"".$this->URL."&cat_opt=".CAT_GROUP_DELETE."&group_ugroup=$r[ugroup]\"'><img src='images/delete.gif' border='0' alt='$GLOBALS[cat_m_delete]' title='$GLOBALS[cat_m_delete]'></a></td>";
			$s .= "</tr>";				
		}; 
		return $s;
	}

	function showInsertForm()
	{
		global $cat_db;

		$s = "<form action='".$this->URL."&cat_opt=".CAT_GROUP_INSERT."' method='post'><tr><td colspan='2' class='einfo' align='right'>";
		$s .= "$GLOBALS[cat_m_group_ugroup] <input type='text' name='group_ugroup' size='16' maxlength='32'> ";
		$s .= "<input type='submit' class='sub' value='$GLOBALS[cat_m_insert]'>";
		$s .= "</td></tr></form>";			
		return $s;
	}

	function insert()
	{
		global $cat_db, $group_ugroup, $cat_modlist;
		
		$res = $cat_db->query("select ugroup from cat_groups where ugroup='$group_ugroup'");
		if(count($res) == 0) {
			$res = $cat_db->query("select * from cat_tables order by pos");
			for($i = 0; $i < count($res); $i++) {
				$r = $res[$i];
				$cat_db->query("insert into cat_groups values('$group_ugroup','$r[name]','1','0','0','1')");
			};
			for($i = 0; $i < count($cat_modlist); $i++) {
				eval('$obj = new '.$cat_modlist[$i].';');
				if(!is_object($obj)) continue;	
				$cat_db->query("insert into cat_groups values('$group_ugroup','$cat_modlist[$i]','1','0','0','1')");
			};
		};
		return '';
	}

	function showEditList()
	{
	        global $cat_db;
	
		$s = "<tr><form action='".$this->URL."&cat_opt=".CAT_GROUP_EDIT_FORM."' method='post'><td class='eedit' align='right' valign='top'>";
		$s .= "$GLOBALS[cat_m_group_edit] <select name='group_ugroup' size='1'> ";
	        $res = $cat_db->query("select * from cat_groups group by ugroup");
		for($i = 0; $i < count($res); $i++) {
			$r = $res[$i];
			$s .= "<option value='$r[ugroup]'>$r[ugroup]";
		}; 
		$s .= "</select> ";
		$s .= "<input type='submit' class='sub' value='$GLOBALS[cat_m_edit]'>";
		$s .= "</td></form>";			
		return $s;
	}

	function showEditForm()
	{
		global $cat_db, $group_ugroup, $cat_modlist;
		
		$s = "<font class='title'>$GLOBALS[cat_m_group_edit]</font><br><br>";
		$s .= "<table border='0' cellpadding='2' cellspacing='1' width='100%' class='pt9'>";
		$s .= "<tr>";
		$s .= "<td class='header' align='center'>$GLOBALS[cat_m_group_mod_table]</td>";
		$s .= "<td class='header' align='center'>$GLOBALS[cat_m_group_show]</td>";
		$s .= "<td class='header' align='center'>$GLOBALS[cat_m_group_edit]</td>";
		// $s .= "<td class='header' align='center'>$GLOBALS[cat_m_group_publish]</td>";
		// $s .= "<td class='header' align='center'>$GLOBALS[cat_m_group_limited]</td>";
		$s .= "</tr>";
		$p = $cat_db->query("select * from cat_groups where ugroup='$group_ugroup'");
		if(count($p) > 0) {
			$s .= "<form action='".$this->URL."&cat_opt=".CAT_GROUP_UPDATE."' method='post'>";
			$res = $cat_db->query("select * from cat_tables order by pos");
			for($i = 0; $i < count($res); $i++) {
				$z = true;
				for($j = 0; $j < count($p); $j++) {
					if($p[$j][mod_table] == $res[$i][name]) {
						$key = 'group_'.md5($res[$i][name]);
						$s .= "<tr>";
						$s .= "<td class='einfo'>".$res[$i][name]."</td>";
						$s .= "<td class='einfo' valign='middle' align='center'><input type='checkbox' name='".$key."_show'";
						if($p[$j][is_show] > 0) $s .= " checked";
						$s .= "></td>";
						$s .= "<td class='einfo' valign='middle' align='center'><input type='checkbox' name='".$key."_edit'";
						if($p[$j][is_edit] > 0) $s .= " checked";
						$s .= "></td>";
						$s .= "<input type='hidden' name='".$key."_publish' value='on'>";
						// $s .= "<td class='einfo' valign='middle' align='center'><input type='checkbox' name='".$key."_publish'";
						// if($p[$j][is_publish] > 0) $s .= " checked";
						// $s .= "></td>";
						// $s .= "<td class='einfo' valign='middle' align='center'><input type='checkbox' name='".$key."_limited'";
						// if($p[$j][is_limited] > 0) $s .= " checked";
						// $s .= "></td>";		
						$s .= "</tr>";
						$z = false;
					};
				};
				if($z) {
					$key = 'group_'.md5($res[$i][name]);
					$s .= "<tr>";
					$s .= "<td class='einfo'>".$res[$i][name]."</td>";
					$s .= "<td class='einfo' valign='middle' align='center'><input type='checkbox' name='".$key."_show'></td>";
					$s .= "<td class='einfo' valign='middle' align='center'><input type='checkbox' name='".$key."_edit'></td>";
					$s .= "<input type='hidden' name='".$key."_publish' value='on'>";
					// $s .= "<td class='einfo' valign='middle' align='center'><input type='checkbox' name='".$key."_publish'></td>";
					// $s .= "<td class='einfo' valign='middle' align='center'><input type='checkbox' name='".$key."_limited'></td>";		
					$s .= "<input type='hidden' name='".$key."_needadd' value='1'>";		
					$s .= "</tr>";
				};
			};
			for($i = 0; $i < count($cat_modlist); $i++) {
				eval('$obj = new '.$cat_modlist[$i].';');
				if(!is_object($obj)) continue;	
				$z = true;
				for($j = 0; $j < count($p); $j++) {
					if($p[$j][mod_table] == $cat_modlist[$i]) {
						$s .= "<tr>";
						$s .= "<td class='eedit'>".$obj->getTitle()."</td>";
						$s .= "<td class='eedit' valign='middle' align='center'><input type='checkbox' name='group_".$cat_modlist[$i]."_show'";
						if($p[$j][is_show] > 0) $s .= " checked";
						$s .= "></td>";
						$s .= "<td class='eedit' valign='middle' align='center'><input type='checkbox' name='group_".$cat_modlist[$i]."_edit'";
						if($p[$j][is_edit] > 0) $s .= " checked";
						$s .= "></td>";
						$s .= "<input type='hidden' name='".$key."_publish' value='on'>";
						// $s .= "<td class='eedit' valign='middle' align='center'><input type='checkbox' name='group_".$cat_modlist[$i]."_publish'";
						// if($p[$j][is_publish] > 0) $s .= " checked";
						// $s .= "></td>";
						// $s .= "<td class='eedit' valign='middle' align='center'><input type='checkbox' name='group_".$cat_modlist[$i]."_limited'";
						// if($p[$j][is_limited] > 0) $s .= " checked";
						// $s .= "></td>";		
						$s .= "</tr>";
						$z = false;
					};
				};
				if($z) {
					$s .= "<tr>";
					$s .= "<td class='eedit'>".$obj->getTitle()."</td>";
					$s .= "<td class='eedit' valign='middle' align='center'><input type='checkbox' name='group_".$cat_modlist[$i]."_show'></td>";
					$s .= "<td class='eedit' valign='middle' align='center'><input type='checkbox' name='group_".$cat_modlist[$i]."_edit'></td>";
					$s .= "<input type='hidden' name='".$key."_publish' value='on'>";
					// $s .= "<td class='eedit' valign='middle' align='center'><input type='checkbox' name='group_".$cat_modlist[$i]."_publish'></td>";
					// $s .= "<td class='eedit' valign='middle' align='center'><input type='checkbox' name='group_".$cat_modlist[$i]."_limited'></td>";		
					$s .= "<input type='hidden' name='group_".$cat_modlist[$i]."_needadd' value='1'>";		
					$s .= "</tr>";
				};
			};
			$s .= "<tr><td colspan='5' class='einfo' align='right'>$GLOBALS[cat_m_group_ugroup] <input type='text' name='group_nugroup' size='16' maxlength='32' value='$group_ugroup'";
			if($group_ugroup == $this->group) $s .= " disable";
			$s .= "> ";
			$s .= "<input type='submit' class='sub' value='$GLOBALS[cat_m_action]'>";
			$s .= "</td><input type='hidden' name='group_ugroup' value='$group_ugroup'></form></tr>";			
		};
		$s .= "</table><br><br>";
		return $s;
	}

	function update()
	{
		global $cat_db, $group_ugroup, $group_nugroup, $cat_modlist;
		
		$res = $cat_db->query("select ugroup from cat_groups where ugroup='$group_ugroup'");
		if(count($res) > 0) {
			$res = $cat_db->query("select * from cat_tables order by pos");
			for($i = 0; $i < count($res); $i++) {
				$key = 'group_'.md5($res[$i][name]);
				if($GLOBALS[$key.'_show'] == 'on') $is_show = 1; else $is_show = 0;
				if($GLOBALS[$key.'_edit'] == 'on') $is_edit = 1; else $is_edit = 0;
				if($GLOBALS[$key.'_publish'] == 'on') $is_publish = 1; else $is_publish = 0;
				if($GLOBALS[$key.'_limited'] == 'on') $is_limited = 1; else $is_limited = 0;
				if($GLOBALS[$key.'_needadd'] == 1) $cat_db->query("insert into cat_groups set is_show='$is_show',is_edit='$is_edit',is_publish='$is_publish',is_limited='$is_limited',mod_table='".$res[$i][name]."',ugroup='$group_ugroup'");
				else $cat_db->query("update cat_groups set is_show='$is_show',is_edit='$is_edit',is_publish='$is_publish',is_limited='$is_limited' where mod_table='".$res[$i][name]."' and ugroup='$group_ugroup'");
				if($group_ugroup == $this->group) {				
					$key = $res[$i][name]; 
					$this->objects[$key][show] = $is_show;
					$this->objects[$key][edit] = $is_edit;
					$this->objects[$key][publish] = $is_publish;
					$this->objects[$key][limited] = $is_limited;
				};
			};
			for($i = 0; $i < count($cat_modlist); $i++) {
				eval('$obj = new '.$cat_modlist[$i].';');
				if(!is_object($obj)) continue;	
				$key = 'group_'.$cat_modlist[$i];
				if($GLOBALS[$key.'_show'] == 'on') $is_show = 1; else $is_show = 0;
				if($GLOBALS[$key.'_edit'] == 'on') $is_edit = 1; else $is_edit = 0;
				if($GLOBALS[$key.'_publish'] == 'on') $is_publish = 1; else $is_publish = 0;
				if($GLOBALS[$key.'_limited'] == 'on') $is_limited = 1; else $is_limited = 0;
				if($GLOBALS[$key.'_needadd'] == 1) $cat_db->query("insert into cat_groups set is_show='$is_show',is_edit='$is_edit',is_publish='$is_publish',is_limited='$is_limited',mod_table='$cat_modlist[$i]',ugroup='$group_ugroup'");
				else $cat_db->query("update cat_groups set is_show='$is_show',is_edit='$is_edit',is_publish='$is_publish',is_limited='$is_limited' where mod_table='$cat_modlist[$i]' and ugroup='$group_ugroup'");
				if($group_ugroup == $this->group) {				
					$key = $cat_modlist[$i]; 
					$this->objects[$key][show] = $is_show;
					$this->objects[$key][edit] = $is_edit;
					$this->objects[$key][publish] = $is_publish;
					$this->objects[$key][limited] = $is_limited;
				};
			};
			if($group_ugroup != $group_nugroup && $group_ugroup != $this->group) {
				$cat_db->query("update cat_users set ugroup='$group_nugroup' where ugroup='$group_ugroup'");
				$cat_db->query("update cat_groups set ugroup='$group_nugroup' where ugroup='$group_ugroup'");			
			};
		};
		return '';
	}

	function showDeleteList()
	{
	        global $cat_db;
	
		$s = "<form action='".$this->URL."&cat_opt=".CAT_GROUP_DELETE."' method='post'><td class='eedit' align='right' valign='top'>";
		$s .= "$GLOBALS[cat_m_group_delete] <select name='group_ugroup' size='1'> ";
	        $res = $cat_db->query("select * from cat_groups group by ugroup");
		for($i = 0; $i < count($res); $i++) {
			$r = $res[$i];
			if($r[ugroup] != $this->group) $s .= "<option value='$r[ugroup]'>$r[ugroup]";
		}; 
		$s .= "</select> ";
		$s .= "<input type='submit' class='sub' value='$GLOBALS[cat_m_delete]'>";
		$s .= "</td></form></tr>";			
		return $s;
	}
	
	function delete()
	{
		global $cat_db, $group_ugroup;

		if(strlen($group_ugroup) > 0 && $group_ugroup != $this->group) {
			$cat_db->query("update cat_users set ugroup='' where ugroup='$group_ugroup'");				
			$cat_db->query("delete from cat_groups where ugroup='$group_ugroup'");				
		};
		return '';		
	}
	
	function execute()
	{
		global $cat_opt, $cat_pos, $cat_mod;

		$this->URL = "?cat_pos=$cat_pos&cat_mod=$cat_mod";		
		$s = '';
		switch($cat_opt) {
			case(CAT_GROUP_INSERT) : {
				$s .= $this->insert();
				$s .= $this->showEditForm();
				break;
			};
			case(CAT_GROUP_EDIT_FORM) : {
				$s .= $this->showEditForm();
				break;
			};
			case(CAT_GROUP_UPDATE) : {
				$s .= $this->update();
				$s .= $this->show();			
				break;
			};
			case(CAT_GROUP_DELETE) : {
				$s .= $this->delete();
				$s .= $this->show();			
				break;
			};
			default: {
				$s .= $this->show();							
			};
		};
		return $s;	
	}
    };

?>