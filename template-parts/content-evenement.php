<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package underscore
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title evtDesTitle">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title evtDesTitle"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				underscore_posted_on();
				underscore_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->


	<div class="entry-content evtDesContent">
		<?php
		
		echo '<p> Auteur: ' . get_author_name().'</p>';
		echo '<p>'.get_the_date().'</p>';
		echo '<p>' . SUBSTR(get_the_excerpt(),0,200) . '</p>';
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php underscore_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
