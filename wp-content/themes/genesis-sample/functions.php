<?php
/**
 * Genesis Sample.
 *
 * This file adds functions to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://www.studiopress.com/
 */

//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'genesis-sample', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'genesis-sample' ) );

//* Add Image upload and Color select to WordPress Theme Customizer
require_once( get_stylesheet_directory() . '/lib/customize.php' );

//* Include Customizer CSS
include_once( get_stylesheet_directory() . '/lib/output.php' );

//* Include ohouais socials icon
require_once( get_stylesheet_directory() . '/lib/ohouais-socials.php' );

//* Include ohouais widget sidebar lateral
require_once( get_stylesheet_directory() . '/lib/ohouais-widget.php' );

//* Include ohouais widget sidebar lateral
require_once( get_stylesheet_directory() . '/lib/cpt.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Genesis Sample' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/' );
define( 'CHILD_THEME_VERSION', '2.2.4' );

//* Enqueue Scripts and Styles
add_action( 'wp_enqueue_scripts', 'genesis_sample_enqueue_scripts_styles' );
function genesis_sample_enqueue_scripts_styles() {

	wp_enqueue_style( 'genesis-sample-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700', array(), CHILD_THEME_VERSION );
    wp_enqueue_style( 'genesis-sample-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700', array(), CHILD_THEME_VERSION );
    wp_enqueue_style('fonts-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
	wp_enqueue_style( 'dashicons' );
    wp_enqueue_style( 'genesis-sample-owl-carousel', get_stylesheet_directory_uri() . '/css/owl.carousel.min.css' );
    wp_enqueue_style( 'genesis-sample-owl-theme', get_stylesheet_directory_uri() . '/css/owl.theme.default.css' );

    wp_enqueue_script( 'genesis-sample-jquery', get_stylesheet_directory_uri() . '/js/jquery.min.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'genesis-sample-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'genesis-sample-custom', get_stylesheet_directory_uri() . '/js/custom.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'genesis-sample-owl-carousel-js', get_stylesheet_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), '1.0.0', true );
	$output = array(
		'mainMenu' => __( 'Menu', 'genesis-sample' ),
		'subMenu'  => __( 'Menu', 'genesis-sample' ),
	);

	wp_enqueue_script( 'ohouais-custom-js', get_stylesheet_directory_uri() . '/js/custom.js', array( 'jquery' ), '1.0.0', true );

	wp_localize_script( 'genesis-sample-responsive-menu', 'genesisSampleL10n', $output );



}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

//* Add Accessibility support
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'width'           => 532,
	'height'          => 272,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
) );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Add Image Sizes
add_image_size( 'featured-image', 720, 400, TRUE );

//* Rename primary and secondary navigation menus
add_theme_support( 'genesis-menus' , array( 'primary' => __( 'After Header Menu', 'genesis-sample' ), 'secondary' => __( 'Footer Menu', 'genesis-sample' ) ) );

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );

//* Reduce the secondary navigation menu to one level depth
add_filter( 'wp_nav_menu_args', 'genesis_sample_secondary_menu_args' );
function genesis_sample_secondary_menu_args( $args ) {

	if ( 'secondary' != $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;

	return $args;

}

//* Modify size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'genesis_sample_author_box_gravatar' );
function genesis_sample_author_box_gravatar( $size ) {

	return 90;

}

//* Modify size of the Gravatar in the entry comments
add_filter( 'genesis_comment_list_args', 'genesis_sample_comments_gravatar' );
function genesis_sample_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;

	return $args;

}

//* Customize the entire footer
remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'ohouais_custom_mentions_footer' );
function ohouais_custom_mentions_footer() {

    echo'<p>&copy; Copyright 2017 Nom du site &middot; Création : <a href="#" target="_blank" href="http://wordpress.org/">Ohouais</a></p>';

}

// modification du footer
add_action( 'genesis_footer', 'ohouais_custom_test_footer' );
function ohouais_custom_test_footer() {

    echo'<p></p>';

}

// Ajout d'une class pour header active
if(get_field('header_fixe_transparent')){

    //* Add Extra Fullwidth Class
    add_filter( 'body_class', 'header_fixe_class_body' );
    function header_fixe_class_body( $classes ) {

        $classes[] = 'site-header-active';
        return $classes;

    }

}

//* Customize the breadcrumbs genesis
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'genesis_after_header', 'genesis_do_breadcrumbs',15 );

// title page
remove_action( 'genesis_before_loop', 'genesis_do_posts_page_heading' );

// function search
function search_exposition(){ ?>

    <div id="nav-search" style="padding: 30px 0; background-color: #ff6400;">
        <div class="wrap">Barre de recherche</div>
    </div>

    <?php
}
add_action('genesis_after_header','search_exposition',10);

// function search filter
function filter_expositions(){

    if ( is_front_page() ){

        $queried_object = get_queried_object();
        $taxonomy = $queried_object->taxonomy;
        $term_id = $queried_object->term_id;
        $event_lieux = get_field('event_adress', $taxonomy . '_' . $term_id);

        $args = array(
            'post_type' => 'lieux',
            'order' => 'DESC',
            'tax_query' => array(
                'taxonomy' => 'category',
                'field'    => 'id',
                'terms'    => array($event_lieux)
            ),
        );

        $query = new WP_Query( $args ); ?>

        <div id="filter-expositions">
        <div class="wrap">
            <ul class="filter-nav">
                <li><a href="#">Événements</a></li>
                <div class="dropdown">
                    <ul>
                        <?php if($query->have_posts()) : while ($query->have_posts() ) : $query->the_post(); ?>
                        <li><?php echo the_title(); ?></li>
                        <?php endwhile; ?>
                        <?php endif; ?>
                        <?php wp_reset_postdata(); ?>
                    </ul>
                </div>
            </ul>
            <ul class="filter-nav">
                <li><a href="#">Lieux</a></li>
                <div class="dropdown">
                    <ul>
                        <li><a href="#">Dropdown 1</a></li>
                        <li><a href="#">Dropdown 2</a></li>
                    </ul>
                </div>
            </ul>
            <ul class="filter-nav">
                <li><a href="#">Dates</a></li>
                <div class="dropdown">
                    <ul>
                        <li><a href="#">Dropdown 1</a></li>
                        <li><a href="#">Dropdown 2</a></li>
                    </ul>
                </div>
            </ul>
            <ul class="filter-nav">
                <li><a href="#">Artistes</a></li>
                <div class="dropdown">
                    <ul>
                        <li><a href="#">Dropdown 1</a></li>
                        <li><a href="#">Dropdown 2</a></li>
                    </ul>
                </div>
            </ul>
            <button>Filtrer</button>
            <div style="width: 75%; display: block;">
            </div>
            <!--<button id="button-geolocation">Se géolocaliser</button>-->

        </div>
    </div>

    <?php }
}
add_action('genesis_after_header','filter_expositions',15);