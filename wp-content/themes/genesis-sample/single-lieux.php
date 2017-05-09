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

//* Display a return button
add_action('genesis_before_entry','return_button');
function return_button(){
    $return_page = get_site_url().'/expositions/';
    echo '<div class="return">';
    echo '<button onclick="location.href=\''.$return_page.'\';" class"float-left">Retour</button>';
    echo '</div>';
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

//* Display all artists
add_action('genesis_entry_content', 'artists_project',15);
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

//* Display credits of the project
add_action('genesis_entry_footer', 'credits_project');
function credits_project(){
    $creditsPerson = get_field('credits_lieux');

    echo '<div class="post-credit">&copy; crédits : '.$creditsPerson.'</div>';
}



function crunchify_social_sharing_buttons($content) {
    global $post;
    if(is_singular() || is_home()){

        // Get current page URL
        $post_url = urlencode(get_permalink());

        // Get current page title
        $post_title = str_replace( ' ', '%20', get_the_title());

        // Get the email address to send the mail
        $address_mail = get_field('email');

        // Get url of icon image in media bibliography (=> http://localhost:8888/parcours-bijoux/wp-content/uploads)
        $folder_social_icon = wp_upload_dir();
        $icon_url = $folder_social_icon['baseurl'];

        // Construct sharing URL without using any script
        $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$post_url;
        $twitterURL = 'https://twitter.com/intent/tweet?text='.$post_title.'&amp;url='.$post_url.'&amp;via=Crunchify';
        $googleURL = 'https://plus.google.com/share?url='.$post_url;
        $pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$post_url.'&amp;description='.$post_title;
        $mailURL = 'mailto:'.$address_mail.'?subject='.$post_title;

        // Add sharing button at the end of page/page content
        $content .= '<!-- Crunchify.com social sharing. Get your copy here: http://crunchify.me/1VIxAsz -->';
        $content .= '<div class="social-share">';
        $content .= '<div><a class="link facebook" href="'.$facebookURL.'" target="_blank"><img src="'.$icon_url.'/2017/05/facebook_logo.png'.'"/></a></div>';
        $content .= '<div><a class="link twitter" href="'. $twitterURL .'" target="_blank"><img src="'.$icon_url.'/2017/05/twitter_logo.png'.'"/></a></div>';
        $content .= '<div><a class="link googleplus" href="'.$googleURL.'" target="_blank"><img src="'.$icon_url.'/2017/05/G_logo.png'.'"/></a></div>';
        $content .= '<div><a class="link pinterest" href="'.$pinterestURL.'" data-pin-custom="true" target="_blank"><img src="'.$icon_url.'/2017/05/pinterest_logo.png'.'"/></a></div>';
        $content .= '<div><a class="link mail" href="'.$mailURL.'" ><img src="'.$icon_url.'/2017/05/mail_icon.png'.'"/></a></div>';
        $content .= '</div>';

        return $content;
    }else{
        // if not a post/page then don't include sharing button
        return $content;
    }
};
add_filter( 'the_content', 'crunchify_social_sharing_buttons');

//display approximité

blabla

genesis();