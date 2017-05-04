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
add_action( 'genesis_after_header', 'slider_project', 10 );
function slider_project() {

    echo '<div class="owl-carousel owl-theme">'; // .owl-carousel

    if( have_rows('slider_lieux') ):
        while ( have_rows('slider_lieux') ) : the_row();

            // Variables that contain fields
            $galleryPicture = get_sub_field('picture_slider_lieux');
            $titlePictureLieux = get_sub_field('title_picture_lieux');
            $cat = get_sub_field('categorie_picture_lieux');

            // Viewing fields
            echo '<div class="item">'; // .item
                echo '<img src="'.$galleryPicture.'" />';

                echo '<div class="caption">'; // .caption
                    echo '<h4>'.$cat->name.'</h4>';
                    echo '<h1>'.$titlePictureLieux.'</h1>';
                echo '</div>'; // ./caption
            echo '</div>'; // ./item

        endwhile;

    else :
        echo 'Il n\'y a aucun slider sur cette page';
    endif;

    echo '</div>'; // ./owl-carousel

}


//* Display the image
add_action('genesis_entry_header', 'image_project', 5);
function image_project(){
    $image = get_field('image_lieux');

    if( !empty($image) ): ?>
        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
    <?php endif;

}

//* Display the category
add_action('genesis_entry_header', 'category_project', 6);
function category_project(){
    echo '<h4>'.get_the_term_list(get_the_ID(), 'categorie').'</h4>';
}

//* Display list of artists & crédits
add_action('genesis_entry_footer', 'artists_project',5);
function artists_project(){

    //display all artists
    $terms = get_terms('artiste');
    $count = count($terms);
    $i = 1;
    foreach ($terms as $term){

        $separateur = ', ';

        if( $i == $count){
            $separateur = '.';
        }

        echo $term->name. $separateur;

        $i += 1;

    }

}

add_action('genesis_entry_footer', 'credits_project');
function credits_project(){
    $creditsPerson = get_field('credits_lieux');

    echo '<div class="post-credit">&copy; crédits : '.$creditsPerson.'</div>';
}


genesis();