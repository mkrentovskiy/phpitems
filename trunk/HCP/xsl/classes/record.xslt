<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="record" mode="objectstree">
	<div id="recordlist">
	<xsl:if test="count(item) > 0">
		<h2 id="record" onClick="showHide('record')">Аудио-записи</h2>

		<div class="list" id="recordlistitem">
		        <xsl:apply-templates select="item" mode="record"/>
		</div>          
	</xsl:if>
	</div>      				
</xsl:template>

<xsl:template match="record" mode="ajax">
	<xsl:apply-templates select="record" mode="objectstree"/>
</xsl:template>

<xsl:template match="recorditem" mode="ajax">
	<xsl:apply-templates select="item" mode="record"/>	
</xsl:template>

<xsl:template match="record" mode="path">
	<tr><td class="toplevels">
		 <xsl:apply-templates select="item" mode="record"/>
	</td></tr>
</xsl:template>

<xsl:template match="record" mode="control">
        <xsl:for-each select="item">			
		<xsl:variable name="id"><xsl:value-of select="id"/></xsl:variable>

		<table botder="0" cellpadding="0" cellspacing="14" width='100%'>
		<tr>
			<td valign="top">
				<img align="absmiddle" src="i/i_recorditem.png"/>
			</td>
			<td width='100%' valign="top">
					<b>
					<xsl:value-of select="title" disable-output-escaping="yes"/>
					</b><br/>
					<xsl:if test="string-length(comment) > 0">
							<xsl:value-of select="comment" disable-output-escaping="yes"/>
					<br/>
					</xsl:if>
					<a class="text" target="_blank">
						<xsl:attribute name="href"><xsl:value-of select="filename" disable-output-escaping="yes"/></xsl:attribute>
    		                        	<xsl:value-of select="filename" disable-output-escaping="yes"/>
					</a>						
					
			</td>
		</tr>	
		</table>	
	</xsl:for-each>
</xsl:template>

<xsl:template match="item" mode="record">
			<xsl:variable name="id"><xsl:value-of select="id"/></xsl:variable>
		    <xsl:variable name="type"><xsl:value-of select="type"/></xsl:variable>
				
				<div class="record">
				        <xsl:attribute name="id">i<xsl:value-of select="oid"/></xsl:attribute>
				        <xsl:attribute name="onDblClick">getControlForm(<xsl:value-of select="oid"/>);</xsl:attribute>
					<a>
						<xsl:attribute name="href">?usecase=ShowObjectsTree&amp;id=<xsl:value-of select="oid" disable-output-escaping="yes"/></xsl:attribute>
						<img align="absmiddle" src="i/i_recorditem.png"/>&#0160;&#0160;<xsl:value-of select="title" disable-output-escaping="yes"/></a>
						
						<div class='recordinfo'>
							<small>
								<xsl:attribute name="id">player<xsl:value-of select="position()"/></xsl:attribute>
								<a href="http://www.macromedia.com/go/getflashplayer">Get the Flash Player</a> to see this player.</small>
							<script type="text/javascript">
							var FO = { movie:"classes/controls/mp3player.swf",
								   	width:"300",
									height:"20",
									majorversion:"7",
									build:"0",
									bgcolor:"#FFFFFF",
									flashvars:"file=<xsl:value-of select="filename" disable-output-escaping="yes"/>&amp;showdigits=true&amp;autostart=false" };
							UFO.create(FO, "player<xsl:value-of select="position()"/>");
							</script>
						</div>
				</div>
</xsl:template>

</xsl:stylesheet>
