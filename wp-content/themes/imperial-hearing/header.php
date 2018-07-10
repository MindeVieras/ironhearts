<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Imperial_Hearing
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>

	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-56KXJKT');</script>
	<!-- End Google Tag Manager -->

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
    
	<!-- TEMP GOOGLE SCRIPT -->
	<?php $google_key = get_theme_mod('google_api_key'); ?>
  <script src="https://maps.googleapis.com/maps/api/js?v=3.29&libraries=places,geometry&key=<?php print $google_key; ?>"></script>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-56KXJKT"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div id="page-wrapper" class="site">

	<header id="site-header">
		
		<div id="header-top">
			<div class="container">
				<ul class="links">
					<?php if(get_theme_mod('phone_number')): ?> 
            <?php
              $phone_number = get_theme_mod('phone_number');
              $phone = str_replace(' ', '', $phone_number);
            ?>
            <li><a href="tel:<?php echo $phone ?>" title="Call Imperial Hearing">
            	<i class="ih-icon icon-phone"></i>
            	<span><?php echo $phone_number ?></span>
            </a></li>
          <?php endif; ?>
					<li><a href="/book-appointment">
						<i class="ih-icon icon-calendar"></i>
						<span>Book your appointment</span>
					</a></li>
				</ul>
			</div>
		</div>

		<div id="header-bottom">
			<div class="container">
				
				<div id="site-logo">
					<a href="/"><img src="<?php bloginfo('template_url'); ?>/assets/images/logo-purple.svg" alt="Imperial Hearing Logo"></a>
				</div>

				<nav id="site-navigation" class="main-navigation">
					<button class="hamburger hamburger--elastic" type="button">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</button>
					<?php
						wp_nav_menu( array(
							'theme_location' => 'main',
							'menu_id' => 'site-main-menu',
							'container' => ''
						) );
					?>
				</nav>

			</div>
		</div>

	</header><!-- #site-header -->
