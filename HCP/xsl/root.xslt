<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:output method="html" indent="yes" encoding="utf-8"/>

<xsl:include href="xsl/classes/address.xslt"/> 
<xsl:include href="xsl/classes/bill.xslt"/> 
<xsl:include href="xsl/classes/company.xslt"/> 
<xsl:include href="xsl/classes/file.xslt"/> 
<xsl:include href="xsl/classes/folder.xslt"/> 
<xsl:include href="xsl/classes/image.xslt"/> 
<xsl:include href="xsl/classes/note.xslt"/> 
<xsl:include href="xsl/classes/phone.xslt"/> 
<xsl:include href="xsl/classes/project.xslt"/> 
<xsl:include href="xsl/classes/person.xslt"/> 
<xsl:include href="xsl/classes/record.xslt"/> 
<xsl:include href="xsl/classes/task.xslt"/> 

<xsl:include href="xsl/design.xslt"/> 
<xsl:include href="xsl/user.xslt"/> 
<xsl:include href="xsl/subblock.xslt"/> 
<xsl:include href="xsl/forms.xslt"/> 
<xsl:include href="xsl/objectstree.xslt"/> 
<xsl:include href="xsl/path.xslt"/> 
<xsl:include href="xsl/control.xslt"/> 

<xsl:include href="xsl/documents.xslt"/> 
<xsl:include href="xsl/tasks.xslt"/> 

<xsl:template match="/">
    <xsl:apply-templates select="document|ajaxdocument|iframedocument"/>
</xsl:template>

<xsl:template match="ajaxdocument">
	<xsl:apply-templates select="*" mode="ajax"/>	
</xsl:template>

<xsl:template match="iframedocument">
	<html>
	<head>
		<link href="css/HCP.css" rel="stylesheet" type="text/css" media="screen"/>
	</head>
	<body style='padding: 0px; margin: 0px;'>
		<xsl:apply-templates select="*" mode="iframe"/>	
	</body>
	</html>
</xsl:template>

</xsl:stylesheet>
