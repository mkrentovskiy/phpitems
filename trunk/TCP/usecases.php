<?
	define('MCLASSPATH','classes/model/');

	include MCLASSPATH."trafic.php";

	define('UCLASSPATH','classes/usecases/');

	include UCLASSPATH."_base.php";
	include UCLASSPATH."start.php";
	include UCLASSPATH."logout.php";	

	include UCLASSPATH."addalias.php";	
	include UCLASSPATH."commitalias.php";	
	include UCLASSPATH."deletealias.php";	

	include UCLASSPATH."showtraficreport.php";	
	include UCLASSPATH."showtraficreportitem.php";	
	include UCLASSPATH."showlogreport.php";	
	
?>