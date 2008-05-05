<?

	class DomBase
	{
		var	$nice;
		var 	$title;
		var	$sql;

		var	$name;
		var	$table;

		var	$info;
		var	$comment;
		
		var	$valid;
		var	$key;
	        var	$onlist;
		var	$onselect;
		var	$parsed;
		var	$rtable;
		
		var	$param;
			
		function DomBase($str) 
		{
			global	$cat_domain_def;				
		
			$this->title = $GLOBALS[cat_m_dom_base];

			$this->nice = $str[id_domains];
			$this->name = $str['name'];
			$this->table = $str['in_table'];
			$this->info = $str['title'];
			$this->comment = $str['comment'];
			$this->key = $str['is_key'];
			$this->onlist = $str['is_on_list'];
			$this->onselect = $str['is_on_select'];
			$this->parsed = $str['is_parsed'];
			$this->rtable = $str['r_table'];
			
			$this->param = $str['param'];			
			if($this->param == 0) $this->param = $cat_domain_def[$this->name];

			$this->sql = $this->name.' char('.$str['param'].')';
			$this->valid = true;
		}
		
		function getSQL()
		{
			return $this->sql;
		}
	
		function getTitle()
		{
			return $this->title;
		}	

		function getName()
		{
			return $this->name;
		}	

		function getInfo()
		{
			return $this->info;
		}	

		function getNice()
		{
			return $this->nice;
		}	

		//
		//
		//

		function isValid()
		{
			return $this->valid;
		}

		function isKey()
		{
			return $this->key;
		}

		function isParKey()
		{
			return false;
		}

		function isSorter()
		{
			return false;
		}

		function isLimit()
		{
			return false;
		}

		function isOnList()
		{
			return $this->onlist;
		}

		function isOnSelect()
		{
			return $this->onselect;
		}

		function rTable()
		{
			return $this->rtable;
		}

		function isParsed()
		{
			return $this->parsed;
		}

		//
		//
		//

		function getFromInput()
		{
	        	return $GLOBALS['dom_'.$this->name];
		}

		function getFromInputAsKey()
		{
	        	return $this->getFromInput();
		}

		function onShow($str)
		{
			$s = "<tr><td class='einfo' align='right' valign='top'>".$this->info."</td>";
			$s .= "<td class='eedit' align='justify' valign='top'>";
			if($this->parsed) $s .= parseToHTML($str[$this->name]); 
			else $s .= $str[$this->name];
			$s .= "&nbsp;</td></tr>";
			return $s;
		}

		function onList($str,$class)
		{
			if(!$this->onlist) return '';
			$s = "<td class='$class'>".$str[$this->name]."</td>";
			return $s;
		}

		function onListTitle()
		{
			if($this->onlist) {
				$s = "<td class='header' align='center'>".$this->info;
				if($this->parsed) $s .= " </font><font class='grey'>&nbsp;[P]&nbsp;</font>";	
				$s .= "</td>";
			};
			return $s;
		}

		function onInsertForm($str)
		{
			return $this->onEditForm($str);
		}

		function onEditForm($str)
		{
			$s = '';
			return $s;		
		}

		function onFilterForm($str)
		{
			$s = '';
			return $s;		
		}

		function onSelect($str)
		{
			if($this->onselect) $s = $str[$this->name];
			return $s;
		}

		function onDelete($str)
		{
			return;
		}	 

		function onEdit($str)
		{
			return;
		}	 

		function afterInsert($r)
		{
			return;
		}

	};




?>