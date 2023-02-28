<?php

    define("CUSTOM_CSS", "articles");
    define("CUSTOM_JS", "articles");
    get_header();

    while ( have_posts() ) :
        the_post();
        $hero = get_field('hero_image');
        //if (!$hero) $hero = "https://via.placeholder.com/1200x250";
        $type = get_field('article_type'); ?>

        <section id="hero">
            <div class="inner">
                <a href="<?= site_url('/latest-reads/'); ?>" class="textCta reverse">Back to all articles</a>
                <?php if ($hero) : ?>
                <div class="hero-image" style="background-image: url('<?= $hero ?>');'"></div>
                <?php endif; ?>
            </div>
        </section>
<style>

section#bodyCopy div.inner ul li {
    color: #525a65;
    padding-left: 30px;
    background: url(/wp-content/themes/isentia/images/global/bullet-tick.svg) no-repeat left top 4px/20px 20px;
    margin-bottom: 15px;
}

</style>

        <div id="articleType-<?= $type ?>">
            <?php get_template_part( 'templates/content', 'post-'.$type ); ?>

            <section id="similar-posts">
                <div class="inner">
                    <div class="socials">
                        <span>Share</span>
                        <a href="https://twitter.com/intent/tweet?text=<?= urlencode(get_the_title()) ?>&url=<?= urlencode(get_the_permalink()) ?>&via=isentia" class="twitter" target="_blank" rel="noopener noreferrer"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.facebook.com/share.php?u=<?= urlencode(get_the_permalink()) ?>&title=<?= urlencode(get_the_title()) ?>" class="facebook" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a>
                        <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?= urlencode(get_the_permalink()) ?>&title=<?= urlencode(get_the_title()) ?>&source=<?= urlencode(get_the_permalink()) ?>" class="linkedin" target="_blank" rel="noopener noreferrer"><i class="fab fa-linkedin"></i></a>
                        <!--<a href="http://service.weibo.com/share/share.php?url=<?= urlencode(get_the_permalink()) ?>&title=<?= urlencode(get_the_title()) ?>" class="weibo" target="_blank" rel="noopener noreferrer"><i class="fab fa-weibo"></i></a>--->
                    </div>

                    <?php if ($type !== 'mediarelease') : ?>
                    <div class="similar-articles">
                        <h3>Similar articles</h3>
                        <div class="articles">
                            <?php 
                                $total_needed = 4;
                                $articles = array();

                                // MANUAL POSTS
                                $manual_articles = get_field("similar_articles");
                                if (is_array($manual_articles)) {
                                    foreach ($manual_articles as $article) {
                                        $articles[] = $article;
                                    }
                                }

                                // RELATED BY TAG
                                if (count($articles) < $total_needed) {
                                    $tags = wp_get_post_tags($post->ID);
                                    $needed = $total_needed - count($articles);
                                    if ($tags) {
                                        $first_tag = $tags[0]->term_id;
                                        $args=array(
                                        'tag__in' => array($first_tag),
                                        'post__not_in' => array($post->ID),
                                        'posts_per_page'=>$needed,
                                        'caller_get_posts'=>1
                                        );
                                        $related_query = new WP_Query($args);
                                        if( $related_query->have_posts() ) {
                                            while ($related_query->have_posts()) : $related_query->the_post(); 
                                                $articles[] = get_post(get_the_ID());
                                            endwhile;
                                        }
                                        wp_reset_query();
                                    }
                                }

                                // RELATED BY CATEGORY
                                if (count($articles) < $total_needed) {
                                    $categories = wp_get_post_categories($post->ID);
                                    $needed = $total_needed - count($articles);
                                    if ($categories) {
                                        $first_category = $categories;
                                        $args=array(
                                        'category__in' => array($first_category),
                                        'post__not_in' => array($post->ID),
                                        'posts_per_page'=>$needed,
                                        'caller_get_posts'=>1
                                        );
                                        $related_query = new WP_Query($args);
                                        if( $related_query->have_posts() ) {
                                            while ($related_query->have_posts()) : $related_query->the_post(); 
                                                $articles[] = get_post(get_the_ID());
                                            endwhile;
                                        }
                                        wp_reset_query();
                                    }
                                }

                                foreach ($articles as $article) {
                                    $post = $article;
                                    setup_postdata($post);
                                    get_template_part( 'templates/content', 'similar-item' );
                                }
                                wp_reset_query();
                            ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </section>
            <?php
            $ctaBar = array(
                'headline' => "Ready to get started?",
                'supporting_text' => "<p>Get in touch or request a demo.</p>",
                "buttons" => array(
                    array(
                        'href' => site_url('/contact-us/'),
                        'label' => 'Contact us',
                        'btn_type' => 'secondary'
                    ),
                    array(
                        'href' => site_url('/request-a-demo/'),
                        'label' => 'Request a demo',
                        'btn_type' => 'primary'
                    )
                )
            );
            include get_template_directory(). "/components/sections/cta-bar.php";
            ?>
        </div>
    <?php endwhile;
    
    get_footer();