<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="objectstree">
	<table border="0" cellpadding="6" cellspacing="0" width="100%">
	<tr>
	<td width='64%' valign="top" style="padding-right: 15px;">
		<xsl:apply-templates select="path" mode="panel"/>
		<xsl:apply-templates select="project|person|company|folder|file|image|record|note|address|phone|bill|code|link|task" mode="objectstree"/>
	</td>
	<td width='36%' valign="top" id="addformtd">
		<h3 id="add">Добавить</h3>
		<small>Редкое, но меткое явление</small>		

		<br/>
		<br/>

		<form id='selectClass'>
		<input type='hidden' name='_pid' id='_pid'>
			<xsl:attribute name="value"><xsl:value-of select="@id"/></xsl:attribute>
		</input>
		<table border="0" cellpadding="0" cellspacing="4" width="100%" align="center">
			<tr>
			<td colspan="2"><b>Вид объекта</b></td>
			</tr>
			<tr>
			<td width='100%'>
				<select name="_class" id="_class" size="1" style="width: 100%;" onChange="showClassAddForm(this)">
				<option>...</option>
				<xsl:for-each select="classes/item">
					<option>
						<xsl:attribute name="value"><xsl:value-of select="id"/></xsl:attribute>
						<xsl:value-of select="title" disable-output-escaping="yes"/>					
					</option>
				</xsl:for-each>
				</select>
			</td>
			<td>
				<img src="i/spacer.gif" width="16" alt="" id="af_loader"/>
			</td>
			</tr>
		</table>	
		</form>

		<div id='addformitem'></div>
	</td>
	</tr>
	</table>
</xsl:template>


<xsl:template match="pages" mode="objectstree">
	<xsl:if test="count(./*) > 0">
	 	<div align='right' class='pages'>Страницы:&#160;&#160;<xsl:apply-templates select="ppage|tpage|npage|cpage" mode="objectstree"/></div>
		<br/>
	</xsl:if>
</xsl:template>

<xsl:template match="ppage" mode="objectstree">
	<span class="page">
		<a>
		<xsl:attribute name="href"><xsl:value-of select="@URL"/></xsl:attribute>
		<xsl:value-of select="."/>
		</a>
	</span>
</xsl:template>

<xsl:template match="tpage" mode="objectstree">
	<span class="page">
		<a>
		<xsl:attribute name="href"><xsl:value-of select="@URL"/></xsl:attribute>
		<xsl:value-of select="."/>
		</a>
	</span>
</xsl:template>

<xsl:template match="npage" mode="objectstree">
	<span class="page">
		<a>
        	<xsl:attribute name="href"><xsl:value-of select="@URL"/></xsl:attribute>
		<xsl:value-of select="."/>
		</a>
	</span>
</xsl:template>

<xsl:template match="cpage" mode="objectstree">
        <span class="selected"><xsl:value-of select="."/></span>
</xsl:template>

</xsl:stylesheet>
