<?
	if(file_exists("config/config.php")) 
		include "config/config.php";

	if(!isset($cat_no_need_install) && !$cat_no_need_install) {
		include "install/install.php";
	} else {	
		include "config/locale.php";
		include "config/locale_project.php";

		include "include.php";
	
		$cat_session = new Session();
		$cat_db = new Database;
		$cat_log = new Log('');
		$cat_db->connect($cat_db_name);

		$cat_manager = new Manager();
		$cat_manager->execute();
	
		$cat_db->disconnect();	
	};
?>