<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="phone" mode="objectstree">
	<div id="phonelist">
	<xsl:if test="count(item) > 0">
		<h2 id="phone" onClick="showHide('phone')">Телефоны</h2>

		<div class="list" id="phonelistitem">
			<xsl:apply-templates select="item" mode="phone"/>	
		</div>          
	</xsl:if>
	</div>      				
</xsl:template>

<xsl:template match="phones" mode="ajax">
	<xsl:apply-templates select="phone" mode="objectstree"/>
</xsl:template>

<xsl:template match="phoneitem" mode="ajax">
	<xsl:apply-templates select="item" mode="phone"/>	
</xsl:template>

<xsl:template match="phone" mode="path">
	<tr><td class="toplevels">
		<xsl:apply-templates select="item" mode="phone"/>	
	</td></tr>
</xsl:template>

<xsl:template match="phone" mode="control">
        <xsl:for-each select="item">			
		<xsl:variable name="id"><xsl:value-of select="id"/></xsl:variable>

		<table botder="0" cellpadding="0" cellspacing="14" width='100%'>
		<tr>
			<td valign="top"><img align="absmiddle" valign='top' src='i/i_phoneitem.png'/></td>
			<td width='100%' valign="top">
				<b>+<xsl:value-of select="country" disable-output-escaping="yes"/><xsl:text> (</xsl:text>
				<xsl:value-of select="area" disable-output-escaping="yes"/><xsl:text>) </xsl:text>
				<xsl:value-of select="number" disable-output-escaping="yes"/></b><br/>
				<xsl:if test="is_cellular ='1'">мобильный<br/></xsl:if>
				<xsl:if test="is_fax ='1'">принимает факсы</xsl:if>
			</td>
		</tr>	
		</table>	
	</xsl:for-each>
</xsl:template>

<xsl:template match="item" mode="phone">
        <xsl:variable name="id"><xsl:value-of select="id"/></xsl:variable>
		<xsl:variable name="type"><xsl:value-of select="type"/></xsl:variable>
				
				<div class="phone">
				        <xsl:attribute name="id">i<xsl:value-of select="oid"/></xsl:attribute>
				        <xsl:attribute name="onDblClick">getControlForm(<xsl:value-of select="oid"/>);</xsl:attribute>
					
					<a>
						<xsl:attribute name="href">?usecase=ShowObjectsTree&amp;id=<xsl:value-of select="oid" disable-output-escaping="yes"/></xsl:attribute>
						<img align="absmiddle" src="i/i_phoneitem.png"/>&#0160;&#0160;<xsl:value-of select="name" disable-output-escaping="yes"/>

					+<xsl:value-of select="country" disable-output-escaping="yes"/><xsl:text> (</xsl:text>
					<xsl:value-of select="area" disable-output-escaping="yes"/><xsl:text>) </xsl:text>
					<xsl:value-of select="number" disable-output-escaping="yes"/>
					</a>
					<div class='phoneinfo'>
						<xsl:if test="is_cellular ='1'">мобильный<br/></xsl:if>
						<xsl:if test="is_fax ='1'">принимает факсы</xsl:if>
					</div>
				</div>
</xsl:template>

</xsl:stylesheet>
