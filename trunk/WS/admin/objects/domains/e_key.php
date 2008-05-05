<?
	require_once("objects/domains/_base.php");

	class DomKey extends DomBase
	{
		function DomKey($str) 
		{
			$this->DomBase($str);
			$this->title = $GLOBALS[cat_m_dom_key];
			
			$this->sql = $this->name.' int('.$str['param'].') not null auto_increment';
			$this->valid = true;
		}

		function getFromInput()
		{
			$v = $GLOBALS['dom_'.$this->name];
	        	if(is_numeric($v) &&  $v > 0) 
				return $v;
			else return '';
		}
		

		function onShow($str)
		{
			return '';
		}

	
		function onInsertForm($str)
		{
			$s = "<input type='hidden' name='dom_$this->name' value='0'>";
			return $s;
		}

		function onEditForm($str)
		{
			$val = $str[$this->name];
			$s = "<input type='hidden' name='dom_$this->name' value='$val'>";
			return $s;		
		}

		function onDelete($str)
		{
			global	$cat_db;
	
			$val = $str[$this->name];
			$res = $cat_db->query("select in_table,name from cat_domains where object='DomParKey' and r_table='$this->table'");
			for($i = 0; $i < count($res); $i++) {
				$table = $res[$i]['in_table'];	
				$field = $res[$i]['name'];
				$cat_db->query("update $table set $field='1' where $field='$val'");	
			};
		}	 


	};




?>