<?php
/** Start the engine */
require_once( TEMPLATEPATH . '/lib/init.php' );
require_once('bulma-navwalker.php');


/**
 * Load child theme textdomain.
 */
load_child_theme_textdomain( 'pezigns-starter' );


/**
 * We tell the name of our child theme
 */
define( 'child_theme_name', __( 'Pezigns Starter', 'pezigns_starter' ) );


/**
 * We tell the web address of our child theme (More info & demo)
 */
define( 'child_theme_url', get_stylesheet_directory_uri() );


/**
 * We tell the version of our child theme
 */
define( 'child_theme_version', '1.0' );
//add_action('wp_head', 'my_custom_css');
//
//function my_custom_css() {
//    echo '<style>
//:root {
//--primary: red !important;
//}
//</style>';
//}

/**
 * add theme support for a footer tertiary navigation menu
 */
add_theme_support ( 'genesis-menus' , array (
    'footer-1' => 'Footer Navigation Menu 1',
    'footer-2' => 'Footer Navigation Menu 2'
) );

remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

register_nav_menus( array(
    'header-menu-right' => __( 'Header Menu Right', 'Pezigns Starter' ),
) );
register_nav_menus( array(
    'header-menu-left' => __( 'Header Menu Left', 'Pezigns Starter' ),
) );
remove_action( 'genesis_after_header','genesis_do_nav' ) ;
add_action( 'genesis_header_left','genesis_do_nav' );
add_action( 'genesis_header_right','genesis_do_nav' );
add_theme_support( 'genesis-structural-wraps', array( 'header-menu', 'menu-secondary', 'footer-widgets', 'footer' ) );
add_theme_support(
    'genesis-custom-logo',
    [
        'height'      => 120,
        'width'       => 700,
        'flex-height' => true,
        'flex-width'  => true,
    ]
);
add_filter( 'get_custom_logo', 'change_logo_class' );
//add_theme_support( 'genesis-structural-wraps', array( 'header', 'menu-secondary', 'footer-widgets', 'footer' ) );//menu-primary is removed


/**
 * pezigns_starter_viewport_meta_tag()
 *
 * @since 1.0.0
 * @return void.
 */
function pezigns_starter_viewport_meta_tag() {
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>';
}

/**
 * pezigns_starter_enable_gutenberg_post_ids()
 * @since 1.0.0
 *
 * @param $can_edit
 * @param $post
 *
 * @return bool.
 **/
function pezigns_starter_enable_gutenberg_post_ids($can_edit, $post) {

    if (empty($post->ID)) return $can_edit;

    if (1 === $post->ID) return true;

    return $can_edit;

}

// Enable Gutenberg for WP < 5.0 beta
add_filter('gutenberg_can_edit_post', 'pezigns_starter_enable_gutenberg_post_ids', 10, 2);

// Enable Gutenberg for WordPress >= 5.0
add_filter('use_block_editor_for_post', 'pezigns_starter_enable_gutenberg_post_ids', 10, 2);
add_action( 'wp_head', 'pezigns_starter_viewport_meta_tag' );
add_action( 'after_setup_theme', 'pezigns_starter_gutenberg_css' );
/** Add support for 3-column footer widgets */
add_theme_support( 'genesis-footer-widgets', 5 );


/**
 * pezigns_starter_gutenberg_css()
 * @since 1.0.0
 * @return void.
 **/
function pezigns_starter_gutenberg_css() {
    /*
    * Gutenberg Compatibility
    */
    //* Add HTML5 markup structure from Genesis
    add_theme_support( 'html5' );

    //* Add HTML5 responsive recognition
    add_theme_support( 'genesis-responsive-viewport' );

    //* Add wide layout
    add_theme_support( 'align-wide' );


    add_theme_support( 'editor-styles' ); // if you don't add this line, your stylesheet won't be added
    add_editor_style( 'style-editor.css' ); // tries to include style-editor.css directly from your theme folder

}


/**
 * genesis_gutenberg_add_body_class()
 *
 * Adds a custom body class to full-width posts or pages using Gutenberg blocks
 *
 * @param $classes
 *
 * @return mixed.
 **@since 1.0.0
 */
function genesis_gutenberg_add_body_class($classes) {

    if ( 'full-width-content' === genesis_site_layout() && (is_single() || is_page()) && !is_page_template() && has_blocks(get_the_ID())){
        $classes[] = 'genesis-gutenberg';
    }
    return $classes;
}
add_filter( 'body_class', 'genesis_gutenberg_add_body_class' );

/**
 * pezigns_starter_initialize_countdown_timer()
 * @return void.
 **@since 1.0.0
 */
function pezigns_starter_initialize_acf_countdown_timer(){
//    if( has_blocks(get_the_ID())){
	?>
	    <script type="text/javascript">
          jQuery(document).ready(function() {
            initializeClock('clockdiv', '<?php echo get_field('count_down_launch_date', 'option'); ?>');
          });
	    </script>

<?php
}

add_action( 'wp_head', 'pezigns_starter_initialize_acf_countdown_timer' );



/**
 * pezigns_starter_initialize_countdown_timer_in_admin()
 * @return void.
 **@since 1.0.0
 */
