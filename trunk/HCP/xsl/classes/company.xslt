<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="company" mode="objectstree">
	<div id="companylist">
	<xsl:if test="count(item) > 0">
		<h2 id="company" onClick="showHide('company')">Компании</h2>

		<div class="list" id="companylistitem">
				<xsl:apply-templates select="item" mode="company"/>	        
		</div>          
	</xsl:if>
	</div>      				
</xsl:template>

<xsl:template match="companies" mode="ajax">
	<xsl:apply-templates select="company" mode="objectstree"/>
</xsl:template>

<xsl:template match="company" mode="path">
	<tr><td class="toplevels">
		<xsl:apply-templates select="item" mode="company"/>		      
	</td></tr>
</xsl:template>

<xsl:template match="companyitem" mode="ajax">
	<xsl:apply-templates select="item" mode="company"/>	
</xsl:template>

<xsl:template match="company" mode="control">
        <xsl:for-each select="item">			
		<xsl:variable name="id"><xsl:value-of select="id"/></xsl:variable>
		<xsl:variable name="type"><xsl:value-of select="type"/></xsl:variable>
		<xsl:variable name="of_address"><xsl:value-of select="of_address"/></xsl:variable>

		<table botder="0" cellpadding="0" cellspacing="14" width='100%'>
		<tr>			
			<td valign="top" class='small'><img align="absmiddle" valign='top'>
				<xsl:attribute name="src">i/i_company_<xsl:value-of select="../types/item[id=$type]/img"/>.png</xsl:attribute>
			</img><br/>	
			<xsl:value-of select="../types/item[id=$type]/title"/>				
			</td>
			<td width='100%' valign="top" class='text'>
			<b>
				<xsl:choose>
					<xsl:when test="fform = '1'">ИП</xsl:when>
					<xsl:when test="fform = '2'">ООО</xsl:when>
					<xsl:when test="fform = '3'">ЗАО</xsl:when>
					<xsl:when test="fform = '4'">ОАО</xsl:when>
					<xsl:when test="fform = '5'">ГУП</xsl:when>
				</xsl:choose>
				<xsl:text> </xsl:text>"<xsl:value-of select="title"/>"
			</b><br/>
			ИНН: <xsl:value-of select="inn"/><br/>
			КПП: <xsl:value-of select="kpp"/><br/>
			ОКВЕД: <xsl:value-of select="okved"/><br/>
			ОКПО: <xsl:value-of select="okpo"/><br/>	
			<br/>
			E-mail: <a class='text'>
				<xsl:attribute name="href">mailto:<xsl:value-of select="email"/></xsl:attribute>
				<xsl:value-of select="email"/></a><br/>
			Дата основания: <xsl:value-of select="tb"/><br/>	
			</td>
		</tr>	
		</table>	
	</xsl:for-each>
</xsl:template>

<xsl:template match="item" mode="company">
	                <xsl:variable name="id"><xsl:value-of select="id"/></xsl:variable>
		                <xsl:variable name="type"><xsl:value-of select="type"/></xsl:variable>
				
				<div class="companyinfo">
				        <xsl:attribute name="id">i<xsl:value-of select="oid"/></xsl:attribute>
				        <xsl:attribute name="onDblClick">getControlForm(<xsl:value-of select="oid"/>);</xsl:attribute>

					<xsl:if test="bd='1'">
						<xsl:attribute name="style">background-color: #ffffe0</xsl:attribute>
					</xsl:if>

					<img align="absmiddle">
						<xsl:attribute name="src">i/i_company_<xsl:value-of select="../types/item[id=$type]/img"/>.png</xsl:attribute>
					</img>&#0160;&#0160;<a>
						<xsl:attribute name="href">?usecase=ShowObjectsTree&amp;id=<xsl:value-of select="oid" disable-output-escaping="yes"/></xsl:attribute>
						<xsl:value-of select="title" disable-output-escaping="yes"/></a>
					<div class="companysubinfo">
						 ИНН: <xsl:value-of select="inn" disable-output-escaping="yes"/>, КПП: <xsl:value-of select="kpp" disable-output-escaping="yes"/>,
						 ОКВЕД: <xsl:value-of select="okved" disable-output-escaping="yes"/>, ОКПО: <xsl:value-of select="okpo" disable-output-escaping="yes"/>
					</div>
				</div>
</xsl:template>

</xsl:stylesheet>
