<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="document">
<html debug="true">
<head>
	<title>Учет потребления Интернет-трафика</title>

	<link href="css/baloon.css" rel="stylesheet" type="text/css"/>
	<link href="css/calendar-dp.css" rel="stylesheet" type="text/css"/>
	<link href="css/TCP.css" rel="stylesheet" type="text/css" media="screen"/>

	<script src="js/calendar.js" type="text/javascript"></script>
	<script src="js/calendar-ru.js" type="text/javascript"></script>

	<script src="js/prototype.js" type="text/javascript"></script>

	<script src="js/baloon.js" type="text/javascript"></script>
	<script src="js/validate.js" type="text/javascript"></script>

	<script src="js/sorttable.js" type="text/javascript"></script>

	<script src="js/TCP.js" type="text/javascript"></script>
	
</head>
<body>
	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
	<td id="top">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
		<td valign="top"><a href="index.php"><img src="i/logo.gif" width="175" height="116" alt=""/></a></td>
		<td id="topitem" width='100%' align="right">
			<h1>Учет потребления интернет-трафика</h1>
		</td>
		</tr>
		</table>
	</td>
	</tr>
	<tr>
	<td valign="top" height="100%" id="content">
		<div id='itemstable'>
		<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
		<tr>
		<td id="leftpath" valign="top" width="15%" height="100%">
			<xsl:apply-templates select="user"/>
		</td>
		<td id="infopath" valign="top" width="85%" height="100%">
			<xsl:apply-templates select="controlpanel|report|reportitem|log" mode='trafic'/>		
		</td>
		</tr>
		</table>		
		</div>
		<div id='null' style='display: none;'></div>
	</td>
	</tr>
	<tr>
	<td id="copyrights">
		&#0169; Разработка WebCRE8 2007.<br/>
		Иконки <a href='http://www.famfamfam.com/lab/icons/silk/' target='_blank' class='text'>Mark James</a>
	</td>
	</tr>
	</table>
</body>
</html>

</xsl:template>

</xsl:stylesheet>
