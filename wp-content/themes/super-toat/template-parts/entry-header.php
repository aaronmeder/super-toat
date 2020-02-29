<?php
/**
 * Displays the post header
 *
 */

$entry_header_classes = '';

if ( is_singular() ) {
	$entry_header_classes .= ' header-footer-group';
}

?>

<header class="entry-header <?php echo esc_attr( $entry_header_classes ); ?>">
		
	<?php
		// display entry title
		the_title( '<h1 class="entry-title heading-size-1"><a href="' . esc_url( get_permalink() ) . '">', '</a></h1>' );
	?>

	<?php
		// display entry categories 
		if ( is_singular() && has_category() ) : 
	?>

		<div class="entry-categories">
			<span class="screen-reader-text"><?php _e( 'Categories', 'twentytwenty' ); ?></span>
			<div class="entry-categories-inner">
				<?php the_category( ' ' ); ?>
			</div><!-- .entry-categories-inner -->
		</div><!-- .entry-categories -->

	<?php endif; // end display categories ?>
	
	<?php

		$intro_text_width = '';

		if ( is_singular() ) {
			$intro_text_width = ' small';
		} else {
			$intro_text_width = ' thin';
		}

		if ( has_excerpt() && is_singular() ) {
			?>

			<div class="intro-text section-inner max-percentage<?php echo $intro_text_width; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output ?>">
				<?php the_excerpt(); ?>
			</div>

			<?php
		}

		// Default to displaying the post meta.
		//twentytwenty_the_post_meta( get_the_ID(), 'single-top' );
	?>


</header><!-- .entry-header -->
