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

// google map
function my_google_map_api( $api ){
    $api['key'] = 'AIzaSyAo2vFww4DDQ5-LpuOKj0CAQiW19GddIks';
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_google_map_api');

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
    wp_enqueue_script( 'genesis-sample-owl-carousel-js', get_stylesheet_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'google-maps-api', '//maps.googleapis.com/maps/api/js?key=AIzaSyAo2vFww4DDQ5-LpuOKj0CAQiW19GddIks', array(), '', true );

    wp_enqueue_script( 'script', get_template_directory_uri().'/js/script.js', array('jquery'), '1.0', true );
    // pass Ajax Url to script.js
    wp_localize_script('script', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
/*
    wp_localize_script( 'ohouais-script', 'ajax_posts', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'noposts' => __('No older posts found', 'ohouais'),
    ));*/

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
add_image_size('thumbnail-image',364,298, TRUE);
add_image_size('slider-image',1920,500,TRUE);

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

    $siteURL = get_site_url();
    $folder_social_icon = wp_upload_dir();
    $icon_url = $folder_social_icon['baseurl'];
    ?>

    <div id="footer">
        <div id="contacts">

            <div id="contact">
                <p class="contact-title">Association D'un bijou à l'autre</p>
                <p class="contact-title ctitle2">Organisateur du Parcours bijoux 2017</p>
                <a href="mailto:dunbijou@gmail.com">dunbijou@gmail.com</a>
                <a href="http://dunbijoualautre.com/">dunbijoualautre.com</a>
                <a href="https://www.facebook.com/dunbijoualautre/">facebook.com/dunbijoualautre/</a>
            </div><!-- ./contact -->

            <div id="contact-presse">
                <p class="contact-title ctitle2">Contacts presse</p>
                <div id="presse-parcours-bijoux">
                    <p>Parcours Bijoux</p>
                    <p>Agence Re-active</p>
                    <p>Séverine Hyvernat</p>
                    <a href="mailto:severine@re-active.fr">severine@re-active.fr</a>
                    <p>+ 33 1 40 22 63 19</p>
                    <p>+ 33 6 47 36 67 27</p>
                </div><!-- ./press-parcours-bijoux -->

                <div id="presse-comite">
                    <p>Comité Francéclat</p>
                    <p>Douzal</p>
                    <p>Morgane Rasle</p>
                    <a href="mailto:mrasle@douzal.com">mrasle@douzal.com</a>
                    <p>+ 33 1 53 05 50 00</p>
                </div><!-- ./presse-comite -->
            </div><!-- ./contact-presse -->

        </div><!-- ./contacts -->

        <div id="footer-left">
            <a href="#" id="button-contact">contact</a>
            <?php if(pll_current_language() =='en'){ ?>
                    <a href="<?php echo $siteURL.'/partnership'?>">partnership</a>
            <?php }
            else { ?>
                    <a href="<?php echo $siteURL.'/partenaires'?>">partenaires</a>
            <?php } ?>
        </div><!-- ./footer-left -->

        <div id="footer-right">
            <a id="site_fb" href="https://www.facebook.com/Parcours-Bijoux-1377799542300463/?ref=br_tf" target="_blank"><img src="<?php echo $icon_url.'/2017/07/facebook_blanc.png'?>"></a>
            <a id="site_instagram" href="https://www.instagram.com/parcoursbijoux/" target="_blank"><img src="<?php echo $icon_url.'/2017/07/instagram_blanc.png'?>"></a>
        </div><!-- ./footer-right -->

        <p id="copyright">&copy; Copyright 2017</p>
    </div><!-- ./footer -->

    <?php

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

add_action('genesis_header_right', 'info_header');
function info_header(){
    $trait = get_stylesheet_directory_uri().'/images/barre_header_dates_white.svg';

    echo '<div id="header-date"><p>25 sept</p><img id="trait" src="'.$trait.'"/><p>30 nov 2017</p></div>';
    echo '<div id="header-description">';

    if(pll_current_language() =='en'){
        ?>
            <p id="comtemporains">Contemporary jewelry tour</p>
        <?php
    }
    else{
        ?>
            <p id="comtemporains">Parcours de bijoux contemporains</p>
        <?php
    }

    echo ' <p id="paris">paris</p>';
    echo '</div><!-- ./header-description -->';

}

//* Customize the breadcrumbs genesis
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'genesis_after_header', 'genesis_do_breadcrumbs',15 );

// title page
remove_action( 'genesis_before_loop', 'genesis_do_posts_page_heading' );

// general function to add a class
function add_class( $attr, $class ) {
    $attr['class'] .= ' ' . sanitize_html_class( $class );
    return $attr;
}


//* Search functionalities
// display search bar
function search_exposition(){

    $closeSearch = get_stylesheet_directory_uri().'/images/close.svg';
    ?>

    <div id="nav-search">
        <div class="wrap">
            <?php get_search_form(); ?>
            <a><img id="close-search" src="<?php echo $closeSearch; ?>" alt="Close search"></a>
        </div>

    </div>

    <?php
}
add_action('genesis_after_header','search_exposition',10);

// limit search result to cpt "lieux"
function searchfilter($query) {

    if ($query->is_search && !is_admin() ) {
        $query->set('post_type',array('post','lieux'));
    }

    return $query;
}
add_filter('pre_get_posts','searchfilter');



// -- add custom fields to the search (https://adambalee.com/search-wordpress-by-custom-fields-without-a-plugin/) --
add_filter('posts_join', 'cf_search_join' );
function cf_search_join( $join ) {
global $wpdb;

if ( is_search() ) {
    $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
}

return $join;
}

// modify the WordPress search query to include custom fields
add_filter( 'posts_where', 'cf_search_where' );
function cf_search_where( $where ) {
    global $wpdb;

    if ( is_search() ) {
        $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
    }

    return $where;
}

// add the DISTINCT keyword to the SQL query in order to prevent returning duplicates
add_filter( 'posts_distinct', 'cf_search_distinct' );
function cf_search_distinct( $where ) {
    global $wpdb;

    if ( is_search() ) {
        return "DISTINCT";
    }

    return $where;
}
// -- add custom fields to the search (https://adambalee.com/search-wordpress-by-custom-fields-without-a-plugin/) --


// search by EXACT words
add_filter('posts_search', 'exact_search', 20, 2);
function exact_search($search, $wp_query){

    global $wpdb;

    if(empty($search))
        return $search;

    $q = $wp_query->query_vars;
    $n = !empty($q['exact']) ? '' : '%';

    $search = $searchand = '';

    foreach((array)$q['search_terms'] as $term) :

        $term = esc_sql(like_escape($term));

        $search .= "{$searchand}($wpdb->posts.post_title REGEXP '[[:<:]]{$term}[[:>:]]') OR ($wpdb->posts.post_content REGEXP '[[:<:]]{$term}[[:>:]]')";

        $searchand = ' AND ';

    endforeach;

    if(!empty($search)) :
        $search = " AND ({$search}) ";
        if(!is_user_logged_in())
            $search .= " AND ($wpdb->posts.post_password = '') ";
    endif;

    return $search;

}

// add tag to the research
add_filter( 'posts_search', 'add_tag_to_research', 500, 2);
function add_tag_to_research( $search, &$wp_query ) {
    global $wpdb;

    if ( empty( $search ))
        return $search;

    $terms = $wp_query->query_vars[ 's' ];
    $exploded = explode( ' ', $terms );
    if( $exploded === FALSE || count( $exploded ) == 0 )
        $exploded = array( 0 => $terms );

    $search = '';
    foreach( $exploded as $tag ) {
        $search .= " AND (
            (wp_posts.post_title LIKE '%$tag%')
            OR (wp_posts.post_content LIKE '%$tag%')
            OR EXISTS
            (
                SELECT * FROM wp_terms
                INNER JOIN wp_term_taxonomy
                    ON wp_term_taxonomy.term_id = wp_terms.term_id
                INNER JOIN wp_term_relationships
                    ON wp_term_relationships.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id
                WHERE taxonomy = 'post_tag'
                    AND object_id = wp_posts.ID
                    AND wp_terms.name LIKE '%$tag%'
            )
        )";
    }

    return $search;
}

