<?php
/**
 * The template for displaying the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */

?>
			<footer id="site-footer" role="contentinfo" class="site-footer">

				<div class="site-footer__inner container--wide">

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
