<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
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
</head>

<body <?php body_class(); ?>>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NPNL894"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div id="page" class="site thin">
        <?php /*<header>
            <div id="pre-navigation">
                <div class="inner">
                    <?php if ( has_nav_menu( 'mini-header' ) ) : ?>
                        <nav class="mini-navigation" aria-label="Pre Menu">
                            <div class="menu-container">
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
                        </nav><!-- #site-navigation -->
                    <?php endif; ?>
                </div>
            </div>
        </header><!-- #masthead -->*/ ?>