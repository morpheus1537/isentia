<?php if (count($imageCollage['images']) > 0) : ?>
<section class="sectionTemplate imageCollage"<?= isset($imageCollage['id']) ? " id='".$imageCollage['id']."'" : "" ?>>
    <div class="inner">
        <div class="leftBar">
            <?php if (isset($imageCollage['images'][4])) : ?>
            <img src="<?= $imageCollage['images'][4]['image'] ?>" />
            <?php endif ?>
        </div>
        <div class="centerBar">
            <div class="topBar">
                <?php if (isset($imageCollage['images'][0])) : ?>
                <div><img src="<?= $imageCollage['images'][0]['image'] ?>" /></div>
                <?php endif ?>

                <?php if (isset($imageCollage['images'][1])) : ?>
                <div><img src="<?= $imageCollage['images'][1]['image'] ?>" /></div>
                <?php endif ?>
            </div>
            <div class="bottomBar">
                <?php if (isset($imageCollage['images'][2])) : ?>
                <div><img src="<?= $imageCollage['images'][2]['image'] ?>" /></div>
                <?php endif ?>

                <?php if (isset($imageCollage['images'][3])) : ?>
                <div><img src="<?= $imageCollage['images'][3]['image'] ?>" /></div>
                <?php endif ?>
            </div>
        </div>
        <div class="rightBar">
            <?php if (isset($imageCollage['images'][5])) : ?>
            <img src="<?= $imageCollage['images'][5]['image'] ?>" />
            <?php endif ?>
        </div>
    </div>
</section>
<?php endif; ?>