<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="user">
	<table border="0" cellpadding="0" cellspacing="1">
	<xsl:apply-templates select="nouser"/>
	<xsl:if test="string-length(@login) > 1">
	<tr>
	<td></td>
	<td class='loginheader'>Пользователь</td>
	<td class='loginheader'>Статус</td>
	<td></td>
	<td></td>
	</tr>
	<tr>
	<td><img src='/i/l.gif' border='0' width='15' height='17'/></td>
	<td class='logintxt' style='width: 114px' align='left'><xsl:value-of select="name"/></td>
	<td class='logintxt' style='width: 114px' align='left'>
		<xsl:choose>
			<xsl:when test="price = 'd'">Дилер</xsl:when>
			<xsl:otherwise>Покупатель</xsl:otherwise>
		</xsl:choose>
	</td>
	<td class='logininfoitem' align='right'><a href='?usecase=Logout' class='smenu'>Выход</a></td>
	<form action='/' method='post'>
	<input type='hidden' name='usecase' value='Logout'/>
	<td style='padding-left: 3px'><input type='submit' value='' style='width: 9px; height: 17px; background: url(/i/g.gif) no-repeat; border: 0px'/></td>
	</form>
	</tr>
	<tr>
	<td></td>
	<td></td>
	<td></td>
	<td class='logintxt' align='right' style='width: 150px'><span style='font-size: 7pt; color: #999;'>Логин:</span> <xsl:value-of select="@login"/></td>
	<td></td>
	</tr>
	</xsl:if>
	</table>
</xsl:template>

<xsl:template match="nouser">	
	<form action='/' method='POST'>
	<input type='hidden' name='sid'>
		<xsl:attribute name="value"><xsl:value-of select="@sid"/></xsl:attribute>
	</input>
	<tr>
	<td></td>
	<td class='loginheader'>Логин</td>
	<td class='loginheader'>Пароль</td>
	<td></td>
	</tr>
	<tr>
	<td><img src='/i/l.gif' border='0' width='15' height='17'/></td>
	<td><input type='text' size='32' maxlength='64' class='login' name="AUTH_USER"/></td>
	<td><input type='password' size='32' maxlength='64' class='login' name="AUTH_PW"/></td>
	<td><input type='submit' value='' style='width: 9px; height: 17px; background:  url(/i/g.gif) no-repeat; border: 0px'/></td>
	</tr>
	<tr>
	<td></td>
	<td><input type='checkbox' id='remember' name="REMEMBERME" class='plain'/> <label for='remember' class='login'>Запомнить</label></td>
	<td valign='bottom'><a href='?usecase=RememberPassword' class='login'>Забыли пароль?</a></td>
	<td></td>
	</tr>
	</form>
</xsl:template>

<xsl:template match="block">
	<table border="0" cellpadding="0" cellspacing="18" width='100%'>
	<tr>
	<td valign="top" align="left" width='100%'>
		<xsl:for-each select="item">
			<xsl:if test="string-length(title) > 1"><h3><xsl:value-of select="title" disable-output-escaping="yes"/></h3></xsl:if>
			<div class='pt8'>
			        <xsl:value-of select="info" disable-output-escaping="yes"/>
			</div>
		</xsl:for-each>
	</td>
	</tr>
	</table>
</xsl:template>

<xsl:template match="registration">
	<table border="0" cellpadding="0" cellspacing="18" width='100%'>
	<tr>
	<td valign="top" align="left" width='100%'>
		<h1>Регистрация</h1>
        	<xsl:apply-templates select="block|relocate"/>	
	</td>
	</tr>
	</table>
</xsl:template>


</xsl:stylesheet>
