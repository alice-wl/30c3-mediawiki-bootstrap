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
                    <div id="page" class="container container-fluid center-block">
                    <?php if($this->data['sitenotice']) { ?>
                        <header class="row-fluid">
                            <div id="siteNotice" class="alert alert-info span12">
                                <button class="close" data-dismiss="alert">x</button>
                                <?php $this->html('sitenotice') ?>
                            </div>
                        </header>
                    <?php } ?>

                    <div class="row-fluid">

                        <?php $TopbarArticle = Article::newFromTitle(
                            Title::newFromText( $sgTopbarOptions['page'] ), 
                            $this->data['skin']->getContext( ));
                        if( $TopbarArticle->getContent() != '' ) { ?>
                              <?php $renderer->renderTopbar(); } ?>

                        <?php $sidebarArticle = Article::newFromTitle(
                            Title::newFromText( $sgSidebarOptions['page'] ), 
                            $this->data['skin']->getContext( ));
                        if( $sidebarArticle->getContent() != '' ) { ?>
                              <?php $renderer->renderSidebar(); ?>
                        <?php } ?>

                        <article id="content" class="row" >
                            <?php 
                              $body = $this->data['bodycontent']; 
                              $matches = array( );

                              switch( $this->data['title'] ) {
                                case 'Main Page':
                                  break;
                                default: ?>
                                  <!--<div class="page-header">
                                  <h1> <?php $this->html( 'title' ); ?> </h1>
                                  </div> -->
                                
                                  <?php
                                  break;
                              }

                              $st = '<table id="toc" class="toc"><tr><td><div id="toctitle"><h2>Contents<\/h2><\/div>';
                              $nd = '<\/td><\/tr><\/table>';
                              if( preg_match('/'.$st.'(.*?)'.$nd.'/s', $body, $matches )) {
                                  $body = preg_replace('/'.$st.'.*?'.$nd.'/s', '', $body );
                                  ?>
                                  <div id="toc" class="col-md-4">
                                    <div id="toctitle"><h2>Contents</h2></div><? echo $matches[1]; ?> 
                                  </div>
                                  <?php
                              }
                              $st = '<div id="mw-content-text" lang="en" dir="ltr" class="mw-content-ltr"><p>';
                              $nd = '<p></div>';
                              if( preg_match('/'.$st.'(.*?)'.$nd.'/s', $body, $matches )) {
                                  $body = preg_replace('/'.$st.'.*?'.$nd.'/s', '', $body );
                                  ?>
                                    <? echo $matches[1]; ?> 
                                  </div>
                                  <?php
                              }
                              echo $body;
                            ?>
                            <?php $renderer->renderCatLinks(); ?>
                            <?php $this->html( 'dataAfterContent' ); ?>
                        </article>
                    </div>

                    <?php $renderer->renderFooter(); ?>

                    </div> <!-- #page .container-fluid -->

                    <?php $this->printTrail(); ?>

                    </body>
                    </html>
                    <?php wfRestoreWarnings(); 
            }
    }
