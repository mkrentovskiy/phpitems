<?
	require_once("objects/domains/_base.php");

	class DomSelfParKey extends DomBase
	{
		var	$addin;

		function DomSelfParKey($str) 
		{
			$this->DomBase($str);

			$this->addin = $str['addin'];
			$this->title = $GLOBALS[cat_m_dom_selfparkey];
			
			$this->sql = $this->name.' int('.$str['param'].')';
			$this->valid = true;
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

			global $cat_db;
			if($this->table != $this->rtable) {
				if($this->onlist) 
					$s .= "<td class='$class' width='10%'><nobr>".$this->createInfo($str)."</nobr></td>";			
			} else {
				if(strlen($this->addin) > 1) {
					$link = ereg_replace("\\[ID\\]",$str[$this->key],$this->addin);
					$s .= "<td class='$class' width='1%'>&nbsp;</td><td class='$class' width='1%'><a href='$link'><img src='images/gosub.gif' alt='$GLOBALS[cat_m_show]' border='0' width='15' height='15'></a></td><td class='$class' width='1%'>&nbsp;</td>";
				};

			};
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
			$s .= "<select name='dom_$this->name' size='1'>";
			$s .= $this->createSelect($str);
			$s .= "</select>";
			$s .= "</td></tr>";
			return $s;		
		}

		function onFilterForm($str)
		{
			$s .= "<select name='dom_$this->name' size='1'>";
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
						if($obj->isSorter()) array_push($oa,$obj->getName());
					};
				};

				$res = $cat_db->query("select * from $this->rtable order by ".implode(",",$oa));
				if($this->rtable == $this->table) 
					$s .= "<option value='0' selected>".$GLOBALS[cat_m_top_menu]."</option>";
				$s .= $this->listIter(0,$res,1,$set,$val,$field); 
				
			};	
			return $s;		
		}

		function createInfo($str)
		{
			global $cat_db;
			
			$val = $str[$this->name];
			if($val == 0) return $GLOBALS[cat_m_top_menu];

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

		function listIter($parent, $arr, $k, $set, $val, $field)
		{
			$s = '';
			if($k > 1000) return;
			foreach($arr as $a) {
				if($a['i_base'] == $parent) {
					if($a[$field] == $val)
						$s .= "<option value='".$a[$field]."' selected>";
					else
						$s .= "<option value='".$a[$field]."'>";
					for($z = 0; $z < $k; $z++) $s .= "...";
					$s .= " ";
					for($i = 0; $i < count($set); $i++)
						$s .= $set[$i]->onSelect($a);
					$s .= "</option>";
					$s .= $this->listIter($a[$this->key], $arr, $k + 1, $set, $val, $field);
				};
			};
			return $s;
		}

		function infoIter($parent, $arr, $k)
		{
			if($parent == 0) return $k;
			foreach($arr as $a) {
				if($a[$this->key] == $parent) {
					$s = $this->infoIter($a[$this->name], $arr, $k + 1);
					break;
				};
			};
			return $s;
		}
		
		function isParKey()
		{
			return true;
		}

		function isSorter()
		{
			return true;
		}


		                                          
	};




?>