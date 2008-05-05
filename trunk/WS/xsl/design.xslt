<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="document">
<html>
<head>
    	<title><xsl:value-of select="@title"/> - WebShop</title>
   	
	<link rel="stylesheet" type="text/css" href="/css/webshop.css"/>
	<link rel="stylesheet" type="text/css" href="/css/baloon.css"/>

   	<script src="/js/prototype.js" language="javascript" type="text/javascript"></script>
	<script src="/js/baloon.js" language="javascript" type="text/javascript"></script>
	<script src="/js/validate.js" language="javascript" type="text/javascript"></script>
    <script src="/js/webshop.js" language="javascript" type="text/javascript"></script>
</head>

<body topmargin="0" leftmargin="0" marginheight="0" marginwidth="0">

<table width="720" border="0" cellpadding="0" cellspacing="0" align="center" height="100%">
<tr>
<td valign="top" align="center" width="100%">
	<table border="0" cellpadding="0" cellspacing="0" id='toptable'>
	<tr>
	<xsl:text disable-output-escaping="yes"><![CDATA[
		<td valign="middle" align="center" style="padding-left: 24px;"><a href='/'><img src='/i/logo.gif' border='0' width='180' height='46'/></a></td>
        ]]></xsl:text>
	<td valign="top" align="left" width='100%'>
		<table border="0" cellpadding="0" cellspacing="0" width='100%' style='height: 155px'>
		<tr>
		<td valign="top" align="right">
			<table border="0" cellpadding="0" cellspacing="0">
			<tr>
			<form action='/' method='GET'>
			<input type='hidden' name='usecase' value='SearchProduct'/>
			<td valign="middle" align="right" id='search'><input type='text' size='40' maxlength='128' id='searchtext' name='f_q'>
			    <xsl:attribute name="value"><xsl:value-of select="search/query" disable-output-escaping="yes"/></xsl:attribute>		
			</input></td>
			<td valign="middle" align="center" id='searchbutton'><input type='submit' value='' style='width: 13px; height: 13px; background: url(/i/ss.gif) no-repeat; border: 0px'/></td>
			</form>
			</tr>
			</table>
		</td>
		</tr>
		<tr>
		<td valign="top" align="right" id='loginbox'>
			<xsl:apply-templates select="user"/>	
		</td>
		</tr>
		<tr>
		<td valign="bottom" align="right" style='padding-right: 12px'>

			<table border="0" cellpadding="0" cellspacing="0">	
			<tr>
			<xsl:for-each select="menu/item">
				<xsl:choose>
					<xsl:when test="../../mcurrent = link">
						<td valign="top" align="right"><img src='i/sml.gif' border='0' width='7' height='30'/></td>
						<td valign="middle" align="center" class='smenu'><a class='smenu'>
							<xsl:attribute name="href"><xsl:value-of select="link" disable-output-escaping="yes"/></xsl:attribute>
							<xsl:value-of select="title" disable-output-escaping="yes"/>
						</a></td>
						<td valign="top" align="left" style='padding-right: 1px;'><img src='i/smr.gif' border='0' width='7' height='30'/></td>
					</xsl:when>
					<xsl:otherwise>
						<td valign="top" align="right"><img src='i/ml.gif' border='0' width='8' height='29'/></td>
						<td valign="middle" align="center" class='menu'><a class='menu'>
							<xsl:attribute name="href"><xsl:value-of select="link" disable-output-escaping="yes"/></xsl:attribute>
							<xsl:value-of select="title" disable-output-escaping="yes"/>			
						</a></td>
						<td valign="top" align="left" style='padding-right: 1px;'><img src='i/mr.gif' border='0' width='8' height='29'/></td>
					</xsl:otherwise>
				</xsl:choose>
			</xsl:for-each>
			</tr>
			</table>
		</td>
		</tr>
		</table>
	</td>
	</tr>
	</table>
</td>
</tr>
<tr>
<td valign="top" align="center" width="100%" height='100%' style='padding-top: 12px;'>
	<table border="0" cellpadding="0" cellspacing="0" width='100%'>
	<tr>
	<td valign="top" align="left" width='208'>
		<table border="0" cellpadding="0" cellspacing="0" width='100%'>

		<tr>
		<td valign='middle'><img src='/i/c.gif' border='0' width='11' height='7'/></td>
		<td width='100%' valign='middle'>Категории</td>
		</tr>

		<tr>
		<td></td>
		<td valign='top' align='middle'><img src='/i/spacer.gif' border='0' width='10' height='10'/></td>
		<td width='100%' valign='top'></td>
		<td></td>
		</tr>

		<xsl:for-each select='categories/item'>
			
			<tr>
			<td valign='top' align='middle' class='categoryitem'>
				<xsl:choose>
					<xsl:when test="count(subcat/item) > 0">
						<img id="i{id_categories}" class="menubtn" src="/i/z.gif" onclick="changeMenu({id_categories});" border="0" number="{id_categories}"/>
					</xsl:when>
					<xsl:otherwise>
						<img src='/i/ci.gif' border='0' width='10' height='7'/>
					</xsl:otherwise>
				</xsl:choose>
			</td>
			<td width='100%' valign='top'>
				<a class='category' href='?usecase=ShowCategory&amp;id={id_categories}'>
					<xsl:value-of select="title" disable-output-escaping="yes"/>
				</a>
				<xsl:if test="count(subcat/item) > 0">
					<table border="0" cellpadding="0" cellspacing="0" width="100%" id="t{id_categories}" style="display: none;">
					<xsl:for-each select='subcat/item'>
						<tr>
						<td valign='top' align='middle' class='categoryitem'><img src='/i/ci.gif' border='0' width='10' height='7'/></td>
						<td width='100%' valign='top'>
						<a class='category' href='?usecase=ShowCategory&amp;id={id_categories}'>
							<xsl:value-of select="title" disable-output-escaping="yes"/>
						</a>
						</td>
						</tr>					
					</xsl:for-each>
					</table>
				</xsl:if>
			</td>
			</tr>
		</xsl:for-each>

		</table>
	</td>
	<td style='width: 2px'></td>	
	<td valign="top" align="center" width='510'>
	        <xsl:apply-templates select="relocate|block|registration|headline|fproductlist|productlist|topcategory|productitem|chart|request|requestlist|actionform|search"/>	
	</td>
	</tr>
	</table>
