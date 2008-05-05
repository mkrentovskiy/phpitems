<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="task" mode="objectstree">
	<div id="list">
	<xsl:if test="count(item) > 0">
		<h2 id="task" onClick="showHide('task')">Задачи</h2>

		<div class="list" id="tasklistitem">
			<xsl:apply-templates select="item" mode="link"/>
		</div>          
	</xsl:if>
	</div>      				
</xsl:template>

<xsl:template match="task" mode="ajax">
	<xsl:apply-templates select="task" mode="objectstree"/>
</xsl:template>

<xsl:template match="linkitem" mode="ajax">
	<xsl:apply-templates select="item" mode="link"/>	
</xsl:template>

<xsl:template match="task" mode="path">
	<tr><td class="toplevels">
		<xsl:apply-templates select="item" mode="link"/>
	</td></tr>
</xsl:template>

<xsl:template match="item" mode="link">
        <xsl:variable name="id"><xsl:value-of select="id"/></xsl:variable>
		<xsl:variable name="type"><xsl:value-of select="type"/></xsl:variable>
				
				<div class="taskitem">
				        <xsl:attribute name="id">i<xsl:value-of select="oid"/></xsl:attribute>
			        	<xsl:attribute name="onDblClick">getControlForm(<xsl:value-of select="oid"/>);</xsl:attribute>

					<xsl:attribute name="style">background-color: #<xsl:value-of select="color" disable-output-escaping="yes"/></xsl:attribute>
					<a>
						<xsl:attribute name="href">?usecase=ShowObjectsTree&amp;id=<xsl:value-of select="oid" disable-output-escaping="yes"/></xsl:attribute>
						<xsl:value-of select="name" disable-output-escaping="yes"/></a>
					<div class="taskinfo"><xsl:value-of select="tb" disable-output-escaping="yes"/></div>
				</div>
</xsl:template>

</xsl:stylesheet>
