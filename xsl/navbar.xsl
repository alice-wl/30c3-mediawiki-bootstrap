<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE xsl:stylesheet [
    <!ENTITY % entities SYSTEM "entities.dtd">
    %entities;
]>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    version="1.0">
    
    <!-- add nav class to root ul element -->
    <xsl:template match="/">
        <nav class="navbar navbar-tools">
            <div class="navbar-inner">
		<!--
		<a class="btn btn-navbar" data-toggle="&collapse-data-toggle;" data-target=".&nav-collapse-class;">
		    <span class="&icon-bar-class;"></span>
		    <span class="&icon-bar-class;"></span>
		    <span class="&icon-bar-class;"></span>
		</a>
-->

		<div id="pagetools" class="&site-tool-group;"></div>

		<xsl:apply-templates select="ul[1]" mode="topLevel">
		    <xsl:with-param name="class">&site-tool-group;</xsl:with-param>
		</xsl:apply-templates>

		<div id="usertools" class="&site-tool-group;"></div>

		<div id="search" class="&site-tool-group;">
		    <form action="/congress/2013/wiki/index.php" class="search">
		        <label for="search" class="icon-search icon-white"> </label>
			<input type="search" name="search" title="Search 30C3_Public_Wiki [f]" accesskey="f" id="searchInput" class="search-query" placeholder="Search" />
		    </form>
		  </div>


		<div class="logo"><a class="brand"></a></div>
		
		
            </div>
        </nav>
    </xsl:template>
    
    <xsl:include href="dropdown.xsl"/>
    
</xsl:stylesheet>
