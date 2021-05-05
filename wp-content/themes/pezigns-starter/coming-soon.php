<?php

/**
*
* * Template Name:  Coming Soon
*
*/
remove_action ( 'genesis_before_header', 'genesis_skip_links', 5 );
remove_action( 'genesis_header', 'pezigns_starter_do_nav', 12 );
remove_action( 'genesis_header_left', 'genesis_site_title', 12 );
remove_action( 'genesis_header_left', 'genesis_site_description', 12 );
remove_action( 'genesis_header', 'genesis_header_right', 12 );
remove_action('genesis_site_title', 'burger_menu');

//* Remove site header elements

//* Remove navigation
remove_theme_support( 'genesis-menus' );

//* Remove breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

//* Remove site footer widgets
remove_theme_support( 'genesis-footer-widgets' );

remove_action( 'genesis_before_footer', 'pezigns_starter_custom_footer' );
//* Remove site footer elements
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );



genesis();