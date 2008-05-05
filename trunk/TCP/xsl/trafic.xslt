<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="controlpanel" mode="trafic">
		<table border='0' width='100%' cellpadding='0' cellspacing='0'>
		<tr>
		<td width='50%' valign='top'>
			<h2>Сколько скачали?</h2>
			<form action='index.php' method='POST'>
				<input type='hidden' name='usecase' value='ShowTraficReport'/>
				<table  border='0' cellpadding='0' cellspacing='12'>
				<tr><td>
					Начиная с<br/>
					<input type='text' id='i_f_dfrom' name='f_dfrom' size='12' maxlength='10' mustbe='1' pattern='[0-9]*\.[0-9]*\.[0-9]*' notice='Поле должно быть заполнено' value="{fdate}"/>
					<img align='absmiddle' src='i/i_calendar.gif' width='16' height='16' style='cursor: pointer;' onClick="return showCalendar('i_f_dfrom', 'dd.mm.y');"/>
				</td><td>
					заканчивая<br/>
					<input type='text' id='i_f_dto' name='f_dto' size='12' maxlength='10' mustbe='1' pattern='[0-9]*\.[0-9]*\.[0-9]*' notice='Поле должно быть заполнено' value="{tdate}"/>
					<img align='absmiddle' src='i/i_calendar.gif' width='16' height='16' style='cursor: pointer;' onClick="return showCalendar('i_f_dto', 'dd.mm.y');"/>
				</td></tr>
				<tr><td colspan='2' align='center'>
					<small>все даты - включительно</small><br/>
				</td></tr>
				<tr>
				<td>
				только для <br/> 
				<select name='f_groups[]' size='3' multiple='1'>
					<xsl:for-each select='aliases/group'>
						<option value='{id}' selected='1'><xsl:value-of select="name"/></option>
					</xsl:for-each>
				</select>
				</td><td>
					<input type='checkbox' name='f_perday' id='i_f_days' class='plain'/><label for='i_f_days'>разбить по дням</label>
					<br/><br/><input type='submit' value='Посмотреть отчет' class='silver'/>				
				</td></tr>
				</table>	
			</form>	
		</td>
		<td width='50%' valign='top'>
			<h2>Куда ходили?</h2>
			<form action='index.php' method='POST'>
				<input type='hidden' name='usecase' value='ShowLogReport'/>
				<table  border='0' cellpadding='0' cellspacing='12'>
				<tr><td>
					За<br/>
					<input type='text' id='i_f_date' name='f_date' size='12' maxlength='10' mustbe='1' pattern='[0-9]*\.[0-9]*\.[0-9]*' notice='Поле должно быть заполнено' value="{ldate}"/>
					<img align='absmiddle' src='i/i_calendar.gif' width='16' height='16' style='cursor: pointer;' onClick="return showCalendar('i_f_date', 'dd.mm.y');"/>
				</td></tr>
				<tr>
				<td>
				только для <br/> 
				<select name='f_groups[]' size='3' multiple='1'>
					<xsl:for-each select='aliases/group'>
						<option value='{id}' selected='1'><xsl:value-of select="name"/></option>
					</xsl:for-each>
				</select>
				</td></tr>
				<tr>
				<td>
					<input type='submit' value='Посмотреть отчет' class='silver'/>				
				</td></tr>
				</table>	
			</form>	
			
		</td>
		</tr>
		</table>
		<br/><br/>
		<h2>Кто есть кто в сети?</h2>
		<div id='iAliases'>
		<xsl:apply-templates select="aliases" mode="ajax"/>
		</div>
		<br/>
		<div class='addform' align='right'>
			<form id='iAddForm' action='?' onSubmit="return addAlias(this);">
				<small>Название</small>&#0160;
				<input type='text' name='f_name' value='' size='32' maxlength='255' mustbe='1' pattern='string' notice='Поле должно быть заполнено'/>&#0160;&#0160;&#0160;
				<small>IP-адрес</small>&#0160;
				<input type='text' name='f_ip' value='192.168.' size='18' maxlength='16' mustbe='1' pattern='([0-9]+)\.([0-9]+)\.([0-9]+)\.([0-9]+)' notice='Поле должно содержать правильный IP-адрес'/>&#0160;&#0160;&#0160;
				<input type='submit' value='Добавить' class='silver'/>&#0160;<img src='i/spacer.gif' id='addLoading' width='16' height='16'/>
			</form>		
		</div>
		<div style='display: none;' id='_hidden_form_alias'>
			<form id='iEditForm_ip_' action='?' onSubmit="return commitAlias(this);">
				<input type='hidden' name='f_old_ip' value='_ip_'/>
				<small>Название</small><br/>
				<input type='text' name='f_name' value='_name_' style='width: 100%;' maxlength='255' mustbe='1' pattern='string' notice='Поле должно быть заполнено'/><br/>
				<small>IP-адрес</small><br/>
				<input type='text' name='f_ip' value='_ip_' style='width: 100%;' maxlength='16' mustbe='1' pattern='([0-9]+)\.([0-9]+)\.([0-9]+)\.([0-9]+)' notice='Поле должно содержать правильный IP-адрес'/><br/>
				<div align='right' style='padding-top: 8px;'>
					<input type='button' class='silver' style='color: #900;' value='Удалить' onClick="deleteAlias('_ip_');"/>
					<input type='submit' value='Исправить' class='silver'/>
				</div>
			</form>
		</div>
