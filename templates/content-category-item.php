<div class="category-item">
    <?php 
        $image = get_the_post_thumbnail_url($post->ID, 'full');
        //if (!$image) $image = "https://via.placeholder.com/255x170";
    ?>
    <?php if ($image) : ?><div class="visual" style="background-image: url(<?= $image ?>);"></div><?php endif; ?>
    <div class="contentBlock">
        <h5><?php the_title(); ?></h5>
    </div>
    <a href="<?= get_the_permalink(); ?>"></a>
</div>