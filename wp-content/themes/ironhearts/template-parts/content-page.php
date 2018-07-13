<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ironhearts
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php $hero = get_the_post_thumbnail_url(get_the_ID(), 'hero-image'); ?>

  <?php if ($hero): ?>
    <div class="entry-hero">
      <div class="image-wrapper" data-parallax="scroll" data-image-src="<?php echo $hero; ?>"></div>
    </div>
  <?php endif; ?>

	<header class="entry-header">
		<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content container">
		<?php
			the_content();
		?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