// modify search form input box
add_filter( 'genesis_search_text', 'b3m_genesis_search_text' );
function b3m_genesis_search_text( $text ) {

    if(pll_current_language() =='en'){
        return esc_attr( 'A place, an exposition, a date, an artist ?' );
    }
    else{
        return esc_attr( 'Un lieu, une exposition, une date, un artiste ?' );
    }

}

// modify search form input button
add_filter( 'genesis_search_button_text', 'b3m_genesis_search_button_text' );
function b3m_genesis_search_button_text( $text ) {

    if(pll_current_language() =='en'){
        return esc_attr( 'research' );
    }
    else{
        return esc_attr( 'rechercher' );
    }

}



/* in posts */
//* Remove post-date
add_filter('genesis_post_info', 'remove_post_info');
function remove_post_info($post_info){
    $post_info = '';
    return $post_info;
}

//* Display picture of the slider, its category and title
/*
function slider_page() {

    echo '<div class="owl-carousel owl-theme">';

    $args = array(
        'post_type'         => 'lieux',
        'posts_per_page'    => '5',
        'orderby'           => 'rand'
    );
    $loop = new WP_Query( $args );
    if( $loop->have_posts() ):

        while( $loop->have_posts() ): $loop->the_post(); global $post;

?>

    <div class="item">
        <img class="img-responsive" src="<?php $slider = get_field('slider'); echo $slider['url'] ?>" alt="<?php echo $slider['alt'] ?>"/>

        <div class="caption-slider">
            <h4><?php echo get_the_term_list(get_the_ID(), 'categorie'); ?></h4>
            <h1><?php the_title();?></h1>
        </div>
    </div>


<?php
        endwhile;

    endif;

    echo '</div><!-- ./owl-carousel -->';


}
*/

