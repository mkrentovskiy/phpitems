<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="task" mode="objectstree">
	<div id="tasklist">
	<xsl:if test="count(item) > 0">
		<h2 id="task" onClick="showHide('task')">Задачи</h2>

		<div class="list" id="tasklistitem">
			<xsl:apply-templates select="item" mode="task"/>
		</div>          
	</xsl:if>
	</div>      				
</xsl:template>

<xsl:template match="tasks" mode="ajax">
	<xsl:apply-templates select="task" mode="objectstree"/>
</xsl:template>

<xsl:template match="taskitem" mode="ajax">
	<xsl:apply-templates select="item" mode="task"/>	
</xsl:template>

<xsl:template match="task" mode="path">
	<tr><td class="toplevels">
       	<xsl:apply-templates select="item" mode="task"/>
	</td></tr>
</xsl:template>

<xsl:template match="task" mode="control">
        <xsl:for-each select="item">			
		<xsl:variable name="id"><xsl:value-of select="id"/></xsl:variable>
                <xsl:variable name="type"><xsl:value-of select="type"/></xsl:variable>

		<table botder="0" cellpadding="0" cellspacing="14" width='100%'>
		<tr>
			<td valign="top"><img align="absmiddle" valign='top' src='i/i_taskitem.png'/></td>
			<td width='100%' valign="top" class="text">
					Тип - <xsl:value-of select="../types/item[id=$type]/type" disable-output-escaping="yes"/><br/>
					Выполнить до <xsl:value-of select="tdeadline" disable-output-escaping="yes"/><br/>
					Выполнено на <xsl:value-of select="pc" disable-output-escaping="yes"/>%<br/><br/>
					<b><xsl:value-of select="title" disable-output-escaping="yes"/></b><br/>
					<xsl:value-of select="description" disable-output-escaping="yes"/>
			</td>
		</tr>	
		</table>	
	</xsl:for-each>
</xsl:template>

<xsl:template match="item" mode="task">
			<xsl:variable name="id"><xsl:value-of select="id"/></xsl:variable>
		    <xsl:variable name="type"><xsl:value-of select="type"/></xsl:variable>
				
				<div class="task">
				        <xsl:attribute name="id">i<xsl:value-of select="oid"/></xsl:attribute>
			        	<xsl:attribute name="onDblClick">getControlForm(<xsl:value-of select="oid"/>);</xsl:attribute>

					<a>
						<xsl:attribute name="href">?usecase=ShowObjectsTree&amp;id=<xsl:value-of select="oid" disable-output-escaping="yes"/></xsl:attribute>
						<img align="absmiddle" src="i/i_taskitem.png"/>&#0160;&#0160;
						<xsl:value-of select="title" disable-output-escaping="yes"/></a>
					<div class="taskinfo">
						Выполнить до <xsl:value-of select="tdeadline" disable-output-escaping="yes"/> [<xsl:value-of select="../types/item[id=$type]/type" disable-output-escaping="yes"/>]<br/>
						Выполнено на <xsl:value-of select="pc" disable-output-escaping="yes"/>%<br/>
					</div>
				</div>
</xsl:template>

</xsl:stylesheet>
