<?php
    get_header();

    while ( have_posts() ) :
        the_post();
        ?>
        <section id="content">
            <div class="inner">
                <h1><?php the_title(); ?></h1>
                <?php the_content(); ?>
            </div>
        </section>
        <?php
    endwhile;

    get_footer();