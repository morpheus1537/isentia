<?php
    $image = get_the_post_thumbnail_url($post->ID, 'full');
    //if (!$image) $image = "https://via.placeholder.com/340x180";
?>
<div class="component-item"<?php if ($image) : ?> style="background-image: url(<?= $image ?>);"<?php endif ?>>
    <div class="contentBlock">
        <h6><?php the_date() ?></h6>
        <h5><?php the_title() ?></h5>
        <span class="textCta">View more</span>
    </div>
    <a href="<?= get_the_permalink(); ?>"></a>
</div>