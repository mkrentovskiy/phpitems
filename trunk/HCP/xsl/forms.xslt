<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="form" mode="ajax">
		<form id="classAddForm" onSubmit="addObject(this.form); return false;" enctype="multipart/form-data" method="POST">
		<input type="hidden" name="MAX_FILE_SIZE" value="104857600" />
		<table border="0" cellpadding="0" cellspacing="4" width="100%" align="center">
			<xsl:apply-templates select="slider|bool|filebox|textbox|selector|editor|variants|calendar|memorybox|notebox" mode="form"/>
			<tr>
			<td align="right" width="100%">
				<br/>
				<img src="i/spacer.gif" width="16" alt="" id="afi_loader"/>
			</td>
			<td>
				<br/>
				<input class="silver" type="button" value=" Добавить " id="afi_button" onClick="addObject(this.form);"/>
			</td>
			</tr>			
		</table>
		</form>	
</xsl:template>

<xsl:template match="textbox" mode="form">
	<xsl:variable name="name"><xsl:value-of select="@name"/></xsl:variable>
	<xsl:variable name="class"><xsl:value-of select="../../class"/></xsl:variable>
	<xsl:variable name="value"><xsl:value-of select="../../*[name()=$class]/item/*[name()=$name]"/></xsl:variable>
	<tr>
	<td colspan="2">
	        <xsl:if test="@mustbe = '1'"><b><xsl:value-of select="@title" disable-output-escaping="yes"/></b></xsl:if>
	        <xsl:if test="@mustbe = '0'"><xsl:value-of select="@title" disable-output-escaping="yes"/></xsl:if>
	</td>
	</tr>
	<tr>
	<td colspan="2">
		<input type="text" size="30" style="width: 100%;">
			<xsl:attribute name="id">i_<xsl:value-of select="@name"/><xsl:value-of select="../../id"/></xsl:attribute>
			<xsl:attribute name="name">f_<xsl:value-of select="@name"/></xsl:attribute>
			<xsl:attribute name="pattern"><xsl:value-of select="@pattern"/></xsl:attribute>
			<xsl:attribute name="notice"><xsl:value-of select="@notice"/></xsl:attribute>
			<xsl:attribute name="mustbe"><xsl:value-of select="@mustbe"/></xsl:attribute>
			<xsl:attribute name="maxlength"><xsl:value-of select="@max"/></xsl:attribute>
			<xsl:attribute name="value"><xsl:value-of select="$value"/></xsl:attribute>
		</input>
	</td>
	</tr>
</xsl:template>

<xsl:template match="filebox" mode="form">
	<tr>
	<td colspan="2">
	        <xsl:if test="@mustbe = '1'"><b><xsl:value-of select="@title" disable-output-escaping="yes"/></b></xsl:if>
	        <xsl:if test="@mustbe = '0'"><xsl:value-of select="@title" disable-output-escaping="yes"/></xsl:if>
	</td>
	</tr>
	<tr>
	<td colspan="2">
		<iframe style="width: 100%; border: 0px; height: 30px; overflow: hidden;" scrolling="no">
			<xsl:attribute name="id">i_frame_<xsl:value-of select="@name"/><xsl:value-of select="../../id"/></xsl:attribute>
			<xsl:attribute name="src">?usecase=uploadFile&amp;name=<xsl:value-of select="@name"/>&amp;target=<xsl:value-of select="@target"/>&amp;id=<xsl:value-of select="../../id"/></xsl:attribute>	
		</iframe>
	</td>
	</tr>
</xsl:template>

<xsl:template match="file" mode="iframe">
	<form action='index.php' enctype="multipart/form-data" method="POST">
		<xsl:attribute name="name"><xsl:value-of select="name"/>_form</xsl:attribute>
		<input type="hidden" name="usecase" value="UploadFile" />
		<input type="hidden" name="MAX_FILE_SIZE" value="104857600" />
		<input type="hidden" name="target" value='{target}'/>
		<input type="hidden" name="id" value='{id}'/>
		<input type="file" size="30">
			<xsl:attribute name="id">i_<xsl:value-of select="name"/><xsl:value-of select="../../id"/></xsl:attribute>
			<xsl:attribute name="name">f_<xsl:value-of select="name"/><xsl:value-of select="../../id"/></xsl:attribute>
		</input>
		</form>
