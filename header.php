<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />

	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11" />
    <link rel="icon" href="/favicon.png" type="image/x-icon" />
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-NPNL894');</script>
    <!-- End Google Tag Manager -->
	<?php wp_head(); ?>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-10973598813"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-10973598813');
</script>
<style type='text/css'>
	.embeddedServiceHelpButton .helpButton .uiButton {
		background-color: #175bdf;
		font-family: "Salesforce Sans", sans-serif;
	}
	.embeddedServiceHelpButton .helpButton .uiButton:focus {
		outline: 1px solid #175bdf;
	}
	@font-face {
		font-family: 'Salesforce Sans';
		src: url('https://c1.sfdcstatic.com/etc/clientlibs/sfdc-aem-master/clientlibs_base/fonts/SalesforceSans-Regular.woff') format('woff'),
		url('https://c1.sfdcstatic.com/etc/clientlibs/sfdc-aem-master/clientlibs_base/fonts/SalesforceSans-Regular.ttf') format('truetype');
	}
</style>

<script type='text/javascript' src='https://service.force.com/embeddedservice/5.0/esw.min.js'></script>
<script type='text/javascript'>
	var initESW = function(gslbBaseURL) {
		embedded_svc.settings.displayHelpButton = true; //Or false
		embedded_svc.settings.language = ''; //For example, enter 'en' or 'en-US'

		//embedded_svc.settings.defaultMinimizedText = '...'; //(Defaults to Chat with an Expert)
		//embedded_svc.settings.disabledMinimizedText = '...'; //(Defaults to Agent Offline)

		//embedded_svc.settings.loadingText = ''; //(Defaults to Loading)
		//embedded_svc.settings.storageDomain = 'yourdomain.com'; //(Sets the domain for your deployment so that visitors can navigate subdomains during a chat session)

		// Settings for Chat
		//embedded_svc.settings.directToButtonRouting = function(prechatFormData) {
			// Dynamically changes the button ID based on what the visitor enters in the pre-chat form.
			// Returns a valid button ID.
		//};
		//embedded_svc.settings.prepopulatedPrechatFields = {}; //Sets the auto-population of pre-chat form fields
		//embedded_svc.settings.fallbackRouting = []; //An array of button IDs, user IDs, or userId_buttonId
		//embedded_svc.settings.offlineSupportMinimizedText = '...'; //(Defaults to Contact Us)

		embedded_svc.settings.enabledFeatures = ['LiveAgent'];
		embedded_svc.settings.entryFeature = 'LiveAgent';

		embedded_svc.init(
			'https://isentia--partial18.sandbox.my.salesforce.com',
			'https://isentia--partial18.sandbox.my.site.com/testcommunity',
			gslbBaseURL,
			'00D250000009M4U',
			'Guest_Live_Chat_Matter',
			{
				baseLiveAgentContentURL: 'https://c.la1-c1cs-lo2.salesforceliveagent.com/content',
				deploymentId: '5723z000000bw47',
				buttonId: '5732500000001Vt',
				baseLiveAgentURL: 'https://d.la1-c1cs-lo2.salesforceliveagent.com/chat',
				eswLiveAgentDevName: 'EmbeddedServiceLiveAgent_Parent04I2500000000irEAA_185dc554713',
				isOfflineSupportEnabled: true
			}
		);
	};

	if (!window.embedded_svc) {
		var s = document.createElement('script');
		s.setAttribute('src', 'https://isentia--partial18.sandbox.my.salesforce.com/embeddedservice/5.0/esw.min.js');
		s.onload = function() {
			initESW(null);
		};
		document.body.appendChild(s);
	} else {
		initESW('https://service.force.com');
	}
</script>

</head>

<body <?php body_class(); ?>>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NPNL894"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div id="page" class="site">
        <header>
            <div id="pre-navigation">
                <div class="inner">
                    <?php if ( has_nav_menu( 'mini-header' ) ) : ?>
                        <nav class="mini-navigation" aria-label="Pre Menu">
                            <div class="menu-container">
<!--                                 <div class="search">
                                    <span><i class="fas fa-search"></i> Search</span>
                                    <?php get_search_form(); ?>
                                </div> -->
                                <?php
                                wp_nav_menu(
                                    array(
                                        'theme_location' => 'mini-header',
                                        'menu_class'     => 'pre-menu',
                                        'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                    )
                                );
                                ?>
                            </div>
                        </nav><!-- #site-navigation -->
                    <?php endif; ?>
                </div>
            </div>
            <div id="main-navigation">
                <div class="inner">
                    <div class="logo">
                        <a href="<?= site_url() ?>"><?php bloginfo( "name" ) ?></a>
                    </div>

                    <?php if ( has_nav_menu( 'header' ) ) : ?>
                        <nav class="main-navigation" aria-label="Top Menu">
                        
                            <a class="get-demo" href="#">Get Demo</a>
                            <div class="mobile-handle">
                                <span></span>
                            </div>
                            <div class="menu-container">
                                <div class="mobile-head">
                                    <a href="<?php site_url() ?>" class="mobile-logo"><?php bloginfo( "name" ) ?></a>
                                    <span class="close-menu"></span>
                                </div>
                                <div class="login-menu-container nav-mobile">
                                <?php
                                wp_nav_menu(
                                    array(
                                        'theme_location' => 'custom-header',
                                        'menu_class'     => 'login-menu',
                                        'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                    )
                                );
                                ?>
                    			</div>
                                <?php
                                wp_nav_menu(
                                    array(
                                        'theme_location' => 'header',
                                        'menu_class'     => 'main-menu',
                                        'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                    )
                                );
                                ?>

                                <div class="mobile-pre-nav">
                                    <div class="search">
                                        <span><i class="fas fa-search"></i> Search</span>
                                        <?php get_search_form(); ?>
                                    </div>
                                    <?php
                                    wp_nav_menu(
                                        array(
                                            'theme_location' => 'mini-header',
                                            'menu_class'     => 'pre-menu',
                                            'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                        )
                                    );
                                    ?>
                                </div>
                            </div>
                        </nav>
					<div class="login-menu-container">
                                <?php
                                wp_nav_menu(
                                    array(
                                        'theme_location' => 'custom-header',
                                        'menu_class'     => 'login-menu',
                                        'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                    )
                                );
                                ?>
                    </div>
					
					<!-- #site-navigation -->
                    <?php endif; ?>

                </div>
            </div>
			

        </header><!-- #masthead -->