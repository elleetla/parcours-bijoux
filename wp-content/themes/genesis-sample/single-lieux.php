<?php
/**
 * Created by PhpStorm.
 * User: ellela
 * Date: 02/05/2017
 * Time: 11:29
 *
 * Custom a Single Page of "Lieux"
 */

//* Remove the default Genesis loop
remove_action( 'genesis_after_header', 'genesis_breadcrumb_args' );

//* Display picture of the slider and its title
//add_action( 'genesis_after_header', 'slider_page', 10 );

//* Display a return button
add_action('genesis_before_entry','return_button');
function return_button(){/*
    $categories = get_the_terms( $post->ID, 'categorie' );
    foreach( $categories as $category ) {
        $return_categorie  = $category->slug;
    }
    $return_page = get_site_url().'/categorie/'.$return_categorie;*/

    $return_page = get_site_url();
    $imageURL = get_stylesheet_directory_uri().'/images/fleche_retour.svg';

    ?>
        <div class="return">
            <button onclick='location.href="<?php
            if(pll_current_language() =='en'){
                echo $return_page.'/en/';
            }
            else{
                echo $return_page;
            }?>"' class"float-left">
                <img class="fleche-retour" src="<?php echo $imageURL ?>"/>
                <span><?php
                        if(pll_current_language() =='en'){
                            echo 'back to the map';
                        }
                        else{
                            echo 'retour à la carte';
                        }
                ?></span>
            </button>
        </div><!-- ./return -->
    <?php
}

//* Add custom classes to posts article
add_filter( 'genesis_attr_site-inner', 'attr_post_class' );
function attr_post_class( $attr ) {
    return add_class( $attr, 'detail-content' );
}

//* Display picture of the slider
add_action('genesis_entry_header','slider_post', 1);
function slider_post() {

    echo '<div class="owl-carousel owl-theme">';
    if( have_rows('slider_post') ):

        while( have_rows('slider_post')) : the_row();

            //variables that contain field
            $imageSlider = get_sub_field('image_slide_post');

            echo '<div class="item">';

            echo '<img src="'.$imageSlider['url'].'" alt="'.$imageSlider['alt'].'"/>';

            echo '</div>'; // ./item


        endwhile;

    endif;

    echo '</div><!-- ./owl-carousel -->';


}

//* Display the category
add_action('genesis_entry_header', 'category_project', 6);
function category_project(){
    echo '<span class="cat-places">'.get_the_term_list(get_the_ID(), 'categorie').'</span>';
}

/* display Content & social sharing buttons (function to improve
so that content & social display are separated) */
add_filter( 'the_content', 'social_sharing_buttons');
function social_sharing_buttons($content) {
    global $post;
    if(is_singular() || is_home()){

        // Get current page URL
        $post_url = urlencode(get_permalink());

        // Get current page title
        $post_title = str_replace( ' ', '%20', get_the_title());

        // Get the email address to send the mail
        $address_mail = get_field('email');

        // Get url of icon image in media bibliography
        $folder_social_icon = wp_upload_dir();
        $icon_url = $folder_social_icon['baseurl'];

        // Construct sharing URL without using any script
        $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$post_url;
        $twitterURL = 'https://twitter.com/intent/tweet?text='.$post_title.'&amp;url='.$post_url.'&amp;via=ParcoursBijoux';
        $googleURL = 'https://plus.google.com/share?url='.$post_url;
        $pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$post_url.'&amp;description='.$post_title;
        $mailURL = 'mailto:?subject= Parcours Bijoux - '.$post_title;

        // Add sharing button at the end of page/page content
        $content .= '<!-- Crunchify.com social sharing. Get your copy here: http://crunchify.me/1VIxAsz -->';
        $content .= '<div class="content-right">'; //content-right - div going on tag div
        $content .= '<div class="social-share">'; //social-share
        $content .= '<div><a class="link facebook" href="'.$facebookURL.'" target="_blank"><img src="'.$icon_url.'/2017/06/facebook.png'.'"/></a></div>';
        $content .= '<div><a class="link twitter" href="'. $twitterURL .'" target="_blank"><img src="'.$icon_url.'/2017/06/twitter.png'.'"/></a></div>';
        $content .= '<div><a class="link googleplus" href="'.$googleURL.'" target="_blank"><img src="'.$icon_url.'/2017/06/google.png'.'"/></a></div>';
        $content .= '<div><a class="link pinterest" href="'.$pinterestURL.'" data-pin-custom="true" target="_blank"><img src="'.$icon_url.'/2017/06/pinterest.png'.'"/></a></div>';
        $content .= '<div><a class="link mail" href="'.$mailURL.'" ><img src="'.$icon_url.'/2017/06/mail.png'.'"/></a></div>';
        $content .= '</div>'; // ./social-share

        return $content;
    }else{
        // if not a post/page then don't include sharing button
        return $content;
    }
};


