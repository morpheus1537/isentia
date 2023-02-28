<section class="sectionTemplate contentVideo<?= isset($contentVideo['image_options']) ? " ".$contentVideo['image_options'] : "" ?><?= isset($contentVideo['classes']) ? " ".$contentVideo['classes'] : "" ?>"<?= isset($contentVideo['id']) ? " id='".$contentVideo['id']."'" : "" ?>>
    <div class="inner">
        <div class="contentBlock">
            <?= $contentVideo['supporting_text'] ?>
        </div>
        
        
        <?php 
	        
	        if($contentVideo['video']['youtube_id']){ ?>
	        
				<div class="videowrap">
					<iframe width="560" height="315" src="https://www.youtube.com/embed/<?= $contentVideo['video']['youtube_id']; ?>" frameborder="0" allow="accelerometer; autoplay=1; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>

	    <?php }else { ?>

        <div class="visual">
            <?php $video = $contentVideo['video'] ?>
            <video <?= $video['autoplay'] ? 'autoplay ' : '' ?><?= $video['loop'] ? 'loop ' : '' ?><?= $video['mute'] ? 'muted ' : '' ?><?= $video['poster'] ? 'poster="'.$video['poster'].'"' : '' ?>>
                <source src="<?= $video['file_path'] ?>.mp4" type="video/mp4">
                <source src="<?= $video['file_path'] ?>.ogg" type="video/ogg">
                <source src="<?= $video['file_path'] ?>.webm" type="video/webm">
                Your browser does not support HTML5 video.
            </video>
        </div>


		<?php } ?>
    </div>
</section>