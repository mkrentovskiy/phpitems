<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="address" mode="objectstree">
	<div id="addresslist">
	<xsl:if test="count(item) > 0">
		<h2 id="address" onClick="showHide('address')">Адреса</h2>

		<div class="list" id="addresslistitem">
			<xsl:apply-templates select="item" mode="address"/>	
		</div>          
	</xsl:if>
	</div>      				
</xsl:template>

<xsl:template match="addresss" mode="ajax">
	<xsl:apply-templates select="address" mode="objectstree"/>
</xsl:template>

<xsl:template match="address" mode="path">
	<tr><td class="toplevels">
		<xsl:apply-templates select="item" mode="address"/>	
	</td></tr>
</xsl:template>

<xsl:template match="addressitem" mode="ajax">
	<xsl:apply-templates select="item" mode="address"/>	
</xsl:template>

<xsl:template match="address" mode="control">
        <xsl:for-each select="item">			
		<xsl:variable name="id"><xsl:value-of select="id"/></xsl:variable>

		<table botder="0" cellpadding="0" cellspacing="14" width='100%'>
		<tr>
			<td valign="top"><img align="absmiddle" valign='top' src='i/i_addressitem.png'/></td>
			<td width='100%' valign="top">
					<b>
					<xsl:if test="string-length(zip) > 0"><xsl:value-of select="zip" disable-output-escaping="yes"/><xsl:text>, </xsl:text></xsl:if>
					<xsl:value-of select="state" disable-output-escaping="yes"/><xsl:text>, </xsl:text>
					<xsl:value-of select="region" disable-output-escaping="yes"/><xsl:text>, </xsl:text>
					<xsl:value-of select="city" disable-output-escaping="yes"/><xsl:text>, </xsl:text>
					<xsl:value-of select="street" disable-output-escaping="yes"/>
					<xsl:if test="string-length(house) > 0"><xsl:text>, </xsl:text><xsl:value-of select="house" disable-output-escaping="yes"/></xsl:if>
					<xsl:if test="string-length(flat) > 0"><xsl:text>, </xsl:text><xsl:value-of select="flat" disable-output-escaping="yes"/></xsl:if>
					</b><br/>
					<xsl:if test="string-length(comment) > 0">
							<xsl:value-of select="comment" disable-output-escaping="yes"/>
					</xsl:if>
			</td>
		</tr>	
		</table>	
	</xsl:for-each>
</xsl:template>

<xsl:template match="item" mode="address">
	<xsl:variable name="id"><xsl:value-of select="id"/></xsl:variable>
	<xsl:variable name="type"><xsl:value-of select="type"/></xsl:variable>
				
	<div class="address">
	        <xsl:attribute name="id">i<xsl:value-of select="oid"/></xsl:attribute>
	        <xsl:attribute name="onDblClick">getControlForm(<xsl:value-of select="oid"/>);</xsl:attribute>
					
		<a>
			<xsl:attribute name="href">?usecase=ShowObjectsTree&amp;id=<xsl:value-of select="oid" disable-output-escaping="yes"/></xsl:attribute>
			<img align="absmiddle" src="i/i_addressitem.png"/>&#0160;&#0160;<xsl:value-of select="name" disable-output-escaping="yes"/>
        
		<xsl:if test="string-length(zip) > 0"><xsl:value-of select="zip" disable-output-escaping="yes"/><xsl:text>, </xsl:text></xsl:if>
		<xsl:value-of select="state" disable-output-escaping="yes"/><xsl:text>, </xsl:text>
		<xsl:value-of select="region" disable-output-escaping="yes"/><xsl:text>, </xsl:text>
		<xsl:value-of select="city" disable-output-escaping="yes"/><xsl:text>, </xsl:text>
		<xsl:value-of select="street" disable-output-escaping="yes"/>
		<xsl:if test="string-length(house) > 0"><xsl:text>, </xsl:text><xsl:value-of select="house" disable-output-escaping="yes"/></xsl:if>
		<xsl:if test="string-length(flat) > 0"><xsl:text>, </xsl:text><xsl:value-of select="flat" disable-output-escaping="yes"/></xsl:if>
		</a>
		<xsl:if test="string-length(comment) > 0">
			<div class='addresscomment'>
				<xsl:value-of select="comment" disable-output-escaping="yes"/>
				</div>
		</xsl:if>
	</div>
</xsl:template>

</xsl:stylesheet>
