<?

	define('UCLASSPATH','classes/usecases/');

	include UCLASSPATH."_base.php";
	include UCLASSPATH."start.php";
	include UCLASSPATH."start-ssl.php";
	include UCLASSPATH."logout.php";	

	include UCLASSPATH."showstatic.php";	
	
	include UCLASSPATH."registration.php";	
	include UCLASSPATH."activation.php";	
	include UCLASSPATH."rememberpassword.php";	
	
	include UCLASSPATH."WS/addtochart.php";	
	include UCLASSPATH."WS/configchart.php";	
	include UCLASSPATH."WS/processchart.php";	
	include UCLASSPATH."WS/removefromchart.php";	
	include UCLASSPATH."WS/searchproduct.php";	
	include UCLASSPATH."WS/showcategory.php";	
	include UCLASSPATH."WS/showchart.php";	
	include UCLASSPATH."WS/showrequests.php";	
	include UCLASSPATH."WS/showproduct.php";	
	
?>