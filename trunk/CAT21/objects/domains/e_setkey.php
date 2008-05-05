<?
	require_once("objects/domains/_base.php");

	class DomSetKey extends DomBase
	{
		function DomSetKey($str) 
		{
			$this->DomBase($str);
			$this->title = $GLOBALS[cat_m_dom_setkey];
			
			$this->sql = '';
			$this->valid = true;
			
			global $cat_db;
			$ltable = $this->rtable.'_'.$this->table;
			$res = $cat_db->query("show tables");
			$z = true;
			foreach($res as $r) {
				if($r[0] == $ltable) $z = false;
			};
			if($z) $cat_db->query("create table $ltable(`$this->table` int(8) not null,`$this->rtable` int(8) not null, key `i_$this->table` (`$this->table`), key `i_$this->rtable` (`$this->rtable`))");			
		}
		
		function onShow($str)
		{
			global $cat_db;

			$s = "<tr><td class='einfo' align='right' valign='top'>".$this->info."</td>";
			$s .= "<td class='eedit' align='justify' valign='top'>";
			$s .= $this->createInfo($str);
			$s .= "&nbsp;</td></tr>";
			return $s;	
		}

		function onList($str,$class)
		{
			$s = '';
			if($this->onlist) $s = "<td class='$class'>".$this->createInfo($str)."</td>";
			return $s;
		}

		function onInsertForm($str)
		{
			$e = array();
			return $this->onEditForm($e);
		}

		function getFromInput()
		{
			global $cat_db;
			$ltable = $this->rtable.'_'.$this->table;
			
			$p = $GLOBALS['dom_'.$this->name];
			$res = $cat_db->query("select name from cat_domains where in_table='$this->table' and object='DomKey'");
			if(count($res) == 1) {
				$key = $res[0]['name'];
				$val = $GLOBALS['dom_'.$key];

				if(!isset($val) || strlen($val) == 0) $val = '0';				
				$cat_db->query("delete from $ltable where $this->table='$val'");
				foreach($p as $r) {
					$cat_db->query("insert into $ltable set $this->table='$val',$this->rtable='$r'");	
				};
			};			
			return '';
		}

		function afterInsert($r)
		{
			global $cat_db;

			$ltable = $this->rtable.'_'.$this->table;
			
			$p = $GLOBALS['dom_'.$this->name];
			$res = $cat_db->query("select name from cat_domains where in_table='$this->table' and object='DomKey'");
			if(count($res) == 1) {
				$key = $res[0]['name'];
				$val = $r[$key];

				$cat_db->query("update $ltable set $this->table='$val' where $this->table='0'");	
			};			
			return '';
		}

		function onDelete($str)
		{
			global $cat_db;
			$ltable = $this->rtable.'_'.$this->table;
			
			$p = $GLOBALS['dom_'.$this->name];
			$res = $cat_db->query("select name from cat_domains where in_table='$this->table' and object='DomKey'");
			if(count($res) == 1) {
				$key = $res[0]['name'];
				$val = $str['dom_'.$key];
				$cat_db->query("delete from $ltable where $this->table='$val'");
			};			
			return;
		}	 

		function onEditForm($str)
		{
			$s = "<tr><td class='einfo' width='50%' align='right' valign='top'><font class='etitle'>";
			$s .= $this->info;
			$s .= "</font><br><font class='ecomment'>";		
			$s .= $this->comment; 
			$s .= "</font></td><td class='eedit' width='50%' valign='top'>";
			$s .= "<select name='dom_".$this->name."[]' size='10' style='width: 250px' multiple>";
			$s .= $this->createSelect($str);
			$s .= "</select>";
			$s .= "</td></tr>";
			return $s;		
		}

		function createSelect($str)
		{
			global $cat_db;
			
			$s = '';

			$res = $cat_db->query("select object from cat_tables where name='$this->rtable'");
			$tt = $res[0]['object'];	

			$res = $cat_db->query("select name from cat_domains where in_table='$this->table' and object='DomKey'");
			$val = $str[($res[0]['name'])];

			$res = $cat_db->query("select name from cat_domains where in_table='$this->rtable' and object='DomKey'");

			if(count($res) == 1) {
				$field = $res[0]['name'];
				$res = $cat_db->query("select * from cat_domains where in_table='$this->rtable' order by pos");
					$oa = array();
				$j = 0;
				$ltable = $this->rtable.'_'.$this->table;

				for($i = 0; $i < count($res); $i++) {
					eval('$obj = new '.$res[$i]['object'].'($res[$i]);');	
					if(is_object($obj) && $obj->isValid()) {
						$set[$j++] = $obj;
						if($obj->isOnSelect()) array_push($oa,$obj->getName());
					};
				};				

				if(count($oa) > 1)
					$res = $cat_db->query("select * from $this->rtable order by ".implode(",",$oa));
				else  {
					if(count($oa) == 1)
						$res = $cat_db->query("select * from $this->rtable order by $oa[0]");
					else 
						$res = $cat_db->query("select * from $this->rtable");				
				};

				$vals = $cat_db->query("select * from $ltable where $this->table='$val'");


				if($tt == "TabStructed") {
					$s .= $this->listIter(0, $res, 1, $set, $field, $vals); 
				} else {
					for($j = 0; $j < count($res); $j++) {
						
						$sp = "<option value='".$res[$j][$field]."'>";
						
						foreach($vals as $v) {
							if($res[$j][$field] == $v[$this->rtable])
								$sp = "<option value='".$res[$j][$field]."' selected>";
						};
		
						$s .= $sp;
						for($i = 0; $i < count($set); $i++)
							$s .= $set[$i]->onSelect($res[$j]);
						$s .= "</option>";
					};
				}
				
			};	
			return $s;		
		}

		function createInfo($str)
		{
			global $cat_db;

			$res = $cat_db->query("select name from cat_domains where in_table='$this->table' and object='DomKey'");
			$val = $str[($res[0]['name'])];
			$vals = $cat_db->query("select * from $ltable where $this->table='$val'");

			$res = $cat_db->query("select name from cat_domains where in_table='$this->rtable' and object='DomKey'");
			if(count($res) == 1) {
				$field = $res[0]['name'];
				$res = $cat_db->query("select * from cat_domains where in_table='$this->rtable' order by pos");
				$j = 0;
				for($i = 0; $i < count($res); $i++) {
					eval('$obj = new '.$res[$i]['object'].'($res[$i]);');	
					if(is_object($obj) && $obj->isValid()) {
						$set[$j++] = $obj;
					}
				};
	
				$ltable = $this->rtable.'_'.$this->table;

				$res = $cat_db->query("select * from $this->rtable, $ltable where $ltable.$this->table='$val' and $this->rtable.$field = $ltable.$this->rtable");
				foreach($res as $r) {
					for($i = 0; $i < count($set); $i++)
						$s .= $set[$i]->onSelect($r);
					$s .= "<br>";
				};
			};	
			return $s;	
		}

		function listIter($parent, $arr, $k, $set, $field, $vals)
		{
			global $cat_db;

			$s = '';
			if($k > 1000) return;
			foreach($arr as $a) {
				if($a['i_base'] == $parent) {
					$ss = "<option value='".$a[$field]."'>";

					foreach($vals as $v) {
						if($a[$field] == $v[$this->rtable])
							$ss = "<option value='".$a[$field]."' selected>";
					};
				
					$s .= $ss; 
						
					for($z = 0; $z < $k; $z++) $s .= "...";
					$s .= " ";
					for($i = 0; $i < count($set); $i++)
						$s .= $set[$i]->onSelect($a);
					$s .= "</option>";
					$s .= $this->listIter($a[$this->key], $arr, $k + 1, $set, $field, $vals);
				};
			};
			return $s;
		}

	};




?>