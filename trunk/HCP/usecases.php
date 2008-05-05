<?
	define('MCLASSPATH','classes/model/');

	include MCLASSPATH."classfactory.php";
	include MCLASSPATH."documentsfactory.php";
	include MCLASSPATH."tasksfactory.php";
	include MCLASSPATH."_base.php";

	include MCLASSPATH."caddress.php";
	include MCLASSPATH."cbill.php";
	include MCLASSPATH."ccompany.php";
	include MCLASSPATH."cfile.php";
	include MCLASSPATH."cfolder.php";
	include MCLASSPATH."cimage.php";
	include MCLASSPATH."cnote.php";
	include MCLASSPATH."cperson.php";
	include MCLASSPATH."cphone.php";
	include MCLASSPATH."cproject.php";
	include MCLASSPATH."crecord.php";
	include MCLASSPATH."ctask.php";

	define('UCLASSPATH','classes/usecases/');

	include UCLASSPATH."_base.php";
	include UCLASSPATH."start.php";
	include UCLASSPATH."logout.php";	

	include UCLASSPATH."showobjectstree.php";	
	
	include UCLASSPATH."addobject.php";	
	include UCLASSPATH."showclassaddform.php";	
	include UCLASSPATH."showcontrolform.php";	
	include UCLASSPATH."uploadfile.php";	
	include UCLASSPATH."showobjectitem.php";	
	include UCLASSPATH."deleteobjectitem.php";	
	include UCLASSPATH."copyobjectitem.php";	
	include UCLASSPATH."commititem.php";	
	
	include UCLASSPATH."setprojectstate.php";	

	include UCLASSPATH."showdocuments.php";	
	include UCLASSPATH."showdocumentitem.php";	
	
	include UCLASSPATH."showfinances.php";	
	
	include UCLASSPATH."movetask.php";	
	include UCLASSPATH."removetask.php";	
	include UCLASSPATH."executetaskitem.php";	
	
?>