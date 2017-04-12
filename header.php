<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ALPS
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'alps' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
        <div class="overlay-layer-nav sticky-navigation-open">
            <!-- FIXED NAVIGATION -->
            <div class="navbar bs-docs-nav navbar-fixed-top sticky-navigation appear-on-scroll">
                <!-- .container -->
                <div class="container">

                    <div class="navbar-header">

                        <!-- LOGO -->
                        <?php $alps_logo = get_theme_mod( 'alps_logo' ); ?>

                        <a href="<?php esc_url( home_url( '/' ) ) ?>" class="navbar-brand" title="<?php bloginfo( 'title' ); ?>">
                            <img src="<?php echo $alps_logo; ?>" alt="<?php bloginfo( 'title' ); ?>" />
                        </a>



                    </div> <!-- .navbar-header-->



                    <?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>

                </div> <!-- .container -->

            </div> <!--FIXED NAVIGATION -->
        </div>

	</header><!-- #masthead -->

	<div id="content" class="site-content">
