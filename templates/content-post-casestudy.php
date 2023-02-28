<?php
$section_map = array(
    'showcase_image' => array(
        'variable' => 'showcaseImage',
        'file' => 'showcase-image'
    ),
    'testimonial' => array(
        'variable' => 'testimonial',
        'file' => 'testimonial'
    ),
    'centered_content' => array(
        'variable' => 'centeredContent',
        'file' => 'centered-content'
    ),
    'content_image' => array(
        'variable' => 'contentImage',
        'file' => 'content-image'
    ),
    'bullets_two_column' => array(
        'variable' => 'bulletsTwoColumn',
        'file' => 'bullets-two-column'
    ),
    'content_testimonial' => array(
        'variable' => 'contentTestimonial',
        'file' => 'content-testimonial'
    ),
    'two_column' => array(
        'variable' => 'twoColumn',
        'file' => 'two-column'
    ),
    'two_block_content' => array(
        'variable' => 'twoBlockContent',
        'file' => 'two-block-content'
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
);
?>

<section id="headline">
    <div class="inner">
        <div class="cs-intro">
            <div class="contentBlock">
                <h6>Case Study</h6>
                <h2><?php the_title(); ?></h2>
                <?= get_field('supporting_text') ?>
            </div>

<?php if(get_field('client_name')) : ?>
            <div class="highlight-client">
                <h6>Client</h6>
                <span class="client-name"><?= get_field('client_name'); ?></span>
                <?php $btn = get_field('button') ?>
                <a class="ibtn primary alt" href="<?= $btn['href'] ?>"><?= $btn['label'] ?></a>


				<?php if(get_field('modal_window')){ ?>
					
	                <a class="ibtn primary alt open-modal" href="#" data-modalid="case_study"><?= get_field('modal_window')['button_label'] ?></a>

				<?php } ?>



                <?php if (get_field('awards')) : ?>
                <div class="awards">
                <?php foreach (get_field('awards') as $award) : ?>
                    <span class="award">
                        <i class="fas fa-trophy"></i> <?= $award['award_name'] ?>
                    </span>
                <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
<?php else : ?>
    <div></div>
<?php endif; ?>

        </div>
        
    </div>
</section>

<?php if(get_field('modal_window')){ ?>
	<div class="modal" data-modalid="case_study">
		<div class="outer-content">
			<div class="content">
				<div class="videowrap">
					<iframe width="560" height="315" src="https://www.youtube.com/embed/<?= get_field('modal_window')['youtube_id'] ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>
				<div class="caption">
					<h4><?= get_field('modal_window')['caption_heading'] ?></h4>
			
					<p><?= get_field('modal_window')['caption_body'] ?></p>
				</div>
			</div>
		</div>
		<div class="overlay"></div>
		<a href="#" class="close-modal">Close</a>
	</div>

<?php } ?>



<div class="sections">
        <div class="inner">
        <?php the_content() ?>
    </div>
<?php
// $page_sections = get_field('sections');
// $section_count = 0;
// $override_alignment = false;
// $override_background = false;
// if (count($page_sections) > 0) :
//     foreach ($page_sections as $section) :
//         $classes = array();
//         $section_count++;

//         if ($section['override_section_alignment']) $override_alignment = $override_alignment ? false : true;
//         if ($section['override_section_background']) $override_background = $override_background ? false : true;
//         if ($override_alignment) $classes[] = 'override-alignment';
//         if ($override_background) $classes[] = 'override-background';

//         if ($section_count % 2 === 0) $classes[] = 'reverse';
//         if (!is_array($section[$section['section_type']])) $section[$section['section_type']] = array();
//         ${$section_map[$section['section_type']]['variable']} = array_merge($section[$section['section_type']], array('id' => $section['section_key'], 'classes' => implode(' ', $classes)));
//         include get_template_directory(). "/components/sections/".$section_map[$section['section_type']]['file'].".php";

//     endforeach;
// endif;
?>
</div>