</xsl:template>

<xsl:template match="uploadedfile" mode="iframe">
	<script language="JavaScript">
		var uFiles = Array();
		var i = 0;
	</script>
	<xsl:for-each select="*">
		<script language="JavaScript">
			uFiles[i] = Array();
			uFiles[i][0] = '<xsl:value-of select="name()"/>';
			uFiles[i++][1] = '<xsl:value-of select="."/>';
		</script>

		<a target='_blank' class='text'>
			<xsl:attribute name="href">/<xsl:value-of select="."/></xsl:attribute>
			<xsl:value-of select="."/>
		</a>&#0160; <small>[<xsl:value-of select="@size"/>]</small><br/>
	</xsl:for-each>
	<script language="JavaScript">
		<xsl:choose>
			<xsl:when test="@id = '0'">
				top.fileTransferCallback(uFiles);
			</xsl:when>
			<xsl:otherwise>
				top.fileTransferCommitCallback(uFiles, <xsl:value-of select="@id"/>);
			</xsl:otherwise>
		</xsl:choose>
	</script>
</xsl:template>

<xsl:template match="bool" mode="form">
	<xsl:variable name="name"><xsl:value-of select="@fname"/></xsl:variable>
	<xsl:variable name="class"><xsl:value-of select="../../class"/></xsl:variable>
	<xsl:variable name="value"><xsl:value-of select="../../*[name()=$class]/item/*[name()=$name]"/></xsl:variable>
	<tr>
	<td>
		<label>
			<xsl:attribute name="for">i_<xsl:value-of select="@name"/></xsl:attribute>
			        <xsl:if test="@mustbe = '1'"><b><xsl:value-of select="@title" disable-output-escaping="yes"/></b></xsl:if>
			        <xsl:if test="@mustbe = '0'"><xsl:value-of select="@title" disable-output-escaping="yes"/></xsl:if>
		</label>
	</td>
	<td>
		<input type="checkbox">
			<xsl:attribute name="id">i_<xsl:value-of select="@name"/><xsl:value-of select="../../id"/></xsl:attribute>
			<xsl:attribute name="name">f_<xsl:value-of select="@name"/></xsl:attribute>
			<xsl:if test="$value = '1'">
				<xsl:attribute name="checked">1</xsl:attribute>
			</xsl:if>
		</input>
 	</td>
	</tr>
</xsl:template>


<xsl:template match="selector" mode="form">
	<xsl:variable name='source' select='@source'/>
	<xsl:variable name='field' select='@field'/>
	<xsl:variable name="name"><xsl:value-of select="@name"/></xsl:variable>
	<xsl:variable name="class"><xsl:value-of select="../../class"/></xsl:variable>
	<xsl:variable name="value"><xsl:value-of select="../../*[name()=$class]/item/*[name()=$name]"/></xsl:variable>
	<tr>
	<td colspan="2">
	        <xsl:if test="@mustbe = '1'"><b><xsl:value-of select="@title" disable-output-escaping="yes"/></b></xsl:if>
	        <xsl:if test="@mustbe = '0'"><xsl:value-of select="@title" disable-output-escaping="yes"/></xsl:if>
	</td>
	</tr>
	<tr>
	<td colspan="2">
		<select size="1" style="width: 100%;">
			<xsl:attribute name="id">i_<xsl:value-of select="@name"/><xsl:value-of select="../../id"/></xsl:attribute>
			<xsl:attribute name="name">f_<xsl:value-of select="@name"/></xsl:attribute>
			<xsl:attribute name="onChange"><xsl:value-of select="@onChange"/></xsl:attribute>
		<xsl:for-each select="../*[name()=$source]/item">
			<option>
				<xsl:attribute name="value"><xsl:value-of select="id"/></xsl:attribute>
				<xsl:if test='id = $value'>
					<xsl:attribute name="selected">1</xsl:attribute>
				</xsl:if>
				<xsl:value-of select="*[name()=$field]/." disable-output-escaping="yes"/>					
			</option>
		</xsl:for-each>
		</select>
	</td>
	</tr>