function pezigns_starter_initialize_countdown_timer_in_admin(){
        if( is_admin() ){ ?>
			<script type="text/javascript">
			      jQuery(document).ready(function() {
			        initializeClock('clockdiv', '<?php echo get_field('count_down_launch_date', 'option'); ?>');
			      });
			      var deadline = new Date(Date.parse(new Date()) + 15 * 24 * 60 * 60 * 1000);
			      function getTimeRemaining(endtime) {
			        var t = Date.parse(endtime) - Date.parse(new Date());
			        var seconds = Math.floor((t / 1000) % 60);
			        var minutes = Math.floor((t / 1000 / 60) % 60);
			        var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
			        var days = Math.floor(t / (1000 * 60 * 60 * 24));
			        return {
			          'total': t,
			          'days': days,
			          'hours': hours,
			          'minutes': minutes,
			          'seconds': seconds
			        };
			      }

			      function initializeClock(id, endtime) {
			        var clock = document.getElementById(id);

			        var daysSpan = clock.querySelector('.days');
			        var hoursSpan = clock.querySelector('.hours');
			        var minutesSpan = clock.querySelector('.minutes');
			        var secondsSpan = clock.querySelector('.seconds');

			        function updateClock() {
			          var t = getTimeRemaining(endtime);

			          daysSpan.innerHTML = t.days;
			          hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
			          minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
			          secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

			          if (t.total <= 0) {
			            clearInterval(timeinterval);
			          }
			        }

			        updateClock();
			        var timeinterval = setInterval(updateClock, 1000);

			      }
			</script>
	 <?php  }
		}
add_action( 'admin_head', 'pezigns_starter_initialize_countdown_timer_in_admin' );


/**
 * pezigns_starter_load_fonts()
 *
 * Add support for Google fonts
 *
 * @since 1.0.0
 * @return void.
 **/
function pezigns_starter_load_fonts() {
	if(get_field('select_google_fonts', 'option')){
        $url = pezigns_starter_fonts_url(); ?>
		<link rel="dns-prefetch" href="https://fonts.gstatic.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous">
		<link rel="preload" href="<?php echo esc_url( $url ); ?>" as="fetch" crossorigin="anonymous">
		<script type="text/javascript">
          !function(e,n,t){"use strict";var o="<?php echo esc_url( $url ); ?>",r="__3perf_googleFontsStylesheet";function c(e){(n.head||n.body).appendChild(e)}function a(){var e=n.createElement("link");e.href=o,e.rel="stylesheet",c(e)}function f(e){if(!n.getElementById(r)){var t=n.createElement("style");t.id=r,c(t)}n.getElementById(r).innerHTML=e}e.FontFace&&e.FontFace.prototype.hasOwnProperty("display")?(t[r]&&f(t[r]),fetch(o).then(function(e){return e.text()}).then(function(e){return e.replace(/@font-face {/g,"@font-face{font-display:swap;")}).then(function(e){return t[r]=e}).then(f).catch(a)):a()}(window,document,localStorage);
		</script>

    <?php }
}
add_action( 'wp_head', 'pezigns_starter_load_fonts' );
add_action( 'enqueue_block_editor_assets', 'pezigns_starter_load_fonts' );


/**
 * pezigns_starter_fonts_url()
 * @since 1.0.0
 * @return string.
 **/
function pezigns_starter_fonts_url() {
    $fonts = array();
    $subsets = 'latin-ext';
    $sub_value = array();

    if( have_rows('select_google_fonts', 'option') ):
        while ( have_rows('select_google_fonts', 'option') ) : the_row();
            $sub_value = get_sub_field('font_name' , 'option');
            // Do something...
            $fonts[] = $sub_value;
            // Load sub field value.

        endwhile;
        // no rows found
    endif;
    $fonts_url = add_query_arg( array(
        'family' => rawurlencode( implode( '|', $fonts ) ),
        'subset' => rawurlencode( $subsets ),
    ), 'https://fonts.googleapis.com/css' );

    return $fonts_url;
}

/**
 * pezigns_starter_acf_load_font_family_field_choices()
 * @since 1.0.0
 *
 * @param $field
 *
 * @return mixed.
 **/
function pezigns_starter_acf_load_font_family_field_choices( $field ) {

    // reset choices
    $field['choices'] = array();
    $value = array();
    if( have_rows('select_google_fonts', 'option') ):
        while ( have_rows('select_google_fonts', 'option') ) : the_row();
            $font_family = get_sub_field('font_family' , 'option');
            // Do something...
            $field['choices'][ $font_family ] = $font_family;
            // Load sub field value.

        endwhile;
        // no rows found
    endif;

    // return the field
    return $field;

}

add_filter('acf/load_field/name=heading_font_select', 'pezigns_starter_acf_load_font_family_field_choices');


/**
 * pezigns_starter_acf_load_font_family_field_choices_paragraph()
 * @since 1.0.0
 *
 * @param $field
 *
 * @return mixed.
 **/
function pezigns_starter_acf_load_font_family_field_choices_paragraph( $field ) {

    // reset choices
    $field['choices'] = array();
    $value = array();
    if( have_rows('select_google_fonts', 'option') ):
        while ( have_rows('select_google_fonts', 'option') ) : the_row();
            $font_family = get_sub_field('font_family' , 'option');
            // Do something...
            $field['choices'][ $font_family ] = $font_family;
            // Load sub field value.

        endwhile;
        // no rows found
    endif;

    // return the field
    return $field;

}

add_filter('acf/load_field/name=paragraph_font_select', 'pezigns_starter_acf_load_font_family_field_choices_paragraph');

/**
 * WooCommerce setup for genesis
 *
 */
// Remove WooCommerce Theme Support admin message
add_theme_support( 'woocommerce' );

/**
 * Check if WooCommerce is activated
 */
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
    /**
     *  is_woocommerce_activated()
     * @since 1.0.0
     * @return bool.
     **/
    function is_woocommerce_activated() {
        if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
    }

    /**
     *  pezigns_starter_remove_wc_breadcrumbs()
     *
     * Remove Genesis breadcrumbs, using Woocommerce crumbs instead.
     *
     * @since 1.0.0
     * @return void.
     **/
    function pezigns_starter_remove_wc_breadcrumbs() {
        remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
    }


	/**
	 * Add WooCommerce support for Genesis layouts (sidebar, full-width, etc)
	 */
    add_post_type_support( 'product', array( 'genesis-layouts', 'genesis-seo' ) );


	/**
	 * Unhook WooCommerce Sidebar - use Genesis Sidebars instead
	 */
    remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );


    // Unhook WooCommerce wrappers
    remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
    remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );


