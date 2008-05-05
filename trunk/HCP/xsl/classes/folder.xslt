<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="folder" mode="objectstree">
	<div id="folderlist">
	<xsl:if test="count(item) > 0">
		<h2 id="folder" onClick="showHide('folder')">Папки</h2>

		<div class="list" id="folderlistitem">
		    <xsl:apply-templates select="item" mode="folder"/>
		</div>          
	</xsl:if>
	</div>      				
</xsl:template>

<xsl:template match="folders" mode="ajax">
	<xsl:apply-templates select="folder" mode="objectstree"/>
</xsl:template>

<xsl:template match="folderitem" mode="ajax">
	<xsl:apply-templates select="item" mode="folder"/>	
</xsl:template>

<xsl:template match="folder" mode="path">
	<tr><td class="toplevels">
        <xsl:apply-templates select="item" mode="folder"/>
	</td></tr>
</xsl:template>

<xsl:template match="folder" mode="control">
        <xsl:for-each select="item">			
		<xsl:variable name="id"><xsl:value-of select="id"/></xsl:variable>

		<table botder="0" cellpadding="0" cellspacing="14" width='100%'>
		<tr>
			<td valign="top"><img align="absmiddle" valign='top' src='i/i_folderitem.png'/></td>
			<td width='100%' valign="top">
				<b><xsl:value-of select="name" disable-output-escaping="yes"/></b><br/>
				<xsl:value-of select="tb" disable-output-escaping="yes"/>
			</td>
		</tr>	
		</table>	
	</xsl:for-each>
</xsl:template>

<xsl:template match="item" mode="folder">
    <xsl:variable name="id"><xsl:value-of select="id"/></xsl:variable>
	<xsl:variable name="type"><xsl:value-of select="type"/></xsl:variable>
				
				<div class="folderitem">
				        <xsl:attribute name="id">i<xsl:value-of select="oid"/></xsl:attribute>
				        <xsl:attribute name="onDblClick">getControlForm(<xsl:value-of select="oid"/>);</xsl:attribute>
					<xsl:attribute name="style"> margin-bottom: 3px; border-top: solid #<xsl:value-of select="color" disable-output-escaping="yes"/> 6px; background-color: #f9f9f0;</xsl:attribute>
					<a>
						<xsl:attribute name="href">?usecase=ShowObjectsTree&amp;id=<xsl:value-of select="oid" disable-output-escaping="yes"/></xsl:attribute>
						<img align="absmiddle" src="i/i_folderitem.png"/>&#0160;&#0160;<xsl:value-of select="name" disable-output-escaping="yes"/></a>
					<div class="folderinfo"><xsl:value-of select="tb" disable-output-escaping="yes"/></div>
				</div>
</xsl:template>

</xsl:stylesheet>
