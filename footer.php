	<footer id="colophon" class="site-footer">
		<div class="inner">
			<div class="footer-menu-container">
				<div>
					<div class="logo">
						<a href="<?= site_url(); ?>">Isentia</a>
					</div>
					<div class="copyright">
						Copyright &copy; <?php bloginfo( "name" ) ?>. All rights reserved. <?php
					if ( function_exists( 'the_privacy_policy_link' ) ) {
						the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"> | </span>' );
					}
					?><a href="/terms/">Terms</a>
					</div>
					<div class="apps">
						<a href="https://apps.apple.com/au/app/isentia/id1129668914" class="apple">Download it on the App Store</a>
						<a href="https://play.google.com/store/apps/details?id=com.isentia.mediaportal&hl=en_AU" class="google">Get it on Google Play</a>
					</div>
				</div>
				<?php if ( has_nav_menu( 'footer-1' ) ) : ?>
					<div>
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer-1',
								'menu_class'     => 'footer-menu',
								'depth'          => 1,
							)
						);
						?>
					</div>
				<?php endif; ?>
				<?php if ( has_nav_menu( 'footer-2' ) ) : ?>
					<div>
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer-2',
								'menu_class'     => 'footer-menu',
								'depth'          => 1,
							)
						);
						?>
						<div class="social">
							<!--<a href="https://www.instagram.com/isentia_" class="instagram"><i class="fab fa-instagram"></i></a>-->
							<a href="https://www.twitter.com/isentia/" class="twitter" style="margin-right: 10px;"><i class="fab fa-twitter"></i></a>
							<a href="https://www.facebook.com/isentiacom/" class="facebook" style=" margin-right: 5px;"><i class="fab fa-facebook-f"></i></a>
							<a href="https://www.youtube.com/Isentia" class="youtube"><i class="fab fa-youtube"></i></a>
							<a href="https://www.linkedin.com/company/isentia" class="linkedin"><i class="fab fa-linkedin"></i></a>
							<!--<a href="https://www.weibo.com/isentia/" class="weibo"><i class="fab fa-weibo"></i></a>-->
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>
<script type="text/javascript">

(function() {
  var didInit = false;
  function initMunchkin() {
    if(didInit === false) {
      didInit = true;
      Munchkin.init('114-HJX-968');
    }
  }
  var s = document.createElement('script');
  s.type = 'text/javascript';
  s.async = true;
  s.src = '//munchkin.marketo.net/munchkin.js';
  s.onreadystatechange = function() {
    if (this.readyState == 'complete' || this.readyState == 'loaded') {
      initMunchkin();
    }
  };
  s.onload = initMunchkin;
  document.getElementsByTagName('head')[0].appendChild(s);
})();
</script>
<script>
  if(window.location.pathname.includes('service-thank-you') || window.location.pathname.includes('intelligence-thank-you')){
    gtag('event', 'conversion', {'send_to': 'AW-10973598813/5XecCOmzvIIYEN2oz_Ao'});
  }
</script>
</body>
</html>