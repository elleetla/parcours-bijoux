<?php
/**
 * Created by PhpStorm.
 * User: ellela
 * Date: 10/05/2017
 * Time: 15:07
 */

add_action( 'genesis_after_header', 'hello_expo', 10 );
function hello_expo(){
    echo 'hello expo';
}