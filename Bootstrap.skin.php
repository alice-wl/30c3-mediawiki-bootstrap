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
			$out->addScriptFile( "http://html5shiv.googlecode.com/svn/trunk/html5.js" );
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
                    <div id="page" class="container container-fluid">
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
                              <?php $renderer->renderTopbar(); ?>
                        <?php $contentSpanSize = "8"; } ?>

                        <?php $sidebarArticle = Article::newFromTitle(
                            Title::newFromText( $sgSidebarOptions['page'] ), 
                            $this->data['skin']->getContext( ));
                        if( $sidebarArticle->getContent() != '' ) { ?>
                              <?php $renderer->renderSidebar(); ?>
                        <?php $contentSpanSize = "8"; } ?>

                        <article id="content" class="span<?php echo $contentSpanSize?>" >
                            <div class="page-header">
                                <h1>
                                    <?php $this->html( 'title' ) ?>
                                    <small><?php $this->html( 'subtitle' ) ?></small>
                                </h1>
                            </div>	
                            <?php $this->html( 'bodycontent' ); ?>
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
