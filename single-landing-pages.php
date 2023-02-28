<?php
    define("CUSTOM_CSS", "landing-pages");
    define("CUSTOM_JS", "landing-pages");

    $section_map = array(
        'tabbed_content_image' => array(
            'variable' => 'tabbedContentImage',
            'file' => 'tabbed-content-image'
        ),
        'logo_strip' => array(
            'variable' => 'logoStrip',
            'file' => 'logo-strip'
        ),
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
        $pageHeadForm = get_field('page_head');

        $header = null;
        if ($pageHeadForm['hide_nav']) $header = "nonav";
        get_header($header);

        /* PAGE HEAD */
        $pageHeadForm['classes'] = $pageHeadForm['colour_theme']." ".$header;
        $pageHeadForm['id'] = $post->post_name."-hero";
        if (is_array($pageHeadForm['form_ids']) && count($pageHeadForm['form_ids']) > 0)
            $pageHeadForm['form_id'] = $isentia_func->get_locale_form_id($pageHeadForm['form_ids']);
        $attrs = '';
        if ($pageHeadForm['background_image']) $attrs .= "background-image: url(".$pageHeadForm['background_image'].");";
        if ($pageHeadForm['background_colour']) $attrs .= "background-color: ".$pageHeadForm['background_colour'].";";
        $pageHeadForm['attrs'] = "style='".$attrs."'";
        include get_template_directory(). "/components/sections/page-head-form.php";

        /* PAGE SECTIONS */
        $page_sections = get_field('page_sections');
        $section_count = 0;
        $override_alignment = false;
        $override_background = false;
        if (count($page_sections) >= 0) :
            foreach ($page_sections as $section) :
                $classes = array();
                $section_count++;

                if ($section['override_section_alignment']) $override_alignment = $override_alignment ? false : true;
                if ($section['override_section_background']) $override_background = $override_background ? false : true;
                if ($override_alignment) $classes[] = 'override-alignment';
                if ($override_background) $classes[] = 'override-background';

                if ($section_count % 2 === 0) $classes[] = 'reverse';
                if (!is_array($section[$section['section_type']])) $section[$section['section_type']] = array();
                ${$section_map[$section['section_type']]['variable']} = array_merge($section[$section['section_type']], array('id' => $section['section_key'], 'classes' => implode(' ', $classes)));
                include get_template_directory(). "/components/sections/".$section_map[$section['section_type']]['file'].".php";

            endforeach;
        endif;

        /* CTA BLOCK */

        $ctaBar = get_field('cta_bar');
        $ctaBar['classes'] = "single";
        include get_template_directory(). "/components/sections/cta-bar.php";

        get_footer();

    endwhile;

    
    