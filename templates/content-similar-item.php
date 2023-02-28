<?php  if (isset($post->ID)): ?>
<?php
    $image = get_the_post_thumbnail_url($post->ID, 'full');
    //if (!$image) $image = "https://via.placeholder.com/340x180";
?>
<div style="display:none;"><?php var_dump($post); ?></div>
<div class="post" data-id="<?= $post->ID ?>">
    <?php if ($image) : ?><div class="image" style="background-image: url(<?= $image ?>);"></div><?php endif; ?>
    <div class="contentBlock">
        <?php
            $labels = array(
                'blog' => "Blog",
                'thoughtleadership' => "Thought Leadership",
                'whitepaper' => "Whitepaper",
                'casestudy' => "Case Study",
                'webinar' => "Webinar",
                'mediarelease' => "Media Release"
            );
        ?>
        <h6><?= $labels[get_field('article_type')] ?></h6>
        <h5><?php the_title() ?></h5>
        <?php the_excerpt(); ?>
    </div>
    <a href="<?= get_the_permalink(); ?>"></a>
</div>
<?php endif;?>