</xsl:template>

<xsl:template match="editor" mode="form">
	<xsl:variable name="class"><xsl:value-of select="../../class"/></xsl:variable>
	<xsl:variable name='fname'>f_<xsl:value-of select="@name"/><xsl:value-of select="../../*[name()=$class]/item/id"/></xsl:variable>
	<xsl:variable name='iid'><xsl:value-of select="../../*[name()=$class]/item/id"/></xsl:variable>
	<tr>
	<td colspan="2">
	        <xsl:if test="@mustbe = '1'"><b><xsl:value-of select="@title" disable-output-escaping="yes"/></b></xsl:if>
	        <xsl:if test="@mustbe = '0'"><xsl:value-of select="@title" disable-output-escaping="yes"/></xsl:if>
	</td>
	</tr>
	<tr>
	<td colspan="2">
		<xsl:value-of select="../embed[@name=$fname]/." disable-output-escaping="yes"/>
		<input type='hidden' name='_note_link' value='{$iid}'/>
	</td>
	</tr>
</xsl:template>

<xsl:template match="variants" mode="form">
	<xsl:variable name="name"><xsl:value-of select="@name"/></xsl:variable>
	<xsl:variable name="class"><xsl:value-of select="../../class"/></xsl:variable>
	<xsl:variable name="value"><xsl:value-of select="../../*[name()=$class]/item/*[name()=$name]"/></xsl:variable>
	<tr>
	<td colspan="2">
	        <xsl:if test="@mustbe = '1'"><b><xsl:value-of select="@title" disable-output-escaping="yes"/></b></xsl:if>
	        <xsl:if test="@mustbe = '0'"><xsl:value-of select="@title" disable-output-escaping="yes"/></xsl:if>
	</td>
	</tr>
	<tr>
	<td colspan="2">
		<select size="1" style="width: 100%;">
			<xsl:attribute name="id">i_<xsl:value-of select="@name"/></xsl:attribute>
			<xsl:attribute name="name">f_<xsl:value-of select="@name"/></xsl:attribute>
			<xsl:attribute name="onChange"><xsl:value-of select="@onChange"/></xsl:attribute>
		<xsl:for-each select="item">
			<option>
				<xsl:attribute name="value"><xsl:value-of select="@value"/></xsl:attribute>
				<xsl:if test='@value = $value'>
					<xsl:attribute name="selected">1</xsl:attribute>
				</xsl:if>
				<xsl:if test="string-length(@style) > 0">
					<xsl:attribute name="style"><xsl:value-of select="@style"/></xsl:attribute>
				</xsl:if>
				<xsl:value-of select="." disable-output-escaping="yes"/>					
			</option>
		</xsl:for-each>
		</select>
		<xsl:apply-templates select="subform"/>
	</td>
	</tr>
</xsl:template>

