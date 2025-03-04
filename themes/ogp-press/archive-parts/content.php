<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix xlarge-margin-bottom'); ?>>
	<header class="entry-header">
		<?php

		if ( is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} elseif ( is_front_page() && is_home() ) {
			the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		} else {
			the_title( '<h2 class="entry-title subtle no-margin"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}

		if ( 'post' === get_post_type() ) {
			echo '<div class="entry-meta small-margin-bottom">';
			ogp_entry_meta();
			echo '</div><!-- .entry-meta -->';
		};
		?>
	</header><!-- .entry-header -->

	<?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
		<div class="post-thumbnail float-left small-margin-right">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'featured-thumb' ); ?>
			</a>
		</div><!-- .post-thumbnail -->
	<?php endif; ?>

	<div class="entry-content">
		<?php
		/* translators: %s: Name of current post */
		the_excerpt();
// 		the_content( sprintf(
// 			__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ),
// 			get_the_title()
// 		) );

		wp_link_pages( array(
			'before'      => '<div class="page-links">' . __( 'Pages:', 'ogp-press' ),
			'after'       => '</div>',
			'link_before' => '<span class="page-number">',
			'link_after'  => '</span>',
		) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-# -->