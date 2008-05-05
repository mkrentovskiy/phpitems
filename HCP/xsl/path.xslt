<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="path" mode="panel">
	<xsl:if test="count(item) > 0">
		<table border="0" cellpadding="0" cellspacing="1" width='100%' align='center'>
		<tr><td class="toplevels">
		<a href="index.php" class="toplink">Начальный список</a>
		</td></tr>
		<xsl:for-each select="item">
		        <xsl:variable name='cl'><xsl:value-of select="class"/></xsl:variable>
			<xsl:apply-templates select="*[name()=$cl]" mode="path"/>
		</xsl:for-each>
		</table><br/><br/>
	</xsl:if>
</xsl:template>

</xsl:stylesheet>
