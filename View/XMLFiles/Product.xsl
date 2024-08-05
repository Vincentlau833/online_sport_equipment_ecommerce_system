<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                xmlns:fo="http://www.w3.org/1999/XSL/Format"
                version="1.0">
  <xsl:template match="/">
    <fo:root xmlns:fo="http://www.w3.org/1999/XSL/Format">
      <fo:layout-master-set>
        <fo:simple-page-master master-name="A4" page-height="29.7cm" page-width="21cm">
          <fo:region-body margin="1cm"/>
        </fo:simple-page-master>
      </fo:layout-master-set>
      <fo:page-sequence master-reference="A4">
        <fo:flow flow-name="xsl-region-body">
          <fo:block font-size="18pt" font-weight="bold" text-align="center">Product List</fo:block>
          <fo:block font-size="12pt" margin-top="1cm">
            <xsl:apply-templates select="//Product"/>
          </fo:block>
        </fo:flow>
      </fo:page-sequence>
    </fo:root>
  </xsl:template>

  <xsl:template match="Product">
    <fo:block margin-top="1cm">
      <fo:block font-weight="bold"><xsl:value-of select="productName"/></fo:block>
      <fo:block font-size="10pt" margin-top="0.5cm"><xsl:value-of select="productDesc"/></fo:block>
      <fo:block font-size="10pt" margin-top="0.5cm">Price: <xsl:value-of select="productPrice"/> USD</fo:block>
      <fo:block font-size="10pt" margin-top="0.5cm">Stock: <xsl:value-of select="stockQuantity"/></fo:block>
    </fo:block>
  </xsl:template>
</xsl:stylesheet>
