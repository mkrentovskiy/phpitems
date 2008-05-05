<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">


<xsl:template match="request">
	<div align='left' style='padding: 7px'>
		<h1><img src='/i/r.gif' width='10' height='10' border='0' align='absmiddle'/>&#0160;&#0160;Ваш заказ</h1>
	</div>
	<table border="0" cellpadding="3" cellspacing="1" width='100%' class='pt8'>
	<tr>
	<td valign="top" width='5%' class='hd'>№</td>
	<td valign="top" width='60%' class='hd'>Название</td>
	<td valign="top" width='10%' class='hd'>Цена</td>
	<td valign="top" width='10%' class='hd'>Кол-во</td>
	<td valign="top" width='14%' class='hd'>Итог</td>
	</tr>
   	<xsl:apply-templates select="chart/chartitem" mode='request'/>		
	<tr>
	<td valign="top" colspan='3' align='right'></td>
	<td valign="top" colspan='2' width='24%' align='right'>
		<nobr><span class='ppricenum'><xsl:value-of select="chart/total" disable-output-escaping="yes"/></span><span class='ppriceeq'>руб</span></nobr></td>
	</tr>
	<tr>
	<td valign="top" colspan='2' align='right'></td>
	<td valign="top" colspan='3' width='24%' align='right'>
	</td>
	</tr>
	<tr>
	<td valign="middle" colspan='2' align='left'><a href='/index.php?usecase=ProcessChart&amp;opt=2' class='pinfo'>Отклонить заказ</a></td>
	<form method='GET' action='/'>	
	<input type='hidden' name='usecase' value='ProcessChart'/>
	<input type='hidden' name='opt' value='1'/>
	<td valign="top" colspan='3' width='24%' align='right'>
		<input type='submit' value='Подтвердить заказ' class='silver'/>
	</td>
	</form>
	</tr>
	</table>
</xsl:template>


<xsl:template match="chartitem" mode='request'>
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
			<xsl:value-of select="title" disable-output-escaping="yes"/>
		
	</td>
	<td valign="top" width='10%' align='right'>
		<xsl:attribute name="class">
			<xsl:value-of select="$cl"/>
		</xsl:attribute>
		<nobr><xsl:value-of select="*[name()=$p]"/> руб.</nobr>		
	</td>
	<td valign="top" width='10%' align='right'>
		<xsl:attribute name="class">
			<xsl:value-of select="$cl"/>
		</xsl:attribute>
		<xsl:value-of select="num" disable-output-escaping="yes"/>
	</td>
	<td valign="top" width='14%' align='right'>
		<xsl:attribute name="class">
			<xsl:value-of select="$cl"/>
		</xsl:attribute>
		<nobr><xsl:value-of select="number(*[name()=$p]) * number(num)"/> руб.</nobr>		
	</td>
	
	</tr>
</xsl:template>



<xsl:template match="requestlist">
	<div align='left' style='padding: 7px'>
		<h1><img src='/i/r.gif' width='10' height='10' border='0' align='absmiddle'/>&#0160;&#0160;Ваши заказы</h1>
	</div>

	<table border="0" cellpadding="3" cellspacing="1" width='100%' class='pt8'>
	<tr>
	<form method='GET' action='/'>	
	<input type='hidden' name='usecase' value='ShowRequests'/>
	<td valign="middle" colspan='3' width='100%' align='right'>
		<nobr>Показать только заказы с состоянием:</nobr>
	</td>
	<td valign="top" colspan='3' width='1%' align='right'>
		<select size='1' name='filter' onChange='this.form.submit()'>
			<option value='0'>--</option>		
			<xsl:for-each select="//document/states/item">	
			<option>
				<xsl:attribute name="value">
					<xsl:value-of select="id_request_states"/>
				</xsl:attribute>
				<xsl:if test="id_request_states = //document/currentstate">
					<xsl:attribute name="selected">1</xsl:attribute>
				</xsl:if>	
				<xsl:value-of select="state"/>
			</option>		
			</xsl:for-each>	
		</select>
	</td>
	<td valign="top" colspan='3' width='1%' align='right'>
		<input type='submit' value='&#9658;' class='silver'/>
	</td>
	</form>
	</tr>
	</table>

	<table border="0" cellpadding="0" cellspacing="14" width='100%' class='pt8'>
	<xsl:if test="count(requestitem) = 0">
		<tr>
		<td valign="top" width='100%' class='ss' align='center' style='padding: 10px'>
		<b>Заказы не обнаружены</b>			
		</td>
		</tr>	
	</xsl:if>
	<xsl:for-each select="requestitem">
		<xsl:variable name='s' select='state'/>
		<tr>
		<td valign="top" width='100%'>
			<h2><xsl:value-of select="tm"/></h2>
			<span class='small'>Идентификатор заказа: R-<xsl:value-of select="id_requests"/></span>
			<br/><b>Состояние заказа:</b>&#0160;<xsl:value-of select="//document/states/item[id_request_states=$s]/state"/> 
			<xsl:if test="string-length(comment) > 1"><br/><b>Комментарий:</b>&#0160;<xsl:value-of select="comment" disable-output-escaping="yes"/></xsl:if> 
			<br/>
			<table border="0" cellpadding="3" cellspacing="1" width='100%' class='pt8'>
			<tr>
			<td valign="top" width='60%' class='hd'>Название</td>
			<td valign="top" width='20%' class='hd'>Кол-во</td>
			<td valign="top" width='20%' class='hd'>Цена</td>
			</tr>
			<xsl:for-each select="content/item">
				<xsl:variable name="cl">
					<xsl:choose>
						<xsl:when test="position() mod 2 = 1">ss</xsl:when>
						<xsl:otherwise>nt</xsl:otherwise>
					</xsl:choose>
				</xsl:variable>
				<tr>
					<td valign="top" width='60%'>
						<xsl:attribute name="class">
							<xsl:value-of select="$cl"/>
						</xsl:attribute>
						<xsl:value-of select="title" disable-output-escaping="yes"/>
					</td>
					<td valign="top" width='20%' align='right'>
						<xsl:attribute name="class">
							<xsl:value-of select="$cl"/>
						</xsl:attribute>
						<xsl:value-of select="num" disable-output-escaping="yes"/>
					</td>
					<td valign="top" width='20%' align='right'>
						<xsl:attribute name="class">
							<xsl:value-of select="$cl"/>
						</xsl:attribute>
						<xsl:value-of select="price" disable-output-escaping="yes"/> руб.
					</td>

				</tr>
			</xsl:for-each>
			<tr>
			<td colspan='2' align='right'><span class='small'>Итого</span></td>
			<td valign="top" width='20%' align='right'>
				<nobr><span class='ppricenum'><xsl:value-of select="total" disable-output-escaping="yes"/></span><span class='ppriceeq'>руб</span></nobr></td>
			</tr>
			</table>			
		</td>
		</tr>
	</xsl:for-each>
	</table>

	<br/><br/>		
    <xsl:apply-templates select="pages"/>		

</xsl:template>


</xsl:stylesheet>
