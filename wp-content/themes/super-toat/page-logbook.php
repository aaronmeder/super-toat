<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

	get_header();
?>

<main id="site-content" role="main">

	<header class="container page page-logbook logbook">

		<?php
			// Display the logbook page content

			the_post();
			the_title( '<h1>', '</h1>' );
			the_content();
		?>

	</header>

	<?php

		// Display the logbook entries

		$args = array( 'post_type' => 'logbook', 'posts_per_page' => 20 );
		$the_query = new WP_Query( $args ); 

		if ( $the_query->have_posts() ) {

			$i = 0;

			while ( $the_query->have_posts() ) {

				/* $i++;
				if ( $i > 1 ) {
					echo '<hr class="posts__separator" aria-hidden="true" />';
				} */

				$the_query->the_post();

				// display the log
				get_template_part( 'template-parts/content', get_post_type() );

			}
		} 
		
		get_template_part( 'template-parts/pagination' );
		
	?>

</main><!-- #site-content -->

<?php
	get_footer();
