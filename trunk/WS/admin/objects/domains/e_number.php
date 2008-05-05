<?
	require_once("objects/domains/_base.php");

	class DomNumber extends DomBase
	{
		function DomNumber($str) 
		{
			$this->DomBase($str);
			$this->title = $GLOBALS[cat_m_dom_number];

			$this->sql = $this->name.' int('.$str['param'].')';
			$this->valid = true;
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

	};




?>