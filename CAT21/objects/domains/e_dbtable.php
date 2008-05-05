<?
	require_once("objects/domains/_base.php");

	class DomDbTable extends DomBase
	{
		var	$array;
			
		function DomDbTable($str) 
		{
			$this->DomBase($str);

			$this->title = $GLOBALS[cat_m_dom_dbtable];

			global $cat_db;
			$this->array = $cat_db->query("select *,cat_areas.area as ar from cat_tables, cat_areas where cat_tables.area=cat_areas.id_area order by cat_areas.pos, cat_tables.pos");
			
			$this->sql = $this->name.' varchar(128)';
			$this->valid = true;
		}
		
		//
		//
		//

		function onEditForm($str)
		{
			$n = $str[$this->name];
			$s = "<tr><td class='einfo' width='50%' align='right' valign='top'><font class='etitle'>";
			$s .= $this->info;
			$s .= "</font><br><font class='ecomment'>";		
			$s .= $this->comment; 
			$s .= "</font></td><td class='eedit' width='50%' valign='top'><select name='dom_$this->name' size='1' style='width: 200px'>";

			foreach($this->array as $n) {
				if($str[$this->name] == $n['name']) 
					$s .= "<option value='$n[name]' selected>$n[ar] : $n[title]</option>";
		   		else 
					$s .= "<option value='$n[name]'>$n[ar] : $n[title]</option>";
			};	
			$s .= "</select></td></tr>";		
			return $s;		
		}

	};




?>