<xsl:template match="calendar" mode="form">
	<xsl:variable name="name"><xsl:value-of select="@lname"/></xsl:variable>
	<xsl:variable name="class"><xsl:value-of select="../../class"/></xsl:variable>
	<xsl:variable name="value"><xsl:value-of select="../../*[name()=$class]/item/*[name()=$name]"/></xsl:variable>
	<tr>
	<td colspan="2">
	        <xsl:if test="@mustbe = '1'"><b><xsl:value-of select="@title" disable-output-escaping="yes"/></b></xsl:if>
	        <xsl:if test="@mustbe = '0'"><xsl:value-of select="@title" disable-output-escaping="yes"/></xsl:if>
	</td>
	</tr>
	<tr>
	<td colspan="2">
		<input type="text" size="11" maxlength="10" style='background-color: #f9f9f9;'>
			<xsl:attribute name="id">i_<xsl:value-of select="@name"/><xsl:value-of select="../../id"/></xsl:attribute>
			<xsl:attribute name="name">f_<xsl:value-of select="@name"/></xsl:attribute>
			<xsl:attribute name="pattern">([0-9]{2}).([0-9]{2}).([0-9]{4})</xsl:attribute>
			<xsl:attribute name="notice">Это когда?</xsl:attribute>
			<xsl:attribute name="mustbe"><xsl:value-of select="@mustbe"/></xsl:attribute>
			<xsl:attribute name="value"><xsl:value-of select="$value"/></xsl:attribute>
		</input>		
		<img src="i/i_c.png" align="absmiddle">
			<xsl:attribute name="onClick">return showCalendar('i_<xsl:value-of select="@name"/><xsl:value-of select="../../id"/>', 'dd.mm.y');</xsl:attribute>
		</img>
	</td>
	</tr>
</xsl:template>

<xsl:template match="slider" mode="form">
	<xsl:variable name="name"><xsl:value-of select="@name"/></xsl:variable>
	<xsl:variable name="class"><xsl:value-of select="../../class"/></xsl:variable>
	<xsl:variable name="value"><xsl:value-of select="../../*[name()=$class]/item/*[name()=$name]"/></xsl:variable>
	<tr>
	<td colspan="2">
	        <xsl:if test="@mustbe = '1'"><b><xsl:value-of select="@title" disable-output-escaping="yes"/></b></xsl:if>
	        <xsl:if test="@mustbe = '0'"><xsl:value-of select="@title" disable-output-escaping="yes"/></xsl:if>
	</td>
	</tr>
	<tr>
	<td colspan="2">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr><td width='100%'>
  		<div class="slider_bg">
			<xsl:attribute name="id">i_<xsl:value-of select="@name"/><xsl:value-of select="../../id"/>_bg</xsl:attribute>
			<div class="slider_item">
				<xsl:attribute name="id">i_<xsl:value-of select="@name"/><xsl:value-of select="../../id"/>_item</xsl:attribute>
			</div>
			<div class="slider_track">
				<xsl:attribute name="id">i_<xsl:value-of select="@name"/><xsl:value-of select="../../id"/>_track</xsl:attribute>
			</div></div>
		</td><td>
			<div class='slider_value'>
				<xsl:attribute name="id">i_<xsl:value-of select="@name"/><xsl:value-of select="../../id"/>_value</xsl:attribute>
			000%</div>
		</td>
		</tr>
		</table>
		<input type="hidden">
			<xsl:attribute name="id">i_<xsl:value-of select="@name"/><xsl:value-of select="../../id"/></xsl:attribute>
			<xsl:attribute name="name">f_<xsl:value-of select="@name"/></xsl:attribute>
			<xsl:attribute name="value">
				<xsl:choose>
					<xsl:when test="string-length($value) > 0">
							<xsl:value-of select="$value"/>
					</xsl:when>
					<xsl:otherwise>0</xsl:otherwise>
				</xsl:choose>
			</xsl:attribute>
		</input>		
	</td>
	</tr>
</xsl:template>

