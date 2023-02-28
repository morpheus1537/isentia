<?php
    define("CUSTOM_CSS", "latest-reads");
    define("CUSTOM_JS", "latest-reads");
    get_header();

    ?>
    <section id="all-posts">
        <div class="inner">
            <h3>Found articles for "<?= get_search_query() ?>"</h3>
            <div id="filterBar">
                <div class="socials">
                    <span>Follow Us</span>
                    <a href="https://www.instagram.com/isentia_" class="instagram"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.twitter.com/isentia/" class="twitter"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.facebook.com/isentiacom/" class="facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.youtube.com/Isentia" class="youtube"><i class="fab fa-youtube"></i></a>
                    <a href="https://www.linkedin.com/company/isentia" class="linkedin"><i class="fab fa-linkedin"></i></a>
                    <a href="https://www.weibo.com/isentia/" class="weibo"><i class="fab fa-weibo"></i></a>
                </div>
            </div>
            <?php
                global $wp_query;

                if ( have_posts() ) {
                    ?><div class="articles"><?php
                    // Load posts loop.
                    while ( have_posts() ) {
                        the_post();
                        get_template_part( 'templates/content', 'category-item' );
                    }
                    ?></div>
                    <?php
                        if ($wp_query->max_num_pages > 1) :
                    ?>
                    <div id="loader">
                        <span class="ibtn secondary large" id="loaderSearchAction" data-maxpages="<?= $wp_query->max_num_pages ?>">Load more</span>
                    </div>
                    <?php
                    endif;
                } else {

                    // If no content, include the "No posts found" template.
                    get_template_part( 'templates/content', 'none' );

                }
            ?>
            </div>
        </div>
    </section>
    
<?php
    get_footer();
