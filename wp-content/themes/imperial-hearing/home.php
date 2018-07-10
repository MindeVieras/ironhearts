<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Imperial_Hearing
 */

get_header(); ?>

	<main id="main" class="site-main home-page">

		<?php
			$homepage = get_page_by_path('home-page');
			$id = $homepage->ID;
		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="entry-hero" style="background-image:url(<?php echo get_the_post_thumbnail_url($id, 'hp-image'); ?>	)">
        <?php $guarantee_badge = get_template_directory_uri().'/assets/images/guarantee-badge.png'; ?>
        <img class="guarantee-badge" src="<?php echo $guarantee_badge; ?>" />
				<div class="hero-intro">
					<h1><?php echo $homepage->post_title; ?></h1>
					<?php $content = apply_filters( 'the_content', $homepage->post_content ); ?>
					<div class="text">
						<?php echo $content; ?>
					</div>
				</div>
				<?php $homepage_curve = get_template_directory_uri().'/assets/images/homepage-curve.png'; ?>
				<div class="content-top-curve" style="background-image:url(<?php echo $homepage_curve ?>)"></div>
			</div>

			<!-- Bottom 1 -->
			<?php $bottom1 = apply_filters( 'the_content', get_post_meta( $id, IMPERIAL_HEARING_PAGE_PREFIX . 'bottom_1', true ) ); ?>
			<?php if ( ! empty( $bottom1 ) ) : ?>
				<div class="entry-bottom-1">
					<?php echo $bottom1; ?>
				</div>
			<?php endif; ?>

			<!-- Bottom 2 -->
			<?php $bottom2 = apply_filters( 'the_content', get_post_meta( $id, IMPERIAL_HEARING_PAGE_PREFIX . 'bottom_2', true ) ); ?>
			<?php if ( ! empty( $bottom2 ) ) : ?>
				<div class="entry-bottom-2">
					<?php echo $bottom2; ?>
				</div>
			<?php endif; ?>

		</article>

	</main><!-- #main -->

<?php get_footer();