// function pezigns_starter_remove_block_styles(){
// 	    $button = 'core/button';
//        $fill = ['rounded'];
//        $outline = ['outline'];
//
//     unregister_block_style( $button, $fill );
//     unregister_block_style( $button, $outline );
// }
//add_action('admin_init','pezigns_starter_remove_block_styles');
    /**
     *  pezigns_starter_wrapper_start()
     *
     * Adds opening wrapper before WooCommerce loop
     *
     * @since 1.0.0
     * @return void.
     **/
    function pezigns_starter_wrapper_start() {

        do_action( 'genesis_before_content_sidebar_wrap' );
        genesis_markup( array(
            'html5' => '<div %s>',
            'xhtml' => '<div id="content-inner">',
            'context' => '.content-inner',
        ) );

        do_action( 'genesis_before_content' );
        genesis_markup( array(
            'html5' => '<main %s>',
            'xhtml' => '<div id="content" class="hfeed">',
            'context' => 'content',
        ) );
//        do_action( 'genesis_before_loop' );

    }
    // Hook new functions with Genesis wrappers
    add_action( 'woocommerce_before_main_content', 'pezigns_starter_wrapper_start', 10 );


    /**
     *  pezigns_starter_wrapper_end()
     *
     * Adds closing wrapper after WooCommerce loop
     *
     * @since 1.0.0
     * @return void.
     **/
    function pezigns_starter_wrapper_end() {

        do_action( 'genesis_after_loop' );
        genesis_markup( array(
            'html5' => '</main>', //* end .content
            'xhtml' => '</div>', //* end #content
        ) );
        do_action( 'genesis_after_content' );

        echo '</div>'; //* end ..content-inner or #.content-inner
        do_action( 'genesis_after_content_sidebar_wrap' );

    }
    add_action( 'woocommerce_after_main_content', 'pezigns_starter_wrapper_end', 10 );


    /**
     *  pezigns_starter_add_bulma_input_classes()
     * @since 1.0.0
     *
     * @param      $args
     * @param      $key
     * @param null $value
     *
     * @return mixed.
     **/
    function pezigns_starter_add_bulma_input_classes( $args, $key, $value = null ) {

        // Start field type switch case
        switch ( $args['type'] ) {

            case "select" :  /* Targets all select input type elements, except the country and state select input types */
                $args['class'][] = 'field'; // Add a class to the field's html element wrapper - woocommerce input types (fields) are often wrapped within a <p></p> tag
                $args['input_class'] = array('input', 'input-lg'); // Add a class to the form input itself
                //$args['custom_attributes']['data-plugin'] = 'select2';
                $args['label_class'] = array('label');
                $args['custom_attributes'] = array( 'data-plugin' => 'select2', 'data-allow-clear' => 'true', 'aria-hidden' => 'true',  ); // Add custom data attributes to the form input itself
                break;

            case 'country' : /* By default WooCommerce will populate a select with the country names - $args defined for this specific input type targets only the country select element */
                $args['class'][] = 'field single-country';
                $args['label_class'] = array('label');
                break;

            case "state" : /* By default WooCommerce will populate a select with state names - $args defined for this specific input type targets only the country select element */
                $args['class'][] = 'field'; // Add class to the field's html element wrapper
                $args['input_class'] = array('input', 'input-lg'); // add class to the form input itself
                //$args['custom_attributes']['data-plugin'] = 'select2';
                $args['label_class'] = array('label');
                $args['custom_attributes'] = array( 'data-plugin' => 'select2', 'data-allow-clear' => 'true', 'aria-hidden' => 'true',  );
                break;


            case "password" :
            case "text" :
            case "email" :
            case "tel" :
            case "number" :
                $args['class'][] = 'field';
                //$args['input_class'][] = 'input input-lg'; // will return an array of classes, the same as bellow
                $args['input_class'] = array('input', 'input-lg');
                $args['label_class'] = array('label');
                break;

            case 'textarea' :
                $args['input_class'] = array('input', 'input-lg');
                $args['label_class'] = array('label');
                break;

            case 'checkbox' :
                break;

            case 'radio' :
                break;

            default :
                $args['class'][] = 'field';
                $args['input_class'] = array('input', 'input-lg');
                $args['label_class'] = array('label');
                break;
        }

        return $args;
    }
    add_filter('woocommerce_form_field_args','pezigns_starter_add_bulma_input_classes',10,3);
}

/**
 * woocommerce END
 */

/**
 * Add Custom Pezigns Starter Gutenberg Blocks
 */
require get_stylesheet_directory() . '/inc/gutenberg.php';

add_action( 'after_setup_theme', 'pezigns_starter_setup' );


/**
 * pezigns_starter_setup()
 * @since 1.0.0
 * @return void.
 **/
function pezigns_starter_setup() {
    load_theme_textdomain( 'pezigns_starter', get_template_directory() . '/languages' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array( 'search-form' ) );
    // Add theme support for accessibility.
    add_theme_support( 'genesis-accessibility', array(
        '404-page',
        'drop-down-menu',
        'headings',
        'rems',
        'search-form',
        'skip-links',
    ) );
    global $content_width;
    if ( ! isset( $content_width ) ) { $content_width = 1920; }
    register_nav_menus( array( 'main-menu' => esc_html__( 'Main Menu', 'pezigns_starter' ) ) );
}

add_action( 'wp_enqueue_scripts', 'pezigns_starter_load_scripts' );


/**
 * pezigns_starter_load_scripts()
 * @since 1.0.0
 * @return void.
 **/
function pezigns_starter_load_scripts() {
    wp_enqueue_style( 'pezigns_starter-style', get_stylesheet_uri() );
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri().'/js/custom.js' );
}

add_action( 'wp_footer', 'pezigns_starter_footer_scripts' );


/**
 * pezigns_starter_footer_scripts()
 * @since 1.0.0
 * @return void.
 **/
