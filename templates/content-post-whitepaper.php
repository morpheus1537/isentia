<section id="headline">
    <div class="inner">
        <h6>Whitepaper</h6>
        <span class="date"><?php the_date('F j, Y') ?></span>
        <h2><?php the_title(); ?></h2>
    </div>
</section>
<section id="bodyCopy">
    <div class="inner">
        <?php the_content() ?>

        <?php $form_id = get_field('form_id'); if ($form_id && $form_id !== '') : ?>
        <div class="formContainer">
            <div class="formWrap">
                <?php if (get_field('form_headline')) : ?>
                <h4><?= get_field('form_headline') ?></h4>
                <?php endif; ?>
                <form id="mktoForm_<?= $form_id ?>" data-mktoformid="<?= $form_id ?>"></form>
                <div class="formSuccess">
                    <?php include get_template_directory(). "/components/success-tick.php" ?>
                    <h4>Thank you</h4>
                    <p>Your submission was successfully received and someone will be in touch shortly.</p>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>