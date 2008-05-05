<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="project" mode="objectstree">
	<div id="projectlist">
	<xsl:if test="count(item) > 0">
		<h2 id="project" onClick="showHide('project')">Проекты</h2>
			
		<div class="list" id="projectlistitem">
		    <xsl:apply-templates select="item" mode="project"/>	
			<xsl:if test="count(pages/*) > 1">
				<xsl:apply-templates select="pages" mode="objectstree"/>
			</xsl:if>
		</div>          
	</xsl:if>
	</div>      				
</xsl:template>

<xsl:template match="projects" mode="ajax">
	<xsl:apply-templates select="project" mode="objectstree"/>
</xsl:template>

<xsl:template match="projectitem" mode="ajax">
	<xsl:apply-templates select="item" mode="project"/>	
</xsl:template>

<xsl:template match="project" mode="path">
		<tr><td class="toplevels">
				<xsl:apply-templates select="item" mode="project"/>	
		</td></tr>
</xsl:template>

<xsl:template match="project" mode="control">
        <xsl:for-each select="item">			
		<xsl:variable name="id"><xsl:value-of select="id"/></xsl:variable>
	        <xsl:variable name="state"><xsl:value-of select="state"/></xsl:variable>
        	<xsl:variable name="type"><xsl:value-of select="type"/></xsl:variable>

		<table botder="0" cellpadding="0" cellspacing="14" width='100%'>
		<tr>
			<td valign="top" class='small'>
				<img align="absmiddle">
					<xsl:attribute name="src">i/i_projectinfo_<xsl:value-of select="../types/item[id=$type]/img"/>.png</xsl:attribute>
				</img><br/>
				<xsl:value-of select="../types/item[id=$type]/type"/>
			</td>
			<td width='100%' valign="top" class='text'>
				<b><xsl:value-of select="title" disable-output-escaping="yes"/></b><br/>
				Дата начала <xsl:value-of select="tm" disable-output-escaping="yes"/> [Длится  <xsl:value-of select="tmlong" disable-output-escaping="yes"/> дней]<br/>
				Состояние: <xsl:value-of select="../states/item[id=$state]/state" disable-output-escaping="yes"/><br/>
				<xsl:value-of select="description" disable-output-escaping="yes"/>				

			</td>
		</tr>	
		</table>	
	</xsl:for-each>
</xsl:template>

<xsl:template match="item" mode="project">
	            <xsl:variable name="id"><xsl:value-of select="id"/></xsl:variable>
		        <xsl:variable name="state"><xsl:value-of select="state"/></xsl:variable>
		        <xsl:variable name="type"><xsl:value-of select="type"/></xsl:variable>
				
				<div class="projectinfo">
				        <xsl:attribute name="id">i<xsl:value-of select="oid"/></xsl:attribute>
				        <xsl:attribute name="onDblClick">getControlForm(<xsl:value-of select="oid"/>);</xsl:attribute>
					<a>
						<xsl:attribute name="href">?usecase=ShowObjectsTree&amp;id=<xsl:value-of select="oid" disable-output-escaping="yes"/></xsl:attribute>
					<img align="absmiddle">
						<xsl:attribute name="src">i/i_projectinfo_<xsl:value-of select="../types/item[id=$type]/img"/>.png</xsl:attribute>
					</img></a>&#0160;&#0160;<a>
						<xsl:attribute name="href">?usecase=ShowObjectsTree&amp;id=<xsl:value-of select="oid" disable-output-escaping="yes"/></xsl:attribute>
						<xsl:value-of select="title" disable-output-escaping="yes"/></a>
					<div class="projectdate">
						Дата начала <xsl:value-of select="tm" disable-output-escaping="yes"/> [Длится  <xsl:value-of select="tmlong" disable-output-escaping="yes"/> дней]
					</div>
					<ul class="projectstate" id='prs{id}'>
						<xsl:for-each select="../states/item">
							<li>
								<xsl:if test="not(id=$state)">							        		
									<xsl:attribute name="onClick">setProjectState(<xsl:value-of select="$id"/>, <xsl:value-of select="id"/>);</xsl:attribute>
								</xsl:if>
								<xsl:if test="id=$state">							        		
									<xsl:attribute name="class">selected</xsl:attribute>
								</xsl:if>
								<xsl:value-of select="state" disable-output-escaping="yes"/>
							</li>
						</xsl:for-each>
					</ul>
				</div>
</xsl:template>

<xsl:template match="projectstate" mode="ajax">
	<xsl:for-each select='project/item'>
		<xsl:variable name="id"><xsl:value-of select="id"/></xsl:variable>
	    <xsl:variable name="state"><xsl:value-of select="state"/></xsl:variable>
	
		<xsl:for-each select="../states/item">	        
			<li>
				<xsl:if test="not(id=$state)">							        		
					<xsl:attribute name="onClick">setProjectState(<xsl:value-of select="$id"/>, <xsl:value-of select="id"/>);</xsl:attribute>
				</xsl:if>
				<xsl:if test="id=$state">							        		
					<xsl:attribute name="class">selected</xsl:attribute>
				</xsl:if>
					<xsl:value-of select="state" disable-output-escaping="yes"/>
			</li>
		</xsl:for-each>
	</xsl:for-each>
</xsl:template>
	
</xsl:stylesheet>
