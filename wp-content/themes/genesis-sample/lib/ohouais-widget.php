<?php
/**
 * Created by PhpStorm.
 * User: juliengrelet
 * Date: 15/03/2017
 * Time: 16:03
 */

genesis_register_sidebar(array(
    'id' => 'home-slider',
    'name' => __('Home Slider', 'Ohouais'),
    'description' => __('This is the slider section of the home page.', 'ohouais'),
));

genesis_register_sidebar(array(
    'id' => 'socials-header',
    'name' => __('Header Socials', 'Ohouais'),
    'description' => __('This is the socials profil for the header.', 'ohouais'),
));

// function

function ohouais_slider_after_header()
{
    if (is_front_page() || is_active_sidebar()) {
        genesis_widget_area('home-slider', array(
            'before' => '<div class="shop-slider widget-area full">',
            'after' => '</div>',
        ));
    }
}

add_action('genesis_after_header', 'ohouais_slider_after_header',20);

function ohouais_preheader()
{
    if (is_front_page() || is_active_sidebar()) {
        genesis_widget_area('socials-header', array(
            'before' => '<div class="socials-header widget-area full">',
            'after' => '</div>',
        ));
    }
}

add_action('genesis_before_header', 'ohouais_preheader');