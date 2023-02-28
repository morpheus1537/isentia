<section class="sectionTemplate contentImage<?= isset($contentImage['image_options']) ? " ".$contentImage['image_options'] : "" ?><?= isset($contentImage['classes']) ? " ".$contentImage['classes'] : "" ?>"<?= isset($contentImage['id']) ? " id='".$contentImage['id']."'" : "" ?>>
    <div class="inner">
        <div class="contentBlock">
            <?= $contentImage['supporting_text'] ?>
        </div>

        <div class="visual">
            <img src="<?= $contentImage['image'] ?>" />
        </div>
    </div>
</section>