<?php

    define("CUSTOM_CSS", "contact");
    define("CUSTOM_JS", "contact");
    get_header();

    while ( have_posts() ) :
        the_post();
        $hero = get_field('hero');
        ?>

        <section id="hero"<?php if (!get_field('show_offices')) echo 'style="margin-bottom: 100px;"'; ?>>
            <div class="inner">
                <div class="formContainer">
                    <span class="form-title"><?php the_title() ?></span>
                    <div class="formWrap">
                        <form id="mktoForm_<?= $hero['form_id'] ?>" data-mktoformid="<?= $hero['form_id'] ?>"></form>
                        <div class="formSuccess">
                            <?php include "components/success-tick.php" ?>
                            <h4>Thank you</h4>
                            <p>Your submission was successfully received and someone will be in touch shortly.</p>
                        </div>
                    </div>
                </div>

                <div class="contentBlock">
                    <h2><?= $hero['headline'] ?></h2>
                    <p><?= $hero['supporting_text'] ?></p>
                    <?php if (is_array($hero['links'])) : ?>
                    <div class="links">
                        <?php foreach ($hero['links'] as $link) : ?>
                        <a href="<?= $link['href'] ?>" class="textCta"><?= $link['label'] ?></a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        
        <?php if (get_field('show_offices')) : ?>
        <section id="offices">
            <div class="inner">
                <h4>Our Offices</h4>
                <?php
                    $locations = get_categories(array('taxonomy'=>'office-locations'));
                    foreach ($locations as $location) : 
                ?>
                <div class="location" id="<?= $location->slug ?>">
                    <span class="handle"><?= $location->name ?></span>
                    <div class="offices">
                        <div class="list">
                        <?php
                            $args = array(
                                'post_type' => 'offices',
                                'post_status' => 'publish',
                                'posts_per_page' => -1,
                                'order' => 'ASC',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'office-locations',
                                        'field' => 'slug',
                                        'terms' => $location->slug
                                    )
                                )
                            ); 
                            $offices = new WP_Query( $args );
                            while ( $offices->have_posts() ) : $offices->the_post();
                                ?>
                                <div class="office">
                                    <span class="office-name"><?= get_the_title() ?></span>
                                    <span class="office-address"><?= get_the_content() ?></span>
                                </div>
                                <?php
                            endwhile;wp_reset_query();
                        ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>

        <?php
        /* CTA BAR */
        $ctaBar = get_field('footer_bar');
        $ctaBar['id'] = "careersBar";
        include get_template_directory(). "/components/sections/cta-bar.php";
    endwhile;

    get_footer();