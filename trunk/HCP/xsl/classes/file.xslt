<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="file" mode="objectstree">
	<div id="filelist">
	<xsl:if test="count(item) > 0">
		<h2 id="file" onClick="showHide('file')">Файлы</h2>

		<div class="list" id="filelistitem">
		    <xsl:apply-templates select="item" mode="file"/>
		</div>          
	</xsl:if>
	</div>      				
</xsl:template>

<xsl:template match="files" mode="ajax">
	<xsl:apply-templates select="file" mode="objectstree"/>
</xsl:template>

<xsl:template match="fileitem" mode="ajax">
	<xsl:apply-templates select="item" mode="file"/>	
</xsl:template>

<xsl:template match="file" mode="path">
	<tr><td class="toplevels">
		   <xsl:apply-templates select="item" mode="file"/>
	</td></tr>
</xsl:template>

<xsl:template match="file" mode="control">
        <xsl:for-each select="item">			
		<xsl:variable name="id"><xsl:value-of select="id"/></xsl:variable>

		<table botder="0" cellpadding="0" cellspacing="14" width='100%'>
		<tr>
			<td valign="top">
				<img align="absmiddle">
						<xsl:attribute name="src">	
							<xsl:choose>
								<xsl:when test="type = 'c'">i/i_file_c.png</xsl:when>
								<xsl:when test="type = 'cpp'">i/i_file_cpp.png</xsl:when>
								<xsl:when test="type = 'cs'">i/i_file_cs.png</xsl:when>
								<xsl:when test="type = 'doc'">i/i_file_doc.png</xsl:when>
								<xsl:when test="type = 'h'">i/i_file_h.png</xsl:when>
								<xsl:when test="type = 'mdb'">i/i_file_mdb.png</xsl:when>
								<xsl:when test="type = 'pdf'">i/i_file_pdf.png</xsl:when>
								<xsl:when test="type = 'php'">i/i_file_php.png</xsl:when>
								<xsl:when test="type = 'ptp'">i/i_file_ptp.png</xsl:when>
								<xsl:when test="type = 'rar'">i/i_file_rar.png</xsl:when>
								<xsl:when test="type = 'swf'">i/i_file_swf.png</xsl:when>
								<xsl:when test="type = 'tgz'">i/i_file_tgz.png</xsl:when>
								<xsl:when test="type = 'txt'">i/i_file_txt.png</xsl:when>
								<xsl:when test="type = 'xls'">i/i_file_xls.png</xsl:when>
								<xsl:when test="type = 'xml'">i/i_file_xml.png</xsl:when>
								<xsl:when test="type = 'zip'">i/i_file_zip.png</xsl:when>
								<xsl:otherwise>i/i_file_unc.png</xsl:otherwise>
							</xsl:choose>
						</xsl:attribute>
				</img>
			</td>
			<td width='100%' valign="top">
					<b>
					<xsl:value-of select="title" disable-output-escaping="yes"/>
					</b><br/>
					<a class="text" target="_blank">
						<xsl:attribute name="href"><xsl:value-of select="filename" disable-output-escaping="yes"/></xsl:attribute>
    		                        	<xsl:value-of select="filename" disable-output-escaping="yes"/>
					</a><br/>
					<xsl:if test="string-length(comment) > 0">
							<xsl:value-of select="comment" disable-output-escaping="yes"/>
					</xsl:if>
			</td>
		</tr>	
		</table>	
	</xsl:for-each>
</xsl:template>

<xsl:template match="item" mode="file">
     <xsl:variable name="id"><xsl:value-of select="id"/></xsl:variable>			
				<div class="file">
				        <xsl:attribute name="id">i<xsl:value-of select="oid"/></xsl:attribute>
				        <xsl:attribute name="onDblClick">getControlForm(<xsl:value-of select="oid"/>);</xsl:attribute>

					<img align="absmiddle">
						<xsl:attribute name="src">	
							<xsl:choose>
								<xsl:when test="type = 'c'">i/i_file_c.png</xsl:when>
								<xsl:when test="type = 'cpp'">i/i_file_cpp.png</xsl:when>
								<xsl:when test="type = 'cs'">i/i_file_cs.png</xsl:when>
								<xsl:when test="type = 'doc'">i/i_file_doc.png</xsl:when>
								<xsl:when test="type = 'h'">i/i_file_h.png</xsl:when>
								<xsl:when test="type = 'mdb'">i/i_file_mdb.png</xsl:when>
								<xsl:when test="type = 'pdf'">i/i_file_pdf.png</xsl:when>
								<xsl:when test="type = 'php'">i/i_file_php.png</xsl:when>
								<xsl:when test="type = 'ptp'">i/i_file_ptp.png</xsl:when>
								<xsl:when test="type = 'rar'">i/i_file_rar.png</xsl:when>
								<xsl:when test="type = 'swf'">i/i_file_swf.png</xsl:when>
								<xsl:when test="type = 'tgz'">i/i_file_tgz.png</xsl:when>
								<xsl:when test="type = 'txt'">i/i_file_txt.png</xsl:when>
								<xsl:when test="type = 'xls'">i/i_file_xls.png</xsl:when>
								<xsl:when test="type = 'xml'">i/i_file_xml.png</xsl:when>
								<xsl:when test="type = 'zip'">i/i_file_zip.png</xsl:when>
								<xsl:otherwise>i/i_file_unc.png</xsl:otherwise>
							</xsl:choose>
						</xsl:attribute>
					</img>&#0160;&#0160;<a>
						<xsl:attribute name="href">?usecase=ShowObjectsTree&amp;id=<xsl:value-of select="oid" disable-output-escaping="yes"/></xsl:attribute>
						<xsl:value-of select="title" disable-output-escaping="yes"/></a>
						<div class='fileinfo'>
							<a class="text" target="_blank">
								<xsl:attribute name="href"><xsl:value-of select="filename" disable-output-escaping="yes"/></xsl:attribute>
        		                                        <xsl:value-of select="filename" disable-output-escaping="yes"/>
							</a>
						</div>
				</div>
</xsl:template>

</xsl:stylesheet>