//* Tags
// remove automatic tags
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
// display tags
add_action( 'genesis_entry_content', 'list_tags_with_count',10);
function list_tags_with_count() {
    echo the_terms( $post->ID, 'post_tag', '<div class="tags-post">', ' ', '</div><!-- ./tags-post--></div><!-- ./content-right in function social_sharing_buttons()-->' );
}


//* Display list of artists and credit
add_action('genesis_entry_content', 'artists_credit');
function artists_credit(){

    echo '<div class="content-left">';
    //display all artists
    $terms = get_the_terms( $post->ID , 'artiste' );
    $count = count($terms);
    $i = 1;
    echo "<div class='list-artistes'>";
    foreach ($terms as $term){

        $separateur = ',';
        if($i % 2 == 0 && $i != $count ){
            $separateur = ',';
        }
        else if( $i == $count){
            $separateur = '';
        }

        echo '<span class="artiste">'.$term->name. $separateur.'</span>';

        $i++;

    }
    echo '</div>'; // ./list-artistes

    //display credit
    $creditsPerson = get_field('credits_lieux');

    if(pll_current_language() =='en'){

        echo '<div class="post-credit">&copy; credits : '.$creditsPerson.'</div>';
    }
    else{
        echo '<div class="post-credit">&copy; crédits : '.$creditsPerson.'</div>';
    }

    echo '</div>'; // ./content-left

}


//display post "A proximité" / "Around"
function proposition_post(){?>

<section id="last-projects">
    <div class="container">
        <div class="row">

            <div class="proximite-banner">
                <?php
                if(pll_current_language() =='en'){
                    echo '<p id="a-proximite">around</p>';
                }
                else{
                    echo '<p id="a-proximite">à promixité</p>';
                }
                ?>
            </div>

            <?php
            //get the terms for the particular item "categories"
            $terms = get_the_terms( $post->ID , 'categories' );
            // loop over each item since it's an array
            if ( $terms != null ){
                foreach( $terms as $term ) {
                    $cat[] = $term->slug ;
                }
            }

            $args = array(
                'post_type'         =>  'lieux',
                'posts_per_page'    =>  3,
                //'tax_query'         => $tax,
                'orderby'           => 'rand',
                'post__not_in'      => array(get_the_ID())
            );
            $loop = new WP_Query( $args );
            while ( $loop->have_posts() ) : $loop->the_post();

                ?>

                <div class="thumbnail <?php // echo $tax ?>">
                    <div class="bloc-project">
                        <a href=" <?php the_permalink(); ?>">
                            <img class="img-responsive" src="<?php
                            $thumbnailURL = wp_get_attachment_image_src(get_post_thumbnail_id ( $post_ID ), 'slider-image');
                            echo $thumbnailURL[0]; ?>" />
                        </a>

                        <div class="caption-project">
                            <span class="cat-places"><?php echo get_the_term_list(get_the_ID(), 'categorie'); ?></span>

                            <a href=" <?php the_permalink(); ?>">
                                <h3 class="title"><?php the_title();?></h3>
                                <?php echo get_field('nom_lieu'); ?>
                                <p><?php
                                    if(pll_current_language() =='en'){
                                        echo get_field('time_period');
                                    }
                                    else{
                                        echo get_field('periode');
                                    }
                                ?></p>
                            </a>

                        </div>
                    </div><!-- ./bloc-project -->
                </div><!-- ./all col-lg-3 -->

            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php
}
add_action('genesis_after_entry','proposition_post');

//add_action('genesis_entry_header', 'category_project', 6);

genesis();