</xsl:template>

<xsl:template match="aliases" mode='ajax'>
			<table border='0' width='100%' cellpadding='0' cellspacing='20'>
			<tr>
				<xsl:for-each select="group">
					<td width='{round(100 div count(../group))}%' valign='top'>
						<xsl:if test="position() != last()"><xsl:attribute name="class">rb </xsl:attribute></xsl:if>
						<h3><xsl:value-of select="name"/></h3>
						<xsl:apply-templates select="list/item" mode="alias"/>
					</td>
				</xsl:for-each>	
			</tr>
			</table>
</xsl:template>

<xsl:template match="item" mode='alias'>
	<div id='i_alias_{ip}' class='aliasitem' ip='{ip}' onClick="editAlias('{ip}');">
		<div class='aliasname' id='i_alias_{ip}_name'><xsl:value-of select="name"/></div>
		<div class='aliasip' id='i_alias_{ip}_ip'><xsl:value-of select="ip"/></div>
	</div>
</xsl:template>


<xsl:template match="report" mode='trafic'>
			<xsl:choose>
				<xsl:when test='@from = @to'>
					<h2>Скачали за <xsl:value-of select="@from"/></h2>				
				</xsl:when>
				<xsl:otherwise>
					<h2>Скачали с <xsl:value-of select="@from"/> по <xsl:value-of select="@to"/> </h2>
				</xsl:otherwise>
			</xsl:choose>
			<div align="right"><a href='index.php'>Панель управления</a></div>
			<table border='0' width='100%' cellpadding='0' cellspacing='20'>
			<tr>
				<xsl:for-each select="group">
					<td width='{round(100 div count(../group))}%' valign='top'>
						<xsl:if test="position() != last()"><xsl:attribute name="class">rb </xsl:attribute></xsl:if>
						<h3><xsl:value-of select="@name"/></h3><br/>
						<table border='0' width='90%' cellpadding='8' cellspacing='0' class="sortable">
						<xsl:if test='not(count(entry) = 0)'>
						<tr>
							<th align="left">Компьютер</th>
							<th align="right" class="sorttable_numeric">Кол-во</th>
						</tr>
						</xsl:if>
						<xsl:if test='count(entry) = 0'>
						<tr><td align='center' class='msg'>Данные по трафику не обнаружены!</td></tr>
						</xsl:if>
						<xsl:for-each select='entry'>
						<tr id='entry_{ip}'>
							<xsl:choose>
								<xsl:when test='position() mod 2 = 1'>
									<xsl:attribute name='class'>fs</xsl:attribute>
									<xsl:attribute name='dclass'>fs</xsl:attribute>
								</xsl:when>
								<xsl:otherwise>
									<xsl:attribute name='class'>ns</xsl:attribute>
									<xsl:attribute name='dclass'>ns</xsl:attribute>
								</xsl:otherwise>
							</xsl:choose>
							<td onMouseOver="select('{ip}');" onMouseOut="unselect('{ip}');" sorttable_customkey="{key}">
							<xsl:choose>
								<xsl:when test='../../@from = ../../@to'>
									<a href='index.php?usecase=ShowTraficReportItem&amp;f_date={../../@from}&amp;f_ip={ip}'><xsl:value-of select="name"/></a>
								</xsl:when>
								<xsl:otherwise>
									<xsl:value-of select="name"/>
								</xsl:otherwise>
							</xsl:choose>
							</td>
							<td onMouseOver="select('{ip}');" onMouseOut="unselect('{ip}');" align='right' sorttable_customkey="{bytes}">
								<xsl:value-of select="value"/>
							</td>
						</tr>
						</xsl:for-each>								
						<xsl:if test='count(entry) > 0'>
						<tfoot>
						<tr>
							<td><b>Итого</b></td>
							<td align='right'><b><xsl:value-of select="total"/></b></td>
						</tr>
						</tfoot>
						</xsl:if>
						</table>
					</td>
				</xsl:for-each>	
			</tr>
			</table>
			<div class='total' align='right'>Итого за весь период - <b><xsl:value-of select="total"/></b><br/><small>все числа - в байтах</small></div>
			<div align="right"><br/><a href='index.php'>Панель управления</a></div>
			<xsl:if test="@perday = '1'">
				<br/><br/>
				<h3>Ежедневные общие затраты трафика на период</h3>
				<br/>
						<table border='0' width='100%' cellpadding='8' cellspacing='0'>
						<xsl:if test='count(perday/entry) = 0'>
						<tr><td align='center' class='msg'>Данные по трафику не обнаружены!</td></tr>
						</xsl:if>
						<xsl:for-each select='perday/entry'>
						<tr id='entry_{day}'>
							<xsl:choose>
								<xsl:when test='position() mod 2 = 1'>
									<xsl:attribute name='class'>fs</xsl:attribute>
									<xsl:attribute name='dclass'>fs</xsl:attribute>
								</xsl:when>
								<xsl:otherwise>
									<xsl:attribute name='class'>ns</xsl:attribute>
									<xsl:attribute name='dclass'>ns</xsl:attribute>
								</xsl:otherwise>
							</xsl:choose>
							<td onMouseOver="select('{day}');" onMouseOut="unselect('{day}');">
									<a href='index.php?usecase=ShowTraficReportItem&amp;f_date={day}'><xsl:value-of select="day"/></a>
							</td>
							<td onMouseOver="select('{day}');" onMouseOut="unselect('{day}');" align='right' >
								<xsl:value-of select="value"/>
							</td>
						</tr>
						</xsl:for-each>								
						</table>
				<div align="right"><br/><a href='index.php'>Панель управления</a></div>
			</xsl:if>
