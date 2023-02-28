<?php
    define("CUSTOM_CSS", "homepage");
    define("CUSTOM_JS", "homepage");
    get_header();

    while ( have_posts() ) :
        the_post();
?> <?php $hero = get_field('hero'); ?> <section id="hero" style="background: url(
	<?= $hero['image'] ?>) no-repeat 50%/cover; padding: 0; margin-top: -60px;">
  <div class="inner">
    <div class="contentBlock">
      <h1> <?= $hero['headline'] ?> </h1>
      <p> <?= $hero['supporting_text'] ?> </p>
      <a href="
				<?= $hero['cta']['href'] ?>" class="ibtn primary large"> <?= $hero['cta']['label'] ?> </a>
    </div>
  </div>
</section> <?php 
    $logoStrip = get_field('logo_strip'); 
    $logoStrip['id'] = "logos";
    include get_template_directory(). "/components/sections/logo-strip.php";
?> <?php
    $tabbedContentImage = get_field('process');
    $tabbedContentImage['id'] = "process";
    include get_template_directory(). "/components/sections/tabbed-content-image.php";
?> <?php $banner = get_field('banner'); ?> <?php
    if($banner['location'] == 'Top'){
?> <div id="banner">
  <div class="inner">
    <div class="contentBlock">
      <div class="Banner-background" style="background-image: url(
				<?= $banner['image'] ?>);">
        <a href="
					<?= $banner['link'] ?>">
          <div class="Banner-text"> <?= $banner['text']  ?> </div>
          <div class="Banner-sub-text"> <?= $banner['subtext']  ?> </div>
        </a>
      </div>
    </div>
  </div>
</div> <?php
    }
?> <?php
$departments = get_field('departments');
?> <section id="departments">
  <div class="inner">
    <h3> <?= $departments['headline'] ?> </h3>
    <p class="dept-sub"> <?= $departments['sub_headline'] ?> </p>
    <div class="departments">
      <div class="contentBlocks"> <?php foreach ($departments['department'] as $department) : ?> <div class="contentBlock" data-department="
					<?= strtolower($department['name']) ?>">
          <div>
            <img src="
							<?= $department['icon'] ?>" class="department-icon">
            <h5 class="large">
              <span style="background-image: url(
									<?= $department['icon'] ?>);">
              </span> <?= $department['name'] ?>
            </h5>
            <div class="departmentText"> <?= $department['supporting_text'] ?> </div>
          </div>
        </div> <?php endforeach; ?> </div>
        <div class="container-navigation">
            <div class="navigation">
                <a class="prev" href="#">
                <img src="./wp-content/themes/isentia/images/homepage/arrow-left.png" alt="Previous">
                </a>
                <a class="next" href="#">
                <img src="./wp-content/themes/isentia/images/homepage/arrow-right.png" alt="Next">
                </a>
            </div>
            <div class="container">
                <div class="box red"></div>
                <div class="box"></div>
                <div class="box"></div>
            </div>
        </div>
    </div>
  </div>
  <style>
.container-navigation {
    margin-top: 60px;
    display: flex;
}
.container-navigation .container {
    display: flex;
    flex-direction: row;
    align-items: center;
    width: 100%;
    margin-top: 4px;
    margin-left: 10px;
    justify-content: flex-start;
}

.container-navigation .container .box:first-child {
    width: 28%;
}

    .box {
        width: 36%;
    height: 3px;
      background-color: #CFD7E1;
    }

    .box.red {
      background-color: #0F3CDE;
    }

    .navigation {
      display: flex;
      justify-content: space-between;
      margin-top: 20px;
    }

    a.prev,
    a.next {
      display: inline-block;
      width: 50px;
      height: 50px;
      text-align: center;
      line-height: 50px;
    }
  </style>
<script>
  const boxes = document.querySelectorAll('.box');
  const prevBtn = document.querySelector('.prev');
  const nextBtn = document.querySelector('.next');
  let clickCount = 0;

  nextBtn.addEventListener('click', () => {
    clickCount++;

    if (clickCount === 1) {
      boxes[0].classList.remove('red');
      boxes[1].classList.remove('blue');
      boxes[2].classList.remove('blue');
      boxes[1].classList.add('red');
      boxes[0].classList.add('blue');
      boxes[2].classList.add('blue');
    } else if (clickCount === 2) {
      boxes[0].classList.remove('red');
      boxes[1].classList.remove('red');
      boxes[2].classList.remove('blue');
      boxes[2].classList.add('red');
      boxes[0].classList.add('blue');
      boxes[1].classList.add('blue');
    } else {
      boxes[0].classList.add('red');
      boxes[1].classList.remove('blue');
      boxes[2].classList.remove('red');
      clickCount = 0;
    }
  });

  prevBtn.addEventListener('click', () => {
    clickCount--;

    if (clickCount === 0) {
      boxes[0].classList.add('red');
      boxes[1].classList.remove('blue');
      boxes[1].classList.remove('red');
      boxes[2].classList.remove('red');
    } else if (clickCount === -1) {
      boxes[0].classList.remove('blue');
      boxes[1].classList.remove('red');
      boxes[2].classList.remove('red');
      boxes[1].classList.add('blue');
      boxes[0].classList.add('red');
      boxes[2].classList.add('blue');
      clickCount = 2;
    } else {
      boxes[0].classList.remove('red');
      boxes[1].classList.remove('blue');
      boxes[2].classList.remove('red');
      boxes[2].classList.add('blue');
      boxes[0].classList.add('blue');
      boxes[1].classList.add('red');
    }
  });
