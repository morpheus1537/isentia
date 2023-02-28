<?php
    $image = get_the_post_thumbnail_url($post->ID, 'full');
    //if (!$image) $image = "https://via.placeholder.com/340x180";
?>
<div class="post">
    <?php if ($image) : ?><div class="image" style="background-image: url(<?= $image ?>);"></div><?php endif; ?>
    <div class="contentBlock">
        <h5><?php the_title() ?></h5>
        <?php the_excerpt(); ?>
    </div>
    <a href="<?= get_the_permalink(); ?>"></a>
</div>