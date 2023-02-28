<?php
    /* Template name: Leadership layout */

    define("CUSTOM_CSS", "investors");
    define("CUSTOM_JS", "investors");
    get_header();

    while ( have_posts() ) :
        the_post();

        ?>
        
        <?php 
            $overview = get_field("overview");
            $sidebars = get_field("sidebars");
        ?>

        <section id="leadership-governance" class="tab-content active">
            <div class="inner">
                <div class="main-column">
                    <div class="main-section" id="executive-team">
                        <h4>Executive Team</h4>

                        <div class="team-list" data-move="0">
                            <?php
                                $args = array(
                                    'post_type' => 'team-members',
                                    'post_status' => 'publish',
                                    'posts_per_page' => -1,
                                    'order' => 'ASC',
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'team-departments',
                                            'field' => 'slug',
                                            'terms' => 'executive-team'
                                        )
                                    )
                                ); 
                                $executive_team = new WP_Query( $args );
                                $active = ' active';
                                $count = 0;
                                while ( $executive_team->have_posts() ) : $executive_team->the_post();
                                    ?>
                                    <div class="team-member<?= $active; ?>">
                                        <div class="image" style="background-image: url(<?= get_the_post_thumbnail_url($post->ID, 'full'); ?>"></div>
                                        <div class="contentBlock">
                                            <h4><?= get_the_title() ?></h4>
                                            <span><?= get_field('position'); ?></span>
                                        </div>
                                        <div class="bio-container"><div class="bio-animate">
                                            <div class="bio">
                                                <div class="image" style="background-image: url(<?= get_the_post_thumbnail_url($post->ID, 'full'); ?>"></div>
                                                <div class="detail">
                                                    <h4><?= get_the_title() ?></h4>
                                                    <span class="position"><?= get_field('position'); ?></span>
                                                    <?php the_content(); ?>
                                                </div>
                                            </div>
                                        </div></div>
                                    </div>
                                    <?php
                                    $count++;
                                    if ($count === 2) $active = '';
                                endwhile;wp_reset_query();
                            ?>
                        </div>

                        <!-- <span id="executive-nav" class="section-nav">
                            <span class="prev" data-dir="-1"><i class="fas fa-chevron-left"></i></span>
                            <span class="next" data-dir="1"><i class="fas fa-chevron-right"></i></span>
                        </span> -->
                    </div>
                </div>

                <div class="side-column">
                    <div class="side-section" id="governance-links">
                        <h4>Governance</h4>
                        <ul>
                        <?php
                            $args = array(
                                'post_type' => 'investor-files',
                                'post_status' => 'publish',
                                'posts_per_page' => -1,
                                'order' => 'ASC',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'investor-file-bucket',
                                        'field' => 'slug',
                                        'terms' => 'governance'
                                    )
                                )
                            ); 
                            $reports = new WP_Query( $args );
                            while ( $reports->have_posts() ) : $reports->the_post();
                                $url = get_field('file') ? get_field('file') : get_field('external_url');
                                ?>
                                <li><a href="<?= $url ?>"><?= get_the_title(); ?></a></li>
                                <?php
                            endwhile;wp_reset_query();
                        ?>
                        </ul>
                    </div>
                    <div class="side-section callout">
                        <h4>Governance Contact</h4>
                        <?= $sidebars['contacts']['governance'] ?>
                    </div>
                </div>
            </div>
        </section>

        <?php
    endwhile;

    get_footer();