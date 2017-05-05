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
<<<<<<< HEAD
                echo '<img src="'.$galleryPicture.'" />';

                echo '<div class="caption">'; // .caption
                    echo '<h4>'.$cat->name.'</h4>';
                    echo '<h1>'.$titlePictureLieux.'</h1>';
                echo '</div>'; // ./caption
=======

            echo '<img src="'.$galleryPicture.'" />';

            echo '<div class="caption">'; // .caption

            echo '<h4>'.$cat->name.'</h4>';

            echo '<h1>'.$titlePictureLieux.'</h1>';

            echo '</div>'; // ./caption

>>>>>>> 0deb363de6d977b0052cf313d39942baf804d3e6
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

<<<<<<< HEAD
//* Display all artists
=======
//* Display list of artists & crédits
>>>>>>> 0deb363de6d977b0052cf313d39942baf804d3e6
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

<<<<<<< HEAD
//* Display credits of the project
=======
>>>>>>> 0deb363de6d977b0052cf313d39942baf804d3e6
add_action('genesis_entry_footer', 'credits_project');
function credits_project(){
    $creditsPerson = get_field('credits_lieux');

    echo '<div class="post-credit">&copy; crédits : '.$creditsPerson.'</div>';
}
<<<<<<< HEAD

//* Display date of the event
add_action('genesis_after_sidebar_widget_area','date_project',1);
function date_project(){
    $date1 = get_field('event_date1');
    $date2 = get_field('event_date2');
    echo 'Du '.$date1.' au '.$date2;
    echo '<br>';
}

//* Display practic infos
add_action('genesis_after_sidebar_widget_area','info_project',2);
function info_project(){
    $infos = get_field('info_plus');
    echo $infos;
    echo '<br>';
}

//* Display opening hours
add_action('genesis_after_sidebar_widget_area','open_hours_project',3);
function open_hours_project(){
    $open_hours = get_field('opening_hours');
    echo $open_hours;
    echo '<br>';
}

//* Display address of the event
add_action('genesis_after_sidebar_widget_area','address_project',4);
function address_project(){
    $address = get_field('event_adress');
    echo $address;
    echo '<br>';
}

//* Display phone number
add_action('genesis_after_sidebar_widget_area','phone_project',5);
function phone_project(){
    $tel = get_field('tel');
    echo $tel;
    echo '<br>';
}

//* Display means of transport
add_action('genesis_after_sidebar_widget_area','transport_project',6);
function transport_project(){
    $transport = get_field('transport');
    echo $transport;
    echo '<br>';
}

//* Display email
add_action('genesis_after_sidebar_widget_area','email_project',7);
function email_project(){
    $email = get_field('email');
    echo $email;
    echo '<br>';
}

=======
>>>>>>> 0deb363de6d977b0052cf313d39942baf804d3e6


genesis();