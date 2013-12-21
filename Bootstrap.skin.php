<?php
/**
 * Skin file for skin Bootstrap.
 *
 * @file
 * @ingroup Skins
 */

 	/**
 	* SkinTemplate class for Bootstrap skin
 	* @ingroup Skins
 	*/
 	class SkinBootstrap extends SkinTemplate {
		
		var $skinname = 'bootstrap', $stylename = 'bootstrap',
			$template = 'BootstrapTemplate', $useHeadElement = true;

		/**
		* @param $out OutputPage object
		*/
		public function initPage( OutputPage $out ) {
			parent::initPage( $out );
			$out->addModuleScripts( 'skins.bootstrap' );
			$out->addMeta("viewport", "width=device-width, initial-scale=1.0");
			#$out->addScriptFile( "http://html5shiv.googlecode.com/svn/trunk/html5.js" );
		}

		/**
		* @param $out OutputPage object
		*/
		function setupSkinUserCss( OutputPage $out ) {
			$out->addModuleStyles( 'skins.bootstrap' );
		}
	}

	/**
	* BaseTemplate class for Bootstrap skin
	* @ingroup Skins
	*/
	class BootstrapTemplate extends BaseTemplate {
		
		/**
		*	Outputs the entire context of the page
		*/
		public function execute() {
                    global $wgUser, $wgVersion, $sgSidebarOptions, $sgTopbarOptions;
                    $renderer = new BootstrapRenderer( $this, $this->data );
                    wfSuppressWarnings();

                    $this->html( 'headelement' ); ?>
                    <?php $renderer->renderNavbar(); ?>
                    <div id="page" class="container center-block">

                    <?php $TopbarArticle = Article::newFromTitle(
                        Title::newFromText( $sgTopbarOptions['page'] ), 
                        $this->data['skin']->getContext( ));
                    if( $TopbarArticle->getContent() != '' ) { ?>
                          <?php $renderer->renderTopbar(); } ?>

                    <div class="row">
                        <?php $sidebarArticle = Article::newFromTitle(
                            Title::newFromText( $sgSidebarOptions['page'] ), 
                            $this->data['skin']->getContext( ));
                        if( $sidebarArticle->getContent() != '' ) { ?>
                              <?php $renderer->renderSidebar(); ?>
                        <?php } ?>

                        <article id="content">
                            <header class="pagestart">
                              <?php 
                              $body = $this->data['bodycontent']; 
                              $matches = array( );

                              switch( $this->data['title'] ) {
                              case 'Main Page': ?>
                                  <div class="page-header">
                                  <h1>30C3: 30th Chaos Communication Congress</div>
                                  <?php 
                                  break;
                                default: ?>
                                  <div class="page-header">
                                  <h1> <?php $this->html( 'title' ); ?> </h1>
                                  </div>
                                  <?php
                                  break;
                              }

                              $st = '<table id="toc" class="toc"><tr><td><div id="toctitle"><h2>Contents<\/h2><\/div>';
                              $nd = '<\/td><\/tr><\/table>';
                              if( preg_match('/'.$st.'(.*?)'.$nd.'/s', $body, $matches )) {
                                  $body = preg_replace('/'.$st.'.*?'.$nd.'/s', '', $body );
                                  ?>
                                  <div id="toc">
                                    <div id="toctitle"><h2>Contents</h2></div><?php echo $matches[1]; ?> 
                                  </div>
                                  <?php
                              }
                              $body = preg_replace('/<div id="mw-content-text" .*? class="/', '\\0row ', $body, 1 );
                              $body = preg_replace('/(<div id="mw-content-text")>/', '\\1class="row">', $body, 1 );

                              if($this->data['sitenotice']) { ?>
                                    <div id="siteNotice" class="alert alert-info span12">
                                        <button class="close" data-dismiss="alert">x</button>
                                        <?php $this->html('sitenotice') ?>
                                    </div>
                              <?php } ?>
                            </header>

                            <?php echo $body; ?>
                            <?php $renderer->renderCatLinks(); ?>
                            <?php $this->html( 'dataAfterContent' ); ?>
                        </article>
                    </div>

                    <footer class="pageend">
                    <?php $renderer->renderFooter(); ?>
                    </footer>

                    </div> <!-- #page .container -->

                    <?php $this->printTrail(); ?>

                    </body>
                    </html>
                    <?php wfRestoreWarnings(); 
            }
    }