//* Display thumbnail content
function post_content(){?>
    <div class="thumbnail <?php // echo $tax ?>">
        <div class="bloc-project">

            <a href=" <?php the_permalink(); ?>">
                <img class="img-responsive" src="<?php
                $thumbnailURL = wp_get_attachment_image_src(get_post_thumbnail_id ( $post->ID ), 'slider-image');
                echo $thumbnailURL[0]; ?>" />
            </a>

            <div class="caption-project">
                <span class="cat-places"><?php echo get_the_term_list(get_the_ID(), 'categorie'); ?></span>

                <a href=" <?php the_permalink(); ?>">
                    <h3 class="title"><?php the_title();?></h3>
                    <?php echo get_field('nom_lieu'); ?>
                    <p><?php
                        if(pll_current_language() =='en'){
                            echo get_field('time_period');
                        }
                        else{
                            echo get_field('periode');
                        }
                        ?></p>
                </a>

            </div>

        </div><!-- ./bloc-project -->
    </div><!-- ./thumbnail -->
<?php
}

//* Tags research - add lieux posts to the tag research
add_action( 'pre_get_posts', 'tags_research' );
function tags_research( $query ) {
    if ( $query->is_tag() && $query->is_main_query() ) {
        $query->set( 'post_type', array( 'post', 'lieux' ) );
    }
}


//* Display posts randomly
function random () {
    global $query_string;
    query_posts($query_string . "&orderby=rand");
}


//* Load more function
add_action( 'wp_ajax_mon_action', 'mon_action' );
add_action( 'wp_ajax_nopriv_mon_action', 'mon_action' );
function mon_action() {

    $args = array(
        'post_type'     => 'lieux',
        'orderby'       => 'rand',
        'post_status'   => 'publish'
    );

    $ajax_query = new WP_Query($args);

    echo '<div class="row">';
    if ( $ajax_query->have_posts() ) : while ( $ajax_query->have_posts() ) : $ajax_query->the_post();?>
<!--        <div class="all col-lg-3 col-md-3 col-sm-6 col-xs-12 portfolio-item --><?php //// echo $tax ?><!--">-->
        <div class="thumbnail <?php // echo $tax ?>">
            <div class="bloc-project">

                <a href=" <?php the_permalink(); ?>">
                    <img class="img-responsive" src="<?php
                    $thumbnailURL = wp_get_attachment_image_src(get_post_thumbnail_id ( $post->ID ), 'slider-image');
                    echo $thumbnailURL[0]; ?>" />
                </a>

                <div class="caption-project">
                    <span class="cat-places"><?php echo get_the_term_list(get_the_ID(), 'categorie'); ?></span>

                    <a href=" <?php the_permalink(); ?>">
                        <h3 class="title"><?php the_title();?></h3>
                        <?php echo get_field('nom_lieu'); ?>

                        <p><?php
                            if(pll_current_language() =='en'){
                                echo get_field('time_period');
                            }
                            else{
                                echo get_field('periode');
                            }
                        ?></p>
                    </a>

                </div>

            </div><!-- ./bloc-project -->
        </div><!-- ./thumbnail -->
    <?php
    endwhile;
    endif;
    echo '</div>'; // ./row

    die();
}
/*
//conditions langues
<?php
        if(pll_current_language() =='en'){
            ?>

            <?php
        }
        else{
            ?>

            <?php
        }
     ?>
*/
