<?php
/**
 * Created by PhpStorm.
 * User: ellela
 * Date: 10/05/2017
 * Time: 13:10
 */

add_action( 'genesis_after_header', 'slider_project', 10 );

remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

genesis();