</xsl:template>

<xsl:template match="reportitem" mode='trafic'>
	<xsl:choose>
		<xsl:when test='string-length(host) > 0'>
			<h2>Скачал <xsl:value-of select="host"/> за <xsl:value-of select="date"/></h2>
		</xsl:when>
		<xsl:otherwise>
			<h2>Скачали за <xsl:value-of select="date"/></h2>				
		</xsl:otherwise>
	</xsl:choose>
	<div align="right"><br/><a href='index.php'>Панель управления</a></div>
	<br/>
	<table border='0' width='100%' cellpadding='8' cellspacing='0' class="sortable">
	<xsl:if test='not(count(entry) = 0)'>
	<tr>
		<th align="left">Время</th>
		<th align="left">Адрес</th>
		<th align="left">Компьютер</th>
		<th align="right" class="sorttable_numeric">Кол-во</th>
	</tr>
	</xsl:if>
	<xsl:if test='count(entry) = 0'>
		<tr><td align='center' class='msg'>Данные по трафику не обнаружены!</td></tr>
	</xsl:if>
	<xsl:for-each select='entry'>
		<tr id='entry_{position()}'>
			<xsl:choose>
				<xsl:when test='position() mod 2 = 1'>
					<xsl:attribute name='class'>fs</xsl:attribute>
					<xsl:attribute name='dclass'>fs</xsl:attribute>
				</xsl:when>
				<xsl:otherwise>
					<xsl:attribute name='class'>ns</xsl:attribute>
					<xsl:attribute name='dclass'>ns</xsl:attribute>
				</xsl:otherwise>
			</xsl:choose>
			<td onMouseOver="select('{position()}');" onMouseOut="unselect('{position()}');">
					<xsl:value-of select="tm"/>
			</td>
			<td onMouseOver="select('{position()}');" onMouseOut="unselect('{position()}');" sorttable_customkey="{skey}">
					<xsl:value-of select="shost"/>
			</td>
			<td onMouseOver="select('{position()}');" onMouseOut="unselect('{position()}');" sorttable_customkey="{dkey}">
					<xsl:value-of select="dhost"/>
			</td>
			<td align='right' onMouseOver="select('{position()}');" onMouseOut="unselect('{position()}');" sorttable_customkey="{bytes}">
					<xsl:value-of select="total"/>
			</td>
		</tr>		
	</xsl:for-each>								
	<xsl:if test='count(entry) > 0'>
		<tfoot>
		<tr>
			<td colspan='3'><b>Итого</b></td>
			<td align='right'><b><xsl:value-of select="total"/></b></td>
		</tr>
		</tfoot>
	</xsl:if>
	</table>
	<br/>					
	<div align="right"><br/><a href='index.php'>Панель управления</a></div>		
