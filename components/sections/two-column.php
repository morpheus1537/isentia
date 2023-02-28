<section class="sectionTemplate twoColumn<?= isset($twoColumn['classes']) ? " ".$twoColumn['classes'] : "" ?>"<?= isset($twoColumn['id']) ? " id='".$twoColumn['id']."'" : "" ?>>
    <div class="inner">
        <h3><?= $twoColumn['headline'] ?></h3>
        <div class="contentBlock">
            <?= $twoColumn['supporting_text'] ?>
        </div>
    </div>
</section>