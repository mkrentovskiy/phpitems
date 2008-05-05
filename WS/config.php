<?

	$db_host = "localhost";
	$db_user = "root";
	$db_password = "1";
	$db_name = "webshop";

	$DEBUG = false;

	define('CLASSPATH','classes/');

	include CLASSPATH."database.php";
	include CLASSPATH."user.php";
	include CLASSPATH."group.php";
	include CLASSPATH."mail.php";
	include CLASSPATH."session.php";
	include CLASSPATH."xmlpage.php";
	include CLASSPATH."chart.php";

?>