</xsl:template>

<xsl:template match="log" mode='trafic'>
			<h2>Посещали <xsl:value-of select="@date"/></h2>				
			<div align="right"><a href='index.php'>Панель управления</a></div>
			<br/>
			<xsl:for-each select="group">
				<br/>
				<h3><xsl:value-of select="@name"/></h3><br/>
				<table border='0' width='100%' cellpadding='8' cellspacing='0' class="sortable">
				<xsl:if test='not(count(entry) = 0)'>
					<tr>
						<th align="left">Время</th>
						<th align="left">Компьютер</th>
						<th align="left">Адрес</th>
						<th align="right" class="sorttable_numeric">Кол-во</th>
					</tr>
				</xsl:if>
				<xsl:if test='count(entry) = 0'>
					<tr><td align='center' class='msg'>Данные по посещениям не обнаружены!</td></tr>
				</xsl:if>

				<xsl:for-each select='entry'>
					<tr id='entry_{position()}'>
						<xsl:choose>
							<xsl:when test='position() mod 2 = 1'>
								<xsl:attribute name='class'>fs</xsl:attribute>
								<xsl:attribute name='dclass'>fs</xsl:attribute>
							</xsl:when>
							<xsl:otherwise>
								<xsl:attribute name='class'>ns</xsl:attribute>
								<xsl:attribute name='dclass'>ns</xsl:attribute>
							</xsl:otherwise>
						</xsl:choose>
						<td onMouseOver="select('{position()}');" onMouseOut="unselect('{position()}');">
							<xsl:value-of select="tm"/>
						</td>
						<td onMouseOver="select('{position()}');" onMouseOut="unselect('{position()}');">
							<xsl:value-of select="host"/>
						</td>
						<td onMouseOver="select('{position()}');" onMouseOut="unselect('{position()}');">
							<a href='{link}' target='_blank'><xsl:value-of select="link"/></a>
						</td>
						<td align='right' onMouseOver="select('{position()}');" onMouseOut="unselect('{position()}');" sorttable_customkey="{bytes}">
							<xsl:value-of select="bt"/>
						</td>
					</tr>
				</xsl:for-each>								
				</table>
				</xsl:for-each>	
			<div align="right"><br/><a href='index.php'>Панель управления</a></div>
</xsl:template>

</xsl:stylesheet>
