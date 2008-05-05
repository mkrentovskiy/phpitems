<?
        define('CAT_TABLE_INSERT_FORM',1);
        define('CAT_TABLE_INSERT',2);
        define('CAT_TABLE_EDIT_FORM',3);
        define('CAT_TABLE_UPDATE',4);
        define('CAT_TABLE_DELETE',5);
        define('CAT_TABLE_LIMIT',6);
        define('CAT_TABLE_SORT',7);
        define('CAT_TABLE_SHOW',8);
        define('CAT_TABLE_SEARCH',9);
	
	class TabBase
	{
		var 	$title;

		var	$table;
		var	$info;
		var	$area;

		var	$domains;
		var	$valid;
		
		var	$limited;
		var	$limitstr;

		var	$orderby;
		var	$rev;
			
		var	$search;
		var	$search_on;
		
		var	$key;
		var	$cpage;
		
		function TabBase($table) 
		{
			$this->title = $GLOBALS[cat_m_tab_base];
			$this->valid = false;

			if(strlen($table) > 0) {
				global $cat_db;
			
				$this->table = $table;

				$res = $cat_db->query("select cat_tables.title, cat_areas.area from cat_tables,cat_areas where cat_areas.id_area=cat_tables.area and cat_tables.name='$table'");
				if(count($res) != 1) return;
				$this->info = $res[0]['title'];
				$this->area = $res[0]['area'];

				$res = $cat_db->query("select * from cat_domains where in_table='$this->table' order by pos");
				$k = 0;
				for($i = 0; $i < count($res); $i++) {
					eval('$obj = new '.$res[$i][object].'($res[$i]);');	
					if(is_object($obj) && $obj->isValid()) {
						$this->domains[$k] = $obj;
						if($obj->isKey()) $this->key = $k;
						$k++;
					};    				
				};
				
				$this->orderby = '';
				$this->orderby = false;

				$this->search = '';
				$this->search_on = '';


				$this->limited = false;
				$this->limitstr = '';
				
				$this->cpage = 0;				

				$this->valid = true;
			} else {
				$table = '';
			};
		}
	
		function getTitle()
		{
			return $this->title;
		}

		function isValid()
		{
			return $this->valid;
		}

		function getDomain($n) 
		{
			$r = -1;
			for($i = 0; $i < count($this->domains); $i++) {
				if($this->domains[$i]->getNice() == $n) {
					$r = $i;  
			                break;
				};			
			};
			return $r;
		}
		
	
		function showList($user)
		{
			global	$cat_pos, $cat_mod, $cat_obj;

			$URL = "?cat_pos=$cat_pos&cat_mod=$cat_mod&cat_obj=$cat_obj";
			
			$s = "<table width='100%' border='0' cellpadding='1' cellspacing='0' class='pt9'>";
			$s .= "<tr><td align='left' width='50%'><font class='title'>$this->area <font class='pointer'>&gt;</font> $this->info</font></td>";
			$s .= "<td align='right' width='50%'><a href='$URL&cat_opt=".CAT_TABLE_INSERT_FORM."' class='pages'><img src='images/insert.gif' border='0' alt='$GLOBALS[cat_m_insert]' title='$GLOBALS[cat_m_insert]'>&nbsp;&nbsp;$GLOBALS[cat_m_add]</a></td></tr>";			

			$s .= "<tr><td align='center' colspan='2'>";
			$s .= $this->showListInfo($user,$URL);
			$s .= "</td></tr>";

			$s .= "<tr><td align='right' colspan='2'>";
			$s .= $this->showListPages($URL);
			$s .= "</td></tr>";

			$s .= "<tr><td align='center' colspan='2'>";
			$s .= $this->showListControls($URL);
			$s .= "</td></tr>";

			$s .= "</table>";			
			return $s;
		}
	
		function showInsertForm()
		{       
			global	$cat_pos, $cat_mod, $cat_obj;

			$p = array();
			$s = "<form enctype='multipart/form-data' action='index.php' method='post'>";
			$s .= "<input type='hidden' name='cat_pos' value='$cat_pos'>";
			$s .= "<input type='hidden' name='cat_mod' value='$cat_mod'>";
			$s .= "<input type='hidden' name='cat_obj' value='$cat_obj'>";
			$s .= "<input type='hidden' name='cat_opt' value='".CAT_TABLE_INSERT."'>";
			$s .= "<table width='100%' border='0' cellpadding='2' cellspacing='1' class='pt9'>";
			$s .= "<tr><td align='left' colspan='2'><font class='title'>$this->area <font class='pointer'>&gt;</font> $this->info <font class='pointer'>&gt;</font> $GLOBALS[cat_m_insert]</font></td></tr>";			
			for($i = 0; $i < count($this->domains); $i++) {
				$s .= $this->domains[$i]->onInsertForm($p);		
			};
			$s .= "<tr><td align='right' class='einfo' width='50%'><input type='submit' class='sub' value='$GLOBALS[cat_m_action]'></td></form>";
			$s .= "<form action='index.php' method='post'>";
			$s .= "<input type='hidden' name='cat_pos' value='$cat_pos'>";
			$s .= "<input type='hidden' name='cat_mod' value='$cat_mod'>";
			$s .= "<input type='hidden' name='cat_obj' value='$cat_obj'>";
			$s .= "<td align='left' class='eedit' width='50%'><input type='submit' class='sub' value='$GLOBALS[cat_m_cancel]'></td></form></tr>";
			$s .= "</table>";			
			return $s;
		}
		
		function insert($user)
		{
			global $cat_db, $cat_log;

			$a = array();
			for($i = 0; $i < count($this->domains); $i++) {
				$z = $this->domains[$i]->getFromInput();
				if(strlen($z) > 0) {
					array_push($a, $this->domains[$i]->getName()."='".$z."'");
				};
			};
	                $cat_db->query("insert into $this->table set ".implode(',', $a));
			$cat_log->event("$this->table","insert");

		        $res = $cat_db->query("select * from $this->table where ".implode(' and ', $a));
			foreach($this->domains as $d) $d->afterInsert($res[0]);
			return $GLOBALS[cat_m_ok];
		}
	
		function insertDomain($d)
		{
			global $cat_db;	
	
			eval('$obj = new '.$d[object].'($d);');	
			if(is_object($obj) && $obj->isValid()) {
				$sql = $obj->getSQL();
				$cat_db->query("alter table $this->table add $sql");

				/* $res = $cat_db->query("select * from cat_domains where in_table='$this->table' order by pos");
				$k = 0;
				$this->domains = array();
				for($i = 0; $i < count($res); $i++) {
					eval('$obj = new '.$res[$i][object].'($res[$i]);');	
					print('$obj = new '.$res[$i][object].'($res[$i]);');	
					if(is_object($obj) && $obj->isValid()) {
						$this->domains = $obj;
						if($obj->isKey()) $this->key = $k;
						$k++;
					};    				
				};*/
			};    				
			return '';			
		}
	
		function showEditForm()
		{
			global	$cat_db, $cat_pos, $cat_mod, $cat_obj;

			$key = $this->domains[$this->key]->getName();
			$val = $this->domains[$this->key]->getFromInput();
			$val = rawurldecode($val);

			$res = $cat_db->query("select * from $this->table where $key='$val'");
			
			if(count($res) != 1) {
				$s = "<font class='title'><b>$GLOBALS[cat_m_error_nofound]</b></font><br>
				<font class='pt8' color='#666666'>$GLOBALS[cat_m_error_comment]</font>";
				return $s;
			};

			$s = "<form enctype='multipart/form-data' action='index.php' method='post'>";
			$s .= "<input type='hidden' name='cat_pos' value='$cat_pos'>";
			$s .= "<input type='hidden' name='cat_mod' value='$cat_mod'>";
			$s .= "<input type='hidden' name='cat_obj' value='$cat_obj'>";
			$s .= "<input type='hidden' name='cat_opt' value='".CAT_TABLE_UPDATE."'>";
			$s .= "<table width='100%' border='0' cellpadding='2' cellspacing='1' class='pt9'>";
			$s .= "<tr><td align='left' colspan='2'><font class='title'>$this->area <font class='pointer'>&gt;</font> $this->info <font class='pointer'>&gt;</font> $GLOBALS[cat_m_edit]</font></td></tr>";			
			for($i = 0; $i < count($this->domains); $i++) {
				$s .= $this->domains[$i]->onEditForm($res[0]);		
			};
			$s .= "<tr><td align='right' class='einfo' width='50%'><input type='submit' class='sub' value='$GLOBALS[cat_m_action]'></td></form>";
			$s .= "<form action='index.php' method='post'>";
			$s .= "<input type='hidden' name='cat_pos' value='$cat_pos'>";
			$s .= "<input type='hidden' name='cat_mod' value='$cat_mod'>";
			$s .= "<input type='hidden' name='cat_obj' value='$cat_obj'>";
			$s .= "<td align='left' class='eedit' width='50%'><input type='submit' class='sub' value='$GLOBALS[cat_m_cancel]'></td></form></tr>";
			$s .= "</table>";			
			return $s;
		}
		
		function update($user)
		{
			global $cat_db, $cat_log;

			$key = $this->domains[$this->key]->getName();
			$val = $this->domains[$this->key]->getFromInput();
			$val = rawurldecode($val);

			$res = $cat_db->query("select * from $this->table where $key='$val'");		
			if(count($res) != 1) return $GLOBALS[cat_m_error_nofound];

			$v = '';
			for($i = 0; $i < count($this->domains); $i++) {
				$this->domains[$i]->onEdit($res[0]);			
				$z = $this->domains[$i]->getFromInput();
				if(strlen($z) > 0) {
					if(strlen($v) > 0) $v .= ",".$this->domains[$i]->getName()."='".$z."'";
					else $v = $this->domains[$i]->getName()."='".$z."'";
				};
			};
	                $cat_db->query("update $this->table set $v where $key='$val'");
			$cat_log->event("$this->table","update [$key=$val]");
			return $GLOBALS[cat_m_ok];
		}
		
		
		function updateDomain($d)
		{
			global $cat_db;	
	
			$dom = $this->getDomain($d[id_domains]);
			if($dom != -1) {
				$name = $this->domains[$dom]->getName();
				eval('$obj = new '.$d[object].'($d);');	
				/*if(is_object($obj) && $obj->isValid()) {
					$this->domains[$dom] = $obj;
				} else return '';  			*/
				$sql = $obj->getSQL();
				$cat_db->query("alter table $this->table change $name $sql");
			};
			return '';						
		}
		
		/*
		function updateInfo($tname, $ttitle, $tarea)
		{
			$this->info = $ttitle;
			$this->area = $tarea;

			if($this->table != $tname) {
				$res = $cat_db->query("alter table $this->table rename $tname");
				$this->table = $tname;
			};
			return '';
		}
		*/

		function delete($user)
		{
			global $cat_db, $cat_log;

			$key = $this->domains[$this->key]->getName();
			$val = $this->domains[$this->key]->getFromInput();
			$val = rawurldecode($val);

			$res = $cat_db->query("select * from $this->table where $key='$val'");		
			if(count($res) != 1) return $GLOBALS[cat_m_error_nofound];

			for($i = 0; $i < count($this->domains); $i++) {
				$this->domains[$i]->onDelete($res[0]);			
			};
	                $cat_db->query("delete from $this->table where $key='$val'");
			$cat_log->event("$this->table","delete [$key=$val]");
			return $GLOBALS[cat_m_ok];
		}		
		
		function deleteDomain($d)
		{			
			global $cat_db;	
	
			$dom = $this->getDomain($d[id_domains]);
			if($dom != -1) {
				$name = $this->domains[$dom]->getName();
				$cat_db->query("alter table $this->table drop $name");
				/* array_splice ($this->domains, $dom);*/
			};
			return '';			
		}


		function show($user)
		{
			global	$cat_db, $cat_pos, $cat_mod, $cat_obj, $cat_session;

			$key = $this->domains[$this->key]->getName();
			$val = $this->domains[$this->key]->getFromInput();
			$val = rawurldecode($val);

			$res = $cat_db->query("select * from $this->table where $key='$val'");
			
			if(count($res) != 1) {
				$s = "<font class='title'><b>$GLOBALS[cat_m_error_nofound]</b></font><br>
				<font class='pt8' color='#666666'>$GLOBALS[cat_m_error_comment]</font>";
				return $s;
			};

			$s = "<table width='100%' border='0' cellpadding='2' cellspacing='1' class='pt9'>";
			$s .= "<tr><td align='left' colspan='2'><font class='title'>$this->area <font class='pointer'>&gt;</font> $this->info <font class='pointer'>&gt;</font> $GLOBALS[cat_m_show]</font></td></tr>";			
			for($i = 0; $i < count($this->domains); $i++) {
				$s .= $this->domains[$i]->onShow($res[0]);		
			};

			$s .= "<tr><td align='left' colspan='2'><table width='100%' border='0' cellpadding='0' cellspacing='10' class='pt9'>";

			$res = $cat_db->query("select cat_domains.*,cat_tables.title as tbtitle,cat_tables.object as tobj from cat_domains,cat_tables where cat_domains.r_table='$this->table' and cat_domains.in_table=cat_tables.name");
			
			foreach($res as $r) {				
				$tb = $r['in_table'];

				if($user->isShow($tb) && $user->isInfo()) {
					$s .= "<tr><td valign='top' align='left'>";							
					$s .= "<b>$r[tbtitle]</b><br>";		
					if($cat_session->isRegistered('cat_table_'.$tb)) {
						$obj = $cat_session->get('cat_table_'.$tb);
					} else {
						eval('$obj = new '.$r['tobj'].'($tb);');							
					};
					if(is_object($obj) && $obj->isValid()) {				
						$URL = "?cat_pos=$cat_pos&cat_mod=$cat_mod&cat_obj=$tb";
						$s .= $obj->showLinkedListInfo($user,$URL,"$r[name]='$val'");
					};
					$s .= "</td></tr>";							
				};				
			};		
						
			$s .= "</table></td></tr>";			


			$s .= "<tr><td align='right' class='einfo' width='50%'>&nbsp;</td>";
			$s .= "<form action='index.php' method='post'>";
			$s .= "<input type='hidden' name='cat_pos' value='$cat_pos'>";
			$s .= "<input type='hidden' name='cat_mod' value='$cat_mod'>";
			$s .= "<input type='hidden' name='cat_obj' value='$cat_obj'>";
			$s .= "<td align='left' class='eedit' width='50%'><input type='submit'  class='sub' value='$GLOBALS[cat_m_cancel]'></td></form></tr>";

			$s .= "</table>";			
			return $s;
		}
		
		function showListInfo($user,$URL)
		{
			global $cat_db, $cat_begin, $cat_tv_npp;
			
			if(!isset($cat_begin)) $cat_begin = $this->cpage;
			else $this->cpage = $cat_begin;

			if($cat_begin > 0) $cat_begin--;			

			$query = "select * from ".$this->table;			
			if($this->limited) {
				$l_lim = str_replace(","," and ",$this->limitstr);
				$query .= " where ".$l_lim;
			};
			if(strlen($this->search) > 1) {
	        	$src = "QWERTYUIOPASDFGHJKLZXCVBNMЁЙЦУКЕНГШЩЗХЪФЫВАПРОЛДЖЭЯЧСМИТЬБЮ,./';[]`~|_=+{}?<>!@#$%^&*()�:";
				$dst = "qwertyuiopasdfghjklzxcvbnmёйцукенгшщзхъфывапролджэячсмитьбю                              ";
		
				$tr = strtr($this->search,$src,$dst);			
				$k = explode(' ', $tr);
		
				$rule = array();
				foreach($k as $it) {
					if(strlen($it) > 1) {
						if(strlen($this->search_on) > 1) {
							array_push($rule,"lcase($this->search_on) like '%$it%'");	
						} else {
							foreach($this->domains as $d)
								array_push($rule,"lcase(".$d->getName().") like '%$it%'");
						};
					};
				};
				$ss = implode(" or ",$rule);		

				if($this->limited) $query .= " and (".$ss.")";
				else $query .= " where ".$ss;
			};
			if(strlen($this->orderby) > 1) {
				$query .= " order by ".$this->orderby;
				if($this->rev) {
					$query .= " desc";
				};		        
			};
			$query .= " limit $cat_begin, $cat_tv_npp";
			$res = $cat_db->query($query);
			                
			// print $query;
			
			if(count($res) > 0) {
				$s = "<table width='100%' border='0' cellpadding='2' cellspacing='1' class='pt9'>";
				
				$s .= "<tr>";	
				for($i = 0; $i < count($this->domains); $i++) {
					$s .= $this->domains[$i]->onListTitle();
				};
				$s .= "<td colspan='3' class='header' width='45'>&nbsp;</td></tr>";	

				for($j = 0; $j < count($res); $j++) {
					$s .= "<tr>";	
					if($j % 2 == 0) $l_class = 'finfo'; else $l_class = 'ninfo';
					for($i = 0; $i < count($this->domains); $i++) {
						$s .= $this->domains[$i]->onList($res[$j],$l_class);
					};

					$l_keyname = $this->domains[$this->key]->getName();
					$l_key = 'dom_'.$l_keyname.'='.rawurlencode($res[$j][$l_keyname]);

					$s .= "<td valign='top' align='center' width='15'><a href='$URL&cat_opt=".CAT_TABLE_SHOW."&$l_key'><img src='images/show.gif' border='0' alt='$GLOBALS[cat_m_show]' title='$GLOBALS[cat_m_show]'></a></td>";
					if($user->isEdit($this->table)) {
						$s .= "<td valign='top' align='center' width='15'><a href='$URL&cat_opt=".CAT_TABLE_EDIT_FORM."&$l_key'><img src='images/edit.gif' border='0' alt='$GLOBALS[cat_m_edit]' title='$GLOBALS[cat_m_edit]'></a></td>";
						$s .= "<td valign='top' align='center' width='15'><a href='#' onClick='if(confirm(\"$GLOBALS[cat_m_delete]?\")) window.location.href = \"$URL&cat_opt=".CAT_TABLE_DELETE."&$l_key\"'><img src='images/delete.gif' border='0' alt='$GLOBALS[cat_m_delete]' title='$GLOBALS[cat_m_delete]'></a></td>";
					} else {
						$s .= "<td valign='top' align='center' width='15'><img src='images/edit.gif' border='0' alt='$GLOBALS[cat_m_edit]' title='$GLOBALS[cat_m_edit]'></td>";
						$s .= "<td valign='top' align='center' width='15'><img src='images/delete.gif' border='0' alt='$GLOBALS[cat_m_delete]' title='$GLOBALS[cat_m_delete]'></td>";
					};
					$s .= "</tr>";	
				}
				$s .= "</table><br>";
			} else {
				$s = "<span class='norecord'>$GLOBALS[cat_m_norecords]</span>";
			};			
			return $s;

		}

		function showLinkedListInfo($user,$URL,$lim)
		{
			global $cat_db;
			
			$query = "select * from ".$this->table." where ".$lim;
			$res = $cat_db->query($query);
			                
			// print $query;
			
			if(count($res) > 0) {
				$s = "<table width='100%' border='0' cellpadding='2' cellspacing='1' class='pt9'>";
				
				$s .= "<tr>";	
				for($i = 0; $i < count($this->domains); $i++) {
					$s .= $this->domains[$i]->onListTitle();
				};
				$s .= "<td colspan='3' class='header' width='45'>&nbsp;</td></tr>";	

				for($j = 0; $j < count($res); $j++) {
					$s .= "<tr>";	
					if($j % 2 == 0) $l_class = 'finfo'; else $l_class = 'ninfo';
					for($i = 0; $i < count($this->domains); $i++) {
						$s .= $this->domains[$i]->onList($res[$j],$l_class);
					};

					$l_keyname = $this->domains[$this->key]->getName();
					$l_key = 'dom_'.$l_keyname.'='.rawurlencode($res[$j][$l_keyname]);

					$s .= "<td valign='top' align='center' width='15'><a href='$URL&cat_opt=".CAT_TABLE_SHOW."&$l_key'><img src='images/show.gif' border='0' alt='$GLOBALS[cat_m_show]' title='$GLOBALS[cat_m_show]'></a></td>";
					if($user->isEdit($this->table)) {
						$s .= "<td valign='top' align='center' width='15'><a href='$URL&cat_opt=".CAT_TABLE_EDIT_FORM."&$l_key'><img src='images/edit.gif' border='0' alt='$GLOBALS[cat_m_edit]' title='$GLOBALS[cat_m_edit]'></a></td>";
						$s .= "<td valign='top' align='center' width='15'><a href='$URL&cat_opt=".CAT_TABLE_DELETE."&$l_key'><img src='images/delete.gif' border='0' alt='$GLOBALS[cat_m_delete]' title='$GLOBALS[cat_m_delete]'></a></td>";
					} else {
						$s .= "<td valign='top' align='center' width='15'><img src='images/edit.gif' border='0' alt='$GLOBALS[cat_m_edit]' title='$GLOBALS[cat_m_edit]'></td>";
						$s .= "<td valign='top' align='center' width='15'><img src='images/delete.gif' border='0' alt='$GLOBALS[cat_m_delete]' title='$GLOBALS[cat_m_delete]'></td>";
					};
					$s .= "</tr>";	
				}
				$s .= "</table>";
			} else {
				$s = "<span class='norecord'>$GLOBALS[cat_m_norecords]</span>";
			};			
			return $s;

		}
		
		function showListControls($URL)
		{
			
			$p = '';

			$s = "<table width='100%' border='0' cellpadding='1' cellspacing='0' bgcolor='#a9a9a9'><tr><td align='center'>";
			$s .= "<table width='100%' border='0' cellpadding='10' cellspacing='0' bgcolor='#f9f9f9' class='pt9'><tr><td align='right'>";
			$s .= "<form action='$URL' method='POST'><input type='hidden' name='cat_opt' value='".CAT_TABLE_SORT."'>$GLOBALS[cat_m_sort] <select name='cat_field' size='1'>";
			for($i = 0; $i < count($this->domains); $i++) {
				if($this->domains[$i]->isOnList()) {
					if($this->orderby == $this->domains[$i]->getName()) {
						$s .= "<option value='".$this->domains[$i]->getName()."' selected>".$this->domains[$i]->getInfo()."</option>";
					} else {
						$s .= "<option value='".$this->domains[$i]->getName()."'>".$this->domains[$i]->getInfo()."</option>";
					};
				};	
				if($this->domains[$i]->isParKey()) {
					if(strlen($p) == 0) {
	                                	$l_z = explode(',',$this->limitstr);
						for($j = 0; $j < count($l_z); $j++) {
							list($key,$pvalue) = explode('=',$l_z[$j]);
							list($vf,$value,$vn) = explode('\'',$pvalue);
							$l_lim[$key] = $value;
						};
					};
					$p .= $this->domains[$i]->onFilterForm($l_lim)." ";
				};			
			};
			$s .= "</select> $GLOBALS[cat_m_desc] <input type='checkbox' name='cat_desc'";
			if($this->rev) $s .= " checked";
			$s .= "><input type='submit' class='sub' value='$GLOBALS[cat_m_action]'></form>";
			$s .= "</td></tr></table>";
			$s .= "</td></tr></table><img src='images/spacer.gif' width='1' height='3' alt='' border='0'>";
			
			if(strlen($p) > 0) {
				$s .= "<table width='100%' border='0' cellpadding='1' cellspacing='0' bgcolor='#a9a9a9'><tr><td align='center'>";
				$s .= "<table width='100%' border='0' cellpadding='10' cellspacing='0' bgcolor='#f9f9f9' class='pt9'><tr><td align='right' width='100%'>";
				$s .= "<form action='$URL' method='POST'><input type='hidden' name='cat_opt' value='".CAT_TABLE_LIMIT."'>$GLOBALS[cat_m_filter] ";
				$s .= $p;
				$s .= " $GLOBALS[cat_m_ison] <input type='checkbox' name='cat_limited'";
				if($this->limited) $s .= " checked";
				$s .= "><input type='submit' class='sub' value='$GLOBALS[cat_m_action]'></form>";
				$s .= "</td></tr></table>";				
				$s .= "</td></tr></table><img src='images/spacer.gif' width='1' height='3' alt='' border='0'>";
			};

			$s .= "<table width='100%' border='0' cellpadding='1' cellspacing='0' bgcolor='#a9a9a9'><tr><td align='center'>";
			$s .= "<table width='100%' border='0' cellpadding='10' cellspacing='0' bgcolor='#f9f9f9' class='pt9'><tr><td align='right' width='100%'>";
			$s .= "<form action='$URL' method='POST'><input type='hidden' name='cat_opt' value='".CAT_TABLE_SEARCH."'>$GLOBALS[cat_m_search] ";
			$s .= " <input type='text' name='cat_search' size='20' value='".$this->search."'> ";
			$s .= "$GLOBALS[cat_m_search_on] <select name='cat_search_on' size='1'>";
			$s .= "<option value=''>--</option>";
			for($i = 0; $i < count($this->domains); $i++) {
				if(!$this->domains[$i]->isKey()) {
					if($this->search_on == $this->domains[$i]->getName()) {
						$s .= "<option value='".$this->domains[$i]->getName()."' selected>".$this->domains[$i]->getInfo()."</option>";
					} else {
						$s .= "<option value='".$this->domains[$i]->getName()."'>".$this->domains[$i]->getInfo()."</option>";
					};
				};
			};	
			$s .= "</select> ";
			$s .= "<input type='submit' class='sub' value='$GLOBALS[cat_m_action]'></form>";
			$s .= "</td></tr></table>";				
			$s .= "</td></tr></table>";
			
			return $s;
		}
		
		function showListPages($URL)
		{
			global $cat_db, $cat_begin, $cat_tv_npp, $cat_tv_ppp;

			$ckey = "count(".$this->domains[$this->key]->getName().")";
			$query = "select $ckey from ".$this->table;
			if($this->limited) {
				$l_lim = str_replace(","," and ",$this->limitstr);
				$query .= " where ".$l_lim;
			};
			$res = $cat_db->query($query);
			if(count($res) == 1) $total = $res[0][$ckey];
			else $total = 0; 	

			$s = "$GLOBALS[cat_m_pages] : ";
		        if(($total % $cat_tv_npp) > 0) $npages = floor($total / $cat_tv_npp) + 1;
	    		else $npages = floor($total / $cat_tv_npp);

			$begin = $cat_begin;
			
    			$begin++;
			$cpage = ($begin - ($begin % $cat_tv_npp)) / $cat_tv_npp;   
	    		
        
    			$bp = $cpage - round($cat_tv_ppp / 2) + 1;
    			$ep = $cpage + round($cat_tv_ppp / 2);	
    			// $bp = $cpage - $cat_tv_ppp / 2 + 1;
    			// $ep = $cpage + $cat_tv_ppp / 2;	
			// $bp = floor($begin / $cat_tv_ppp) - $cat_tv_ppp / 2 + 1;
	    		// $ep = floor($begin / $cat_tv_ppp) + $cat_tv_ppp / 2;
	    		if($bp < 1) { $ep = $ep + (1 - $bp); $bp = 1; }; 
		    	if($ep > $npages) { $bp = $bp - ($ep - $npages); $ep = $npages; };
	    		if($bp < 1 || $ep > $npages || $bp > $ep) { $bp = 1; $ep = $npages; }; 
    
	   		if($bp > 1) {
				$b = ($bp - 2) * $cat_tv_npp + 1;
				$e = ($bp - 1) * $cat_tv_npp;	
				$s .= "&nbsp;<a title='[$b-$e]' href='$URL&cat_begin=$b' class='pages'>&lt;</a>&nbsp;|&nbsp;";
	    		};
    
	    		for($i = $bp; $i < ($ep + 1); $i++) {
				$b = ($i - 1) * $cat_tv_npp + 1;
				$e = $i * $cat_tv_npp;
				if($begin >= $b && $begin <= $e) {
				if($i < $ep)
		    			$s .= "&nbsp;<b><font class='cpage'>$i</font></b>&nbsp;|";
				else 
					$s .= "&nbsp;<b><font class='cpage'>$i</font>&nbsp;</b>";		
				} else {
					if($i < $ep)
		    				$s .= "&nbsp;<a title='[$b-$e]' href='$URL&cat_begin=$b' class='pages'>$i</a>&nbsp;|";
					else
		    				$s .= "&nbsp;<a title='[$b-$e]' href='$URL&cat_begin=$b' class='pages'>$i</a>&nbsp;";
				};
	    		};

	    		if($ep < $npages) {
				$b = $ep * $cat_tv_npp + 1;
				$e = ($ep + 1) * $cat_tv_npp;	
				$s .= "|&nbsp;<a title='[$b-$e]' href='$URL&cat_begin=$b' class='pages'>&gt;</a>&nbsp;";
	    		};
	    
			$s .= " <br>$GLOBALS[cat_m_total] : <b><font class='cpage'>$total</font></b> &nbsp;";			

			return $s;
		
		}		

		function setLimits()
		{
			global 	$cat_limited, $cat_session;
				
			if($cat_limited == 'on') $this->limited = true;
			else $this->limited = false;
			
			$p = '';
			for($i = 0; $i < count($this->domains); $i++) {
				if($this->domains[$i]->isParKey()) {
					$val = $this->domains[$i]->getFromInput();
					if(strlen($val) > 0) {
						if(strlen($p) != 0) $p .= ","; 
						$p .= $this->domains[$i]->getName()."='".$val."'";
						$cat_session->set('l_'.$this->table.'_'.$this->domains[$i]->getName(), $val);
					};
				};			
			};
			$this->limitstr = $p;
		  	
	
			if(strlen($this->limitstr) == 0) $this->limited = false; 
		}

		function setSorted()
		{
			global	$cat_field, $cat_desc;

			$this->orderby = $cat_field;
			if($cat_desc == 'on') $this->rev = true;
			else $this->rev = false;		
		}		

		function setSearch()
		{
			global	$cat_search, $cat_search_on;

			$this->search = $cat_search;
			$this->search_on = $cat_search_on;
		}		
		
		function getOpResult($error)
		{
			if(strlen($error) == 0) $error = $GLOBALS[cat_m_noresult];

			$s = "<table width='100%' border='0' cellpadding='1' cellspacing='0' bgcolor='#a9a9a9'><tr><td align='center'>";
			$s .= "<table width='100%' border='0' cellpadding='10' cellspacing='0' bgcolor='#f0f0f0' class='pt8'><tr><td align='center'>";
			$s .= "<font class='result'>$GLOBALS[cat_m_result]</font> : $error";
			$s .= "</td></tr></table>";
			$s .= "</td></tr></table><br>";
 			return $s;
		}
		
		function execute($user)
		{
			if(!$this->valid) return;
			
			global $cat_opt;
			
			$s = ''; 
			switch($cat_opt) {
				case(CAT_TABLE_INSERT_FORM): {
					if($user->isShow($this->table) && $user->isInfo()) {
						$s .= $this->showInsertForm();
					};
					break;
				};
				case(CAT_TABLE_INSERT): {
					if($user->isShow($this->table) && $user->isInfo()) {
						if($user->isEdit($this->table)) {
							$z = $this->insert($user);
							$s .= $this->getOpResult($z); 							
						};
						$s .= $this->showList($user);
					};
					break;
				};
				case(CAT_TABLE_EDIT_FORM): {
					if($user->isShow($this->table) && $user->isInfo()) {
						$s .= $this->showEditForm($user);
					};
					break;
				};
				case(CAT_TABLE_UPDATE): {
					if($user->isShow($this->table) && $user->isInfo()) {
						if($user->isEdit($this->table)) {
							$z = $this->update($user);
							$s .= $this->getOpResult($z); 							
						};
						$s .= $this->showList($user);
					};
					break;
				};
				case(CAT_TABLE_DELETE): {
					if($user->isShow($this->table) && $user->isInfo()) {
						if($user->isEdit($this->table)) {
							$z = $this->delete($user);
							$s .= $this->getOpResult($z); 							
						};
						$s .= $this->showList($user);
					};
					break;
				};
				case(CAT_TABLE_LIMIT): {
					if($user->isShow($this->table) && $user->isInfo()) {
						$s .= $this->setLimits();
						$s .= $this->showList($user);				
					};
					break;
				};
				case(CAT_TABLE_SORT): {
					if($user->isShow($this->table) && $user->isInfo()) {
						$s .= $this->setSorted();
						$s .= $this->showList($user);				
					};
					break;
				};
				case(CAT_TABLE_SEARCH): {
					if($user->isShow($this->table) && $user->isInfo()) {
						$s .= $this->setSearch();
						$s .= $this->showList($user);				
					};
					break;
				};
				case(CAT_TABLE_SHOW): {
					if($user->isShow($this->table) && $user->isInfo()) {
						$s .= $this->show($user);
					};
					break;
				};
				default: {
			        	if($user->isShow($this->table) && $user->isInfo()) 
						$s .= $this->showList($user);
				};
			};
			
			return $s;
		}	
	};




?>