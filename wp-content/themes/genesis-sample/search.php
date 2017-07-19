<?php
/**
 * Created by PhpStorm.
 * User: ellela
 * Date: 15/06/2017
 * Time: 14:55
 */

//* Display picture of the slider, its category and title
add_action( 'genesis_after_header', 'slider_page', 10 );

//* Removes Title and Description on Archive, Taxonomy, Category, Tag
remove_action( 'genesis_before_loop', 'genesis_do_taxonomy_title_description', 15 );

//* Remove title content
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

//* Remove post content
remove_action('genesis_entry_content', 'genesis_do_post_content');

//* Remove footer content
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

//* Add custom classes to posts article
add_filter( 'genesis_attr_site-inner', 'attr__post_class' );
function attr__post_class( $attr ) {
    return add_class( $attr, 'research-content' );
}

//* Display thumbnail content
add_action('genesis_entry_content', 'post_content');

//* Display posts randomly
add_action('genesis_before_loop', 'random');

//* Button return to the top of the page
add_action('genesis_before_footer','return_top_page');
function return_top_page(){
    echo '<div>';
    echo '<a id="return-top" class="return-top-invisible" href="#"><img src="'.get_stylesheet_directory_uri().'/images/return-top.png"></a>';
    echo '</div>';
}

genesis();
