<?
	require_once("objects/tables/_base.php");

	class TabStructed extends TabBase
	{
	
		function TabStructed($table) 
		{
			$this->TabBase($table);
			$this->title = $GLOBALS[cat_m_tab_structed];
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

			$s .= "</table>";			
			return $s;
		}
	
		
		function showListInfo($user,$URL)
		{
			global $cat_db;
				
			$query = "select * from ".$this->table;			

			$a = array();
			foreach($this->domains as $d) {
				if($d->isSorter()) {
					array_push($a ,"'".$d->getName()."'");
				};
			};

			if(count($a) > 0) $query .= " order by ".implode(",",$a);
			$res = $cat_db->query($query);
			                
			if(count($res) > 0) {
				$s = "<table width='100%' border='0' cellpadding='2' cellspacing='1' class='pt9'>";
				$s .= "<tr><td colspan='4' align='left'>&nbsp;</td></tr>";				
				$s .= "<tr><td colspan='4' align='left'><font class='ecomment'>$GLOBALS[cat_m_top_menu]</font></td></tr>";				
				
				$s .= $this->listIter(0,$res,1,$user,$URL);

				$s .= "</table><br>";
			} else {
				$s = "<span class='norecord'>$GLOBALS[cat_m_norecords]</span>";
			};			
			return $s;

		}
		
		function listIter($parent, $arr, $k, $user, $URL)
		{
			$s = '';
			if($k > 1000) return;
			foreach($arr as $a) {
				if($a['i_base'] == $parent) {
					$s .= "<tr><td width='100%'><table border='0' cellpadding='0' cellspacing='0' width='100%' class='pt9'>";	
					if($k % 2 == 0) $l_class = 'finfo'; else $l_class = 'ninfo';

					$s .= "<td width='1%'>";
					for($z = 0; $z < $k; $z++) $s .= ".....";
					$s .= "</td>";
					for($i = 0; $i < count($this->domains); $i++) {
						$s .= $this->domains[$i]->onList($a,$l_class);
					};

					$l_keyname = $this->domains[$this->key]->getName();
					$l_key = 'dom_'.$l_keyname.'='.rawurlencode($a[$l_keyname]);

					$s .= "</table></td><td valign='top' align='center' width='15'><a href='$URL&cat_opt=".CAT_TABLE_SHOW."&$l_key'><img src='images/show.gif' border='0' alt='$GLOBALS[cat_m_show]' title='$GLOBALS[cat_m_show]'></a></td>";
					if($user->isEdit($this->table)) {
						$s .= "<td valign='top' align='center' width='15'><a href='$URL&cat_opt=".CAT_TABLE_EDIT_FORM."&$l_key'><img src='images/edit.gif' border='0' alt='$GLOBALS[cat_m_edit]' title='$GLOBALS[cat_m_edit]'></a></td>";
						$s .= "<td valign='top' align='center' width='15'><a href='#' onClick='if(confirm(\"$GLOBALS[cat_m_delete]?\")) window.location.href = \"$URL&cat_opt=".CAT_TABLE_DELETE."&$l_key\"'><img src='images/delete.gif' border='0' alt='$GLOBALS[cat_m_delete]' title='$GLOBALS[cat_m_delete]'></a></td>";
					} else {
						$s .= "<td valign='top' align='center' width='15'><img src='images/edit.gif' border='0' alt='$GLOBALS[cat_m_edit]' title='$GLOBALS[cat_m_edit]'></td>";
						$s .= "<td valign='top' align='center' width='15'><img src='images/delete.gif' border='0' alt='$GLOBALS[cat_m_delete]' title='$GLOBALS[cat_m_delete]'></td>";
					};
					$s .= "</tr>";	

					$s .= $this->listIter($a[$this->key], $arr, $k + 1, $user, $URL);
				};
			};
			return $s;
		}
		

	};




?>