<xsl:template match="memorybox" mode="form">
	<xsl:variable name="name"><xsl:value-of select="@name"/></xsl:variable>
	<xsl:variable name="class"><xsl:value-of select="../../class"/></xsl:variable>
	<xsl:variable name="value"><xsl:value-of select="../../*[name()=$class]/item/*[name()=$name]"/></xsl:variable>
	<xsl:variable name='source' select='@source'/>
	<tr>
	<td colspan="2">
	        <xsl:if test="@mustbe = '1'"><b><xsl:value-of select="@title" disable-output-escaping="yes"/></b></xsl:if>
	        <xsl:if test="@mustbe = '0'"><xsl:value-of select="@title" disable-output-escaping="yes"/></xsl:if>
	</td>
	</tr>
	<tr>
	<td colspan="2">
		<input type="text" size="30" style="width: 100%;">
			<xsl:attribute name="id">i_<xsl:value-of select="@name"/><xsl:value-of select="../../id"/></xsl:attribute>
			<xsl:attribute name="name">f_<xsl:value-of select="@name"/></xsl:attribute>
			<xsl:attribute name="pattern"><xsl:value-of select="@pattern"/></xsl:attribute>
			<xsl:attribute name="notice"><xsl:value-of select="@notice"/></xsl:attribute>
			<xsl:attribute name="mustbe"><xsl:value-of select="@mustbe"/></xsl:attribute>
			<xsl:attribute name="maxlength"><xsl:value-of select="@max"/></xsl:attribute>
			<xsl:attribute name="value"><xsl:value-of select="$value" disable-output-escaping="yes"/></xsl:attribute>
		</input>
		<div style="display:none; border: 1px solid #ddd; background-color: #fff; position:relative;" class="autocomplete">
			<xsl:attribute name="id">i_<xsl:value-of select="@name"/><xsl:value-of select="../../id"/>_ac</xsl:attribute>
			<ul class="aclist">
			<xsl:attribute name="id">i_<xsl:value-of select="@name"/><xsl:value-of select="../../id"/>_list</xsl:attribute>
			<xsl:for-each select="../*[name()=$source]/item">
				<li><xsl:value-of select="value" disable-output-escaping="yes"/></li>				
			</xsl:for-each>
			</ul>
		</div>
	</td>
	</tr>
</xsl:template>

<xsl:template match="notebox" mode="form">
	<xsl:variable name="name"><xsl:value-of select="@name"/></xsl:variable>
	<xsl:variable name="class"><xsl:value-of select="../../class"/></xsl:variable>
	<xsl:variable name="value"><xsl:value-of select="../../*[name()=$class]/item/*[name()=$name]"/></xsl:variable>
	<tr>
	<td colspan="2">
	        <xsl:if test="@mustbe = '1'"><b><xsl:value-of select="@title" disable-output-escaping="yes"/></b></xsl:if>
	        <xsl:if test="@mustbe = '0'"><xsl:value-of select="@title" disable-output-escaping="yes"/></xsl:if>
	</td>
	</tr>
	<tr>
	<td colspan="2">
		<textarea rows='7' cols='30' style='width: 100%;'>
			<xsl:attribute name="id">i_<xsl:value-of select="@name"/><xsl:value-of select="../../id"/></xsl:attribute>
			<xsl:attribute name="name">f_<xsl:value-of select="@name"/></xsl:attribute>
			<xsl:value-of select="$value"/>
		</textarea>
	</td>
	</tr>
</xsl:template>

<xsl:template match="linker" mode="form">
	<tr>
	<td colspan="2">
	        <xsl:if test="@mustbe = '1'"><b><xsl:value-of select="@title" disable-output-escaping="yes"/></b></xsl:if>
	        <xsl:if test="@mustbe = '0'"><xsl:value-of select="@title" disable-output-escaping="yes"/></xsl:if>
	</td>
	</tr>
	<tr>
	<td colspan="2">
		<select size='1' style='width: 100%;'>
			<xsl:attribute name="id">i_<xsl:value-of select="@name"/><xsl:value-of select="../../id"/></xsl:attribute>
			<xsl:attribute name="name">f_<xsl:value-of select="@name"/></xsl:attribute>
			<xsl:attribute name="onChange"><xsl:value-of select="onChange"/></xsl:attribute>
			<xsl:apply-templates select="../tree/node" mode="control"/>	
		</select><br/>
	</td>
	</tr>
</xsl:template>
			
<xsl:template match="subform">
	<div class='subformitem' id='sf_{@name}'>
		<table border="0" cellpadding="0" cellspacing="4" width="100%" align="right">
			<xsl:apply-templates select="slider|bool|filebox|textbox|selector|editor|variants|calendar|memorybox|notebox" mode="form"/>
		</table>
	</div>
</xsl:template>

</xsl:stylesheet>
