<?php
/**
 * Created by PhpStorm.
 * User: ellela
 * Date: 26/06/2017
 * Time: 12:30
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
    return add_class( $attr, 'categorie-content' );
}

//* Display post content
add_action('genesis_entry_content', 'post_content');

//* Display posts randomly
add_action('genesis_before_loop', 'random');

genesis();