</td>
</tr>

<tr><td style='height: 14px'></td></tr>
<tr><td bgcolor='#000000' style='height: 4px;'></td></tr>

<tr>
<td valign="middle" align="center" width="100%" style="padding-top: 12px;">
	<table border="0" cellpadding="0" cellspacing="0" width='100%' class='pt8'>
	<tr>
	<td id='contacts' width='33%'>
        &#0169; LeXXI, 2007
	<br/>тел. (4872) 35-46-55, 36-46-65
	<br/><a href='mailto:lexxi@tula.net' class='category'>lexxi@tula.net</a>
	</td>
	<td width='34%' align='center'>
	<xsl:text disable-output-escaping="yes"><![CDATA[
	]]></xsl:text>
	</td>
	<td width='33%' align='right'>
	<div class='consult'>Online-консультант</div>
	<a title="отправить сообщение на ICQ" href="http://wwp.icq.com/scripts/contact.dll?msgto=12345768" class='icq'>
		<img border="0" height="18" width="18" src="http://wwp.icq.com/scripts/online.dll?icq=12345768&amp;img=5" align='absmiddle'/>
	</a> <a title="консультация менеджера" href="http://wwp.icq.com/scripts/contact.dll?msgto=12345768" class='icq'>12345768</a>
	</td>
	</tr>
	</table>
</td>
</tr>


</table>
</body>
</html>
</xsl:template>

<xsl:template match="relocate">
	<xsl:text disable-output-escaping="yes"><![CDATA[
<script language='JavaScript'><!--]]>
	</xsl:text>
	<xsl:for-each select="open">
		window.open('<xsl:value-of select="url" disable-output-escaping="yes"/>');
	</xsl:for-each>
		window.location.href = '<xsl:value-of select="url" disable-output-escaping="yes"/>';
	<xsl:text disable-output-escaping="yes"><![CDATA[
//--></script>
	]]></xsl:text>
	<div class='pt8' style='padding: 24px'>
	Если Вы не были перемещены автоматически, воспользуйтесь следующей ссылкой<br/>
	<a>
		<xsl:attribute name="href"><xsl:value-of select="url" disable-output-escaping="yes"/></xsl:attribute>
		<xsl:value-of select="url" disable-output-escaping="yes"/>
	</a>
	</div>
</xsl:template>

<xsl:template match='maildocument'>                        
<html>
<head>
    	<title></title>
<xsl:text disable-output-escaping="yes"><![CDATA[
<style type='text/css'>

body{
	font-size: 8pt;
	font-family: Arial, Tahoma, Verdana, sans-serif;
	color: #000000;
	}


.pt7{
	font-size: 7pt;
	}
.pt8{
	font-size: 8pt;
	}
.pt9{
	font-size: 9pt;
	}

table{
	font-family: Arial, Tahoma, Verdana, sans-serif;
	font-size: 8pt;
	}

</style>
]]></xsl:text>
</head>
<body bgcolor="#ffffff" topmargin="30" leftmargin="30" marginheight="30" marginwidth="30">	
	<xsl:apply-templates select="block"/>
</body>
</html>
</xsl:template>

<xsl:template match="pages">
 	<tr><td align='right' class='pt7' colspan='3'>Страницы: <xsl:apply-templates select="ppage|tpage|npage|cpage"/> [<xsl:value-of select="@records"/>]</td></tr>
</xsl:template>

<xsl:template match="ppage">
	<a>
	<xsl:attribute name="href"><xsl:value-of select="@URL"/></xsl:attribute>
	<xsl:value-of select="."/></a>
</xsl:template>

<xsl:template match="tpage">
	<a>
	<xsl:attribute name="href"><xsl:value-of select="@URL"/></xsl:attribute>
	<xsl:value-of select="."/></a>
</xsl:template>

<xsl:template match="npage">
	<a>
        <xsl:attribute name="href"><xsl:value-of select="@URL"/></xsl:attribute>
	<xsl:value-of select="."/></a>
</xsl:template>

<xsl:template match="cpage">
        <b><xsl:value-of select="."/></b>
</xsl:template>


</xsl:stylesheet>
