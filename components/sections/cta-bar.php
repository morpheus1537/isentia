<section class="sectionTemplate ctaBar<?= isset($ctaBar['classes']) ? " ".$ctaBar['classes'] : "" ?>"<?= isset($ctaBar['id']) ? " id='".$ctaBar['id']."'" : "" ?>>
    <div class="inner">
        <div class="contentBlock">
            <h3><?= $ctaBar['headline'] ?></h3>
            <p><?= $ctaBar['supporting_text'] ?></p>
        </div>

        <div class="buttons">
            <?php foreach ($ctaBar['buttons'] as $button) : ?>
            <a href="<?= $button['href'] ?>" class="ibtn <?= $button['btn_type'] ?>"><?= $button['label'] ?></a>
            <?php endforeach ?>
        </div>
    </div>
</section>