<section class="sectionTemplate columnContent<?= isset($columnContent['classes']) ? " ".$columnContent['classes'] : "" ?>"<?= isset($columnContent['id']) ? " id='".$columnContent['id']."'" : "" ?>>
    <div class="inner">
        <h4><?= $columnContent['headline'] ?></h4>
        <div class="columns">
            <?php foreach ($columnContent['columns'] as $column) : ?>
            <div class="column">
                <img src="<?= $column['image'] ?>" />
                <span><?= $column['label'] ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>