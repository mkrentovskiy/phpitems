<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="image" mode="objectstree">
	<div id="imagelist">
	<xsl:if test="count(item) > 0">
		<h2 id="image" onClick="showHide('image')">Изображения</h2>

		<div class="list" id="imagelistitem">
			<xsl:apply-templates select="item" mode="image"/>	
		</div>          
	</xsl:if>
	</div>      				
</xsl:template>

<xsl:template match="images" mode="ajax">
	<xsl:apply-templates select="image" mode="objectstree"/>
</xsl:template>

<xsl:template match="imageitem" mode="ajax">
	<xsl:apply-templates select="item" mode="image"/>	
</xsl:template>

<xsl:template match="image" mode="path">
	<tr><td class="toplevels">
		<xsl:apply-templates select="item" mode="image"/>	
	</td></tr>
</xsl:template>

<xsl:template match="image" mode="control">
        <xsl:for-each select="item">			
		<xsl:variable name="id"><xsl:value-of select="id"/></xsl:variable>

		<table botder="0" cellpadding="0" cellspacing="14" width='100%'>
		<tr>
			<td valign="top">
				<img align="absmiddle" src="i/i_imageitem.png"/>
			</td>
			<td width='100%' valign="top">
					<b>
					<xsl:value-of select="title" disable-output-escaping="yes"/>
					</b><br/>
					<xsl:if test="string-length(comment) > 0">
							<xsl:value-of select="comment" disable-output-escaping="yes"/>
					</xsl:if><br/>

					<a class="text" target="_blank">
						<xsl:attribute name="href"><xsl:value-of select="filename" disable-output-escaping="yes"/></xsl:attribute>
    		                        	<xsl:value-of select="filename" disable-output-escaping="yes"/>
					</a><br/>
					
					<xsl:if test="has_preview = '1'">
						<a class="text" rel="lightbox">
							<xsl:attribute name="href"><xsl:value-of select="filename" disable-output-escaping="yes"/></xsl:attribute>
								<img>
									<xsl:attribute name="src"><xsl:value-of select="filename" disable-output-escaping="yes"/>-t.png</xsl:attribute>
								</img>
						</a>
					</xsl:if>
			</td>
		</tr>	
		</table>	
	</xsl:for-each>
</xsl:template>

<xsl:template match="item" mode="image">
			<xsl:variable name="id"><xsl:value-of select="id"/></xsl:variable>
		    <xsl:variable name="type"><xsl:value-of select="type"/></xsl:variable>
				
				<div class="image">
				        <xsl:attribute name="id">i<xsl:value-of select="oid"/></xsl:attribute>
				        <xsl:attribute name="onDblClick">getControlForm(<xsl:value-of select="oid"/>);</xsl:attribute>
					<a>
						<xsl:attribute name="href">?usecase=ShowObjectsTree&amp;id=<xsl:value-of select="oid" disable-output-escaping="yes"/></xsl:attribute>
						<img align="absmiddle" src="i/i_imageitem.png"/>&#0160;&#0160;<xsl:value-of select="title" disable-output-escaping="yes"/></a>

						<div class='imageinfo'>
							<xsl:if test="has_preview = '1'">
								<a class="text" rel="lightbox">
									<xsl:attribute name="href"><xsl:value-of select="filename" disable-output-escaping="yes"/></xsl:attribute>
									<img>
										<xsl:attribute name="src"><xsl:value-of select="filename" disable-output-escaping="yes"/>-t.png</xsl:attribute>
									</img>
								</a>
							</xsl:if>
							<xsl:if test="has_preview = '0'">
								<a class="text" target="_blank">
									<xsl:attribute name="href"><xsl:value-of select="filename" disable-output-escaping="yes"/></xsl:attribute>
        			                                        <xsl:value-of select="filename" disable-output-escaping="yes"/>
								</a>
							</xsl:if>
						</div>
				</div>
</xsl:template>


</xsl:stylesheet>
