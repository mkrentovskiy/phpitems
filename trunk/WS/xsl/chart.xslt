<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">


<xsl:template match="chart">
	<div align='left' style='padding: 7px'>
		<h1><img src='/i/b.gif' width='15' height='13' border='0' align='absmiddle'/>&#0160;&#0160;Ваша корзина</h1>
	</div>
	<xsl:choose>
		<xsl:when test='count(chartitem) = 0'>	
			<table border="0" cellpadding="0" cellspacing="14" width='100%' class='pt8'>
			<tr>
			<td valign="top">
			<h3>Ваша корзина пуста</h3>
			Вы не добавили ни одного продукта в Вашу корзину. Вы можете это сделать после просмотра категорий продуктов, приведенных в левой колонке. 
			</td>
			</tr>
			</table>
		</xsl:when>
		<xsl:otherwise>
			<table border="0" cellpadding="3" cellspacing="1" width='100%' class='pt8'>
			<form method='POST' action='/index.php' onSubmit="return validateForm(this);">	
			<input type='hidden' name='usecase' value='ConfigChart'/>
			<tr>
			<td valign="top" width='5%' class='hd'>№</td>
			<td valign="top" width='60%' class='hd'>Название</td>
			<td valign="top" width='10%' class='hd'>Цена</td>
			<td valign="top" width='10%' class='hd'>Кол-во</td>
			<td valign="top" width='14%' class='hd'>Итог</td>
			<td valign="top" width='1%'></td>
			</tr>
        			<xsl:apply-templates select="chartitem" mode='form'/>		
			<tr>
			<td valign="top" colspan='4' align='right'><b>Итого</b></td>
			<td valign="top" width='14%' align='right'><nobr><xsl:value-of select="total"/> руб.</nobr></td>
			<td valign="top" width='1%'></td>
			</tr>
			<tr><td valign='top' colspan='6' align='right'><input type='submit' value='Пересчитать' class='silver'/></td></tr>
			</form>
			<tr><td valign='top' colspan='6' align='right'></td></tr>
			<form method='GET' action='/index.php'>	
			<input type='hidden' name='usecase' value='ProcessChart'/>
			<tr><td valign='top' colspan='6' align='right'>
				<input type='submit' value='Оформить заказ' class='silver'>
				<xsl:if test='string-length(//document/user/name) = 0'>					
					<xsl:attribute name="disabled">1</xsl:attribute>
				</xsl:if>
				</input>
				<xsl:if test='string-length(//document/user/name) = 0'>					
				<br/>
				Для оформления заказа Вам необходимо <a href='?usecase=Registration'>зарегистрироваться</a> и войти!
				</xsl:if>
			</td></tr>	
			</form>
			</table>
		</xsl:otherwise>
	</xsl:choose>
</xsl:template>


<xsl:template match="chartitem" mode='form'>
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
	<td valign="top" width='5%'>
		<xsl:attribute name="class">
			<xsl:value-of select="$cl"/>
		</xsl:attribute>
		<xsl:value-of select="id_products"/>
	</td>
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
	<td valign="top" width='10%'>
		<xsl:attribute name="class">
			<xsl:value-of select="$cl"/>
		</xsl:attribute>
		<input type='text' size='5' maxlength='5' style='text-align: right' pattern="([0-9]*)" notice='Ячейка должна содержать целое число' mustbe='1'>
			<xsl:attribute name="name">f_p_<xsl:value-of select="id_products" disable-output-escaping="yes"/></xsl:attribute>			
			<xsl:attribute name="value"><xsl:value-of select="num" disable-output-escaping="yes"/></xsl:attribute>
		</input>
	</td>
	<td valign="top" width='14%' align='right'>
		<xsl:attribute name="class">
			<xsl:value-of select="$cl"/>
		</xsl:attribute>
		<nobr><xsl:value-of select="number(*[name()=$p]) * number(num)"/> руб.</nobr>		
	</td>
	<td valign="top" width='1%'>
		<xsl:attribute name="class">
			<xsl:value-of select="$cl"/>
		</xsl:attribute>
		<a>
			<xsl:attribute name="href">?usecase=RemoveFromChart&amp;id=<xsl:value-of select="id_products"/></xsl:attribute>
			<img src='/i/d.gif' width='11' height='11' border='0' alt='Удалить позицию из корзины' title='Удалить позицию из корзины'/>
		</a>
	</td>
	
	</tr>
</xsl:template>


</xsl:stylesheet>
