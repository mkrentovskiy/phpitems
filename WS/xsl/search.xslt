<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">


<xsl:template match="search">
	<div align='left' style='padding: 7px'>
		<h1><img src='/i/ct.gif' width='13' height='10' border='0'/>&#0160;&#0160;Поиск по каталогу</h1><br/>
		<span style='padding-left: 19px'><b>Вы искали:</b>&#0160;<xsl:value-of select="query" /></span>
	</div>
	
	<xsl:choose>
		<xsl:when test="total = '0'">
			<br/><br/><b style='color: #e00'>
			К сожалению, по Вашему запросу ничего не найдено. Попробуйте переформулировать запрос или воспользуйтесь поиском 
			через дерево категорий.</b>
		</xsl:when>
		<xsl:otherwise>
		        <xsl:apply-templates select="productlist"/>
			<br/><br/>		
	        	<xsl:apply-templates select="pages"/>		
		</xsl:otherwise>
	</xsl:choose>
</xsl:template>



</xsl:stylesheet>
