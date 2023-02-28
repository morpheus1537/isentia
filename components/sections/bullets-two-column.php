<section class="sectionTemplate bulletsTwoColumn<?= isset($bulletsTwoColumn['classes']) ? " ".$bulletsTwoColumn['classes'] : "" ?>"<?= isset($bulletsTwoColumn['id']) ? " id='".$bulletsTwoColumn['id']."'" : "" ?>>
    <div class="inner">
        <?php if ($bulletsTwoColumn['bullets_title'] !== "") : ?>
        <h4 class="main"><?= $bulletsTwoColumn['bullets_title'] ?></h4>
        <?php endif; ?>

        <div class="contentBlock">
            <?= $bulletsTwoColumn['supporting_text'] ?>
        </div>

        <div class="bullets">
            <ul>
				<?php if ($bulletsTwoColumn['bullets'] !== "") : ?>
				<?php foreach ($bulletsTwoColumn['bullets'] as $bullet) : ?>
				
				
                <li><?= $bullet['text'] ?></li>
				
				
                <?php endforeach ?>
				<?php else : ?>
                <span></span>
				<?php endif; ?>
            </ul>
        </div>
    </div>
</section>