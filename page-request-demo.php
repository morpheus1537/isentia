<?php
    /* Template name: Request Demo layout */

    define("CUSTOM_CSS", "contact");
    define("CUSTOM_JS", "contact");
    get_header();

    while ( have_posts() ) :
        the_post();
        $hero = get_field('hero');
        $form_id = $isentia_func->get_locale_form_id($hero['form_ids']);
        // echo json_encode($hero['form_ids']);
        ?>

        <section id="hero"<?php if (!get_field('show_offices')) echo 'style="margin-bottom: 100px;"'; ?> class="request-demo">
            <div class="inner">
                <div class="formContainer">
                <h1><?= $hero['headline'] ?></h1>
                <?= $hero['supporting_text'] ?>
                    <div class="formWrap">
                        <form id="mktoForm_<?= $form_id ?>" data-mktoformid="<?= $form_id ?>"></form>
                        <div class="formSuccess">
                            <?php include "components/success-tick.php" ?>
                            <h4>Thank you</h4>
                            <p>Your submission was successfully received and someone will be in touch shortly.</p>
                        </div>
                        <p class="have-account">Already have an account? <a href="/login">Log in</a></p>
                    </div>
                </div>

                <div class="contentBlock">
                <h2><?= $hero['headline_2'] ?></h2>
                <?= $hero['supporting_text_2'] ?>

                <?php
                    $hero = get_field('hero');
                    $list_items = $hero['list_items'];

                    if ($list_items) {
                    echo '<ul>';
                    foreach ($list_items as $list_item) {
                        $text = $list_item['text'];
                        echo '<span><li>' . $text . '</li></span>';
                    }
                    echo '</ul>';
                    }
                    ?>

                    <?php
                    $hero = get_field('hero');
                    $logos = $hero['logo'];

                    if ($logos) {
                    echo '<div class="contact-img">';
                    foreach ($logos as $logo) {
                        $image = $logo['image'];
                        echo '<img src="' . $image['url'] .'">';
                    }
                    echo '</div>';
                    }
                ?>
                
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