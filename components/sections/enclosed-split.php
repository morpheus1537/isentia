<section class="sectionTemplate enclosedSplit"<?= isset($enclosedSplit['id']) ? " id='".$enclosedSplit['id']."'" : "" ?>>
    <div class="inner">
        <div class="visual" style="background-image: url('<?= $enclosedSplit['image'] ?>')"></div>

        <div class="contentBlock">
            <?= $enclosedSplit['supporting_text'] ?>
        </div>
    </div>
</section>