<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Imperial_Hearing
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php $hero_image_url = get_template_directory_uri().'/assets/images/hero-bg.png'; ?>

	<div class="entry-hero">
		<div class="hero-bg" style="background-image:url(<?php echo $hero_image_url ?>)"></div>
		<div class="image-wrapper" style="background-image:url(<?php echo get_the_post_thumbnail_url(get_the_ID(), 'hero-image'); ?>	)"></div>
	</div>

	<div class="entry-content">

		<div class="content-wrapper">		
			<?php imperial_hearing_breadcrumbs(); ?>
			<?php the_content(); ?>
		</div>
	</div>

	<!-- Bottom 1 -->
	<?php $bottom1 = apply_filters( 'the_content', get_post_meta( get_the_ID(), IMPERIAL_HEARING_PAGE_PREFIX . 'bottom_1', true ) ); ?>
	<?php if ( ! empty( $bottom1 ) ) : ?>
		<div class="entry-bottom-1">
			<?php echo $bottom1; ?>
		</div>
	<?php endif; ?>

	<!-- Bottom 2 -->
	<?php $bottom2 = apply_filters( 'the_content', get_post_meta( get_the_ID(), IMPERIAL_HEARING_PAGE_PREFIX . 'bottom_2', true ) ); ?>
	<?php if ( ! empty( $bottom2 ) ) : ?>
		<div class="entry-bottom-2">
			<?php echo $bottom2; ?>
		</div>
	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
