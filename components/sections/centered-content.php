<?php 
    if (isset($centeredContent['text-align'])) {
        if (isset($centeredContent['classes']) && $centeredContent['classes'] !== "") $centeredContent['classes'] .= " ";
        $centeredContent['classes'] .= "text-".$centeredContent['text-align'];
    }
?>
<section class="sectionTemplate centeredContent<?= isset($centeredContent['classes']) ? " ".$centeredContent['classes'] : "" ?>"<?= isset($centeredContent['id']) ? " id='".$centeredContent['id']."'" : "" ?>>
    <div class="inner">
        <div class="contentBlock">
            <?= $centeredContent['supporting_text'] ?>
        </div>
    </div>
</section>