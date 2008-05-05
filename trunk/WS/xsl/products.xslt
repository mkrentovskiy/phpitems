<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="headline">
	<table border="0" cellpadding="0" cellspacing="0" id='preview'>
	<tr>
	<td valign="top" align="left" id='previewtext' width='100%'>
		<div id='previewtextheader'><xsl:value-of select="item/title" disable-output-escaping="yes"/></div>
		<div id='previewtextitem'><xsl:value-of select="item/info" disable-output-escaping="yes"/></div> 		
		<div id='previewtextsub'><xsl:value-of select="item/comment" disable-output-escaping="yes"/></div>
	</td>
	<td valign="top" align="left">
	<a>
		<xsl:attribute name="href"><xsl:value-of select="item/link" disable-output-escaping="yes"/></xsl:attribute>
		<img border='0' width="227" height="165">
			<xsl:attribute name="src">/<xsl:value-of select="item/img"/></xsl:attribute>
		</img>
	</a>
	</td>
	</tr>
	</table>
	<br/>
</xsl:template>

<xsl:template match="fproductlist">
		<xsl:if test="string-length(@title) > 1"><h1><xsl:value-of select="@title"/></h1></xsl:if>		
		<table border="0" cellpadding="0" cellspacing="0" width='100%'>
		<tr>
		<xsl:variable name="c">
			<xsl:choose>
				<xsl:when test="count(item) mod 2 = 0">1</xsl:when>
				<xsl:otherwise>0</xsl:otherwise>
		</xsl:choose></xsl:variable>
		<xsl:for-each select='item'>
		<td valign="top" align="left" width='50%'>
			<xsl:attribute name="class">
				<xsl:choose>
					<xsl:when test="((position() - 1) mod 2 = 1) and (((count(../item) - 1) > position() and $c = '1') or (count(../item) > position() and $c = '0'))">pl</xsl:when>
					<xsl:when test="((count(../item) - 1) = position() and $c = '1') or (count(../item) = position() and $c = '0')">ps</xsl:when>
					<xsl:when test="position() = count(../item) and $c = '1'">pz</xsl:when>
					<xsl:otherwise>pt</xsl:otherwise>
				</xsl:choose>	
			</xsl:attribute>

			<h2><xsl:value-of select="title" disable-output-escaping="yes"/></h2>
			<table border="0" cellpadding="0" cellspacing="14" width='100%'>
			<tr>
			<td valign="top" width='50%'>
				<a class='pinfo'>
					<xsl:attribute name="href">?usecase=ShowProduct&amp;id=<xsl:value-of select="id_products"/></xsl:attribute>
					<img border='0'>
						<xsl:attribute name="src">
							<xsl:choose>
								<xsl:when test="string-length(img) > 1">/photo/tumb/<xsl:value-of select="img"/></xsl:when>
								<xsl:otherwise>/i/nofoto.gif</xsl:otherwise>
							</xsl:choose>
						</xsl:attribute>
					</img>
				</a>
			</td>
			<td valign="top" width='50%' class='pdesc'>
				<div><xsl:value-of select="shortinfo" disable-output-escaping="yes"/></div>
				<div class='pwarn'>Гарантия - <xsl:value-of select="warranty" disable-output-escaping="yes"/></div>

				<xsl:variable name="p">
					<xsl:choose>
						<xsl:when test="string-length(//document/user/price) > 0"><xsl:value-of select="//document/user/price"/></xsl:when>
						<xsl:otherwise>c</xsl:otherwise>
					</xsl:choose>_price</xsl:variable>
				<div><span class='ppricenum'><xsl:value-of select="./*[name() = $p]" disable-output-escaping="yes"/></span><span class='ppriceeq'>руб</span></div>
			</td>
			</tr>
			<tr>
			<td valign="top" width='50%'>
				<a class='pinfo'>
					<xsl:attribute name="href">?usecase=ShowProduct&amp;id=<xsl:value-of select="id_products"/></xsl:attribute>
				<img src='/i/i.gif' border='0' width='15' height='14' align='absmiddle'/></a> 
				<a class='pinfo'>
					<xsl:attribute name="href">?usecase=ShowProduct&amp;id=<xsl:value-of select="id_products"/></xsl:attribute>				
				Подробнее</a>
			</td>
			<td valign="top" width='50%'>
				<a class='pchart'>
					<xsl:attribute name="href">?usecase=AddToChart&amp;id=<xsl:value-of select="id_products"/></xsl:attribute>
				<img src='/i/b.gif' border='0' width='15' height='13' align='absmiddle'/></a> 
				<a class='pchart'>
					<xsl:attribute name="href">?usecase=AddToChart&amp;id=<xsl:value-of select="id_products"/></xsl:attribute>
				В корзину</a>
			</td>
			</tr>
			</table>			
		</td>
		<xsl:if test="(count(../item) > position()) and ((position() - 1) mod 2 = 1)">
			<xsl:text disable-output-escaping="yes"><![CDATA[</tr><tr>]]></xsl:text>				
		</xsl:if>
		</xsl:for-each>
		<xsl:if test="$c = '1' or count(item) = 1">
			<td width='50%'><a href='#' class='smenu'>.</a></td>					
		</xsl:if>

	        </tr>
		</table>		
