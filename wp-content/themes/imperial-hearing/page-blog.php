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

	<main id="main" class="site-main">

		<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php $hero_image_url = get_template_directory_uri().'/assets/images/hero-bg.png'; ?>
			
			<div class="entry-hero">
				<div class="hero-bg" style="background-image:url(<?php echo $hero_image_url ?>)"></div>
				<div class="image-wrapper" style="background-image:url(<?php echo get_the_post_thumbnail_url(get_the_ID(), 'hero-image'); ?>	)"></div>
			</div>

			<div class="entry-content">

				<div class="content-wrapper">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					<?php the_content(); ?>
				</div>

				<div id="blog-content">
					<?php
						$args = array(
							'numberposts' => -1,
							'post_type'   => 'post',
							'category_name' => 'article'
						);

						$articles = get_posts( $args );

						foreach ($articles as $row) {
							$text = strlen($row->post_content) > 60 ? substr($row->post_content,0,60)."..." : $row->post_content;
							$block = '
								<div class="block"><a class="main-link" href="'.get_permalink($row->ID).'">
									<div class="inner">
										<div class="block-title">'.$row->post_title.'</div>
										<div class="block-text">'.$text.'</div>
										<span class="read-more">Read more</span>
									</div>
								</a></div>';
							echo $block;
						}
					?>
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

		</article>

		<?php endwhile; ?>

	</main><!-- #main -->

<?php get_footer();
