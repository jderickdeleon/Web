<?php
/**
 * ALPS functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ALPS
 */

if ( ! function_exists( 'alps_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function alps_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on ALPS, use a find and replace
	 * to change 'alps' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'alps', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'alps' ),
		'footer' => esc_html__('Footer Menu', 'alps'),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'alps_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'alps_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function alps_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'alps_content_width', 640 );
}
add_action( 'after_setup_theme', 'alps_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function alps_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'alps' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'alps' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'alps_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function alps_scripts() {

	wp_enqueue_style( 'alps-style', get_stylesheet_uri() );

	wp_enqueue_script( 'jquery' );

	wp_enqueue_style( 'alps-bootstrap-style', get_template_directory_uri() . '/css/bootstrap.min.css');

	wp_enqueue_style( 'alps-stamp-icons', get_template_directory_uri() . '/inc/icon-picker/css/stamp-icons.min.css');

    wp_enqueue_script( 'alps-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '3.3.7', true );

	wp_enqueue_script( 'alps-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'alps-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

}
add_action( 'wp_enqueue_scripts', 'alps_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';



/**
 *  Custom Post-Type "Course"
 */
function alps_custom_post_type () {

    $types = array(

        array(
            'type' => 'in_house_course',
            'singular' => 'In House Course',
            'plural' => 'In House Courses'
        ),

        array(
            'type' => 'public_course',
            'singular' => 'Public Course',
            'plural' => 'Public Courses'
        ),

        array(
            'type' => 'faq',
            'single' => 'FAQ',
            'plural' => 'FAQs'
        )

    );

    foreach($types as $t) {
        $type = $t['type'];
        $singular = $t['singular'];
        $plural = $t['plural'];

        $labels = array(
            'name' => $plural,
            'singular_name' => $singular,
            'add_new' => 'Add New',
            'add_new_item' => 'Add New',
            'edit_item' => 'Edit',
            'new_item' => 'New',
            'view_item' => 'View',
            'search_item' => 'Search',
            'not_found' => 'No ' .$plural. ' found',
            'not_found_in_trash' => 'No ' .$plural. ' in trash',
            'parent_item_colon' => ''
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'has_archives' => false,
            'menu_icon' => 'dashicons-laptop',
            'publicly_queryable' => true,
            'query_var' => true,
            'rewrite' => true,
            'show_ui' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'supports' => array(
                'title',
                'editor'
            ),
            'menu_position' => 5
        );
        register_post_type($type, $args);
    }


}
add_action('init', 'alps_custom_post_type');


function change_default_title( $title ){
    $screen = get_current_screen();
    if  ( 'course' == $screen->post_type ) {
        $title = 'Course';
    } elseif ( 'faq' == $screen->post_type ) {
        $title = 'Question';
    }
    return $title;
}
add_filter( 'enter_title_here', 'change_default_title' );


function alps_customizer_style() {
    wp_register_style( 'customizer_stylesheet', get_template_directory_uri() . '/css/admin-style.css', '1.0.0');
    wp_enqueue_style( 'customizer_stylesheet' );
}
add_action( 'admin_enqueue_scripts', 'alps_customizer_style', 10);


function alps_customizer_script() {
    wp_register_script( 'customizer_script', get_template_directory_uri() . '/js/alps-customizer.js',
        array('jquery', 'jquery-ui-draggable'), '1.0.2', true);
    wp_enqueue_script( 'customizer_script' );
}
add_action( 'customize_controls_enqueue_scripts', 'alps_customizer_script');


function alps_make_protocol_relative_url( $url ) {
    return preg_replace( '(https?://)', '//', $url );
}


function remove_admin_menus() {
    remove_menu_page( 'edit-comments.php' );
    remove_menu_page( 'edit.php' );
}
add_action('admin_menu', 'remove_admin_menus');