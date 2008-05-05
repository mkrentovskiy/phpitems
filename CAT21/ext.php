<?
	if(file_exists("config/config.php")) 
		include "config/config.php";

	if(isset($cat_no_need_install) && $cat_no_need_install) {
		include "config/locale.php";
		include "config/locale_project.php";

		include "include.php";
	
		$cat_session = new Session();
		$cat_manager = new ExtManager();
		$cat_manager->execute();
	};
?>