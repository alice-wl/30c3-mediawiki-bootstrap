<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE xsl:stylesheet [
    <!ENTITY % entities SYSTEM "entities.dtd">
    %entities;
]>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    version="1.0">
    
    <xsl:param name="nav-type">&nav-pills-class;</xsl:param>
    <xsl:template match="/">
        <nav role="navigation" class="navbar navbar-default">
            <div class="navbar-header">
		<button class="navbar-toggle" data-toggle="&collapse-data-toggle;" data-target=".&nav-topbar-collapse;">
		    <span class="&icon-bar-class;"></span>
		    <span class="&icon-bar-class;"></span>
		    <span class="&icon-bar-class;"></span>
		</button>
            </div>
            <div class="&nav-topbar-collapse; &nav-topbar-class;">
                <xsl:apply-templates select="ul[1]" mode="topLevel">
                    <xsl:with-param name="class">&topbar-nav;</xsl:with-param>
                </xsl:apply-templates>
            </div>
        </nav>
    </xsl:template>
    
    <xsl:include href="dropdown.xsl"/>    
    
</xsl:stylesheet>
