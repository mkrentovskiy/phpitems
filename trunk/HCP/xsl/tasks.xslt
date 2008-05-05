<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="taskpanel">
		<div id='taskpanelitem'>		
			<h3 id="calendar">Cобытия</h3>
			<xsl:if test="@id = '1'">
				<small>по подготовке документов</small>		
			</xsl:if>
			<br/>
			<br/>
			
			<xsl:if test="count(dcalendarlost/item)">
				<h4 class='lost'>Пропущеные задания</h4>
				<xsl:apply-templates select="dcalendarlost/item" mode="scalendar"/>
			</xsl:if>

			<h4>Ближайшая неделя</h4>
			<xsl:choose>
				<xsl:when test="count(dcalendar/item) = 0">
					<div align='center' style='padding: 20px;'><small>Нет событий по выставлению документов</small></div>
				</xsl:when>
				<xsl:otherwise>
					<xsl:apply-templates select="dcalendar/item" mode="scalendar"/>
				</xsl:otherwise>
			</xsl:choose>
		</div>
</xsl:template>

<xsl:template match="item" mode="scalendar">
		<div class='schtask'>
			<xsl:choose>
				<xsl:when test="is_done = '2'">
					<div class='dateitem'><xsl:value-of select="tm" disable-output-escaping="yes"/></div>
					<div class='tdeleted'><xsl:value-of select="task" disable-output-escaping="yes"/></div>									
				</xsl:when>
				<xsl:when test="is_done = '1'">
					<div class='dateitem'><xsl:value-of select="tm" disable-output-escaping="yes"/></div>
					<div class='tdone'><xsl:value-of select="task" disable-output-escaping="yes"/></div>									
				</xsl:when>
				<xsl:when test="string-length(is_this_user) and is_this_user = '0'">
					<div class='dateitem'><xsl:value-of select="tm" disable-output-escaping="yes"/></div>
					<div class='tanother'><xsl:value-of select="task" disable-output-escaping="yes"/></div>									
				</xsl:when>
				<xsl:otherwise>
					<div class='dateitem'><xsl:value-of select="tm" disable-output-escaping="yes"/></div>
					<a href='?usecase=ExecuteTaskItem&amp;id={id}' class='sch'><xsl:value-of select="task" disable-output-escaping="yes"/></a>
					<xsl:if test="string-length(comment) > 1">
						<br/><small><xsl:value-of select="comment" disable-output-escaping="yes"/></small><br/>
					</xsl:if>
					<div align='right'><img src='i/i_calendar_move.png' alt='Перенести' title='Перенести' onClick="moveTask({id});" style="cursor: pointer;"/>
						&#0160;<img src='i/i_calendar_remove.png' alt='Удалить' title='Удалить' onClick="removeTask({id});" style="cursor: pointer;"/></div>
					<div id='_move_{id}' class='movepanel' style='display: none;'>
						<form  onSubmit="moveTaskTo(this.form, {id}); return false;" method="GET">
							<table border="0" cellpadding="0" cellspacing="4" width="100%" align="center">
							<tr>
							<td width='100%'>
							Перенести на<br/>
								<input type="text" size="11" maxlength="10" style='background-color: #f9f9f9;'>
									<xsl:attribute name="id">mt_<xsl:value-of select="id"/></xsl:attribute>
									<xsl:attribute name="name">f_moveto</xsl:attribute>
									<xsl:attribute name="pattern">([0-9]{2}).([0-9]{2}).([0-9]{4})</xsl:attribute>
									<xsl:attribute name="notice">Это когда?</xsl:attribute>
									<xsl:attribute name="mustbe">1</xsl:attribute>
								</input>		
								<img src="i/i_c.png" align="absmiddle">
									<xsl:attribute name="onClick">return showCalendar('mt_<xsl:value-of select="id"/>', 'dd.mm.y');</xsl:attribute>
								</img> 
							</td>
							<td align='right'>
								<input type='button' class='silver' value='Перенести' onClick="moveTaskTo(this.form, {id});"/>
							</td>
							</tr>
							</table>
						</form>
					</div>
				</xsl:otherwise>
			</xsl:choose>
		</div>
</xsl:template>

<xsl:template match="scheduler" mode="ajax">
	<xsl:apply-templates select="taskpanel"/>
</xsl:template>


</xsl:stylesheet>
