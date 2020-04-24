<?php
/* load stylesheets, it is important that any new stylesheets load AFTER bootstrap */
function load_stylesheets()
{

    wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', 
        array(), false, 'all');
    wp_enqueue_style('bootstrap');

    wp_register_style('style', get_template_directory_uri() . '/style.css', 
        array(), false, 'all');
    wp_enqueue_style('style');


}
add_action('wp_enqueue_scripts', 'load_stylesheets');

/* include jquery, separate froms scripts */
function include_jquery()
{
    wp_deregister_script('jquery');

    wp_enqueue_script('jquery', get_template_directory_uri() . '/js/jquery3.4.1.min.js', '', 1,     true);
    add_action('wp_enqueue_scripts', 'jquery');



}
add_action('wp_enqueue_scripts', 'include_jquery');

/* load javascript for site */
function loadjs()
{




    wp_register_script('customjs', get_template_directory_uri() . '/js/scripts.js', '', 1, true);
    wp_enqueue_script('customjs');




}
add_action('wp_enqueue_scripts', 'loadjs');

/* theme supports, this will grow */
add_theme_support('menus');

add_theme_support('post-thumbnails');

add_theme_support( 'custom-logo' );

add_theme_support( 'custom-header' );

function prefix_custom_header_setup() {
	add_theme_support( 'custom-header', array(
        'video' => true,
        'height' => '300px',
	) );
}

add_action( 'after_setup_theme', 'prefix_custom_header_setup' );


/* menu locations */
register_nav_menus(

    array(

        'top-menu' => __('Top Menu', 'theme'),
        'footer-menu' => __('Footer Menu', 'theme'),

    )



);

/* image sizes*/
add_image_size('smallest', 300, 300, true);
add_image_size('largest', 800, 800, true);


/* Theme setup */
add_action( 'after_setup_theme', 'wpt_setup' );
    if ( ! function_exists( 'wpt_setup' ) ):
        function wpt_setup() {  
            register_nav_menu( 'primary', __( 'Primary navigation', 'wptuts' ) );
        } endif;


/* call bootstrap navwalker for menu THIS IS BLACK MAGIC AND YOU DAREN'T TOUCH IT */
function register_navwalker(){
	require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );

/* logo support */
function themename_custom_logo_setup() {
 $defaults = array(
 'height'      => 100,
 'width'       => 800,
 'flex-height' => true,
 'flex-width'  => true,
 'header-text' => array( 'site-title', 'site-description' ),
 );
 add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'themename_custom_logo_setup' );


/* header support */
function themename_custom_header_setup() {
    $defaults = array(
        // Default Header Image to display
        'default-image'         => get_template_directory_uri() . '/images/headers/default.jpg',
        // Display the header text along with the image
        'header-text'           => true,
        // Header text color default
        'default-text-color'        => '000',
        // Header image width (in pixels)
        'width'             => 1000,
        // Header image height (in pixels)
        'height'            => 198,
        // Header image random rotation default
        'random-default'        => false,
        // Enable upload of image file in admin 
        'uploads'       => false,
        // function to be called in theme head section
        'wp-head-callback'      => 'wphead_cb',
        //  function to be called in preview page head section
        'admin-head-callback'       => 'adminhead_cb',
        // function to produce preview markup in the admin screen
        'admin-preview-callback'    => 'adminpreview_cb',
        );
}
add_action( 'after_setup_theme', 'themename_custom_header_setup' );
