<?

	require_once("objects/tables/_base.php");

	class TabCommon extends TabBase
	{
		function TabCommon($table) 
		{
			$this->TabBase($table);
			$this->title = $GLOBALS[cat_m_tab_common];
		}
	
	};




?>