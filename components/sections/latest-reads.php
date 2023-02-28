<section class="sectionTemplate latestReads<?= isset($latestReads['classes']) ? " ".$latestReads['classes'] : "" ?>"<?= isset($latestReads['id']) ? " id='".$latestReads['id']."'" : "" ?>>
    <div class="inner">
        <h4>The latest reads</h4>

        <div class="articles">
        <?php
            $args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => 3,
                'order' => 'DESC', 
                'orderby' => 'date',
                'meta_query'	=> array(
                    array(
                        'key'		=> 'article_type',
                        'value'		=> 'mediarelease',
                        'compare'	=> '!='
                    )
                )
            ); 
            $latest = new WP_Query( $args );
            while ( $latest->have_posts() ) : $latest->the_post();
                get_template_part( 'templates/content', 'component-item' );
            endwhile;
            wp_reset_query();
        ?>
        </div>
    </div>
</section>