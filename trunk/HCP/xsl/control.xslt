<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="control" mode="ajax">
	<div class='cform'>
		<xsl:attribute name="id">cf<xsl:value-of select="id"/></xsl:attribute>
		<div class="controlnavigation">
			<ul class="controlnavigationlist">
				<li><div>
					<xsl:attribute name="id">v_<xsl:value-of select="id"/></xsl:attribute>
					<xsl:attribute name="onClick">controlMenuSelected(<xsl:value-of select="id"/>, 1)</xsl:attribute>
					Просмотр</div></li>
				<li><div class="cnlactive">
					<xsl:attribute name="id">e_<xsl:value-of select="id"/></xsl:attribute>
					<xsl:attribute name="onClick">controlMenuSelected(<xsl:value-of select="id"/>, 2)</xsl:attribute>					
					Редактирование</div></li>
				<li><div>
					<xsl:attribute name="id">o_<xsl:value-of select="id"/></xsl:attribute>
					<xsl:attribute name="onClick">controlMenuSelected(<xsl:value-of select="id"/>, 3)</xsl:attribute>
					Операции</div></li>
				<li><div>
					<xsl:attribute name="id">c_<xsl:value-of select="id"/></xsl:attribute>
					<xsl:attribute name="onClick">controlMenuSelected(<xsl:value-of select="id"/>, 4)</xsl:attribute>
					_</div></li>
			</ul>
		</div>

		<!-- Object -->
		<div style='display: none;' class='controlbody'>	
			<xsl:attribute name="id">l-<xsl:value-of select="id"/>-1</xsl:attribute>					
			<xsl:apply-templates select="address|bill|phone|project|person|company|folder|file|image|record|note|task" mode="control"/>			
		</div>

		<!-- Edit form -->
		<div class='controlbody'>
			<xsl:attribute name="id">l-<xsl:value-of select="id"/>-2</xsl:attribute>					
			<form onSubmit="commitItem(this.form, {id}); return false;" enctype="multipart/form-data" method="POST" id="_form_{id}">
			<input type="hidden" name="MAX_FILE_SIZE" value="104857600" />
			<input type="hidden" name="_oid" value='{id}'/>
			<input type="hidden" name="_class" value='{class}'/>
			<table border="0" cellpadding="0" cellspacing="4" width="100%" align="center">
				<xsl:for-each select="form">
					<xsl:apply-templates select="slider|bool|filebox|textbox|selector|editor|variants|calendar|memorybox|notebox" mode="form"/>
				</xsl:for-each>
				<tr>
				<td align="right" width="100%">
					<br/>
					<img src="i/spacer.gif" width="16" alt="" id="cui-{id}-loader"/>
				</td>
				<td>
					<br/>
					<input class="silver" type="button" value=" Исправить " id="cui-{id}-button" onClick="commitItem(this.form, {id});"/>
				</td>
				</tr>			
			</table>
			</form>	
		</div>

		<!-- Operations -->
		<div style='display: none;' class='controlbody'>
			<xsl:attribute name="id">l-<xsl:value-of select="id"/>-3</xsl:attribute>					

			<div class="objectinfo">
				<b>Версия №<xsl:value-of select="version"/></b><br/>
				создана <xsl:value-of select="tb"/> пользователем <xsl:value-of select="user"/> 
			</div>
			
			<div class="objectcopy">
				Скопировать в <br/>
				<select size='1' id='cui-{id}-sel' style='width: 100%;' onChange="copyItem({id}, this);">
					<option value='0'>...Выберите объект</option>
					<xsl:apply-templates select="info/tree/node" mode="control"/>	
				</select><br/>
				<div id='cui-{id}-cc' style='display: none;'><small>Копирование произведено. Обновите другие панели для редактирования.</small></div>				
			</div>
			
			<div class="objectdelete">
				<input type='button' class='silver' value='Удалить' onClick="deleteItem({id});"/>
				<input type='checkbox' id='cd-{id}'/><span class='confirmdelete' id='cdi-{id}'><label for='cd-{id}'> Да, я подтверждаю данное действие</label></span> 				
			</div>
		</div>
	</div>
</xsl:template>

<xsl:template match="node" mode='control'>
    <xsl:param name="pref"></xsl:param>

	<option value='{@oid}' cl='{@class}'>
		<xsl:value-of select="$pref"/>
		<xsl:if test="position() != last()">&#9500;</xsl:if>
		<xsl:if test="position() = last()">&#9492;</xsl:if>
		&#0160;<xsl:value-of select="title" disable-output-escaping="yes"/>
	</option>	

	<xsl:if test="count(childs/node) > 0">
		<xsl:if test="position() != last()">
			<xsl:apply-templates select='childs' mode='control'>
				<xsl:with-param name="pref"><xsl:value-of select="$pref"/>&#9474;&#0160;&#0160;&#0160;</xsl:with-param>  
			</xsl:apply-templates>
		</xsl:if>
		<xsl:if test="position() = last()">
			<xsl:apply-templates select='childs' mode='control'>
				<xsl:with-param name="pref"><xsl:value-of select="$pref"/>&#0160;&#0160;&#0160;&#0160;</xsl:with-param>  
			</xsl:apply-templates>
		</xsl:if>
	</xsl:if>
</xsl:template>

<xsl:template match="childs" mode='control'>
     	<xsl:param name="pref"/>
	<xsl:apply-templates select='node' mode='control'>
		<xsl:with-param name="pref"><xsl:value-of select="$pref"/></xsl:with-param>  
	</xsl:apply-templates>
</xsl:template>

<xsl:template match="tree" mode='ajax'>
	<option value='0'>...Выберите объект</option>
	<xsl:apply-templates select="node" mode="control"/>
</xsl:template>

</xsl:stylesheet>