function pezigns_starter_footer_scripts() {
    ?>
	<script>
      jQuery(document).ready(function (jQuery) {
        var deviceAgent = navigator.userAgent.toLowerCase();
        if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
          jQuery("html").addClass("ios");
          jQuery("html").addClass("mobile");
        }
        if (navigator.userAgent.search("MSIE") >= 0) {
          jQuery("html").addClass("ie");
        }
        else if (navigator.userAgent.search("Chrome") >= 0) {
          jQuery("html").addClass("chrome");
        }
        else if (navigator.userAgent.search("Firefox") >= 0) {
          jQuery("html").addClass("firefox");
        }
        else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
          jQuery("html").addClass("safari");
        }
        else if (navigator.userAgent.search("Opera") >= 0) {
          jQuery("html").addClass("opera");
        }
      });
	</script>
    <?php
}

/**
 * Define path to the ACF plugin.
 */
const PEZIGNS_ACF_PATH = ABSPATH . 'wp-content/plugins/advanced-custom-fields-pro/';

/**
 *Define URL to the ACF plugin.
 */
define( 'PEZIGNS_ACF_URL', get_site_url() . '/wp-content/plugins/advanced-custom-fields-pro/' );

// Include the ACF plugin.
include_once( ACF_PATH . 'acf.php' );


/**
 * pezigns_starter_acf_settings_url()
 *
 * Customize the url setting to fix incorrect asset URLs.
 *
 * @since 1.0.0
 *
 * @param $url
 *
 * @return string.
 **/
function pezigns_starter_acf_settings_url( $url ) {
    return PEZIGNS_ACF_URL;
}
add_filter('acf/settings/url', 'pezigns_starter_acf_settings_url');


/**
 * acf_settings()
 *
 * Configure ACF Settings in bulk.
 *
 * @since 1.0.0
 * @return void.
 **/
function acf_settings() {
    // Absolute path to ACF plugin folder including trailing slash
    acf_update_setting( 'path', PEZIGNS_ACF_PATH );
    // URL to ACF plugin folder including trailing slash
    acf_update_setting( 'dir', PEZIGNS_ACF_URL );
}
add_filter( 'acf/init', 'acf_settings' );


/**
 * pezigns_starter_ACF_meta_in_REST()
 *
 * Automatically expose all the ACF fields to the Wordpress REST API in Pages and in your custom post types.
 *
 * @return void.
 **@since 1.0.0
 */
function pezigns_starter_ACF_meta_in_REST() {
    $postypes_to_exclude = ['acf-field-group','acf-field'];
    $extra_postypes_to_include = ["page", "post"];
    $post_types = array_diff(get_post_types(["_builtin" => false], 'names'),$postypes_to_exclude);

    array_push($post_types, $extra_postypes_to_include);

    foreach ($post_types as $post_type) {
        register_rest_field( $post_type, 'acf', [
                'get_callback'    => 'pezigns_starter_expose_ACF_fields',
                'schema'          => null,
            ]
        );
    }

}

function pezigns_starter_expose_ACF_fields( $object ) {
    $ID = $object['id'];
    return get_fields($ID);
}
add_action( 'rest_api_init', 'pezigns_starter_ACF_meta_in_REST' );

/**
 * pezigns_starter_acf_settings_show_admin()
 *
 * (Optional) Hide the ACF admin menu item.
 *
 * @since 1.0.0
 * @param $show_admin
 * @return bool.
 **/
function pezigns_starter_acf_settings_show_admin( $show_admin ) {
    return false;
}
//add_filter('acf/settings/show_admin', 'pezigns_starter_acf_settings_show_admin');


if( function_exists('acf_add_options_page') ) {

    $option_page = acf_add_options_page(array(
        'page_title' 	=> 'Site Settings',
        'menu_title' 	=> 'Site Settings',
        'menu_slug' 	=> 'site-settings',
        'icon_url'     => get_stylesheet_directory_uri().'/img/pezigns-logo.svg',
        'capability' 	=> 'edit_posts',
        'redirect' 	=> false
    ));

}



/**
 * pezigns_starter_get_logo()
 * @since 1.0.0
 * @return string.
 **/
function pezigns_starter_get_logo(){
    $login_logo = esc_url( wp_get_attachment_url( get_theme_mod( 'custom_logo' ) ) );
    if ( empty( $login_logo ) ){
        $login_logo = "http://pezigns-blueprint.local/wp-content/uploads/2021/04/cropped-Pezigns-Logo-updated-2019-white-P-only.png";
        return $login_logo;
    }
    return $login_logo;
}

/**
 * pezigns_starter_get_login_background()
 * @since 1.0.0
 * @return string.
 **/
function pezigns_starter_get_login_background(){
    $custom_login_background = get_field('styles_&_colors','option');
    $login_background =  esc_url( $custom_login_background['login_background_image']['url'] );
    if ( empty( $login_background ) ){
        $login_background = "https://picsum.photos/1920/1080?grayscale&blur=2";
        return $login_background;
    }
    return $login_background;
}

/**
 * pezigns_starter_login_logo()
 * @since 1.0.0
 * @return void.
 **/
