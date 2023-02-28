<section id="headline">
    <div class="inner">
        <h6>Blog post</h6>
        <span class="date"><?php the_date('F j, Y') ?></span>
        <h2><?php the_title(); ?></h2>
    </div>
</section>
<section id="bodyCopy">
    <div class="inner">
        <?php the_content() ?>
    </div>
</section>