</script>
  <script>
(function($) {
  const section = $("#departments");
  const contentBlocks = section.find(".contentBlocks .contentBlock");
  const totalBlocks = contentBlocks.length;
  let currentBlock = 0;
  let clickCount = 0;
  section.find(".navigation .prev").click(function(event) {
    event.preventDefault();
    clickCount++;
    if (clickCount === 1) {
    currentBlock = currentBlock === 0 ? totalBlocks - 3 : currentBlock - 3;
    clickCount = 0;
    }
    showBlock();
  });
  section.find(".navigation .next").click(function(event) {
    event.preventDefault();
    clickCount++;
    if (clickCount === 3) {
      currentBlock = currentBlock === totalBlocks - 3 ? 0 : currentBlock + 3;
      clickCount = 0;
    }
    showBlock();
  });

  function showBlock() {
    contentBlocks.removeClass("active");
    let numItemsToShow = 3; // default number of items to show
    if ($(window).width() <= 980) { // if screen size is less than or equal to 980px
      numItemsToShow = 2; // show only 2 items
    }
    if ($(window).width() <= 768) { // if screen size is less than or equal to 768px
      numItemsToShow = 1; // show only 1 item
    }
    for (let i = 0; i < numItemsToShow; i++) {
      const index = (currentBlock + i) % totalBlocks;
      contentBlocks.eq(index).addClass("active");
    }
  }
  showBlock();
})(jQuery);

    (function($) {
      const section = $("#departments");
      section.find(".departmentItem").click(function() {
        if (!$(this).hasClass('active')) {
          const current = $(this).parent().children(".active").data('department');
          const next = $(this).data('department');
          section.find("[data-department='" + current + "']").removeClass('active');
          section.find("[data-department='" + next + "']").addClass('active');
          // add active class to first three items
          section.find('.departmentItem').removeClass('active').slice(0, 3).addClass('active');
        }
      });
      section.find('h5').click(function() {
        if (!section.find(".departmentMenu").is(":visible") && !$(this).parents(".contentBlock").hasClass('active')) {
          const current = $(this).parents(".contentBlocks").children(".active").data('department');
          const next = $(this).parents(".contentBlock").data('department');
          section.find("[data-department='" + current + "']").removeClass('active');
          section.find("[data-department='" + next + "']").addClass('active');
        }
      })
    })(jQuery);
  </script>
   </section>
   
</section> <?php $happy_customers = get_field('happy_customers'); ?> <section id="happy" style="background: url(
				<?= $happy_customers['background_image'] ?>) no-repeat 50%/cover;">
  <div class="inner">
    <div class="contentBlock">
      <h3> <?= $happy_customers['headline'] ?> </h3> <?= $happy_customers['supporting_text'] ?> <a href="
							<?= $happy_customers['cta']['href'] ?>" class="ibtn primary"> <?= $happy_customers['cta']['label'] ?> </a>
    </div>
  </div>
</section> <?php $blockquote = get_field('blockquote'); ?> <section id="blockquote">
  <div class="inner">
    <div class="contentBlock">
      <p class="bquote">
        <span>“</span> <?= $blockquote['quote'] ?>
      </p>
      <p class="quotename"> <?= $blockquote['name'] ?> </p>
    </div>
  </div>
</section> <?php $get_started = get_field('get_started'); ?> <section id="get_started" style="background: url(
				<?= $get_started['background_image'] ?>) no-repeat 50%/cover;">
  <div class="inner">
    <div class="contentBlock">
      <h3> <?= $get_started['title'] ?> </h3>
      <p> <?= $get_started['description'] ?> </p>
      <span>
        <a href="
								<?= $get_started['link'] ?>"> <?= $get_started['button'] ?> </a>
      </span>
    </div>
  </div>
</section> <?php $get_help = get_field('get_help'); ?> <section id="get_help">
  <div class="inner">
    <div class="contentBlock">
      <h3> <?= $get_help['title'] ?> </h3>
      <p> <?= $get_help['description'] ?> </p>
      <span>
        <a href="
								<?= $get_help['link'] ?>"> <?= $get_help['button'] ?> </a>
      </span>
    </div>
    <div class="imageBlock">
      <img src="
							<?= $get_help['image'] ?>">
    </div>
  </div>
</section> <?php $awards = get_field('awards'); ?> <section id="awards">
  <div class="inner">
    <h3> <?= $awards['headline'] ?> </h3>
    <div class="awards"> <?php foreach ($awards['awards'] as $award) : ?> <div class="award">
        <div>
          <span class="name"> <?= $award['name'] ?> </span>
          <span class="years"> <?= $award['years'] ?> </span>
        </div>
      </div> <?php endforeach; ?> </div>
  </div>
</section> <?php $careers = get_field('careers'); ?> <section id="careers">
  <div class="inner">
    <img src="
							<?= $careers['image'] ?>" />
    <div class="contentBlock">
      <h2> <?= $careers['headline'] ?> </h2>
      <a href="
									<?= $careers['link']['href'] ?>" class="textCta"> <?= $careers['link']['label'] ?> </a>
    </div>
  </div>
</section> <?php
    /* LATEST READS */
    include get_template_directory(). "/components/sections/latest-reads.php";
?> <?php
    endwhile;

    get_footer();