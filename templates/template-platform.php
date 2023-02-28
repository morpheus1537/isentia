<?php
    /* Template Name: Platform Template */

    define("CUSTOM_CSS", "platform");
    define("CUSTOM_JS", "platform");
    get_header();

    while ( have_posts() ) :
        the_post();
        
        /* PAGE HEAD */
        $pageHead = get_field('page_head');
        $pageHead['classes'] = "border";
        $pageHead['id'] = $post->post_name."-hero";
        $pageHeadImage = $pageHead;
        include get_template_directory(). "/components/sections/page-head-platform.php";


        $page_sections = get_field('page_section');
        $section_count = 0;
        $override_alignment = false;
        $override_background = false;
        // echo "<pre>";
        // print_r($page_sections);
        // echo "</pre>";
        if (count($page_sections) > 0) :
            //Simple yet section
            if ($page_sections['two_block_content']) {

                ?>

                <section id="section-simple" class="blue">
                    <div class="inner spacer bottom blue">
                        <div class="content">
                            <div class="contentBlock"><?php echo $page_sections['two_block_content']['left_block']; ?></div>
                            <div class="visual contain"><?php echo $page_sections['two_block_content']['right_block']; ?></div>
                        </div>
                    </div>
                </section>

            <?php }

            //Discover what's new section
            if ($page_sections['icons_six_column']) {
                $blocks =  $page_sections['icons_six_column']['blocks'];
                ?>
                <section id="discover" class="sectionTemplate <?php echo isset($tabbedContentImage['classes']) ? "".$tabbedContentImage['classes'] : "" ?>"<?= isset($tabbedContentImage['id']) ? ' id="'.$tabbedContentImage['id'].'"' : "" ?>>
                    <div class="inner">
                        <?php echo '<h2 class="heading">'. $page_sections['icons_six_column']['headline'] . '</h2>'; ?>
                        <div class="content">
                            <div class="wrapper-left">
                                <div class="sectionNav">
                                    <?php
                                    $count = 0;
                                    foreach ($blocks as $block) {
                                        $active = ($count == 0) ? ' active' : '';
                                        echo '<div class="sectionItem hoverMenu ' . $active . '" data-section="discover-' . $count . '"><div class="contentIcon">';
                                        echo "<img src='" . $block['icon_white'] . "' class='white-icon' alt='white-icon'/>";
                                        echo "<img src='" . $block['icon_black'] . "' class='black-icon' alt='black-icon'/>";
                                        echo '</div><div class="contentBlock">';
                                        echo "<h4>" . $block['headline_box'] . "</h4>";
                                        echo $block['content_box'];
                                        echo "</div></div>";
                                        $count++;
                                    } ?>
                                </div>
                            </div>
                            <div class="wrapper-right">
                                <div class="sections">
                                    <?php
                                    $count = 0;
                                    foreach ($blocks as $block) {
                                        $active = ($count == 0) ? ' active' : '';
                                        echo '<div class="section hoverMenuItem ' . $active . '" data-section="discover-' . $count . '"><div class="visual"><img src="' . $block['image_box'] . '" class="image-side"/></div></div>';
                                        $count++;
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php
            }

            //Make it your own section
            if ($page_sections['centered_content']) { ?>

            <section id="section-own">
                <div class="inner">
                    <div class="content">
                        <div class="contentBlock"><?php echo $page_sections['centered_content']['content']; ?></div>
                        <div class="visual contain"><p><img src='<?php echo $page_sections['centered_content']['image']; ?>' alt='image-white-bg' class='simple-image'/></p></div>
                    </div>
                </div>
            </section>

            <?php }

            //Fully supported section
            if ($page_sections['two_block_content_2']) {              
                ?>

                <section id="section-supported" class="blue">
                    <div class="inner spacer top white">
                        <div class="content">
                            <div class="contentBlock"><?php echo $page_sections['two_block_content_2']['left_block']; ?></div>
                            <div class="visual overflow"><?php echo $page_sections['two_block_content_2']['right_block']; ?></div>
                        </div>
                    </div>
                </section>

            <?php }

            //Testimonials
            if ($page_sections['testimonial']) { 
                $blocks = $page_sections['testimonial']['blocks'];
                if ( !empty($blocks) ) { ?>
                    <section id="section-testimonial">
                        <div class="inner">
                            <div class="content">
                                <h3 class="title">Testimonials</h3>
                                <h4 class="subtitle"><?php echo $page_sections['testimonial']['supporting_text']; ?></h4>
                                <div class='contentBlock'>
                                    <?php
                                    foreach ($blocks as $block) { ?>
                                        <div class="block-testimonial" style="background-image: url(<?= get_template_directory_uri() . '/images/platform/quote.png' ?>);">
                                            <p><?= $block['quote']; ?></p>
                                            <p><?= $block['author']; ?></p>
                                            <p><?= $block['position']; ?></p>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </section>
                            <?php
                        }
                    }
                    
                    //Ready get started
                    if ($page_sections['two_block_content_3']) {
                        ?>
                        <section id="section-get-started" class="white">
                            <div class="inner <?= !empty($page_sections['testimonial']['blocks']) ? 'spacer line' : ''; ?>">
                                <div class="content">
                                    <div class="contentBlock"><?php echo $page_sections['two_block_content_3']['left_block']; ?></div>
                                    <div class="visual"><?php echo $page_sections['two_block_content_3']['right_block']; ?></div>
                                </div>
                            </div>
                        </section>
            <?php }

        endif;

        /* CTA BAR */
        // $ctaBar = array(
        //     'headline' => "Ready to get started?",
        //     'supporting_text' => "<p>Get in touch or request a demo.</p>",
        //     "buttons" => array(
        //         array(
        //             'href' => site_url('/contact-us/'),
        //             'label' => 'Contact us',
        //             'btn_type' => 'secondary'
        //         ),
        //         array(
        //             'href' => site_url('/request-a-demo/'),
        //             'label' => 'Request a demo',
        //             'btn_type' => 'primary'
        //         )
        //     )
        // );
        // include get_template_directory(). "/components/sections/cta-bar.php";

    endwhile;

    get_footer();