<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" indent="yes" encoding="UTF-8"/>

<xsl:include href="xsl/design.xslt"/> 
<xsl:include href="xsl/user.xslt"/> 
<xsl:include href="xsl/products.xslt"/>
<xsl:include href="xsl/chart.xslt"/>
<xsl:include href="xsl/request.xslt"/>
<xsl:include href="xsl/search.xslt"/>


<xsl:template match="/">
    <xsl:apply-templates select="document|simple|maildocument"/>
</xsl:template>

</xsl:stylesheet>