</xsl:template>

<xsl:template match="productlist">
		<xsl:if test="string-length(@title) > 1"><h1><xsl:value-of select="@title"/></h1></xsl:if>		
		<table border="0" cellpadding="3" cellspacing="1" width='100%' class='pt8'>
		<tr>
			<td valign="top" width='74%' class='hd'>Продукт</td>
			<td valign="top" width='20%' class='hd'>Цена</td>
			<td valign="top" width='3%' class='hd'></td>
			<td valign="top" width='3%' class='hd'></td>
		</tr>

		<xsl:for-each select='item'>
			<xsl:variable name="cl">
				<xsl:choose>
					<xsl:when test="position() mod 2 = 1">ss</xsl:when>
					<xsl:otherwise>nt</xsl:otherwise>
				</xsl:choose>
			</xsl:variable>
			<xsl:variable name="p">
				<xsl:choose>
					<xsl:when test="string-length(//document/user/price) > 0"><xsl:value-of select="//document/user/price"/></xsl:when>
					<xsl:otherwise>c</xsl:otherwise>
				</xsl:choose>_price</xsl:variable>
	
		<tr>
			<td valign="top" width='60%'>
				<xsl:attribute name="class">
					<xsl:value-of select="$cl"/>
				</xsl:attribute>
				<a>
					<xsl:attribute name="href">?usecase=ShowProduct&amp;id=<xsl:value-of select="id_products"/></xsl:attribute>
				<xsl:value-of select="title" disable-output-escaping="yes"/>
				</a><br/>
				<span class='small'><xsl:value-of select="shortinfo" disable-output-escaping="yes"/></span>
			</td>
			<td valign="top" width='10%' align='right'>
				<xsl:attribute name="class">
					<xsl:value-of select="$cl"/>
				</xsl:attribute>
				<nobr><xsl:value-of select="*[name()=$p]"/> руб.</nobr>		
			</td>
			<td valign="top" width='10%' align='center'>
				<a class='pinfo'>
					<xsl:attribute name="href">?usecase=ShowProduct&amp;id=<xsl:value-of select="id_products"/></xsl:attribute>
				<img src='/i/i.gif' border='0' width='15' height='14' align='absmiddle' alt='Подробнее' title='Подробнее'/></a> 
			</td>
			<td valign="top" width='14%' align='center'>
				<a class='pchart'>
					<xsl:attribute name="href">?usecase=AddToChart&amp;id=<xsl:value-of select="id_products"/></xsl:attribute>
				<img src='/i/b.gif' border='0' width='15' height='13' align='absmiddle' alt='Купить' title='Купить'/></a> 
			</td>
	
		</tr>
		</xsl:for-each>
		</table>		
