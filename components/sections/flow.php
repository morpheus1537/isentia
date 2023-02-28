<section class="sectionTemplate flow<?= isset($flow['classes']) ? " ".$flow['classes'] : "" ?>"<?= isset($flow['id']) ? " id='".$flow['id']."'" : "" ?>>
    <div class="inner">
        <h4><?= $flow['headline'] ?></h4>
        <div class="flow">
            <?php foreach ($flow['items'] as $item) : ?>
            <div class="flow-item">
                <div><?= $item['supporting_text'] ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>