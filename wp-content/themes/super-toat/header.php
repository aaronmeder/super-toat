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

	</head>

	<body <?php body_class(); ?>>

		<?php if( is_dev_env() && acf_is_enabled() && get_field('remake2020_notice', 'options') ) : ?>
			
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