</xsl:template>

<xsl:template match="topcategory">
	<div align='left' style='padding: 7px'>
		<h1><img src='/i/ct.gif' width='13' height='10' border='0' align='absmiddle'/>&#0160;&#0160;<xsl:value-of select="title" disable-output-escaping="yes"/></h1>
	</div>
        <xsl:apply-templates select="productlist|category"/>		
</xsl:template>

<xsl:template match="category">
	<xsl:if test="count(productlist) >0">
		<div align='left' style='padding: 7px'>
			<br/><br/>
			<h3><xsl:value-of select="title" disable-output-escaping="yes"/></h3>	
		</div>
        	<xsl:apply-templates select="productlist"/>			
	</xsl:if>
       	<xsl:apply-templates select="category"/>				
</xsl:template>

<xsl:template match="productitem">
	<div align='left' style='padding: 7px'>
		<h1><img src='/i/i.gif' width='15' height='14' border='0' align='absmiddle'/>&#0160;&#0160;<xsl:value-of select="item/title" disable-output-escaping="yes"/></h1>
		<div style='padding-left: 19px' class='pt7'>
		<xsl:variable name="ct" select="item/category"/>
		<xsl:if test='string-length(//document/categories/item[id_categories=$ct]/title) > 0'>    
			Категория: <a class='category'>
			<xsl:attribute name="href">?usecase=ShowCategory&amp;id=<xsl:value-of select="item/category" disable-output-escaping="yes"/></xsl:attribute>
			<xsl:value-of select='//document/categories/item[id_categories=$ct]/title'/>
			</a><br/>
		</xsl:if>
		Артикул: <span style='color: #666666'><xsl:value-of select="item/id_products" disable-output-escaping="yes"/></span>
		</div>
	</div>
	<table border="0" cellpadding="0" cellspacing="14" width='100%' class='pt8'>
	<tr>
	<td valign="top" width='40%'>
		<img border='0'>
			<xsl:attribute name="src">
				<xsl:choose>
					<xsl:when test="string-length(item/img) > 1">/photo/<xsl:value-of select="item/img"/></xsl:when>
					<xsl:otherwise>/i/nofoto.gif</xsl:otherwise>
				</xsl:choose>
			</xsl:attribute>
		</img>
	<br/>
	<br/>
	<div class='pwarn'>Гарантия: <xsl:value-of select="item/warranty" disable-output-escaping="yes"/></div>
	<br/>

	<xsl:variable name="p">
		<xsl:choose>
			<xsl:when test="string-length(//document/user/price) > 0"><xsl:value-of select="//document/user/price"/></xsl:when>
			<xsl:otherwise>c</xsl:otherwise>
		</xsl:choose>_price</xsl:variable>
	<div>
	<span class='small'>Цена:</span><br/>
	<span class='ppricenum'><xsl:value-of select="item/*[name() = $p]" disable-output-escaping="yes"/></span><span class='ppriceeq'>руб</span></div>
	<br/>
	<br/>
	<nobr>
	<a class='pchart'>
		<xsl:attribute name="href">?usecase=AddToChart&amp;id=<xsl:value-of select="item/id_products"/></xsl:attribute>
		<img src='/i/b.gif' border='0' width='15' height='13' align='absmiddle'/></a> 
	<a class='pchart'>
		<xsl:attribute name="href">?usecase=AddToChart&amp;id=<xsl:value-of select="item/id_products"/></xsl:attribute>
	В корзину</a>
	</nobr>
	</td>
	<td valign="top" width='60%' class='pt8'>
		<div><xsl:value-of select="item/info" disable-output-escaping="yes"/></div>
	</td>
	</tr>
	</table>		
</xsl:template>


</xsl:stylesheet>
