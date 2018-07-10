<?php
/**
 * The template for displaying all single event posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Imperial_Hearing
 */

get_header(); ?>

	<main id="main" class="site-main">

	<?php
	while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
			<?php $hero_image_url = get_template_directory_uri().'/assets/images/hero-bg.png'; ?>
			
			<div class="entry-hero">
				<div class="hero-bg" style="background-image:url(<?php echo $hero_image_url ?>)"></div>
				<div class="image-wrapper" style="background-image:url(<?php echo get_the_post_thumbnail_url(get_the_ID(), 'hero-image'); ?>	)"></div>
			</div>

			<div class="entry-content">

				<div class="content-wrapper">
					<?php imperial_hearing_breadcrumbs(); ?>
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					
					<div class="centre-wrapper">
						<div class="centre-address">
							<h4>Address</h4>
							<div class="line1"><?php echo get_post_meta(get_the_ID(), IMPERIAL_HEARING_CENTRE_PREFIX.'address_line1', true); ?></div>
							<div class="line2"><?php echo get_post_meta(get_the_ID(), IMPERIAL_HEARING_CENTRE_PREFIX.'address_line2', true); ?></div>
							<div class="city"><?php echo get_post_meta(get_the_ID(), IMPERIAL_HEARING_CENTRE_PREFIX.'address_city', true); ?></div>
							<div class="postcode"><?php echo get_post_meta(get_the_ID(), IMPERIAL_HEARING_CENTRE_PREFIX.'address_postcode', true); ?></div>
						</div>
						<div class="centre-email">
							<h4>Email</h4>
              <?php $email = get_post_meta(get_the_ID(), IMPERIAL_HEARING_CENTRE_PREFIX.'email', true); ?>
              <?php $email_extra = get_post_meta(get_the_ID(), IMPERIAL_HEARING_CENTRE_PREFIX.'email_extra', true); ?>
							<div class="email"><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></div>
							<div class="email_extra"><a href="mailto:<?php echo $email_extra; ?>"><?php echo $email_extra; ?></a></div>
						</div>
						<div class="centre-phone">
							<h4>Telephone</h4>
							<div class="phone"><?php echo get_post_meta(get_the_ID(), IMPERIAL_HEARING_CENTRE_PREFIX.'phone', true); ?></div>
							<div class="phone_extra"><?php echo get_post_meta(get_the_ID(), IMPERIAL_HEARING_CENTRE_PREFIX.'phone_extra', true); ?></div>
						</div>
						<div class="content-text">
							<?php the_content(); ?>
						</div>
					</div>

				</div>

			</div>

			<!-- Bottom 1 -->
			<?php $bottom1 = apply_filters( 'the_content', get_post_meta( get_the_ID(), IMPERIAL_HEARING_CENTRE_PREFIX . 'bottom_1', true ) ); ?>
			<?php if ( ! empty( $bottom1 ) ) : ?>
				<div class="entry-bottom-1 padded">
					<?php echo $bottom1; ?>
				</div>
			<?php endif; ?>

			<!-- Bottom 2 -->
			<?php $bottom2 = apply_filters( 'the_content', get_post_meta( get_the_ID(), IMPERIAL_HEARING_CENTRE_PREFIX . 'bottom_2', true ) ); ?>
			<?php if ( ! empty( $bottom2 ) ) : ?>
				<div class="entry-bottom-2 padded">
					<?php echo $bottom2; ?>
				</div>
			<?php endif; ?>

		</article>

	<?php endwhile; ?>

	</main><!-- #main -->

<?php get_footer();
