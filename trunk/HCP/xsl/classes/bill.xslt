<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="bill" mode="objectstree">
	<div id="billlist">
	<xsl:if test="count(item) > 0">
		<h2 id="bill" onClick="showHide('bill')">Банковские счета</h2>

		<div class="list" id="billlistitem">
			<xsl:apply-templates select="item" mode="bill"/>
		</div>          
	</xsl:if>
	</div>      				
</xsl:template>

<xsl:template match="bills" mode="ajax">
	<xsl:apply-templates select="bill" mode="objectstree"/>
</xsl:template>

<xsl:template match="bill" mode="path">
	<tr><td class="toplevels">
		<xsl:apply-templates select="item" mode="bill"/>	
	</td></tr>
</xsl:template>

<xsl:template match="billitem" mode="ajax">
	<xsl:apply-templates select="item" mode="bill"/>	
</xsl:template>

<xsl:template match="bill" mode="control">
        <xsl:for-each select="item">			
		<xsl:variable name="id"><xsl:value-of select="id"/></xsl:variable>

		<table botder="0" cellpadding="0" cellspacing="14" width='100%'>
		<tr>
			<td valign="top"><img align="absmiddle" valign='top' src='i/i_billitem.png'/></td>
			<td width='100%' valign="top">
				<b><xsl:value-of select="bill" disable-output-escaping="yes"/></b><br/>
				<xsl:value-of select="bank" disable-output-escaping="yes"/><br/>
				к.с. <xsl:value-of select="corbill" disable-output-escaping="yes"/><br/>
				БИК <xsl:value-of select="bik" disable-output-escaping="yes"/>
			</td>
		</tr>	
		</table>	
	</xsl:for-each>
</xsl:template>

<xsl:template match="item" mode="bill">
    <xsl:variable name="id"><xsl:value-of select="id"/></xsl:variable>
	<xsl:variable name="type"><xsl:value-of select="type"/></xsl:variable>
				
	<div class="bill">
		<xsl:attribute name="id">i<xsl:value-of select="oid"/></xsl:attribute>
		<xsl:attribute name="onDblClick">getControlForm(<xsl:value-of select="oid"/>);</xsl:attribute>
					
		<a>
			<xsl:attribute name="href">?usecase=ShowObjectsTree&amp;id=<xsl:value-of select="oid" disable-output-escaping="yes"/></xsl:attribute>
				<img align="absmiddle" src="i/i_billitem.png"/>&#0160;&#0160;<xsl:value-of select="name" disable-output-escaping="yes"/>
					<xsl:value-of select="bill" disable-output-escaping="yes"/>
				</a>
			<div class='bankinfo'>
				<xsl:value-of select="bank" disable-output-escaping="yes"/><xsl:text>, </xsl:text>
				к.с. <xsl:value-of select="corbill" disable-output-escaping="yes"/><xsl:text>, </xsl:text>
				БИК <xsl:value-of select="bik" disable-output-escaping="yes"/>
			</div>
	</div>
</xsl:template>

</xsl:stylesheet>
