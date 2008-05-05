<?

	$db_host = "localhost";
	$db_user = "root";
	$db_password = "1";
	$db_name = "hcp";

	$DEBUG = false;

	define('CLASSPATH','classes/');

	include CLASSPATH."database.php";
	include CLASSPATH."user.php";
	include CLASSPATH."group.php";
	include CLASSPATH."mail.php";
	include CLASSPATH."session.php";
	include CLASSPATH."xmlpage.php";

	include CLASSPATH."controls/FCKeditor/fckeditor.php";
	include CLASSPATH."controls/Image_Toolbox.class.php";

	define('LOOPMAX', 1024);
	define('CACHEPREFIX','cache_');
	define('FILEPATH','data');

	define('MAXIMGWIDTH', 200);
	define('MAXIMGHEIGHT', 150);

?>