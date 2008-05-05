<?
	require_once("objects/domains/_base.php");

	class DomTitle extends DomBase
	{
		function DomTitle($str) 
		{
			$this->DomBase($str);
			$this->title = $GLOBALS[cat_m_dom_title];

			$this->sql = $this->name.' char('.$str['param'].')';
			$this->valid = true;
		}

		function getFromInputAsKey()
		{
	        	if($this->key) return $GLOBALS["cat_key_".$this->name];
			else return $this->getFromInput();
		}
		
		function onEditForm($str)
		{
			$val = $str[$this->name];
			$s = "<tr><td class='einfo' width='50%' align='right' valign='top'><font class='etitle'>";
			$s .= $this->info;
			$s .= "</font><br><font class='ecomment'>";		
			$s .= $this->comment; 
			$s .= "</font></td><td class='eedit' width='50%' valign='top'><input type='text' name='dom_$this->name' maxlength='$this->param' size='60' value='$val'></td></tr>";
	        	if($this->key) $s .= "<input type='hidden' name='cat_key_".$this->name."' value='$val'>"; 
			return $s;		
		}

		function onEdit($str)
		{
			if(!$this->key) return;

			global	$cat_db;
	
			$val = $str[$this->name];
			$nval = $this->getFromInput();

			if($val == $nval) return;

			$res = $cat_db->query("select in_table,name from cat_domains where object='DomSParKey' and r_table='$this->table'");
			for($i = 0; $i < count($res); $i++) {
				$table = $res[$i]['in_table'];	
				$field = $res[$i]['name'];
				$cat_db->query("update $table set $field='$nval' where $field='$val'");	
			};
		}	 


		function onDelete($str)
		{
			if(!$this->key) return;

			global	$cat_db;
	
			$val = $str[$this->name];
			$res = $cat_db->query("select in_table,name from cat_domains where object='DomSParKey' and r_table='$this->table'");
			for($i = 0; $i < count($res); $i++) {
				$table = $res[$i]['in_table'];	
				$field = $res[$i]['name'];
				$cat_db->query("update $table set $field='' where $field='$val'");	
			};
		}	 

	};




?>