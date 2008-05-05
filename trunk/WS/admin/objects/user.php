<?
	//
	//
	//

        define('CAT_USER_INSERT',1);
        define('CAT_USER_EDIT_FORM',2);
        define('CAT_USER_UPDATE',3);
        define('CAT_USER_DELETE',4);	

    	class User 
	{
		var	$login;
		var	$person;
		var	$email;
			
		var	$system;
		var	$control;
		var	$info;
	
		var	$group;
		var	$valid;
		
		var	$URL;
		
	function User($login, $password) 
	{
		global $cat_db;

		$this->valid = false;
		$res = $cat_db->query("select * from cat_users where login='$login' and passwd='$password' limit 0,1");
		if(count($res) == 1) {
			$this->login = $login;
			$this->person = $res[0][person]; 
			$this->email = $res[0][email];

			$this->system = $res[0][is_system]; 
			$this->control = $res[0][is_control]; 
			$this->info = $res[0][is_info]; 
 
			$this->group = new Group($res[0][ugroup]);
			$this->valid = true;
		};
	}
	
	function isValid()
	{
	    return $this->valid;
	}
	
	function getLogin()
	{
	    return $this->login;
	}

	function getUserInfo()
	{
		$str = "<font class='stitle'>$this->person [$this->login]</font><br>";
		$str .= "&nbsp;&nbsp;E-mail: <a href='mailto:$this->email'>$this->email</a>&nbsp&nbsp&nbsp&nbsp";
	        $str .= "&nbsp;&nbsp;[ $GLOBALS[cat_m_alevel]: ";
		
		if($this->isSystem()) $str .= "<font class='red'>$GLOBALS[cat_m_system]</font> | ";		
		else $str .= "<font class='grey'>$GLOBALS[cat_m_system]</font> | ";
		if($this->isControl()) $str .= "<font class='red'>$GLOBALS[cat_m_control]</font> | ";		
		else $str .= "<font class='grey'>$GLOBALS[cat_m_control]</font> | ";
		if($this->isInfo()) $str .= "<font class='red'>$GLOBALS[cat_m_info]</font> ]";		
		else $str .= "<font class='grey'>$GLOBALS[cat_m_info]</font> ]";
		
	        return $str;
	}

	function isSystem()
	{
		return $this->system;
	}

	function isControl()
	{
		return $this->control;
	}

	function isInfo()
	{
		return $this->info;
	}

	function isShow($object)
	{
		if($this->valid) return $this->group->isShow($object);
		else return false;
	}

	function isEdit($object)
	{
		if($this->valid) return $this->group->isEdit($object);
		else return false;
	}

	function isPublish($object)
	{
		if($this->valid) return $this->group->isPublish($object);
		else return false;
	}

	function isLimited($object)
	{
		if($this->valid) return $this->group->isLimited($object);
		else return false;
	}

	function updateObject($object)
	{
		if($this->valid) return $this->group->updateObject($object);
		else return false;		
	}
	//
	//
	//
	
	function show()
	{
		$s = "<font class='title'>$GLOBALS[cat_m_users]</font><br><br>";
		$s .= "<table border='0' cellpadding='2' cellspacing='1' width='100%' class='pt9'>";
		$s .= $this->showList();		
		$s .= "</table><br>";
		$s .= "<table border='0' cellpadding='2' cellspacing='1' width='100%' class='pt9'>";
		$s .= $this->showInsertForm();
		$s .= "</table><br><br>";
		return $s;		
	}

	function showInsertForm()
	{
		global $cat_db;

		$s = "<form action='".$this->URL."&cat_opt=".CAT_USER_INSERT."' method='post'><tr><td colspan='2' class='einfo' align='right'>";
		$s .= "$GLOBALS[cat_m_user_login] <input type='text' name='user_login' size='16' maxlength='32'> ";
		$s .= "$GLOBALS[cat_m_user_password] <input type='password' name='user_password' size='16' maxlength='32'> ";
		$s .= "$GLOBALS[cat_m_user_group] <select name='user_ugroup' size='1'> ";
	        $res = $cat_db->query("select ugroup from cat_groups group by ugroup");
		for($i = 0; $i < count($res); $i++) {
			$r = $res[$i];
			$s .= "<option value='$r[ugroup]'>$r[ugroup]";
		}; 
		$s .= "</select> ";
		$s .= "</td></tr><tr><td colspan='2' class='einfo' align='right'>";
		$s .= "$GLOBALS[cat_m_user_person] <input type='text' name='user_person' size='32' maxlength='255'> ";
		$s .= "$GLOBALS[cat_m_user_email] <input type='text' name='user_email' size='32' maxlength='128'> ";
		$s .= "</td></tr><tr><td colspan='2' class='einfo' align='right' vlaign='middle'>";
		$s .= "<input type='checkbox' name='user_system'> $GLOBALS[cat_m_system] <font color='#cccccc'>|</font> ";
		$s .= "<input type='checkbox' name='user_control' checked> $GLOBALS[cat_m_control] <font color='#cccccc'>|</font> ";
		$s .= "<input type='checkbox' name='user_info' checked> $GLOBALS[cat_m_info] <font color='#cccccc'>|</font> ";
		$s .= "<input type='submit' class='sub' value='$GLOBALS[cat_m_insert]'>";
		$s .= "</td></tr></form>";			
		return $s;
	}

	function insert()
	{
		global $cat_db, $user_login;
		
		$res = $cat_db->query("select login from cat_users where login='$user_login'");
		if(count($res) == 0) {
			global $user_password, $user_person, $user_email, $user_ugroup, $user_system, $user_control, $user_info;
			
			if($user_system == 'on') $user_is_system = '1'; else $user_is_system = '0';
			if($user_info == 'on') $user_is_info = '1'; else $user_is_info = '0';
			if($user_control == 'on') $user_is_control = '1'; else $user_is_control = '0';
			$cat_db->query("insert into cat_users values('$user_login','$user_password','$user_ugroup','$user_person','$user_email','$user_is_system','$user_is_control','$user_is_info')");			
		};
		return '';
	}

	function showEditList()
	{
	        global $cat_db;
	
		$s = "<tr><form action='".$this->URL."&cat_opt=".CAT_USER_EDIT_FORM."' method='post'><td class='eedit' align='right' valign='top'>";
		$s .= "$GLOBALS[cat_m_user_edit] <select name='user_login' size='1'> ";
	        $res = $cat_db->query("select * from cat_users order by login");
		for($i = 0; $i < count($res); $i++) {
			$r = $res[$i];
			$s .= "<option value='$r[login]'>$r[person]";
		}; 
		$s .= "</select> ";
		$s .= "<input type='submit' class='sub' value='$GLOBALS[cat_m_edit]'>";
		$s .= "</td></form>";			
		return $s;
	}

	function showEditForm()
	{
		global $cat_db, $user_login;
		
		$res = $cat_db->query("select * from cat_users where login='$user_login'");
		if(count($res) != 1) return '';
		
		$z = $res[0];
		if($user_login == $this->login) $ea = ' disabled'; else $ea = '';
		$s = "<font class='title'>$GLOBALS[cat_m_users]</font><br><br>";
		$s .= "<table border='0' cellpadding='2' cellspacing='1' width='100%' class='pt9'>";
		$s .= "<form action='".$this->URL."&cat_opt=".CAT_USER_UPDATE."' method='post'><tr><td colspan='2' class='einfo' align='right'>";
		$s .= "<input type='hidden' name='user_login' value='$z[login]'>";
		$s .= "$GLOBALS[cat_m_user_login] <input type='text' name='user_nlogin' size='16' maxlength='32' value='$z[login]'$ea> ";
		$s .= "$GLOBALS[cat_m_user_password] <input type='text' name='user_password' size='16' maxlength='32' value='$z[passwd]'> ";
		$s .= "$GLOBALS[cat_m_user_group] <select name='user_ugroup' size='1'$ea> ";
	        $res = $cat_db->query("select ugroup from cat_groups group by ugroup");
		if(strlen($z[ugroup]) < 2) $s .= "<option value='' selected>...";
		for($i = 0; $i < count($res); $i++) {
			$r = $res[$i];
			$s .= "<option value='$r[ugroup]'";
			if($z[ugroup] == $r[ugroup]) $s .= " selected";
			$s .= ">$r[ugroup]";
		}; 
		$s .= "</select> ";
		$s .= "</td></tr><tr><td colspan='2' class='einfo' align='right'>";
		$s .= "$GLOBALS[cat_m_user_person] <input type='text' name='user_person' size='32' maxlength='255' value='$z[person]'> ";
		$s .= "$GLOBALS[cat_m_user_email] <input type='text' name='user_email' size='32' maxlength='128' value='$z[email]'> ";
		$s .= "</td></tr><tr><td colspan='2' class='einfo' align='right'>";
		$s .= "$GLOBALS[cat_m_user_system] <input type='checkbox' name='user_system'";
		if($z[is_system] > 0) $s .= " checked";
		$s .="$ea> ";
		$s .= "$GLOBALS[cat_m_user_control] <input type='checkbox' name='user_control'";
		if($z[is_control] > 0) $s .= " checked";
		$s .="$ea> ";
		$s .= "$GLOBALS[cat_m_user_info] <input type='checkbox' name='user_info'";
		if($z[is_info] > 0) $s .= " checked";
		$s .="$ea> ";
		$s .= "<input type='submit' class='sub' value='$GLOBALS[cat_m_action]'>";
		$s .= "</td></tr></form>";			
		$s .= "</table><br><br>";
		return $s;
	}

	function update()
	{
		global $cat_db, $user_login;
		
		$res = $cat_db->query("select login from cat_users where login='$user_login'");
		if(count($res) == 1) {
			global $user_nlogin, $user_password, $user_person, $user_email, $user_ugroup, $user_system, $user_control, $user_info;
			
			if($user_login != $this->login) {
				if($user_system == 'on') $user_is_system = '1'; else $user_is_system = '0';
				if($user_info == 'on') $user_is_info = '1'; else $user_is_info = '0';
				if($user_control == 'on') $user_is_control = '1'; else $user_is_control = '0';
				$cat_db->query("update cat_users set login='$user_nlogin',passwd='$user_password',ugroup='$user_ugroup',person='$user_person',email='$user_email',is_system='$user_is_system',is_control='$user_is_control',is_info='$user_is_info' where login='$user_login'");			
			} else {
				$cat_db->query("update cat_users set passwd='$user_password',person='$user_person',email='$user_email' where login='$user_login'");			
				$this->person = $user_person;
				$this->email = $user_email;
			};
		};
		return '';
	}

	function showDeleteList()
	{
	        global $cat_db;
	
		$s = "<form action='".$this->URL."&cat_opt=".CAT_USER_DELETE."' method='post'><td class='eedit' align='right' valign='top'>";
		$s .= "$GLOBALS[cat_m_user_delete] <select name='user_login' size='1'> ";
	        $res = $cat_db->query("select * from cat_users order by login");
		for($i = 0; $i < count($res); $i++) {
			$r = $res[$i];
			if($r[login] != $this->login) $s .= "<option value='$r[login]'>$r[person]";
		}; 
		$s .= "</select> ";
		$s .= "<input type='submit' class='sub' value='$GLOBALS[cat_m_delete]'>";
		$s .= "</td></form></tr>";			
		return $s;
	}
	
	function delete()
	{
		global $cat_db, $user_login;
		
		if($user_login != $this->login) {
			$cat_db->query("delete from cat_users where login='$user_login'");			
		};
		return '';
		
	}
	
	function showList()
	{
		global $cat_db;
			
		$s = "<tr>";
		$s .= "<td class='header' align='center'>$GLOBALS[cat_m_user_login]</td>";
		$s .= "<td class='header' align='center'>$GLOBALS[cat_m_user_group]</td>";
		$s .= "<td class='header' align='center'>$GLOBALS[cat_m_user_person]</td>";
		$s .= "<td class='header' align='center'>$GLOBALS[cat_m_user_email]</td>";
		$s .= "<td align='center' colspan='2'>&nbsp;</td>";
		$s .= "</tr>";
		$res = $cat_db->query("select * from cat_users order by person");
		for($i = 0; $i < count($res); $i++) {
			$r = $res[$i];
			$s .= "<tr><td class='einfo'>$r[login]</td>";
			$s .= "<td class='einfo'>$r[ugroup]</td>";
			$s .= "<td class='einfo'>$r[person]</td>";				
			$s .= "<td class='einfo'><a href='mailto:$r[email]'>$r[email]</a></td>";				
			$s .= "<td valign='top' align='center' width='15'><a href='".$this->URL."&cat_opt=".CAT_USER_EDIT_FORM."&user_login=$r[login]'><img src='images/edit.gif' border='0' alt='$GLOBALS[cat_m_edit]' title='$GLOBALS[cat_m_edit]'></a></td>";
			$s .= "<td valign='top' align='center' width='15'><a href='#' onClick='if(confirm(\"$GLOBALS[cat_m_delete]?\")) window.location.href = \"".$this->URL."&cat_opt=".CAT_USER_DELETE."&user_login=$r[login]\"'><img src='images/delete.gif' border='0' alt='$GLOBALS[cat_m_delete]' title='$GLOBALS[cat_m_delete]'></a></td>";
			$s .= "</tr>";				
		}; 
		return $s;
	}

	function execute()
	{
		global $cat_opt, $cat_pos, $cat_mod;

		$this->URL = "?cat_pos=$cat_pos&cat_mod=$cat_mod";		
		$s = '';
		switch($cat_opt) {
			case(CAT_USER_INSERT) : {
				$s .= $this->insert();
				$s .= $this->show();			
				break;
			};
			case(CAT_USER_EDIT_FORM) : {
				$s .= $this->showEditForm();
				break;
			};
			case(CAT_USER_UPDATE) : {
				$s .= $this->update();
				$s .= $this->show();			
				break;
			};
			case(CAT_USER_DELETE) : {
				$s .= $this->delete();
				$s .= $this->show();			
				break;
			};
			default: {
				$s .= $this->show();							
			};
		};
		$s .= $this->group->execute(); 
		return $s;	
        }

    };

?>