<?php
/**
 * Created by PhpStorm.
 * User: ellela
 * Date: 02/05/2017
 * Time: 11:29
 *
 * Custom a Single Page of Exposition
 */

//* Remove the default Genesis loop
remove_action( 'genesis_after_header', 'genesis_breadcrumb_args' );

//* Display picture of the slider and its title
function slider_project() {

    //echo '<div class="owl-carousel owl-theme">';

    if( have_rows('slider_lieux') ):
        while ( have_rows('slider_lieux') ) : the_row();

            // Variables that contain fields
            $galleryPicture = get_sub_field('picture_slider_lieux');
            $titlePictureLieux = get_sub_field('title_picture_lieux');
            $cat = get_sub_field('categorie_picture_lieux');

            // Viewing fields
            echo '<div class="item">';
            echo '<img src="'.$galleryPicture.'" />';
            echo '<h4>'.$cat->name.'</h4>';
            echo '<h1>'.$titlePictureLieux.'</h1>';
            echo '</div>';

        endwhile;

    else :
        echo 'Il n\'y a aucun slider sur cette page';
    endif;

    //echo '</div>';

}

add_action( 'genesis_after_header', 'slider_project', 10 );

genesis();