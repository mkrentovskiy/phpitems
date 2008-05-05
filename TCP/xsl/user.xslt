<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="user">
	<table border="0" cellpadding="0" cellspacing="6" class="small">
		<xsl:choose>
		        <xsl:when test="string-length(login) = 0 or login = 'Amonymous'">
				<form method='POST'>
					<xsl:attribute name="action">index.php<xsl:value-of select="//document/mcurrent" disable-output-escaping="yes"/></xsl:attribute>
					<tr>
						<td><img src="i/i_user.png" alt="Логин"/></td>
						<td><input type='text' size='12' maxlength='32' class='login' name="AUTH_USER"/></td>
						<td></td>
					</tr>
					<tr>
						<td><img src="i/i_vcard.png" alt="Пароль"/></td>
						<td><input type='password' size='12' maxlength='32' class='login' name="AUTH_PW"/></td>
						<td><input type='submit' value='' id='enter'/></td>
					</tr>
					<tr>
						<td align='right'><input type='checkbox' id='remember' name="REMEMBERME" class='plain'/></td>
						<td colspan='2'><label for='remember'><small>Запомнить</small></label></td>
					</tr>
				</form>
			</xsl:when>
			<xsl:otherwise>

					<tr>
						<td><img src="i/i_user.png" alt="Логин"/></td>
						<td>Пользователь</td>
					</tr>
					<tr>
						<td colspan="2" align='right'><b style="white-space: nowrap;"><xsl:value-of select="name" disable-output-escaping="yes"/></b></td>
					</tr>
					<tr>
						<td colspan="2" align='right'><a href='?usecase=Logout'><img src="i/i_logout.png" alt="Выход"/></a></td>
					</tr>
			</xsl:otherwise>
		</xsl:choose>
	</table>
</xsl:template>

</xsl:stylesheet>
