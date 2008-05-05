<?
	class ModBase
	{
		var 	$title;
		var	$URL;
		
		function ModBase() 
		{
			global $cat_mod;			

			$this->title = $GLOBALS[cat_m_mod_base];
			$this->URL = "?cat_pos=control&cat_mod=$cat_mod";
		}
	
		function getTitle()
		{
			return $this->title;
		}
	
		function isValid()
		{
			return true;
		}
	
		function makeMenu($user)
		{
			$str = '';
			return $str;
		}
		
		function execute($user)
		{}
	
	};

?>