function pezigns_starter_login_logo() {
    $login_background = pezigns_starter_get_login_background();
    $login_logo = pezigns_starter_get_logo();
    echo '<style type="text/css">
		h1 a {
			background-image:url('.$login_logo.') !important; 
			background-size: 100px !important;
			width: auto !important;
			min-height: 100px; }
		body {
			background: linear-gradient( rgba(0, 0, 0, .65), rgba(0, 0, 0, .55) ),  url('.$login_background.') !important;
			background-size: cover !important;
			background-position: center center !important;
		}.login form {
			margin-top: 20px;
			margin-left: 0;
			padding: 26px 24px 46px;
			background: rgba(0,0,0,.65);
			box-shadow: 0 1px 3px rgba(0,0,0,.13);
			border: medium none;
		}.wp-core-ui .button-primary {
			background: #933ded !important;
			border-color: #933ded !important;
			-webkit-box-shadow: 0 1px 0 #933ded !important;
			box-shadow: 0 1px 0 #933ded !important;
			color: #fff;
			text-decoration: none;
			text-shadow: 0 -1px 1px #933ded, 1px 0 1px #933ded, 0 1px 1px #933ded, -1px 0 1px #933ded !important;
		}
		.wp-core-ui .button-primary:hover {
			background: #8A2BE2 !important;
			border-color: #8A2BE2 !important;
			-webkit-box-shadow: 0 1px 0 #8A2BE2 !important;
			box-shadow: 0 1px 0 #8A2BE2 !important;
			color: #fff;
			text-decoration: none;
			text-shadow: 0 -1px 1px #8A2BE2, 1px 0 1px #8A2BE2, 0 1px 1px #8A2BE2, -1px 0 1px #8A2BE2 !important;
		}
		input:-webkit-autofill, textarea:-webkit-autofill, select:-webkit-autofill {
			background-color: rgba(147, 61, 237, .4) !important;
			background-image: none;
			color: rgb(0, 0, 0);
		}.login #backtoblog a, .login #nav a {
			text-decoration: none;
			color: #fff !important;
		}.login label {
			color: #fff !important;
			font-size: 14px;
		}
	</style>';
}

add_action('login_head', 'pezigns_starter_login_logo');

/**
 * pezigns_starter_options_icon()
 * @since 1.0.0
 * @return void.
 **/
function pezigns_starter_options_icon(){
    echo'<style>
			#adminmenu .wp-menu-image img {
			  padding: 5% 5% !important;
			  margin: 5% 10% !important;
			  opacity: .8;
			  filter: alpha(opacity=80);
			  max-width: 19px !important;
			}
			#adminmenu .toplevel_page_site-settings a:hover{
			box-shadow: inset 4px 0 0 0 #ff0000;
            transition: box-shadow .1s linear;
            background: #f0f0f0 !important;
            color: #000 !important;
			}
			.current.toplevel_page_site-settings {
				background: #f0f0f0 !important;
				color: #000 !important;
			}
			.CodeMirror-sizer {
			  min-height: 20vh !important;
			}
		</style>';
}
add_action('admin_head', 'pezigns_starter_options_icon');


/**
 * pezigns_starter_acf_frontend_styling()
 * @since 1.0.0
 * @return void.
 **/
function pezigns_starter_acf_frontend_styling() {
    $styles = get_field('styles_&_colors', 'option');
    $heading_font_select = get_field('heading_font_select', 'option');
    $heading_font_weight_select = get_field('heading_font_weight_select', 'option');
    $heading_fallback_font_select = get_field('heading_fallback_font_select', 'option');
    $paragraph_font_select = get_field('paragraph_font_select', 'option');
    $header_color = $styles['header_color'];
    $footer_color = $styles['footer_color'];
    $header_menu_items_color = $styles['header_menu_items_color'];
    $header_menu_items_color_current = $styles['header_menu_items_color_current'];
    $footer_menu_items_color = $styles['footer_menu_items_color'];
    $footer_text_color = $styles['footer_text_color'];
    $link_color = $styles['header_menu_items_color'];
    $link_hover = $styles['link_hover'];
    ?>
	<style type="text/css">

		/* Acf Start ---------------------------------------------------------------------------------------------------- */
		/**
         * Set Header Background Color
         */

		.site-container a:not(.footer-widgets a, .footer a, .button, .content a){
			color:<?php echo $link_color; ?> !important;
		}
		.site-container a:hover:not(.footer-widgets a, .footer a, .button){
			color:<?php echo $link_hover; ?> !important;
		}
		body {
			font-family: <?php echo $paragraph_font_select; ?> !important;
		}
		body.header-color header.header{
			background-color: <?php echo $header_color; ?>;
		}
		/**
         * Set Footer Background Color
         */
		body.footer-color footer.footer{
			background-color: <?php echo $footer_color; ?>;
		}

		/**
         * Set Header Menu Items Color
         */
		body.header-menu-items-color .navbar-item, body.header-menu-items-color .navbar-item::after{
			color: <?php echo $header_menu_items_color; ?>;
		}
		/**
         * Set Header Menu Items Active Color
         */
		body.header-menu-items-color a.navbar-item.is-active{
			color:<?php echo $header_menu_items_color_current; ?> !important;
		}

		/**
         * Set Header Drop-down Menu Items Color
         */
		body.header-color .navbar-link:hover {
			background-color: <?php echo $header_color; ?>;
		}
		/**
         * Set Header Drop-down Menu Items Hover Color
         */
		body.header-menu-items-color a.navbar-item:hover{
			color:<?php echo $link_hover; ?> !important;
		}
		/**
         * Set Mobile Burger Menu Icon Color
         */
		body.header-menu-items-color .navbar-burger {
			color: <?php echo $header_menu_items_color; ?> !important;
		}
		body.header-color .navbar-menu {
			background-color: <?php echo $header_color; ?>;
			/* box-shadow: 0 8px 16px rgb(10 10 10 / 10%); */
			padding: 0.5rem 0;
		}
		body.header-color .navbar-item.is-active, body.header-color .navbar-link.is-active {
			background-color: <?php echo $header_color; ?>;
		}

		/**
         * Set Header Drop-down Menu Background Color
         */
		body.header-menu-items-color .navbar-dropdown {
			background-color: <?php echo $header_color; ?>;
			border-top: 2px solid <?php echo $header_color; ?>;
		}
		/**
         * Set Header Drop-down Menu background Hover Color
         */
		body.header-menu-items-color .navbar-item.has-dropdown.is-hoverable, .navbar-item.has-dropdown:hover .navbar-link, a.navbar-item:hover {
			background-color: <?php echo $header_color; ?> !important;
		}
		/**
         * Set Header Drop-down Menu Arrow Color
         */
		body.header-menu-items-color .navbar-link:not(.is-arrowless)::after {
			border-color: <?php echo $header_menu_items_color; ?>;
			margin-top: -0.375em;
			right: 1.125em;
		}
		/**
         * Set Footer Drop-down Menu Arrow Color
         */
		body.footer-menu-items-color footer .navbar-link:not(.is-arrowless)::after, body.footer-menu-items-color .footer-widgets .navbar-link:not(.is-arrowless)::after {
			border-color: <?php echo $footer_menu_items_color; ?>;
			margin-top: -0.375em;
			right: 1.125em;
		}
		/**
         * Set Footer link (<a>) color
         */
		body.footer-menu-items-color footer  a, body.footer-menu-items-color .footer-widgets  a {
			color: <?php echo $footer_menu_items_color; ?>;
		}
		/**
         * Set Footer link sub-menu (<a>) color
         */
		body.footer-menu-items-color footer li.has-child  ul li a, body.footer-menu-items-color .footer-widgets  li.has-child  ul li a {
			color: black;
		}
		/**
         * Set Footer link (<a>) hover color
         */
		body.footer-menu-items-color footer a:hover, body.footer-menu-items-color .footer-widgets a:hover {
			color: <?php echo $link_hover; ?> !important;
		}
		body.footer-menu-items-color footer li.has-child  ul li a:hover, body.footer-menu-items-color .footer-widgets li.has-child  ul li a:hover {
			color: <?php echo $link_hover; ?> !important;
		}
		/**
         * Set Footer text (<p>)color
         */
		body.footer-menu-items-color footer .content p, body.footer-menu-items-color footer .content, body.footer-menu-items-color footer-widgets .content{
			color: <?php echo $footer_text_color; ?> !important;
		}
		h1,
		h2,
		h3,
		h4,
		h5,
		h6,
		.content h1,
		.content h2,
		.content h3,
		.content h4,
		.content h5,
		.content h6 {
			font-family: "<?php echo $heading_font_select; ?>", <?php echo $heading_fallback_font_select; ?> !important;
			font-weight: <?php echo $heading_font_weight_select; ?> !important;
		}


		/* Acf End ---------------------------------------------------------------------------------------------------- */
	</style>
    <?php
}
add_action( 'wp_head', 'pezigns_starter_acf_frontend_styling', 100 );


