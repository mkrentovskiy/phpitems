<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="person" mode="objectstree">
	<div id="personlist">
	<xsl:if test="count(item) > 0">
		<h2 id="person" onClick="showHide('person')">Персоны</h2>

		<div class="list" id="personlistitem">
		    <xsl:apply-templates select="item" mode="person"/>	
		</div>          
	</xsl:if>
	</div>      				
</xsl:template>

<xsl:template match="persons" mode="ajax">
	<xsl:apply-templates select="person" mode="objectstree"/>
</xsl:template>

<xsl:template match="personitem" mode="ajax">
	<xsl:apply-templates select="item" mode="person"/>	
</xsl:template>

<xsl:template match="person" mode="path">
	<tr><td class="toplevels">
		<xsl:apply-templates select="item" mode="person"/>	
	</td></tr>
</xsl:template>

<xsl:template match="person" mode="control">
        <xsl:for-each select="item">			
		<xsl:variable name="id"><xsl:value-of select="id"/></xsl:variable>

		<table botder="0" cellpadding="0" cellspacing="14" width='100%'>
		<tr>
			<td valign="top">
				<img>
					<xsl:attribute name="src">
						<xsl:if test="sex = '1' and not(bd = '1')">i/i_male.png</xsl:if>
						<xsl:if test="sex = '2' and not(bd = '1')">i/i_female.png</xsl:if>
						<xsl:if test="sex = '3' and not(bd = '1')">i/i_tux.png</xsl:if>
						<xsl:if test="bd = '1'">i/i_hbty.png</xsl:if>
					</xsl:attribute>
				</img>
			</td>
			<td width='100%' valign="top" class='text'>
				<b>
				<xsl:value-of select="lname" disable-output-escaping="yes"/><xsl:text> </xsl:text>
				<xsl:value-of select="fname" disable-output-escaping="yes"/><xsl:text> </xsl:text>
				<xsl:value-of select="mname" disable-output-escaping="yes"/></b><br/>
				Должность: <xsl:value-of select="title" disable-output-escaping="yes"/><br/>
				Дата рождения: <xsl:value-of select="ttborn" disable-output-escaping="yes"/><br/>
        			</td>
		</tr>	
		</table>	
	</xsl:for-each>
</xsl:template>

<xsl:template match="item" mode="person">
		<div class="personinfo">
				        <xsl:attribute name="id">i<xsl:value-of select="oid"/></xsl:attribute>
				        <xsl:attribute name="onDblClick">getControlForm(<xsl:value-of select="oid"/>);</xsl:attribute>
					<xsl:if test="bd='1'">
						<xsl:attribute name="style">background-color: #ffffe0</xsl:attribute>
					</xsl:if>

					<img align="absmiddle">
						<xsl:attribute name="src">
							<xsl:if test="sex = '1' and not(bd = '1')">i/i_male.png</xsl:if>
							<xsl:if test="sex = '2' and not(bd = '1')">i/i_female.png</xsl:if>
							<xsl:if test="sex = '3' and not(bd = '1')">i/i_tux.png</xsl:if>
							<xsl:if test="bd = '1'">i/i_hbty.png</xsl:if>
						</xsl:attribute>
					</img>&#0160;&#0160;<a>
						<xsl:attribute name="href">?usecase=ShowObjectsTree&amp;id=<xsl:value-of select="oid" disable-output-escaping="yes"/></xsl:attribute>
						<xsl:value-of select="lname" disable-output-escaping="yes"/><xsl:text> </xsl:text>
						<xsl:value-of select="fname" disable-output-escaping="yes"/><xsl:text> </xsl:text>
						<xsl:value-of select="mname" disable-output-escaping="yes"/>
					</a>
					<div class="personsubinfo">
						<xsl:value-of select="title" disable-output-escaping="yes"/><br/>
					</div>
				</div>
</xsl:template>

</xsl:stylesheet>
