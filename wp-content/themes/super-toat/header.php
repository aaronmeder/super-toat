<?php
/**
 * Header file 
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */

?><!DOCTYPE html>

<html <?php language_attributes(); ?>>

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >

		<link rel="profile" href="https://gmpg.org/xfn/11">

		<?php wp_head(); ?>

		<!-- Matomo -->
		<script type="text/javascript">
			var _paq = window._paq || [];
			/* tracker methods like "setCustomDimension" should be called before "trackPageView" */
			_paq.push(["disableCookies"]);
			_paq.push(['trackPageView']);
			_paq.push(['enableLinkTracking']);
			(function() {
				var u="//telltec.ch/analytics/";
				_paq.push(['setTrackerUrl', u+'matomo.php']);
				_paq.push(['setSiteId', '2']);
				var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
				g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
			})();
		</script>
		<!-- End Matomo Code -->

	</head>

	<body <?php body_class(); ?>>

		<?php if( !is_dev_env() && acf_is_enabled() && get_field('remake2020_notice', 'options') ) : ?>
			
			<div class="remake2020-notice container">
				<?php echo get_field('remake2020_notice', 'options'); ?>
			</div>
			
		<?php endif; // end if remake2020 notice ?>

		<header id="site-header" class="site-header">
			<div class="site-header__inner container container--wide">
				<h1>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
				</h1>
			</div> <!-- end site header inner -->
		</header>