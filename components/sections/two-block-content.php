<section class="sectionTemplate twoBlockContent<?= isset($twoBlockContent['classes']) ? " ".$twoBlockContent['classes'] : "" ?>"<?= isset($twoBlockContent['id']) ? " id='".$twoBlockContent['id']."'" : "" ?>>
    <div class="inner">
        <div class="contentBlock left">
            <?= $twoBlockContent['left_block'] ?>
        </div>
        <div class="contentBlock right">
            <?= $twoBlockContent['right_block'] ?>
        </div>
    </div>
</section>