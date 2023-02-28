<section class="sectionTemplate showcaseImage<?= isset($showcaseImage['classes']) ? " ".$showcaseImage['classes'] : "" ?>"<?= isset($showcaseImage['id']) ? " id='".$showcaseImage['id']."'" : "" ?>>
    <div class="inner">
        <img src="<?= $showcaseImage['image'] ?>" />
    </div>
</section>