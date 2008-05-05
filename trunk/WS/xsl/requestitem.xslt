<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="xml" indent="no" encoding="UTF-8"/>

<xsl:template match="/">
    <xsl:apply-templates select="document"/>
</xsl:template>

<xsl:template match="document">
<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:o="urn:schemas-microsoft-com:office:office"
 xmlns:x="urn:schemas-microsoft-com:office:excel"
 xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:html="http://www.w3.org/TR/REC-html40">
 <DocumentProperties xmlns="urn:schemas-microsoft-com:office:office">
  <Author>WebShop</Author>
  <LastAuthor>WebShop</LastAuthor>
  <Created>2007-10-04T19:02:39Z</Created>
  <LastSaved>2007-10-04T19:02:40Z</LastSaved>
  <Company>WebCRE8</Company>
  <Version>11.5606</Version>
 </DocumentProperties>
 <ExcelWorkbook xmlns="urn:schemas-microsoft-com:office:excel">
  <WindowHeight>12405</WindowHeight>
  <WindowWidth>19020</WindowWidth>
  <WindowTopX>120</WindowTopX>
  <WindowTopY>90</WindowTopY>
  <ProtectStructure>False</ProtectStructure>
  <ProtectWindows>False</ProtectWindows>
 </ExcelWorkbook>
 <Styles>
  <Style ss:ID="Default" ss:Name="Normal">
   <Alignment ss:Vertical="Center"/>
   <Borders/>
   <Font x:CharSet="204" x:Family="Swiss" ss:Size="8"/>
   <Interior/>
   <NumberFormat/>
   <Protection/>
  </Style>
  <Style ss:ID="Default" ss:Name="">
   <Alignment ss:Vertical="Center"/>
   <Borders/>
   <Font x:CharSet="204" x:Family="Swiss" ss:Size="8"/>
   <Interior/>
   <NumberFormat/>
   <Protection/>
  </Style>
  <Style ss:ID="s20" ss:Name="Percent">
   <NumberFormat ss:Format="0%"/>
  </Style>
  <Style ss:ID="m16847476">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font x:CharSet="204" x:Family="Swiss" ss:Size="8" ss:Color="#000080"
    ss:Bold="1" ss:Italic="1"/>
   <Interior ss:Color="#CCFFFF" ss:Pattern="Solid"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m16847486">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font x:CharSet="204" x:Family="Swiss" ss:Size="8" ss:Color="#000080"
    ss:Bold="1" ss:Italic="1"/>
   <Interior ss:Color="#CCFFFF" ss:Pattern="Solid"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s21">
   <Borders/>
   <Font x:CharSet="204" x:Family="Swiss" ss:Size="8" ss:Color="#000080"/>
   <Interior/>
   <Protection/>
  </Style>
  <Style ss:ID="s22">
   <Alignment ss:Horizontal="Right" ss:Vertical="Bottom"/>
   <Font x:CharSet="204" x:Family="Swiss" ss:Size="8" ss:Bold="1"/>
   <Interior/>
   <Protection/>
  </Style>
  <Style ss:ID="s23">
   <Alignment ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font x:CharSet="204" x:Family="Swiss" ss:Size="8" ss:Color="#000080"
    ss:Bold="1" ss:Italic="1"/>
   <Interior ss:Color="#CCFFFF" ss:Pattern="Solid"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s24">
   <Alignment ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font x:CharSet="204" x:Family="Swiss" ss:Size="8" ss:Color="#000080"
    ss:Bold="1" ss:Italic="1"/>
   <Interior ss:Color="#CCFFFF" ss:Pattern="Solid"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s25">
   <Alignment ss:Horizontal="Right" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font x:CharSet="204" x:Family="Swiss" ss:Size="8" ss:Color="#000080"
    ss:Bold="1" ss:Italic="1"/>
   <Interior/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s28">
   <Alignment ss:Vertical="Bottom"/>
   <Font x:CharSet="204" x:Family="Swiss" ss:Size="8"/>
   <Interior/>
   <Protection/>
  </Style>
  <Style ss:ID="s29">
   <Alignment ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font x:CharSet="204" x:Family="Swiss" ss:Size="8" ss:Color="#000080"
    ss:Bold="1" ss:Italic="1"/>
   <Interior ss:Color="#CCFFFF" ss:Pattern="Solid"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s30">
   <Font x:CharSet="204" x:Family="Swiss" ss:Size="8"/>
   <Interior/>
   <Protection/>
  </Style>
  <Style ss:ID="s31">
   <Alignment ss:Horizontal="Right" ss:Vertical="Bottom"/>
   <Font x:CharSet="204" x:Family="Swiss" ss:Size="8" ss:Bold="1" ss:Italic="1"/>
   <Interior/>
   <Protection/>
  </Style>
  <Style ss:ID="s32">
   <Alignment ss:Horizontal="Right" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font x:CharSet="204" x:Family="Swiss" ss:Size="8" ss:Color="#000080"
    ss:Bold="1" ss:Italic="1"/>
   <Interior ss:Color="#CCFFFF" ss:Pattern="Solid"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s33">
   <Alignment ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font x:CharSet="204" x:Family="Swiss" ss:Size="8" ss:Color="#000080"
    ss:Bold="1" ss:Italic="1"/>
   <Interior ss:Color="#CCFFFF" ss:Pattern="Solid"/>
   <NumberFormat ss:Format="0.0000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s34">
   <Borders/>
   <Font x:CharSet="204" x:Family="Swiss" ss:Size="8"/>
   <Interior/>
   <Protection/>
  </Style>
  <Style ss:ID="s35" ss:Parent="s20">
   <Alignment ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font x:CharSet="204" x:Family="Swiss" ss:Size="8" ss:Color="#000080"
    ss:Bold="1" ss:Italic="1"/>
   <Interior ss:Color="#CCFFFF" ss:Pattern="Solid"/>
   <NumberFormat ss:Format="[$$-409]#,##0.00"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s36">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Font x:CharSet="204" x:Family="Swiss" ss:Size="8"/>
   <Interior/>
   <Protection/>
  </Style>
  <Style ss:ID="s37">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font x:CharSet="204" x:Family="Swiss" ss:Size="8" ss:Bold="1"/>
   <Interior/>
   <Protection/>
  </Style>
  <Style ss:ID="s38">
   <Alignment ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font x:CharSet="204" x:Family="Swiss" ss:Size="8" ss:Bold="1"/>
   <Interior/>
   <Protection/>
  </Style>
  <Style ss:ID="s39">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font x:CharSet="204" x:Family="Swiss" ss:Size="8" ss:Bold="1"/>
   <Interior/>
   <Protection/>
  </Style>
  <Style ss:ID="s40">
   <Alignment ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font x:CharSet="204" x:Family="Swiss" ss:Size="8" ss:Bold="1"/>
   <Interior/>
   <Protection/>
  </Style>
  <Style ss:ID="s41">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font x:CharSet="204" x:Family="Swiss" ss:Size="8" ss:Bold="1"/>
   <Interior/>
   <Protection/>
  </Style>
  <Style ss:ID="s42">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font x:CharSet="204" x:Family="Swiss" ss:Size="8" ss:Color="#000080"/>
   <Interior/>
   <NumberFormat/>
   <Protection/>
  </Style>
  <Style ss:ID="s43">
   <Alignment ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font x:CharSet="204" x:Family="Swiss" ss:Size="8" ss:Color="#000080"/>
   <Interior/>
   <Protection/>
  </Style>
  <Style ss:ID="s44">
   <Alignment ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font x:CharSet="204" x:Family="Swiss" ss:Size="8" ss:Color="#000080"/>
   <Interior/>
   <Protection/>
  </Style>
  <Style ss:ID="s45">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font x:CharSet="204" x:Family="Swiss" ss:Size="8" ss:Color="#000080"
    ss:Bold="1"/>
   <Interior ss:Color="#CCFFFF" ss:Pattern="Solid"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s46">
   <Alignment ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font x:CharSet="204" x:Family="Swiss" ss:Size="8" ss:Color="#000080"
    ss:Bold="1"/>
   <Interior ss:Color="#CCFFFF" ss:Pattern="Solid"/>
   <NumberFormat ss:Format="Standard"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s47">
   <Alignment ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font x:CharSet="204" x:Family="Swiss" ss:Size="8" ss:Color="#000080"
    ss:Bold="1"/>
   <Interior/>
   <NumberFormat ss:Format="Standard"/>
   <Protection/>
  </Style>
  <Style ss:ID="s48">
   <Alignment ss:Horizontal="Left" ss:Vertical="Bottom"/>
   <Font x:CharSet="204" x:Family="Swiss" ss:Size="8" ss:Color="#800080"
    ss:Bold="1"/>
   <Interior/>
   <NumberFormat/>
   <Protection/>
  </Style>
  <Style ss:ID="s49">
   <Alignment ss:Vertical="Bottom"/>
   <Font x:CharSet="204" x:Family="Swiss" ss:Size="8" ss:Color="#008000"/>
   <Interior/>
   <NumberFormat ss:Format="#,##0.00_ ;[Red]\-#,##0.00\ "/>
   <Protection/>
  </Style>
  <Style ss:ID="s50">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Font x:CharSet="204" x:Family="Swiss" ss:Size="8" ss:Color="#000080"
    ss:Bold="1"/>
   <Interior/>
   <NumberFormat ss:Format="#,##0"/>
   <Protection/>
  </Style>
  <Style ss:ID="s51">
   <Font x:CharSet="204" x:Family="Swiss" ss:Size="8" ss:Color="#000080"
    ss:Bold="1"/>
   <Interior/>
   <NumberFormat ss:Format="Standard"/>
   <Protection/>
  </Style>
 </Styles>
 <Worksheet ss:Name="Sheet1">
  <Names>
   <NamedRange ss:Name="Print_Area" ss:RefersTo="=Sheet1!C2:C8"/>
  </Names>
  <Table ss:ExpandedColumnCount="8" ss:ExpandedRowCount="16" x:FullColumns="1"
   x:FullRows="1">
   <Column ss:AutoFitWidth="0" ss:Width="9"/>
   <Column ss:AutoFitWidth="0" ss:Width="40.5"/>
   <Column ss:AutoFitWidth="0" ss:Width="66.75"/>
   <Column ss:AutoFitWidth="0" ss:Width="240"/>
   <Column ss:AutoFitWidth="0" ss:Width="19.5"/>
   <Column ss:AutoFitWidth="0" ss:Width="35.25"/>
   <Column ss:AutoFitWidth="0" ss:Width="45.75"/>
   <Column ss:AutoFitWidth="0" ss:Width="51"/>
   <Row ss:Index="3">
    <Cell ss:Index="2" ss:StyleID="s21"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s22"><Data ss:Type="String">Наименование:</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s23"><Comment ss:Author="My"><ss:Data
       xmlns="http://www.w3.org/TR/REC-html40"><B><Font html:Face="Tahoma"
         x:CharSet="204" html:Size="8" html:Color="#000000">Название организации согласно юридическим документам</Font></B></ss:Data></Comment><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s24"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s25"><Data ss:Type="String">ИНН:</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:StyleID="m16847476"><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row>
    <Cell ss:Index="2" ss:StyleID="s28"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s22"><Data ss:Type="String">Юридический адрес:</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s23"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s29"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s25"><Data ss:Type="String">КПП:</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:StyleID="m16847486"><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row>
    <Cell ss:Index="2" ss:StyleID="s28"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s22"><Data ss:Type="String">Ф.И.О. представителя:</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s23"><Comment ss:Author="My"><ss:Data
       xmlns="http://www.w3.org/TR/REC-html40"><B><Font html:Face="Tahoma"
         x:CharSet="204" html:Size="8" html:Color="#000000">Ф.И.О. ответственного человека для связи</Font></B></ss:Data></Comment><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s29"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s30"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s31"><Data ss:Type="String">Дата заказа:</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s32" ss:Formula="=TODAY()"><Data ss:Type="DateTime">2007-10-04T00:00:00.000</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row>
    <Cell ss:Index="2" ss:StyleID="s28"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s22"><Data ss:Type="String">Тел./Факс:</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s23"><Comment ss:Author="My"><ss:Data
       xmlns="http://www.w3.org/TR/REC-html40"><B><Font html:Face="Tahoma"
         x:CharSet="204" html:Size="8" html:Color="#000000">ответственного человека для связи</Font></B></ss:Data></Comment><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s29"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s22"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s31"><Data ss:Type="String">Курс ЦБ:</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s33"><Data ss:Type="Number">26.041899999999998</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row>
    <Cell ss:Index="2" ss:StyleID="s28"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s22"><Data ss:Type="String">E-mail:</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s23"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s29"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s34"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s31"><Data ss:Type="String">Справочно в $:</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s35" ss:Formula="=R[9]C/R[-1]C"><Data ss:Type="Number">208.85572865267127</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row>
    <Cell ss:Index="2" ss:StyleID="s30"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s22"><Data ss:Type="String">Примечание:</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s23"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s24"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s24"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s24"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s29"><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row>
    <Cell ss:Index="2" ss:StyleID="s30"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s30"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s30"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s30"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s30"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s30"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s30"><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row>
    <Cell ss:Index="2" ss:StyleID="s36"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s36"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s36"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s36"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s36"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s36"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s36"><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row>
    <Cell ss:Index="2" ss:StyleID="s37"><Data ss:Type="String">Код</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s38"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s39"><Data ss:Type="String">Наименование</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s40"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s41"><Data ss:Type="String">Кол-во</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s37"><Data ss:Type="String">Цена</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s37"><Data ss:Type="String">Сумма</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   
   
   <xsl:for-each select="requested/item">
   <Row>
    <Cell ss:Index="2" ss:StyleID="s42"><Data ss:Type="Number"><xsl:value-of select="id_products" disable-output-escaping="yes"/></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s43"><Data ss:Type="String"><xsl:value-of select="title" disable-output-escaping="yes"/></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s44"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s44"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s45"><Data ss:Type="Number"><xsl:value-of select="num" disable-output-escaping="yes"/></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s46"><Data ss:Type="Number"><xsl:value-of select="price" disable-output-escaping="yes"/></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s47" ss:Formula="=RC[-1]*RC[-2]"><Data ss:Type="Number"><xsl:value-of select="num * price"/></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   </xsl:for-each>
   
   <Row>
    <Cell ss:Index="2" ss:StyleID="s30"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s22"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s48"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s49"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s50" ss:Formula="=SUM(R[-{count(requested/item)}]C:R[-1]C)"><Data ss:Type="Number"><xsl:value-of select="count(requested/item)"/></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s22"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s51" ss:Formula="=SUM(R[-{count(requested/item)}]C:R[-1]C)"><Data ss:Type="Number"><xsl:value-of select="total"/></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
  </Table>
  <WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
   <PageSetup>
    <Header x:Margin="0"/>
    <Footer x:Margin="0"/>
    <PageMargins x:Bottom="0.2" x:Left="0.5" x:Right="0.2" x:Top="0.5"/>
   </PageSetup>
   <Print>
    <BlackAndWhite/>
    <ValidPrinterInfo/>
    <HorizontalResolution>300</HorizontalResolution>
    <VerticalResolution>300</VerticalResolution>
    <NumberofCopies>0</NumberofCopies>
   </Print>
   <Selected/>
   <DoNotDisplayGridlines/>
   <DoNotDisplayZeros/>
   <Panes>
    <Pane>
     <Number>3</Number>
     <ActiveRow>27</ActiveRow>
     <ActiveCol>3</ActiveCol>
    </Pane>
   </Panes>
   <ProtectObjects>False</ProtectObjects>
   <ProtectScenarios>False</ProtectScenarios>
  </WorksheetOptions>
 </Worksheet>
</Workbook>
</xsl:template>

</xsl:stylesheet>
