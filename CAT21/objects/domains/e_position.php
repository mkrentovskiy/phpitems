<?
	require_once("objects/domains/_base.php");

	class DomPosition extends DomBase
	{
		function DomPosition($str) 
		{
			$this->DomBase($str);
			$this->title = $GLOBALS[cat_m_dom_position];

			$this->sql = $this->name.' int('.$str['param'].')';
			$this->valid = true;
		}


		function onInsertForm($str)
		{
			global $cat_db;
			
			$res = $cat_db->query("select max(".$this->name.") from ".$this->table);
			
			if(!is_array($str)) $str = array();
			$str[$this->name] = $res[0]["max($this->name)"] + 1;

			return $this->onEditForm($str);
		}

		function onEditForm($str)
		{
			$val = $str[$this->name];
			$s = "<tr><td class='einfo' width='50%' align='right' valign='top'><font class='etitle'>";
			$s .= $this->info;
			$s .= "</font><br><font class='ecomment'>";		
			$s .= $this->comment; 
			$s .= "</font></td><td class='eedit' width='50%' valign='top'><input type='text' name='dom_$this->name' maxlength='$this->param' size='10' value='$val'></td></tr>";
	        	if($this->key) $s .= "<input type='hidden' name='cat_key_".$this->name."' value='$val'>"; 
			return $s;		
		}

		function isSorter()
		{
			return true;
		}

	};




?>