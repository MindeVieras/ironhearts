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
					<div class="event-wrapper">
						<div class="image-wrapper">
							<?php
								echo wp_get_attachment_image(get_post_meta(get_the_ID(), IMPERIAL_HEARING_EVENT_PREFIX.'content_image_id', true), 'event-image');
							?>
						</div>
						<div class="info-wrapper">
							<div class="time item">
								<i class="ih-icon icon-time"></i>
								<div class="text">
									<div class="heading">Time</div>
									<?php
										$start_date = get_post_meta(get_the_ID(), IMPERIAL_HEARING_EVENT_PREFIX.'start_datetime', true);
										$end_date = get_post_meta(get_the_ID(), IMPERIAL_HEARING_EVENT_PREFIX.'end_datetime', true);
									?>
									<?php echo date('ga', $start_date).' - '.date('ga, l j F Y', $end_date); ?>
								</div>
							</div>
							<div class="place item">
								<i class="ih-icon icon-place"></i>
								<div class="text">
									<div class="heading">Place</div>
										<?php $location = get_post_meta(get_the_ID(), IMPERIAL_HEARING_EVENT_PREFIX.'google_location', true); ?>
										<?php echo $location['google_location']; ?>
										<a href="https://www.google.com/maps/?q=<?php echo $location['latitude']; ?>,<?php echo $location['longitude']; ?>" class="map-link" target="_blank">Google maps</a>
								</div>
							</div>
							<div class="content-text">
								<?php the_content(); ?>
							</div>
						</div>
					</div>
				</div>

			</div>

			<!-- Bottom 1 -->
			<?php $bottom1 = apply_filters( 'the_content', get_post_meta( get_the_ID(), IMPERIAL_HEARING_EVENT_PREFIX . 'bottom_1', true ) ); ?>
			<?php if ( ! empty( $bottom1 ) ) : ?>
				<div class="entry-bottom-1 content-wrapper">
					<?php echo $bottom1; ?>
				</div>
			<?php endif; ?>

			<!-- Bottom 2 -->
			<?php $bottom2 = apply_filters( 'the_content', get_post_meta( get_the_ID(), IMPERIAL_HEARING_EVENT_PREFIX . 'bottom_2', true ) ); ?>
			<?php if ( ! empty( $bottom2 ) ) : ?>
				<div class="entry-bottom-2">
					<?php echo $bottom2; ?>
				</div>
			<?php endif; ?>

		</article>

	<?php endwhile; ?>

	</main><!-- #main -->

<?php get_footer();
