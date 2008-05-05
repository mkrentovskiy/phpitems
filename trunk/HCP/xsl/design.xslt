<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="document">
<html>
<head>
	<title>WfloW</title>

	<link href="css/baloon.css" rel="stylesheet" type="text/css"/>
	<link href="css/calendar-dp.css" rel="stylesheet" type="text/css"/>
	<link href="css/lightbox.css" rel="stylesheet" type="text/css" media="screen"/>
	<link href="css/HCP.css" rel="stylesheet" type="text/css" media="screen"/>

	<script src="js/calendar/calendar.js" type="text/javascript"></script>
	<script src="js/calendar/calendar-ru.js" type="text/javascript"></script>
	
	<script src="js/prototype/prototype.js" type="text/javascript"></script>

	<script src="js/baloons/baloon.js" type="text/javascript"></script>
	<script src="js/baloons/validate.js" type="text/javascript"></script>

	<script src="js/scriptaculous/scriptaculous.js" type="text/javascript"></script>

	<script src="js/lightbox/lightbox.js" type="text/javascript"></script>
	
	<script src="js/UFO/ufo.js" type="text/javascript"></script>

	<script src="js/HCP.js" type="text/javascript"></script>

</head>
<body>
	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
	<td id="top">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
		<td valign="top"><a href="index.php"><img src="i/logo.gif" width="175" height="116" alt=""/></a></td>
		<td id="topitem" width='100%' align="right">
			<h1>Система ведения проектов</h1>
			<small>Проектное управление и документооборот</small>
		</td>
		</tr>
		</table>
	</td>
	</tr>
	<tr>
	<td valign="top" height="100%" id="content">
		<xsl:if test="string-length(user/login) > 0">	
			<div id='menu'>
				<div>
					<xsl:attribute name="class">
						<xsl:choose>
							<xsl:when test="@menuid = '1'">smenuitem</xsl:when>
							<xsl:otherwise>menuitem</xsl:otherwise>
						</xsl:choose>
					</xsl:attribute>
					<a href='index.php?usecase=showObjectsTree' class='objectstree'>Объекты</a>
				</div>
				<div>
					<xsl:attribute name="class">
						<xsl:choose>
							<xsl:when test="@menuid = '2'">smenuitem</xsl:when>
							<xsl:otherwise>menuitem</xsl:otherwise>
						</xsl:choose>
					</xsl:attribute>
					<a href='index.php?usecase=showDocuments' class='documents'>Документы</a>
				</div>
				<div>
					<xsl:attribute name="class">
						<xsl:choose>
							<xsl:when test="@menuid = '3'">smenuitem</xsl:when>
							<xsl:otherwise>menuitem</xsl:otherwise>
						</xsl:choose>
					</xsl:attribute>
					<a href='index.php?usecase=showFinances' class='finances'>Финансы</a>
				</div>
			</div>
		</xsl:if>
		<div id='itemstable'>
		<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
		<tr>
		<td id="leftpath" valign="top" width="15%" height="100%">
			<xsl:apply-templates select="user|subblock"/>
		</td>
		<td id="infopath" valign="top" width="85%" height="100%">
			<xsl:apply-templates select="objectstree|documents|finances"/>		
		</td>
		</tr>
		</table>		
		</div>
		<div id='null' style='display: none;'></div>
	</td>
	</tr>
	<tr>
	<td id="copyrights">
		&#0169; Разработка WebCRE8 2006-7.<br/>
		Иконки <a href='http://tango.freedesktop.org/Tango_Icon_Gallery' target='_blank' class='text'>Tango Project</a> и <a href='http://www.famfamfam.com/lab/icons/silk/' target='_blank' class='text'>Mark James</a>
	</td>
	</tr>
	</table>
</body>
</html>

</xsl:template>

</xsl:stylesheet>
