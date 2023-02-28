<section class="sectionTemplate iconsFourColumn<?= isset($iconsFourColumn['classes']) ? " ".$iconsFourColumn['classes'] : "" ?>"<?= isset($iconsFourColumn['id']) ? " id='".$iconsFourColumn['id']."'" : "" ?>>
    <div class="inner">
        <?php if ($iconsFourColumn['headline'] !== "") : ?><h4><?= $iconsFourColumn['headline'] ?></h4><?php endif; ?>
        <div class="blocks">
            <?php foreach ($iconsFourColumn['blocks'] as $block) : ?>
            <div class="iconBlock" style="background-image: url(<?= $block['icon'] ?>);">
                <h5><?= $block['headline'] ?></h5>
                <span><?= $block['supporting_text'] ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>