<section class="sectionTemplate contentTestimonial<?= isset($contentTestimonial['classes']) ? " ".$contentTestimonial['classes'] : "" ?>"<?= isset($contentTestimonial['id']) ? " id='".$contentTestimonial['id']."'" : "" ?>>
    <div class="inner">
        <div class="contentBlock">
            <?= $contentTestimonial['supporting_text'] ?>
        </div>

        <div class="testimonial">
            <div class="card">
                <div class="image" style="background-image: url(<?= $contentTestimonial['testimonial_card']['image'] ?>"></div>
                <div class="quote">
                    <span class="text <?= $contentTestimonial['testimonial_card']['quote_size'] ?>"><?= $contentTestimonial['testimonial_card']['quote'] ?></span>
                    <span class="author"><?= $contentTestimonial['testimonial_card']['author'] ?></span>
                    <span class="position"><?= $contentTestimonial['testimonial_card']['position'] ?></span>
                </div>
            </div>
        </div>
    </div>
</section>