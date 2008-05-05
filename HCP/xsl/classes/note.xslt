<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="note" mode="objectstree">
	<div id="notelist">
	<xsl:if test="count(item) > 0">
		<h2 id="note" onClick="showHide('note')">Пометки</h2>

		<div class="list" id="notelistitem">
		    <xsl:apply-templates select="item" mode="note"/>	
		</div>          
	</xsl:if>
	</div>      				
</xsl:template>

<xsl:template match="notes" mode="ajax">
	<xsl:apply-templates select="note" mode="objectstree"/>
</xsl:template>

<xsl:template match="noteitem" mode="ajax">
	<xsl:apply-templates select="item" mode="note"/>	
</xsl:template>

<xsl:template match="note" mode="control">
        <xsl:for-each select="item">			
		<xsl:variable name="id"><xsl:value-of select="id"/></xsl:variable>

		<table botder="0" cellpadding="0" cellspacing="14" width='100%'>
		<tr>
			<td valign="top"><img align="absmiddle" valign='top' src='i/i_comment.png'/></td>
			<td width='100%' valign="top" class='text'>
				<div class="noteauthor"><xsl:value-of select="author" disable-output-escaping="yes"/></div>
				<div class="notetime"><xsl:value-of select="tb" disable-output-escaping="yes"/></div>
				<xsl:value-of select="note" disable-output-escaping="yes"/>
        			</td>
		</tr>	
		</table>	
	</xsl:for-each>
</xsl:template>

<xsl:template match="item" mode="note">
    <xsl:variable name="id"><xsl:value-of select="id"/></xsl:variable>
    <xsl:variable name="type"><xsl:value-of select="type"/></xsl:variable>
				
				<div class="noteitem">
				        <xsl:attribute name="id">i<xsl:value-of select="oid"/></xsl:attribute>
				        <xsl:attribute name="onDblClick">getControlForm(<xsl:value-of select="oid"/>);</xsl:attribute>

					<div class="noteauthor"><xsl:value-of select="author" disable-output-escaping="yes"/></div>
					<div class="notetime"><xsl:value-of select="tb" disable-output-escaping="yes"/></div>
					<xsl:value-of select="note" disable-output-escaping="yes"/>
				</div>
</xsl:template>

</xsl:stylesheet>