/**
 * gb_gutenberg_admin_styles()
 * @since 1.0.0
 * @return void.
 **/
function gb_gutenberg_admin_styles() {

    echo '
        <style>
            /* Main column width */
            .wp-block {
                max-width: 100%;
            }
 
            /* Width of "wide" blocks */
            .wp-block[data-align="wide"] {
                max-width: 1080px !important;
            }
 
            /* Width of "full-wide" blocks */
            .wp-block[data-align="full"] {
                max-width: none !important;
            }	
        </style>
    ';
}
add_action('admin_head', 'gb_gutenberg_admin_styles');


/**
 * pezigns_starter_document_title_separator()
 * @since 1.0.0
 *
 * @param $sep
 *
 * @return string.
 **/
function pezigns_starter_document_title_separator( $sep ) {
    $sep = '|';
    return $sep;
}
add_filter( 'document_title_separator', 'pezigns_starter_document_title_separator' );


/**
 * pezigns_starter_title()
 * @since 1.0.0
 *
 * @param $title
 *
 * @return string.
 **/
function pezigns_starter_title( $title ) {
    if ( $title == '' ) {
        return '...';
    } else {
        return $title;
    }
}
add_filter( 'the_title', 'pezigns_starter_title' );


/**
 * pezigns_starter_read_more_link()
 * @since 1.0.0
 * @return string.
 **/
function pezigns_starter_read_more_link() {
    if ( ! is_admin() ) {
        return ' <a href="' . esc_url( get_permalink() ) . '" class="more-link">...</a>';
    }
}
add_filter( 'the_content_more_link', 'pezigns_starter_read_more_link' );


/**
 * pezigns_starter_excerpt_read_more_link()
 * @since 1.0.0
 *
 * @param $more
 *
 * @return string.
 **/
function pezigns_starter_excerpt_read_more_link( $more ) {
    if ( ! is_admin() ) {
        global $post;
        return ' <a href="' . esc_url( get_permalink( $post->ID ) ) . '" class="more-link">...</a>';
    }
}
add_filter( 'excerpt_more', 'pezigns_starter_excerpt_read_more_link' );


/**
 * pezigns_starter_image_insert_override()
 * @since 1.0.0
 *
 * @param $sizes
 *
 * @return mixed.
 **/
function pezigns_starter_image_insert_override( $sizes ) {
    unset( $sizes['medium_large'] );
    return $sizes;
}
add_filter( 'intermediate_image_sizes_advanced', 'pezigns_starter_image_insert_override' );


/**
 * pezigns_starter_widgets_init()
 * @since 1.0.0
 * @return void.
 **/
