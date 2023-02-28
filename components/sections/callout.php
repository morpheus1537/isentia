<section class="sectionTemplate callout<?= isset($callout['classes']) ? " ".$callout['classes'] : "" ?>"<?= isset($callout['id']) ? " id='".$callout['id']."'" : "" ?>>
    <div class="inner">
        <?= $callout['content'] ?>
    </div>
</section>