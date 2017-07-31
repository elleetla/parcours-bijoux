<?php
/**
 * Created by PhpStorm.
 * User: ellela
 * Date: 20/06/2017
 * Time: 12:05
 */


//* Removes Title and Description on Archive, Taxonomy, Category, Tag
//remove_action( 'genesis_before_loop', 'genesis_do_taxonomy_title_description', 15 );

//* Add custom classes to posts article
add_filter( 'genesis_attr_site-inner', 'attr_cat_post_class' );
function attr_cat_post_class( $attr ) {
    return add_class( $attr, 'categorie-content' );
}

//* Remove title content
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

//* Remove post content
remove_action('genesis_entry_content', 'genesis_do_post_content');

//* Remove footer content
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

//* Display post content
add_action('genesis_entry_content', 'post_content');


//* Display posts randomly
//add_action('genesis_before_loop', 'random');
add_action('init','random_add_rewrite');
function random_add_rewrite() {
    global $wp;
    $wp->add_query_var('random');
//    echo var_dump($wp);
}




genesis();