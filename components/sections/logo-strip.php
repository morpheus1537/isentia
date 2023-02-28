<section class="sectionTemplate logoStrip<?= isset($logoStrip['classes']) ? " ".$logoStrip['classes'] : "" ?>"<?= isset($logoStrip['id']) ? " id='".$logoStrip['id']."'" : "" ?>>
    <div class="inner"><?php if ($logoStrip['headline']) : ?><h3><?= $logoStrip['headline'] ?></h3><?php endif; ?>
    <div id="maindiv"> 
        
  <div id="div1">
  <?php foreach ($logoStrip['logos'] as $logo) : ?>
            <div><img src="<?= $logo['logo'] ?>" alt="<?= $logo['company_name'] ?>" title="<?= $logo['company_name'] ?>" /></div>
            <?php endforeach; ?>
  </div>
  <div id="div2">
  <?php foreach ($logoStrip['logos'] as $logo) : ?>
            <div><img src="<?= $logo['logo'] ?>" alt="<?= $logo['company_name'] ?>" title="<?= $logo['company_name'] ?>" /></div>
            <?php endforeach; ?>
  </div>
</div>
</section>

<style>

section.sectionTemplate.logoStrip .inner {
    max-width: unset;
    width: 100%;
}
#maindiv{
    overflow: hidden;
    white-space: nowrap;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
}

#div1 {
    display: flex;
    animation: marquee 20s linear infinite;
    justify-content: space-between;
    align-items: center;
}


#div2 {
    display: flex;
    animation: marquee2 20s linear infinite;
    animation-delay: 10s;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
}

div#div1 div {
    margin: 30px;
}

div#div2 div {
    margin: 30px;
}


div#div1 img {
    height: 100px;
    object-fit: scale-down;
    width: 200px;
}

div#div2 img {
    height: 100px;
    object-fit: scale-down;
    width: 200px;
}

@keyframes marquee {
  from {
    transform: translateX(-100%);
  }
  to {
    transform: translateX(100%);
  }
}

@keyframes marquee2 {
  from {
    transform: translateX(-200%);
  }
  to {
    transform: translateX(0%);
  }
}
</style>

<script>
    $('#maindiv').width($('#div1').width());
</script>