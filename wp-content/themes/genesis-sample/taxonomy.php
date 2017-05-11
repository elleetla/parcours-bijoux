<?php
/**
 * Created by PhpStorm.
 * User: ellela
 * Date: 10/05/2017
 * Time: 13:10
 */

//* Display picture of the slider and its title (/!\ display only slider of the 1st post)
add_action( 'genesis_after_header', 'slider_project', 10 );

//* Removes Title and Description on Archive, Taxonomy, Category, Tag
remove_action( 'genesis_before_loop', 'genesis_do_taxonomy_title_description', 15 );

//* Remove all post content
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

genesis();
