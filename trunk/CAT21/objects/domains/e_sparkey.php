<?
	require_once("objects/domains/e_parkey.php");

	class DomSParKey extends DomParKey
	{
		function DomSParKey($str) 
		{
			$this->DomBase($str);
			$this->title = $GLOBALS[cat_m_dom_sparkey];
			
			$this->sql = $this->name.' char('.$str['param'].')';
			$this->valid = true;
		}		
	};




?>