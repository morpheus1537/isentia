<?php
    /* Template name: Investors layout */

    define("CUSTOM_CSS", "investors");
    define("CUSTOM_JS", "investors");
    get_header();

    $tabs = array(
        "investor-overview",
        "latest-news", //Couldnt change to announcement ID because it's used in another element
        "leadership-governance"
    );
    $tab = get_query_var('tab');
    if (!$tab || !in_array($tab, $tabs)) $tab = "investor-overview";

    while ( have_posts() ) :
        the_post();

        $hero = get_field("hero");
        ?>

        <section id="hero">
            <div class="inner">
                <h1 class="h4">Investor Centre</h1>
                <h2><?= $hero['headline'] ?></h2>
                <div class="stats">
                    <?php foreach ($hero['stats'] as $stat) : ?>
                    <div class="stat">
                        <span class="figure"><?= $stat['figure'] ?></span>
                        <span class="label"><?= $stat['label'] ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?= $hero['supporting_text'] ?>
            </div>
        </section>

        <section id="tabs">
            <div class="inner">
                <div class="tab<?= $tab === "investor-overview" ? " active" : "" ?>" data-tab="investor-overview"><span><span>Investor Overview</span></span></div>
                <div class="tab<?= $tab === "latest-news" ? " active" : "" ?>" data-tab="latest-news"><span><span>Announcements</span></span></div>
                <div class="tab<?= $tab === "leadership-governance" ? " active" : "" ?>" data-tab="leadership-governance"><span><span>Leadership & Governance</span></span></div>
            </div>
        </section>

        <?php 
            $overview = get_field("overview");
            $sidebars = get_field("sidebars");
        ?>
        <section id="investor-overview" class="tab-content<?= $tab === "investor-overview" ? " active" : "" ?>">
            <div class="inner">
                <div class="main-column">
                <?php
                    $list_items = array();
                    $fy_items = array();
                    $args = array(
                        'post_type' => 'investor-files',
                        'post_status' => 'publish',
                        'posts_per_page' => -1,
                        'order' => 'ASC',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'investor-file-bucket',
                                'field' => 'slug',
                                'terms' => 'presentations'
                            )
                        )
                    ); 
                    $presentations = new WP_Query( $args );
                    if ($presentations->have_posts()) : ?>
                    <div class="main-section" id="investor-presentations">
                        <h4>Investor Presentations</h4>
                        <?php
                            while ( $presentations->have_posts() ) : $presentations->the_post();
                                $url = get_field('file') ? get_field('file') : get_field('external_url');
                                $fy_items[get_field('financial_year')] = '<option value="'.get_field('financial_year').'">FY'.get_field('financial_year').'</option>';
                                $list_items[] = '<li data-fy="'.get_field('financial_year').'"><a href="'.$url.'" target="_blank" rel="nofollow noopener">'.get_the_title().'</a></li>';
                            endwhile;
                            krsort($fy_items);
                        ?>
                        <div class="filters">
                            <div class="selector">
                                <select id="presentation_filter">
                                    <?= implode("", $fy_items) ?>
                                </select>
                            </div>
                        </div>
                        <div class="table_data">
                            <ul>
                            <?= implode("", $list_items) ?>
                            </ul>
                        </div>
                    </div>
                    <?php endif;wp_reset_query(); ?>

                    <?php
                    $list_items = array();
                    $fy_items = array();
                    $args = array(
                        'post_type' => 'investor-files',
                        'post_status' => 'publish',
                        'posts_per_page' => -1,
                        'order' => 'ASC',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'investor-file-bucket',
                                'field' => 'slug',
                                'terms' => 'results-reports'
                            )
                        )
                    ); 
                    $reports = new WP_Query( $args );
                    if ($reports->have_posts()) : ?>
                    <div class="main-section" id="result-reports">
                        <h4>Results & Reports</h4>
                        <?php
                            while ( $reports->have_posts() ) : $reports->the_post();
                                $url = get_field('file') ? get_field('file') : get_field('external_url');
                                $fy_items[get_field('financial_year')] = '<option value="'.get_field('financial_year').'">FY'.get_field('financial_year').'</option>';
                                $list_items[] = '<li data-fy="'.get_field('financial_year').'"><a href="'.$url.'" target="_blank" rel="nofollow noopener">'.get_the_title().'</a></li>';
                            endwhile;
                            krsort($fy_items);
                            
                        ?>
                        <div class="filters">
                            <div class="selector">
                                <select id="reports_filter">
                                    <?= implode("", $fy_items) ?>
                                </select>
                            </div>
                        </div>
                        <div class="table_data">
                            <ul>
                            <?= implode("", $list_items) ?>
                            </ul>
                        </div>
                    </div>
                    <?php endif; wp_reset_query(); ?>

                    <div class="main-section" id="key-dates">
                        <h4>Key Dates</h4>
                        <div class="table_data">
                            <ul>
                                <?php 
                                    if ($overview['key_dates'] && count($overview['key_dates']) > 0) :
                                        foreach ($overview['key_dates'] as $date) : ?>
                                <li>
                                    <strong><?= $date['headline'] ?></strong>
                                    <span class="date"><?= $date['date'] ?></span>
                                </li>
                                <?php endforeach; else : ?>
                                <li>No current key dates</li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>

                    <div class="main-section" id="alerts">
                        <h4><?= $overview['details']['headline'] ?></h4>
                        <?= $overview['details']['supporting_text'] ?>
                    </div>
                </div>

                <div class="side-column">
                    <div class="side-section">
                        <h4>ASX Share Price</h4>
                        <iframe width="100%" frameborder="0" loading="lazy" allowtransparency="true" class="sharelink" scrolling="no" style="width: 1px;min-width: 100%;" src="https://app.sharelinktechnologies.com/widget/c2178205-0052-4b29-890c-0440f94e6a88"></iframe>
                    </div>

                    <a href="<?= $sidebars['investor_fact_sheet_link'] ?>" class="ibtn primary large">Download Investor Fact Sheet</a>

                    <div class="side-section callout">
                        <h4>Investor Contact</h4>
                        <?= $sidebars['contacts']['investor'] ?>
                    </div>
                </div>
            </div>
        </section>

        <section id="latest-news" class="tab-content<?= $tab === "latest-news" ? " active" : "" ?>">
            <div class="inner">
                <div class="main-column">
                    <div class="main-section" id="media-releases">
                        <div class="headline">
                            <h4>Media Releases</h4>
                            <div class="search">
                                <span><i class="fas fa-search"></i> Search</span>
                                <form role="search" method="get" id="searchform" class="searchform" action="<?= home_url( '/' ) ?>" >
                                    <input type="search" placeholder="Search..." value="" name="s" />
                                    <input type="hidden" name="meta_key" value="article_type" />
                                    <input type="hidden" name="meta_value" value="mediarelease" />
                                    <input type="submit" id="searchsubmit" value="Search" />
                                </form>
                            </div>
                        </div>
                        
                        <div class="posts">
                            <?php
                                $args = array(
                                    'post_type' => 'post',
                                    'post_status' => 'publish',
                                    'order' => 'DESC',
                                    'meta_query'	=> array(
                                        array(
                                            'key'		=> 'article_type',
                                            'value'		=> 'mediarelease',
                                            'compare'	=> '='
                                        )
                                    )
                                ); 
                                $media_releases = new WP_Query( $args );
                                while ( $media_releases->have_posts() ) : $media_releases->the_post();
                                    get_template_part( 'templates/content', 'investor-media-item' );
                                endwhile;wp_reset_query(); ?>
                        </div>
                        <?php if ($media_releases->max_num_pages > 1) :?>
                        <div id="loader">
                            <span class="ibtn secondary large" id="loaderAction" data-maxpages="<?= $wp_query->max_num_pages ?>">Load more</span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="side-column">
                    <div class="side-section">
                        <h4>ASX Announcements</h4>
                        <iframe width="100%" frameborder="0" loading="lazy" allowtransparency="true" class="sharelink" scrolling="no" style="width: 1px;min-width: 100%;" src="https://app.sharelinktechnologies.com/widget/d9ebda6b-6318-4b2f-aacf-5519f42a875c"></iframe>
                    </div>
                    <div class="side-section callout">
                        <h4>Media Contact</h4>
                        <?= $sidebars['contacts']['media'] ?>
                        <h4>Investor Contact</h4>
                        <?= $sidebars['contacts']['investor'] ?>
                    </div>
                </div>
            </div>
        </section>

        <section id="leadership-governance" class="tab-content<?= $tab === "leadership-governance" ? " active" : "" ?>">
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

                        <span id="executive-nav" class="section-nav">
                            <span class="prev" data-dir="-1"><i class="fas fa-chevron-left"></i></span>
                            <span class="next" data-dir="1"><i class="fas fa-chevron-right"></i></span>
                        </span>
                    </div>

                    <div class="main-section" id="board-team">
                        <h4>Board of Directors</h4>

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
                                            'terms' => 'board-of-directors'
                                        )
                                    )
                                ); 
                                $board_members = new WP_Query( $args );
                                $active = ' active';
                                $count = 0;
                                while ( $board_members->have_posts() ) : $board_members->the_post();
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

                        <span id="directors-nav" class="section-nav">
                            <span class="prev" data-dir="-1"><i class="fas fa-chevron-left"></i></span>
                            <span class="next" data-dir="1"><i class="fas fa-chevron-right"></i></span>
                        </span>
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