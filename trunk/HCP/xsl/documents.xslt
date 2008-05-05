<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="documents">
	<table border="0" cellpadding="6" cellspacing="0" width="100%">
	<tr>
	<td width='64%' valign="top" style="padding-right: 15px;">
		<div id='adddocument'>
			<h3 id="add">Добавить</h3>
			<form id="documentAddForm" onSubmit="addDocument(this.form); return false;" method="GET">
			<table border="0" cellpadding="0" cellspacing="4" width="100%" align="center">
				<xsl:apply-templates select="slider|bool|filebox|textbox|selector|editor|variants|calendar|memorybox|notebox|linker" mode="form"/>
				<tr>
				<td colspan='2' id='adSF'>
					
				</td>
				</tr>
				<tr>
				<td align="right" width="100%">
					<br/>
					<img src="i/spacer.gif" width="16" alt="" id="adi_loader"/>
				</td>
				<td>
					<br/>
					<input class="silver" type="button" value=" Добавить " id="adi_button" onClick="addDocument(this.form);"/>
				</td>
				</tr>			
			</table>
			</form>	
		</div>
		<div id='showdocuments'>
			<h3 id="view">Посмотреть и поискать</h3>
			<div class='doclist'>
				<h4>За прошлые сутки</h4>
			</div>
			<div class='doclist'>
				<h4>За прошлую неделю</h4>
				
			</div>
			
			<h4>Выбрать</h4>
			<form id="documentSelectForm" onSubmit="selectDocument(this.form); return false;" method="GET">
			<table border="0" cellpadding="0" cellspacing="4" width="100%" align="center">
			</table>
			</form>	
		</div>
	</td>
	<td width='36%' valign="top" id="schtd">
		<xsl:apply-templates select="taskpanel"/>
	</td>
	</tr>
	</table>
</xsl:template>


</xsl:stylesheet>
