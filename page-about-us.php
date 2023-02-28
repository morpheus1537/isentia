<?php
    /* Template name: About us layout */

    define("CUSTOM_CSS", "about");
    get_header();

    while ( have_posts() ) :
        the_post();

        /* PAGE HEAD */
        $pageHead = get_field('page_head');
        include get_template_directory(). "/components/sections/page-head.php";

        /* ENCLOSED SPLIT */
        $enclosedSplit = get_field('enclosed_split');
        include get_template_directory(). "/components/sections/enclosed-split.php";

        /* TWO COLUMN */
        $twoColumn = get_field('two_column');
        $twoColumn['id'] = "story";
        include get_template_directory(). "/components/sections/two-column.php";

        ?>
        <section id="timeline">
            <div class="inner">
                <img src="<?= get_template_directory_uri(). "/images/about/timeline.svg" ?>" />
            </div>
        </section>
        <?php

        /* IMAGE COLLAGE */
        $imageCollage = get_field('image_collage');
        $imageCollage['id'] = "collage";
        include get_template_directory(). "/components/sections/image-collage.php";

        /* BULLET TWO COLUMN */
        $bulletsTwoColumn = get_field('bullets_two_column');
        $bulletsTwoColumn['id'] = "bullets";
        include get_template_directory(). "/components/sections/bullets-two-column.php";

        /* CONTENT IMAGE */
        $contentImage = get_field('content_image');
        $contentImage['id'] = "social";
        include get_template_directory(). "/components/sections/content-image.php";

        /* BULLET TWO COLUMN 2 */
        $bulletsTwoColumn = get_field('bullets_two_column_2');
        $bulletsTwoColumn['id'] = "unique";
        include get_template_directory(). "/components/sections/bullets-two-column.php";

        /* TWO COLUMN 2 */
        $twoColumn = get_field('two_column_2');
        $twoColumn['id'] = "trust";
        include get_template_directory(). "/components/sections/two-column.php";

        /* ICONS FOUR COLUMN */
        $iconsFourColumn = get_field('icons_four_column');
        $iconsFourColumn['id'] = "icons";
        include get_template_directory(). "/components/sections/icons-four-column.php";

    endwhile;

    get_footer();