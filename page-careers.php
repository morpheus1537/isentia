<?php
    /* Template name: Careers layout */

    define("CUSTOM_CSS", "careers");
    define("CUSTOM_JS", "careers");
    get_header();

    while ( have_posts() ) :
        the_post();

        $hero = get_field('hero');
        ?>

        <section id="hero">
            <div class="inner">
                <div class="contentBlock">
                    <h2><?= $hero['headline'] ?></h2>
                    <?= $hero['supporting_text'] ?>
                    <span class="ibtn secondary" data-scrollto="opportunities"><?= $hero['button']['label'] ?></a>
                </div>
            </div>
        </section>
        
        <?php /*<section id="video">
            <div class="inner">
                <video poster="<?= get_template_directory_uri().'/images/careers/video-splash.jpg' ?>"></video>
            </div>
        </section>*/ ?>

        <?php $business = get_field("business"); ?>
        <section id="business">
            <div class="inner">
                <div class="blocks">
                    <?php foreach ($business['blocks'] as $block) : ?>
                    <div class="block">
                        <h3 style="background-image: url(<?= $block['icon'] ?>)"><?= $block['headline'] ?></h3>
                        <?= $block['supporting_text'] ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <?php $backgrounds = get_field("backgrounds"); ?>
        <section id="backgrounds">
            <div class="inner">
                <div class="image"></div>
                <div class="contentBlock">
                    <h4><?= $backgrounds['headline'] ?></h4>
                    <?= $backgrounds['supporting_text'] ?>
                </div>
            </div>
        </section>

        <section id="teams">
            <div class="inner">
                <h3>Our teams</h3>

                <div class="teams" data-move="0">
                    <div class="block technology active" data-department="technology">
                        <h6>Technology</h6>
                        <p>Engineering in overdrove fuelling inspiring media advancements.</p>
                        <div class="links">
                            <span>No current listings</span>
                        </div>
                    </div>

                    <div class="block product" data-department="product cx & marketing">
                        <h6>Product, CX and Marketing</h6>
                        <p>The forefront of innovation, research and creating an experience that’s unique and valuable.</p>
                        <div class="links">
                            <span>No current listings</span>
                        </div>
                    </div>

                    <div class="block operations" data-department="operations">
                        <h6>Operations</h6>
                        <p>System performance optimised through resourceful practice.</p>
                        <div class="links">
                            <span>No current listings</span>
                        </div>
                    </div>

                    <div class="block sales" data-department="sales">
                        <h6>Sales</h6>
                        <p>Customer focused, commercially minded masters.</p>
                        <div class="links">
                            <span>No current listings</span>
                        </div>
                    </div>

                    <div class="block insights" data-department="insights">
                        <h6>Insights</h6>
                        <p>Empowering comprehensive data insights and ground breaking research.</p>
                        <div class="links">
                            <span>No current listings</span>
                        </div>
                    </div>

                    <div class="block corporate" data-department="corporate">
                        <h6>Corporate</h6>
                        <p>Driving best-practice in business management and leadership.</p>
                        <div class="links">
                            <span>No current listings</span>
                        </div>
                    </div>
                </div>

                <div class="teams-nav">
                    <span class="active" data-move="0"></span>
                    <span data-move="1"></span>
                    <span data-move="2"></span>
                    <span data-move="3"></span>
                    <span data-move="4"></span>
                    <span data-move="5"></span>
                </div>
            </div>
        </section>

        <?php $benefits = get_field("benefits"); ?>
        <section id="benefits">
            <div class="inner">
                <h3>Benefits</h3>

                <div class="benefits-slider">
                    <div class="benefits" data-move="0" data-max="<?= ceil(count($benefits['blocks'])/2) ?>">
                        <?php $active = ' active'; $active_mobile = ' active-mobile'; foreach ($benefits['blocks'] as $k=>$block) : ?>
                        <div class="benefit<?= $active.$active_mobile ?>">
                            <div class="image" style="background-image: url(<?= $block['image'] ?>);"></div>
                            <div class="contentBlock">
                                <h4><?= $block['headline'] ?></h4>
                                <p><?= $block['supporting_text'] ?></p>
                            </div>
                        </div>
                        <?php if ($k === 1) {$active = '';} $active_mobile = ''; endforeach; ?>
                    </div>
                    <div class="benefits-buttons">
                        <span class="prev" data-dir="-1"><i class="fas fa-chevron-left"></i></span>
                        <span class="next active" data-dir="1"><i class="fas fa-chevron-right"></i></span>
                    </div>
                    <div class="benefits-nav">
                        <?php $active = "class='active' "; for ($n=0; $n<ceil(count($benefits['blocks'])/2); $n++) : ?>
                        <span <?= $active ?>data-move="<?= $n ?>"></span>
                        <?php $active = ''; endfor; ?>
                    </div>
                    <div class="benefits-mobile-nav">
                        <?php $active = "class='active' "; for ($n=0; $n<count($benefits['blocks']); $n++) : ?>
                        <span <?= $active ?>data-move="<?= $n ?>"></span>
                        <?php $active = ''; endfor; ?>
                    </div>
                </div>
            </div>
        </section>

        <?php $testimonials = get_field('testimonials'); ?>
        <section id="testimonials">
            <div class="inner">
                <div class="testimonials">
                    <?php $active = " active"; foreach ($testimonials['quotes'] as $quote) : ?>
                        <div class="testimonial<?= $active ?>">
                            <div class="image">
                                <img src="<?= $quote['image'] ?>" />
                            </div>
                            <div class="contentBlock">
                                <div class="quote"><?= $quote['quote'] ?></div>
                                <div class="author"><?= $quote['author'] ?></div>
                                <div class="position"><?= $quote['position'] ?></div>
                                <?php if (count($testimonials['quotes']) > 1) : ?>
                                <div class="navigation">
                                    <span class="prev" data-dir="-1"><i class="fas fa-chevron-left"></i></span>
                                    <span class="next" data-dir="1"><i class="fas fa-chevron-right"></i></span>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php $active = ''; endforeach; ?>
                </div>
            </div>
        </section>
               
        <section id="opportunities">
            <div class="inner">
                <h4>Open opportunities</h4>
                <div class="filters">
                    <div class="selector"><select id="location_selection"></select></div>
                    <div class="selector"><select id="department_selection"></select></div>
                </div>
                <script>
                    var jobAdderData = '<?php echo addslashes(get_post_meta( get_the_ID(), 'jobs', true));?>';
                </script>
                <div id="listings" data-job-source="<?php
                    if( get_field('job_listing_source') == 'recruitee' ) {
                        echo 'recruitee';
                    } else if( get_field('job_listing_source') == 'jobadder' ) {
                        echo 'jobadder';
                    }
                ?>">
                    <span class="loading">Loading listings...</span>
                </div>
                <div id="listing-pagination"></div>
            </div>
        </section>

        <?php
    endwhile;

    get_footer();