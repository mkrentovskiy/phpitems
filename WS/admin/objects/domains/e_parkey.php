<?
	require_once("objects/domains/_base.php");

	class DomParKey extends DomBase
	{
		function DomParKey($str) 
		{
			$this->DomBase($str);
			$this->title = $GLOBALS[cat_m_dom_parkey];
			
			$this->sql = $this->name.' int('.$str['param'].')';
			$this->valid = true;
		}
		
		function isParKey()
		{
			return true;
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

		function onEditForm($str)
		{
			$s = "<tr><td class='einfo' width='50%' align='right' valign='top'><font class='etitle'>";
			$s .= $this->info;
			$s .= "</font><br><font class='ecomment'>";		
			$s .= $this->comment; 
			$s .= "</font></td><td class='eedit' width='50%' valign='top'>";
			$s .= "<select name='dom_$this->name' size='1' style='width: 200px'>";
			$s .= $this->createSelect($str);
			$s .= "</select>";
			$s .= "</td></tr>";
			return $s;		
		}

		function onFilterForm($str)
		{
			$s .= "<select name='dom_$this->name' size='1' style='width: 200px'>";
			$s .= "<option value='' class='red'";
			if(strlen($str[$this->name]) == 0 || $str[$this->name] == 0) $s .= " selected";
			$s .= ">- $this->info</option>";
			$s .= $this->createSelect($str);
			$s .= "</select>";
			return $s;		
		}

		function createSelect($str)
		{
			global $cat_db;
			
			$s = '';
			$val = $str[$this->name];
			$res = $cat_db->query("select name from cat_domains where in_table='$this->rtable' and object='DomKey'");
			if(count($res) == 1) {
				$field = $res[0]['name'];
				$res = $cat_db->query("select * from cat_domains where in_table='$this->rtable' order by pos");
				$oa = array();
				$j = 0;
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
				for($j = 0; $j < count($res); $j++) {
					if($res[$j][$field] == $val)
						$s .= "<option value='".$res[$j][$field]."' selected>";
					else
						$s .= "<option value='".$res[$j][$field]."'>";
					for($i = 0; $i < count($set); $i++)
						$s .= $set[$i]->onSelect($res[$j]);
					$s .= "</option>";
				};
			};	
			return $s;		
		}

		function createInfo($str)
		{
			global $cat_db;

			$val = $str[$this->name];
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
				$res = $cat_db->query("select * from $this->rtable where $field='$val'");
				if(count($res) == 1) {
					for($i = 0; $i < count($set); $i++)
						$s .= $set[$i]->onSelect($res[0]);
				};
			};	
			return $s;	
		}
	};




?>