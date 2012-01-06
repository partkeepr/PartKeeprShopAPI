<?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:xhtml="http://www.w3.org/1999/xhtml">
	<xsl:output method="xml" encoding="ISO-8859-1" indent="yes"/>
    
	<xsl:template match="/">
		<root>
			<xsl:apply-templates/>
		</root>
	</xsl:template>
	
	<xsl:template match="xhtml:div[@id='r_content']//xhtml:div[@id='pagecontent']//xhtml:div[@style='float:right']/text()">
		<xsl:variable name="pagecount"><xsl:value-of select="normalize-space(.)"/></xsl:variable>
		<xsl:if test="$pagecount != ''">
			<page>
				<xsl:call-template name="extract-pagenumbers">
					<xsl:with-param name="string" select="$pagecount"/>
				</xsl:call-template>
			</page>
		</xsl:if>
	</xsl:template>
	
	<xsl:template match="text()|@*">
  		<!-- <xsl:value-of select="."/>-->
	</xsl:template>
	

	<!-- Extracts the page number from reichelt -->
	<xsl:template name="extract-pagenumbers">
	    <xsl:param name="string" />

	    <xsl:choose>
	        <xsl:when test="contains($string, ' von ')">
	            <xsl:variable name="firstpart" select="substring-before($string, ' von ')"/>
	            <xsl:variable name="lastpart" select="substring-after($string, ' von ')"/>
	            
	            <xsl:variable name="stripped-firstpart" select="substring-after($firstpart, 'Seite ')"/>
	            <xsl:variable name="stripped-lastpart" select="substring-before($lastpart, ' ')"/>
	            
	            <start><xsl:value-of select="$stripped-firstpart"/></start>
	            
	            <xsl:choose>
	            	<xsl:when test="$stripped-lastpart != ''">
	            		<end><xsl:value-of select="$stripped-lastpart"/></end>
	            	</xsl:when>
	            	<xsl:otherwise>
	            		<end><xsl:value-of select="$lastpart"/></end>
	            	</xsl:otherwise>
	            </xsl:choose>
	            
	        </xsl:when>
	    </xsl:choose>
	</xsl:template>
</xsl:stylesheet>