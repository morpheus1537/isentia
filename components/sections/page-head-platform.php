<section id="hero" class="sectionTemplate pageHeadImage<?= isset($pageHeadImage['classes']) ? " ".$pageHeadImage['classes'] : "" ?>"<?= isset($pageHeadImage['id']) ? " id='".$pageHeadImage['id']."'" : "" ?>>
    <div class="inner">
        <div class="content-head contentBlock">
            <h1><?= $pageHeadImage['headline'] ?></h1>
            <?= $pageHeadImage['supporting_text'] ?>
        </div>

        <div class="head-image visual">
            <?php if ($pageHeadImage['image']) : ?>
            <img src="<?= $pageHeadImage['image'] ?>" />
            <a class="ibtn primary large open-modal" href="#" data-modalid="platform_hero"><i class="fas fa-play-circle"></i></a>
            <?php endif; ?>
        </div>
    </div>
</section>
<div class="modal" data-modalid="platform_hero">
    <div class="outer-content">
        <div class="content">
            <?php if ($pageHeadImage['video']) : ?>
                <div class="video-popup videowrap">
                    <iframe width="560" height="315"src="<?= $pageHeadImage['video']['file_path'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            <?php endif; ?>
        </div>
        <div class="overlay close-modal"></div>
    </div>
    <a href="#" class="close-modal">Close</a>
</div>