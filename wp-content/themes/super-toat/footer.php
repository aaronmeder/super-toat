<?php
/**
 * The template for displaying the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */

?>
			<footer id="site-footer" role="contentinfo" class="site-footer clear-float">

				<?php if( is_dev_env() && acf_is_enabled() && get_field('remake2020_notice', 'options') ) : ?>
				
					<div class="remake2020-notice container">
						<?php echo get_field('remake2020_notice', 'options'); ?>
					</div>
				
				<?php endif; // end if remake2020 notice ?>

				<div class="site-footer__inner container container--wide">

					<div class="footer__credits">

						<?php _e( 'Built with ❤️ by Aaron', 'supertoat' ); ?>

					</div><!-- end footer credits -->

					<a class="to-the-top" href="#top">
						<span class="to-the-top-long invisible--until-md visible--md">
							<?php
							/* translators: %s: HTML character for up arrow */
							printf( __( 'To the top %s', 'supertoat' ), '<span class="arrow" aria-hidden="true">&uarr;</span>' );
							?>
						</span><!-- .to-the-top-long -->
						<span class="to-the-top-short visible invisible--md">
							<?php
							/* translators: %s: HTML character for up arrow */
							printf( __( 'Up %s', 'supertoat' ), '<span class="arrow" aria-hidden="true">&uarr;</span>' );
							?>
						</span><!-- .to-the-top-short -->
					</a><!-- .to-the-top -->

				</div><!-- end site-footer inner -->

			</footer><!-- end site-footer -->

		<?php wp_footer(); ?>

	</body>
</html>
