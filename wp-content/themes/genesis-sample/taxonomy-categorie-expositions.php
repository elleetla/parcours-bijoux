<?php
/**
 * Created by PhpStorm.
 * User: ellela
 * Date: 12/05/2017
 * Time: 14:24
 */

//* Display picture of the slider, its category and title
add_action( 'genesis_after_header', 'slider_page', 10 );

//* Removes Title and Description on Archive, Taxonomy, Category, Tag
remove_action( 'genesis_before_loop', 'genesis_do_taxonomy_title_description', 15 );

//* Remove the standard loop
//remove_action ('genesis_loop', 'genesis_do_loop');

//* Remove title content
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

//* Remove post content
remove_action('genesis_entry_content', 'genesis_do_post_content');

//* Remove footer content
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

//* Add custom classes to posts article
add_filter( 'genesis_attr_site-inner', 'attr_cat_post_class' );
function attr_cat_post_class( $attr ) {
    return add_class( $attr, 'categorie-content' );
}

//* Display post content
add_action('genesis_entry_content', 'post_content');

//* Display posts randomly
add_action('genesis_before_loop', 'random');

//Load More button
add_action('genesis_before_loop', 'load_more_top');
function load_more_top () {
    echo '<a id="load-more-top" href="#">+ voir tous les événements +</a>';

}

add_action('genesis_after_loop', 'load_more_bottom');
function load_more_bottom () {
    echo '<a id="load-more-bottom" href="#">+ voir tous les événements +</a>';

}

genesis();