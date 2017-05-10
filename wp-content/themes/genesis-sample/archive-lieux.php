<?php
/**
 * Created by PhpStorm.
 * User: ellela
 * Date: 10/05/2017
 * Time: 14:58
 */

add_action('genesis_after_header', 'test', 6);
function test(){
    echo 'test';
}


genesis();