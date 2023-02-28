<section  class="sectionTemplate tabbedContentImage<?= isset($tabbedContentImage['classes']) ? " ".$tabbedContentImage['classes'] : "" ?>"<?= isset($tabbedContentImage['id']) ? " id='".$tabbedContentImage['id']."'" : "" ?>>
<h2 class="process-heading"><?= $tabbedContentImage['process_heading']; ?></h2>
<div class="inner">
        <div class="sectionNav">
            <span class="sectionItem active" id="section-1" data-section="<?= strtolower($tabbedContentImage['section_1']['tab_label']); ?>"><?= $tabbedContentImage['section_1']['tab_label']; ?></span>
            <span class="sectionItem" id="section-2" data-section="<?= strtolower($tabbedContentImage['section_2']['tab_label']); ?>"><?= $tabbedContentImage['section_2']['tab_label']; ?></span>
            <span class="sectionItem" id="section-3" data-section="<?= strtolower($tabbedContentImage['section_3']['tab_label']); ?>"><?= $tabbedContentImage['section_3']['tab_label']; ?></span>
            <span class="sectionItem" id="section-4" data-section="<?= strtolower($tabbedContentImage['section_4']['tab_label']); ?>"><?= $tabbedContentImage['section_4']['tab_label']; ?></span>
        </div>
        <div class="sections">
            <div class="section active" data-section="<?= strtolower($tabbedContentImage['section_1']['tab_label']); ?>">
                <div class="visual">
                    <img src="<?= $tabbedContentImage['section_1']['image']; ?>" />
                </div>

                <div class="contentBlock">
                    <h3><?= $tabbedContentImage['section_1']['headline']; ?></h3>
                    <?= $tabbedContentImage['section_1']['supporting_text']; ?>
                    <div class="optional-text">
                        <?php if (!empty($tabbedContentImage['section_1']['optional_text_1'])): ?>
                        <p><?= $tabbedContentImage['section_1']['optional_text_1'] ?></p>
                        <?php endif; ?>
                        <?php if (!empty($tabbedContentImage['section_1']['optional_text_2'])): ?>
                        <p><?= $tabbedContentImage['section_1']['optional_text_2'] ?></p>
                        <?php endif; ?>
                        <?php if (!empty($tabbedContentImage['section_1']['optional_text_3'])): ?>
                        <p><?= $tabbedContentImage['section_1']['optional_text_3'] ?></p>
                        <?php endif; ?>
                    </div>
                    <?php if ($tabbedContentImage['section_1']['link']['href'] !== "") : ?> 
                        <a href="<?= $tabbedContentImage['section_1']['link']['href']; ?>" class="textCta"><?= $tabbedContentImage['section_1']['link']['label']; ?></a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="section" data-section="<?= strtolower($tabbedContentImage['section_2']['tab_label']); ?>">
                <div class="visual">
                    <img src="<?= $tabbedContentImage['section_2']['image']; ?>" />
                </div>

                <div class="contentBlock">
                    <h3><?= $tabbedContentImage['section_2']['headline']; ?></h3>
                    <?= $tabbedContentImage['section_2']['supporting_text']; ?>
                    <div class="optional-text">
                        <?php if (!empty($tabbedContentImage['section_2']['optional_text_1'])): ?>
                        <p><?= $tabbedContentImage['section_2']['optional_text_1'] ?></p>
                        <?php endif; ?>
                        <?php if (!empty($tabbedContentImage['section_2']['optional_text_2'])): ?>
                        <p><?= $tabbedContentImage['section_2']['optional_text_2'] ?></p>
                        <?php endif; ?>
                        <?php if (!empty($tabbedContentImage['section_2']['optional_text_3'])): ?>
                        <p><?= $tabbedContentImage['section_2']['optional_text_3'] ?></p>
                        <?php endif; ?>
                    </div>
                    <?php if ($tabbedContentImage['section_2']['link']['href'] !== "") : ?> 
                        <a href="<?= $tabbedContentImage['section_2']['link']['href']; ?>" class="textCta"><?= $tabbedContentImage['section_2']['link']['label']; ?></a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="section" data-section="<?= strtolower($tabbedContentImage['section_3']['tab_label']); ?>">
                <div class="visual">
                    <img src="<?= $tabbedContentImage['section_3']['image']; ?>" />
                </div>

                <div class="contentBlock">
                    <h3><?= $tabbedContentImage['section_3']['headline']; ?></h3>
                    <?= $tabbedContentImage['section_3']['supporting_text']; ?>
                    <div class="optional-text">
                        <?php if (!empty($tabbedContentImage['section_3']['optional_text_1'])): ?>
                        <p><?= $tabbedContentImage['section_3']['optional_text_1'] ?></p>
                        <?php endif; ?>
                        <?php if (!empty($tabbedContentImage['section_3']['optional_text_2'])): ?>
                        <p><?= $tabbedContentImage['section_3']['optional_text_2'] ?></p>
                        <?php endif; ?>
                        <?php if (!empty($tabbedContentImage['section_3']['optional_text_3'])): ?>
                        <p><?= $tabbedContentImage['section_3']['optional_text_3'] ?></p>
                        <?php endif; ?>
                    </div>
                    <?php if ($tabbedContentImage['section_3']['link']['href'] !== "") : ?> 
                        <a href="<?= $tabbedContentImage['section_3']['link']['href']; ?>" class="textCta"><?= $tabbedContentImage['section_3']['link']['label']; ?></a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="section" data-section="<?= strtolower($tabbedContentImage['section_4']['tab_label']); ?>">
                <div class="visual">
                    <img src="<?= $tabbedContentImage['section_4']['image']; ?>" />
                </div>

                <div class="contentBlock">
                    <h3><?= $tabbedContentImage['section_4']['headline']; ?></h3>
                    <?= $tabbedContentImage['section_4']['supporting_text']; ?>
                    <div class="optional-text">
                        <?php if (!empty($tabbedContentImage['section_4']['optional_text_1'])): ?>
                        <p><?= $tabbedContentImage['section_4']['optional_text_1'] ?></p>
                        <?php endif; ?>
                        <?php if (!empty($tabbedContentImage['sectisection_4n_1']['optional_text_2'])): ?>
                        <p><?= $tabbedContentImage['section_4']['optional_text_2'] ?></p>
                        <?php endif; ?>
                        <?php if (!empty($tabbedContentImage['section_4']['optional_text_3'])): ?>
                        <p><?= $tabbedContentImage['section_4']['optional_text_3'] ?></p>
                        <?php endif; ?>
                    </div>
                    <?php if ($tabbedContentImage['section_4']['link']['href'] !== "") : ?> 
                        <a href="<?= $tabbedContentImage['section_4']['link']['href']; ?>" class="textCta"><?= $tabbedContentImage['section_4']['link']['label']; ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>