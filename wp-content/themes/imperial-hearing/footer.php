
	<footer id="site-footer">
		
		<?php $footer_curve_image = get_template_directory_uri().'/assets/images/footer-curve.png'; ?>
		
		<div class="footer-curve" style="background-image:url(<?php echo $footer_curve_image ?>)"></div>
		
		<div class="footer-top">
			<div class="footer-container">
				<div class="inner">

					<div class="logo-wrapper">
						<img src="<?php bloginfo('template_url'); ?>/assets/images/logo-white.svg" alt="Imperial Hearing Logo">
					</div>
					
					<div class="address">
						<ul>
							<li><b>Head Office</b></li>
							<?php if(get_theme_mod('street')): ?>
                <li><?php echo get_theme_mod('street'); ?></li>
              <?php endif; ?>
							<?php if(get_theme_mod('city')): ?>
                <li><?php echo get_theme_mod('city'); ?></li>
              <?php endif; ?>
							<?php if(get_theme_mod('county')): ?>
                <li><?php echo get_theme_mod('county'); ?></li>
              <?php endif; ?>
							<?php if(get_theme_mod('postcode')): ?>
                <li><?php echo get_theme_mod('postcode'); ?></li>
              <?php endif; ?>
						</ul>
					</div>
					
					<div class="contacts">
						<ul>
							<?php if(get_theme_mod('phone_number')): ?>
								<?php
									$phone_number = get_theme_mod('phone_number');
									$phone = str_replace(' ', '', $phone_number);
								?>
								<li><a href="tel:<?php echo $phone ?>" title="Call Imperial Hearing">
									<i class="ih-icon icon-phone"></i>
									<span><?php echo $phone_number; ?></span>
								</a></li>
              <?php endif; ?>
							<?php if(get_theme_mod('email_address')): ?>
                <li><a href="mailto:<?php echo get_theme_mod('email_address'); ?>">
                	<i class="ih-icon icon-email"></i>
                	<span><?php echo get_theme_mod('email_address'); ?></span>
                </a></li>
              <?php endif; ?>
						</ul>
					</div>
					
					<div class="social">
						<ul>
							<?php if(get_theme_mod('facebook')): ?>
                <li><a href="<?php echo get_theme_mod('facebook'); ?>" target="_blank"><i class="ih-icon icon-facebook"></i></a></li>
              <?php endif; ?>
							<?php if(get_theme_mod('twitter')): ?>
                <li><a href="<?php echo get_theme_mod('twitter'); ?>" target="_blank"><i class="ih-icon icon-twitter"></i></a></li>
              <?php endif; ?>
							<?php if(get_theme_mod('instagram')): ?>
                <li><a href="<?php echo get_theme_mod('instagram'); ?>" target="_blank"><i class="ih-icon icon-instagram"></i></a></li>
              <?php endif; ?>
						</ul>
					</div>

				</div>
			</div>
		</div>

		<div class="footer-bottom">
			<div class="footer-container">
				<div class="site-name">&copy; <?php bloginfo('name'); ?></div>
				<?php 
					wp_nav_menu([
						'menu' => 'footer-bottom',
						'menu_id' => 'site-footer-bottom-menu',
						'container' => '',
					]);
				?>
				<div id="to-top"><i class="ih-icon icon-to-top"></i></div>
			</div>
		</div>

	</footer><!-- #site-footer -->

</div><!-- #page-wrapper -->

<?php wp_footer(); ?>

</body>
</html>
