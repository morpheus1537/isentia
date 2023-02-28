<section class="sectionTemplate pageHeadImage<?= isset($pageHeadImage['classes']) ? " ".$pageHeadImage['classes'] : "" ?>"<?= isset($pageHeadImage['id']) ? " id='".$pageHeadImage['id']."'" : "" ?>>
    <div class="inner">
        <div class="contentBlock">
            <h1><?= $pageHeadImage['headline'] ?></h1>
            <?= $pageHeadImage['supporting_text'] ?>
        </div>

        <div class="visual">
            <?php if ($pageHeadImage['image']) : ?>
            <img src="<?= $pageHeadImage['image'] ?>" />
            <?php endif; ?>
        </div>
    </div>
</section>