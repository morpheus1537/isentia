<section class="sectionTemplate pageHeadForm<?= isset($pageHeadForm['classes']) ? " ".$pageHeadForm['classes'] : "" ?>"<?= isset($pageHeadForm['id']) ? " id='".$pageHeadForm['id']."'" : "" ?><?= isset($pageHeadForm['attrs']) ? " ".$pageHeadForm['attrs']."'" : "" ?>>
    <div class="inner">
        <div class="contentBlock">
            <?php if ($pageHeadForm['sub_headline']) : ?><h6><?= $pageHeadForm['sub_headline'] ?></h6><?php endif; ?>
            <h1><?= $pageHeadForm['headline'] ?></h1>
            <?= $pageHeadForm['supporting_text'] ?>
            <?php if (isset($pageHeadForm['buttons'])) : ?>
            <?php if (is_array($pageHeadForm['buttons']) && count($pageHeadForm['buttons']) > 0) : ?>
            <div class="buttons">
                <?php foreach ($pageHeadForm['buttons'] as $button) : ?>
                <a href="<?= $button['href'] ?>" class="ibtn <?= $button['btn_type'] ?>"><?= $button['label'] ?></a>
                <?php endforeach ?>
            </div>
            <?php endif; ?>
            <?php endif; ?>
        </div>

        <?php if ($pageHeadForm['form_id']) : ?>
        <div class="formContainer">
            <div class="formWrap">
                <script src="//pages.isentia.com/js/forms2/js/forms2.min.js"></script> <form id="mktoForm_<?= $pageHeadForm['form_id'] ?>"></form> <script>MktoForms2.loadForm("//pages.isentia.com", "114-HJX-968", <?= $pageHeadForm['form_id'] ?>);</script>
            </div>
        </div>
        <?php else : ?>
        <div class="formContainer">
            <div class="formWrap">
                <span></span>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

