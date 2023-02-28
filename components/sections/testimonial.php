<?php 
    if (!isset($testimonial['quotes']) && is_array($testimonial)) :
        $temp_testimonial = array();
        $temp_testimonial[] = $testimonial;
        $testimonial['quotes'] = $temp_testimonial;
    endif;
?>
<section class="sectionTemplate testimonial<?= isset($testimonial['classes']) ? " ".$testimonial['classes'] : "" ?>"<?= isset($testimonial['id']) ? " id='".$testimonial['id']."'" : "" ?>>
    <div class="inner">
        <div class="testimonials">
            <?php $active = " active"; foreach ($testimonial['quotes'] as $quote) : ?>
                <div class="testimonial<?= $active ?>">
                    <?php if ($quote['image']) : ?>
                    <div class="image">
                        <img src="<?= $quote['image'] ?>" />
                    </div>
                    <?php endif; ?>
                    <div class="contentBlock">
                        <div class="quote"><?= $quote['quote'] ?></div>
                        <div class="author"><?= $quote['author'] ?></div>
                        <div class="position"><?= $quote['position'] ?></div>
                        <?php if (count($testimonial['quotes']) > 1) : ?>
                        <div class="navigation">
                            <span class="prev" data-dir="-1"><i class="fas fa-chevron-left"></i></span>
                            <span class="next" data-dir="1"><i class="fas fa-chevron-right"></i></span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php $active = ''; endforeach; ?>
        </div>
    </div>
</section>