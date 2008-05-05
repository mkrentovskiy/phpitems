<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" indent="no" encoding="utf-8"/>

<xsl:include href="xsl/design.xslt"/> 
<xsl:include href="xsl/main.xslt"/> 

<xsl:template match="/">
    <xsl:apply-templates select="document|ajaxdocument|maildocument"/>
</xsl:template>

<xsl:template match="ajaxdocument">
    <xsl:apply-templates select="*" mode="ajax"/>
</xsl:template>

</xsl:stylesheet>
