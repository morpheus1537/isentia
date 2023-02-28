<section class="sectionTemplate pageHead<?= isset($pageHead['classes']) ? " ".$pageHead['classes'] : "" ?>"<?= isset($pageHead['id']) ? " id='".$pageHead['id']."'" : "" ?>>
    <div class="inner">
        <div class="headline">
            <h1><?= $pageHead['headline'] ?></h1>
        </div>

        <div class="contentBlock">
            <?= $pageHead['supporting_text'] ?>
            <?php if (is_array($pageHead['links']) && count($pageHead['links']) > 0) : ?>
            <div class="links">
                <?php foreach ($pageHead['links'] as $link) : ?>
                <a href="<?= $link['href'] ?>" class="textCta"><?= $link['label'] ?></a>
                <?php endforeach ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>