function pezigns_starter_widgets_init() {
    register_sidebar( array(
        'name' => esc_html__( 'Sidebar Widget Area', 'pezigns_starter' ),
        'id' => 'primary-widget-area',
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
}
add_action( 'widgets_init', 'pezigns_starter_widgets_init' );


/**
 * pezigns_starter_pingback_header()
 * @since 1.0.0
 * @return void.
 **/
function pezigns_starter_pingback_header() {
    if ( is_singular() && pings_open() ) {
        printf( '<link rel="pingback" href="%s" />' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
}
add_action( 'wp_head', 'pezigns_starter_pingback_header' );


/**
 * pezigns_starter_enqueue_comment_reply_script()
 * @since 1.0.0
 * @return void.
 **/
function pezigns_starter_enqueue_comment_reply_script() {
    if ( get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'comment_form_before', 'pezigns_starter_enqueue_comment_reply_script' );

/**
 * pezigns_starter_custom_pings()
 * @since 1.0.0
 *
 * @param $comment
 *
 * @return void.
 **/
function pezigns_starter_custom_pings( $comment ) {
    ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
    <?php
}
add_filter( 'get_comments_number', 'pezigns_starter_comment_count', 0 );


/**
 * pezigns_starter_comment_count()
 * @since 1.0.0
 *
 * @param $count
 *
 * @return int.
 **/
function pezigns_starter_comment_count( $count ) {
    if ( ! is_admin() ) {
        global $id;
        $get_comments = get_comments( 'status=approve&post_id=' . $id );
        $comments_by_type = separate_comments( $get_comments );
        return count( $comments_by_type['comment'] );
    } else {
        return $count;
    }
}



/**
 * pezigns_starter_header_scripts()
 *
 * Include Header Scripts
 *
 * @since 1.0.0
 * @return void.
 **/
function pezigns_starter_header_scripts() {

    $scripts = get_field('scripts', 'option');
    $headScripts = $scripts['head_scripts'];

    echo $headScripts;
}
add_action('wp_head','pezigns_starter_header_scripts', 100);


/**
 * footer_scripts()
 *
 * Include Footer Scripts
 *
 * @since 1.0.0
 * @return void.
 **/
function footer_scripts() {

    $scripts = get_field('scripts', 'option');
    $footerScripts = $scripts['footer_scripts'];

    echo $footerScripts;
}
add_action('wp_footer','footer_scripts', 20);


/**
 * get_google_tag_id()
 *
 * adds google analytics tag id dynamically
 *
 * @since 1.0.0
 * @return mixed.
 **/
function get_google_tag_id() {
    $GTM_id = get_field('scripts', 'option');
    $id = $GTM_id['google_tag_id'];

    return $id;
}
add_action('init', 'get_google_tag_id');


/**
 * pezigns_starter_menu_item_class()
 * @since 1.0.0
 *
 * @param $attributes
 *
 * @return mixed.
 **/
function pezigns_starter_menu_item_class( $attributes ) {
    $attributes['class'] = 'navbar-item';
    return $attributes;
}
add_filter( 'genesis_attr_menu-item', 'pezigns_starter_menu_item_class' );



/**
 * pezigns_starter_site_title_area_class()
 * @since 1.0.0
 *
 * @param $attributes
 *
 * @return mixed.
 **/
function pezigns_starter_site_title_area_class( $attributes ) {
    $attributes['class'] = 'navbar-brand';
    return $attributes;
}
add_filter( 'genesis_attr_title-area', 'pezigns_starter_site_title_area_class' );

/**
 * pezigns_starter_is_dark()
 *
 * Checks if the dark mode toggle in site settings is on or not, if its on returns 'dark' string.
 *
 * @return string.
 **@since 1.0.0
 */
function pezigns_starter_is_dark(){
    $is_dark = get_field('dark_mode','option');
    $dark = $is_dark ? 'dark' : '';

    return $dark;
}
/**
 * pezigns_starter_site_header_class()
 * @since 1.0.0
 *
 * @param $attributes
 *
 * @return mixed.
 **/
function pezigns_starter_site_header_class( $attributes ) {
    $dark = pezigns_starter_is_dark();

	$attributes['class'] = 'header '. $dark;
    $attributes['role'] = 'navigation';
    $attributes['aria-label'] = 'main navigation';

    return $attributes;
}
add_filter( 'genesis_attr_site-header', 'pezigns_starter_site_header_class' );


/**
 * pezigns_starter_custom_logo_link_class()
 * @since 1.0.0
 *
 * @param $attributes
 *
 * @return mixed.
 **/
function pezigns_starter_custom_logo_link_class( $attributes ) {
    $attributes['class'] = 'navbar-item';
    return $attributes;
}
add_filter( 'genesis_attr_custom-logo-link', 'pezigns_starter_custom_logo_link_class' );


/**
 * pezigns_starter_nav_header_menu_class()
 * @since 1.0.0
 *
 * @param $attributes
 *
 * @return mixed.
 **/
function pezigns_starter_nav_header_menu_class( $attributes ) {
    $attributes['class'] = 'navbar-menu';
    return $attributes;
}
add_filter( 'genesis_attr_nav-header-menu', 'pezigns_starter_nav_header_menu_class' );


/**
 * pezigns_starter_nav_header_menu_left_class()
 * @since 1.0.0
 *
 * @param $attributes
 *
 * @return mixed.
 **/
function pezigns_starter_nav_header_menu_left_class( $attributes ) {
    $attributes['class'] = 'navbar-start';
    return $attributes;
}
add_filter( 'genesis_attr_nav-header-menu-left', 'pezigns_starter_nav_header_menu_left_class' );


/**
 * pezigns_starter_nav_header_menu_right_class()
 * @since 1.0.0
 *
 * @param $attributes
 *
 * @return mixed.
 **/
function pezigns_starter_nav_header_menu_right_class( $attributes ) {
    $attributes['class'] = 'navbar-end';
    return $attributes;
}
add_filter( 'genesis_attr_nav-header-menu-right', 'pezigns_starter_nav_header_menu_right_class' );


/**
 * pezigns_starter_header_widget_area_class()
 * @since 1.0.0
 *
 * @param $attributes
 *
 * @return mixed.
 **/
function pezigns_starter_header_widget_area_class( $attributes ) {
    $attributes['class'] = 'navbar-menu';
    return $attributes;
}
add_filter( 'genesis_attr_header-widget-area', 'pezigns_starter_header_widget_area_class' );

/**
 * pezigns_starter_site_inner_class()
 * @since 1.0.0
 *
 * @param $attributes
 *
 * @return mixed.
 **/
function pezigns_starter_site_inner_class( $attributes ) {
    $attributes['class'] = 'content-container';
    return $attributes;
}
add_filter( 'genesis_attr_site-inner', 'pezigns_starter_site_inner_class' );


/**
 * pezigns_starter_site_footer_class()
 * @since 1.0.0
 *
 * @param $attributes
 *
 * @return mixed.
 **/
function pezigns_starter_site_footer_class( $attributes ) {
    $attributes['class'] = 'footer section';
    return $attributes;
}
add_filter( 'genesis_attr_site-footer', 'pezigns_starter_site_footer_class' );


/**
 * pezigns_starter_custom_footer()
 *
 * Customize site footer
 *
 * @since 1.0.0
 * @return void.
 **/
function pezigns_starter_custom_footer() {
    $dark = pezigns_starter_is_dark();
	?>

	<footer class="footer <?php echo $dark; ?> section">
		<div class="content has-text-centered">
            <?php do_action( 'genesis_footer' ); ?>
			<p>&copy; <?php echo date('Y '); echo '<a href="'.site_url().'">'.bloginfo('"name"') . '</a>';  ?></p>
			<p>Design by <a href="https://www.pezigns.com/">Pezigns</a>.</p>
		</div>
	</footer>


    <?php
}
add_action( 'genesis_before_footer', 'pezigns_starter_custom_footer' );


/**
 * Echoes the "Custom Navigation" menu.
 */
function pezigns_starter_do_nav() {

    //    // Do nothing if menu not supported.
    //    if ( ! genesis_nav_menu_supported( 'main-menu' ) || ! has_nav_menu( 'header-menu' ) ) {
    //        echo"here";
    //        return;
    //    }

    $startclass = 'navbar-start header-menu-left';
    $endclass = 'navbar-end header-menu-right';


    genesis_nav_menu( array(
        'theme_location' => 'header-menu-left',
        'menu_class'     => $startclass,
        'container_class'         => 'navbar-menu',
        'walker' => new bulma_navwalker(),
    ) );
    genesis_nav_menu( array(
        'theme_location' => 'header-menu-right',
        'menu_class'     => $endclass,
        'container_class'         => 'navbar-menu',
        'walker' => new bulma_navwalker()
    ) );


}
add_action( 'genesis_header', 'pezigns_starter_do_nav', 12 );


/**
 * change_logo_class()
 * @since 1.0.0
 *
 * @param $html
 *
 * @return mixed.
 **/
function change_logo_class( $html ) {

    $html = str_replace( 'custom-logo-link', 'navbar-item', $html );
    $html = str_replace( 'custom-logo', 'logo', $html );

    return $html;
}

/**
 * special_nav_class()
 * @since 1.0.0
 *
 * @param $classes
 * @param $item
 *
 * @return array.
 **/
function special_nav_class( $classes, $item ){

    $classes = ["navbar-item"];


    return $classes;
}
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
add_action('genesis_site_title', 'burger_menu');

/**
 * burger_menu()
 * @since 1.0.0
 * @return void.
 **/
function burger_menu(){ ?>
	<a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false">
		<span aria-hidden="true"> </span>
		<span aria-hidden="true"></span>
		<span aria-hidden="true"></span>
	</a>
<?php }

add_action('genesis_header_right', 'navbar_menu_wrap');


/**
 * navbar_menu_wrap()
 * @since 1.0.0
 * @return void.
 **/
function navbar_menu_wrap(){
    printf( '<div class="navbar-menu" style="display:none;">' );
}


/**
 *
 * Add custom classes to the page based on ACF settings
 *
 * @since 1.0.0
 *
 * @param $classes
 *
 * @return array.
 **/
add_filter( 'body_class', function( $classes ) {
    $body_classes= array();
    $styles = get_field('styles_&_colors', 'option');
    $header_color = $styles['header_color'];
    $footer_color = $styles['footer_color'];
    $header_menu_items_color = $styles['header_menu_items_color'];
    $footer_menu_items_color = $styles['footer_menu_items_color'];
    $dark_mode = $styles['dark_mode'];

    // add header color class
    if( !empty($header_color)){
        $body_classes[] = "header-color";
    }
    // add footer color class
    if ( !empty($footer_color) ){
        $body_classes[] = "footer-color";
    }
    if ( !empty($header_menu_items_color) ){
        $body_classes[] = "header-menu-items-color";
    }
    if ( !empty($footer_menu_items_color) ){
        $body_classes[] = "footer-menu-items-color";
    }
    if ( $dark_mode){
        $body_classes[] = "dark";
    }

    // merge your custom classes with the usual classes added to the body element
    return array_merge( $classes, $body_classes );

} );


/**
 * pezigns_starter_site_health()
 * @since 1.0.0
 * @return void.
 **/
function pezigns_starter_site_health(){
    //    require_once(ABSPATH . 'wp-admin/site-health.php');
}
//add_action("init","pezigns_starter_site_health");


/**
 * pezigns_starter_reordering_checkout_order_review()
 *
 * remove order review header and move to inside order review table in woocommerce checkout
 *
 * @return void.
 **@since 1.0.0
 */
function pezigns_starter_reordering_checkout_order_review(){
    remove_action( 'woocommerce_checkout_before_order_review_heading', 'woocommerce_order_review_heading', 10 );
    remove_action( 'woocommerce_checkout_before_order_review', 'woocommerce_order_review', 10 );
    add_action( 'woocommerce_checkout_order_review', 'pezigns_starter_after_custom_checkout_payment', 9 );

}
add_action( 'woocommerce_checkout_order_review', 'pezigns_starter_reordering_checkout_order_review', 1 );

/**
 * pezigns_starter_after_custom_checkout_payment()
 *
 * change the custom review order text that we reordered in pezigns_starter_reordering_checkout_order_review()
 *
 * @return void.
 **@since 1.0.0
 */
function pezigns_starter_after_custom_checkout_payment() { ?>
	<div id="before-order-table" class="woocommerce-checkout-custom-text">
		<h3 id="pez-order_review"><?php _e("Order details", "pezigns_starter"); ?></h3>
	</div>
<?php
}


remove_action('genesis_attr_order_review_heading', 'woocommerce_checkout_before_order_review_heading');