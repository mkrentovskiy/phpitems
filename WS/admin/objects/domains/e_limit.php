<?
	require_once("objects/domains/_base.php");

	class DomLimit extends DomBase
	{
		var	$login;
		var	$ul;

		function DomLimit($str) 
		{
			$this->DomBase($str);
			$this->title = $GLOBALS[cat_m_dom_limit];
			
			global 	$cat_manager;

			$user = $cat_manager->getUser();
			$this->login = $user->getLogin();
			$this->ul = $user->isLimited($this->table);
			$this->sql = $this->name.' char(32)';
			$this->valid = true;
		}
		
		function isLimit()
		{
			return true;
		}

		function getFromInput()
		{
			if($this->ul) return $this->login;
	        	else return $GLOBALS['dom_'.$this->name];
		}

		function getFromInputAsKey()
		{
	        	if($this->ul) return $this->login;
	        	else return $this->getFromInput();
		}

		function onShow($str)
		{
			if($this->ul) return '';

			global $cat_db;

			$s = "<tr><td class='einfo' align='right' valign='top'>".$this->info."</td>";
			$s .= "<td class='eedit' align='justify' valign='top'>";
			$s .= $this->createInfo($str);
			$s .= "&nbsp;</td></tr>";
			return $s;	
		}

		function onList($str,$class)
		{
			if($this->ul) return '';
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
			if($this->ul) return "<input type='hidden' name='dom_$this->name' value='$this->login'>";

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

		function createSelect($str)
		{
			global $cat_db;
			
			$s = '';
			$val = $str[$this->name];
			$res = $cat_db->query("select login, person from cat_users");
			for($i = 0; $i < count($res); $i++) {
				if($res[$i][login] == $val)
					$s .= "<option value='".$res[$i][login]."' selected>";
				else
					$s .= "<option value='".$res[$i][login]."'>";
				$s .= $res[$i][person]."</option>";
			};				
			return $s;		
		}

		function createInfo($str)
		{
			global $cat_db;

			$val = $str[$this->name];
			$res = $cat_db->query("select person from cat_users where login='$var'");
			if(count($res) == 1) {
				$s .= $res[0][person];
			};	
			return $s;	
		}
	};




?>