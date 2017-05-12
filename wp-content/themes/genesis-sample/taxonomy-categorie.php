<?php
/**
 * Created by PhpStorm.
 * User: ellela
 * Date: 10/05/2017
 * Time: 13:10
 */

//* Display picture of the slider, its category and title
add_action( 'genesis_after_header', 'slider_project', 10 );

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


//* Display post content
add_action('genesis_entry_content', 'post_content');

//* Display posts randomly
add_action('genesis_before_loop', 'random');

genesis();
