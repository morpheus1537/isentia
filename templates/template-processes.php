<?php
    /* Template Name: Processes Template */

    define("CUSTOM_CSS", "processes");
    get_header();

    $section_map = array(
        'content_image' => array(
            'variable' => 'contentImage',
            'file' => 'content-image'
        ),
        'content_video' => array(
            'variable' => 'contentVideo',
            'file' => 'content-video'
        ),
        'bullets_two_column' => array(
            'variable' => 'bulletsTwoColumn',
            'file' => 'bullets-two-column'
        ),
        'content_testimonial' => array(
            'variable' => 'contentTestimonial',
            'file' => 'content-testimonial'
        ),
        'centered_content' => array(
            'variable' => 'centeredContent',
            'file' => 'centered-content'
        ),
        'two_column' => array(
            'variable' => 'twoColumn',
            'file' => 'two-column'
        ),
        'two_block_content' => array(
            'variable' => 'twoBlockContent',
            'file' => 'two-block-content'
        ),
        'showcase_image' => array(
            'variable' => 'showcaseImage',
            'file' => 'showcase-image'
        ),
        'testimonial' => array(
            'variable' => 'testimonial',
            'file' => 'testimonial'
        ),
        'icons_four_column' => array(
            'variable' => 'iconsFourColumn',
            'file' => 'icons-four-column'
        ),
        'column_content' => array(
            'variable' => 'columnContent',
            'file' => 'column-content'
        ),
        'flow' => array(
            'variable' => 'flow',
            'file' => 'flow'
        ),
        'latest_reads' => array(
            'variable' => 'latestReads',
            'file' => 'latest-reads'
        ),
    );

    while ( have_posts() ) :
        the_post();
        
        /* PAGE HEAD */
        $pageHead = get_field('page_head');
        $pageHead['classes'] = "border";
        $pageHead['id'] = $post->post_name."-hero";
        if ($pageHead['image_layout']) {
            $pageHeadImage = $pageHead;
            include get_template_directory(). "/components/sections/page-head-image.php";
        } else {
            include get_template_directory(). "/components/sections/page-head.php";
        }

        $page_sections = get_field('page_sections');
        $section_count = 0;
        $override_alignment = false;
        $override_background = false;
        if (count($page_sections) > 0) :
            foreach ($page_sections as $section) :
                $classes = array();
                $section_count++;

                if ($section['override_section_alignment']) $override_alignment = $override_alignment ? false : true;
                if ($section['override_section_background']) $override_background = $override_background ? false : true;
                if ($override_alignment) $classes[] = 'override-alignment';
                if ($override_background) $classes[] = 'override-background';

                if ($section_count % 2 === 0) $classes[] = 'reverse';
	
				if ($section['section_type'] !== 'latest_reads') {
                	if (!is_array($section[$section['section_type']])) $section[$section['section_type']] = array();
				}	else {
					$section[$section['section_type']] = array();
				}
                ${$section_map[$section['section_type']]['variable']} = array_merge($section[$section['section_type']], array('id' => $section['section_key'], 'classes' => implode(' ', $classes)));
                include get_template_directory(). "/components/sections/".$section_map[$section['section_type']]['file'].".php";
				
            endforeach;
        endif;

        /* CTA BAR */
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

    endwhile;

    get_footer();