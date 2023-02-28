<?php
    define("CUSTOM_CSS", "latest-reads");
    define("CUSTOM_JS", "latest-reads");
    get_header();

    ?>
    <section id="featured-posts">
        <div class="inner">
            <h3>Latest reads</h3>
            <div class="featured-items">
                <?php
                    $args = array(
                        'post_type' => 'post',
                        'post_status' => 'publish',
                        'posts_per_page' => 2,
                        'order' => 'ASC',
                        'cat' => 1,
                        'meta_query'	=> array(
                            array(
                                'key'		=> 'article_type',
                                'value'		=> 'mediarelease',
                                'compare'	=> '!='
                            )
                        )
                    ); 
                    $featured = new WP_Query( $args );
                    while ( $featured->have_posts() ) : $featured->the_post();
                        get_template_part( 'templates/content', 'featured-item' );
                    endwhile;
                    wp_reset_query();
                ?>
            </div>
        </div>
    </section>

	<section id="all-posts">
	<div class="inner">
	<div class="filter-article">
	<h3>All Articles</h3>
	<div class="socials">
                    <span>Follow Us</span>
                    <a href="https://www.twitter.com/isentia/" class="twitter"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.facebook.com/isentiacom/" class="facebook"><i class="fab fa-facebook-f">						</i></a>
                    <a href="https://www.youtube.com/Isentia" class="youtube"><i class="fab fa-youtube"></i></a>
                    <a href="https://www.linkedin.com/company/isentia" class="linkedin"><i class="fab fa-linkedin">						</i></a>
    </div>
	</div>
		<?php echo do_shortcode('[caf_filter id="22204"]'); ?>
						<style>
							ul#caf-layout-pagination.post-layout1 {
								margin-top: 75px!important;
							}
							
							#caf-filter-layout1 li a {
								font-weight: 400!important;
							}
							.caf-post-layout1 .manage-layout1 {
								box-shadow: unset!important;
							}

							.caf-post-layout1 div#manage-post-area .caf-meta-content {
								display: none;
							}

							.caf-post-layout1 div#manage-post-area .caf-content {
								display: none;
							}

							.caf-post-layout1 div#manage-post-area .caf-content-read-more {
								display: none;
							}
							
							.filter-article {
								display: flex;
								justify-content: space-between;
								align-items: center;
							}
							.filter-article .socials span {
								font-size: 14px;
							}
							section .filter-article .socials a {
								color: #525a65;
								margin-left: 15px;
								font-size: 1.4em;
							}
							.filter-article h3 {
								margin-bottom: unset;
							}
						</style>
		</div>
	</section>
    
<?php
    get_footer();
