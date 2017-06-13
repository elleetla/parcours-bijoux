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
add_action( 'genesis_after_header', 'slider_project', 10 );

//* Display a return button
add_action('genesis_before_entry','return_button');
function return_button(){
    $categories = get_the_terms( $post->ID, 'categorie' );
    foreach( $categories as $category ) {
        $return_categorie  = $category->slug;
    }
    $return_page = get_site_url().'/categorie/'.$return_categorie;
    $imageURL = get_stylesheet_directory_uri().'/images/fleche_retour.svg';
    echo '<div class="return">';
    echo '<div><button onclick="location.href=\''.$return_page.'\';" class"float-left"><img class="fleche-retour" src="'.$imageURL.'"/><span>Retour</span></button></div>';
    echo '</div>';
}

//* Add custom classes to posts article
add_filter( 'genesis_attr_entry', 'attr_post_class' );
function attr_post_class( $attr ) {
    return add_class( $attr, 'detail-content' );
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
    echo '<span class="cat-places">'.get_the_term_list(get_the_ID(), 'categorie').'</span>';
}

//* Display all artists
add_action('genesis_entry_content', 'artists_project',15);
function artists_project(){

    //display all artists
    $terms = get_the_terms( $post->ID , 'artiste' );
    $count = count($terms);
    $i = 1;
    echo "<div class='list-artistes'>";
    foreach ($terms as $term){

        $separateur = ', ';
        if($i % 2 == 0 && $i != $count ){
            $separateur = ","."<br>";
        }
        else if( $i == $count){
            $separateur = '.';
        }

        echo $term->name. $separateur;

        $i++;

    }
    echo"</div>";

}

//* Display credits of the project
add_action('genesis_entry_footer', 'credits_project');
function credits_project(){
    $creditsPerson = get_field('credits_lieux');

    echo '<div class="post-credit">&copy; crédits : '.$creditsPerson.'</div>';
}

function social_sharing_buttons($content) {
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
        $twitterURL = 'https://twitter.com/intent/tweet?text='.$post_title.'&amp;url='.$post_url.'&amp;via=ParcoursBijoux';
        $googleURL = 'https://plus.google.com/share?url='.$post_url;
        $pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$post_url.'&amp;description='.$post_title;
        $mailURL = 'mailto:?subject= Parcours Bijoux - '.$post_title;

        // Add sharing button at the end of page/page content
        $content .= '<!-- Crunchify.com social sharing. Get your copy here: http://crunchify.me/1VIxAsz -->';
        $content .= '<div class="social-share">';
        $content .= '<div><a class="link facebook" href="'.$facebookURL.'" target="_blank"><img src="'.$icon_url.'/2017/06/facebook.png'.'"/></a></div>';
        $content .= '<div><a class="link twitter" href="'. $twitterURL .'" target="_blank"><img src="'.$icon_url.'/2017/06/twitter.png'.'"/></a></div>';
        $content .= '<div><a class="link googleplus" href="'.$googleURL.'" target="_blank"><img src="'.$icon_url.'/2017/06/google.png'.'"/></a></div>';
        $content .= '<div><a class="link pinterest" href="'.$pinterestURL.'" data-pin-custom="true" target="_blank"><img src="'.$icon_url.'/2017/06/pinterest_logo.png'.'"/></a></div>';
        $content .= '<div><a class="link mail" href="'.$mailURL.'" ><img src="'.$icon_url.'/2017/06/mail.png'.'"/></a></div>';
        $content .= '</div>';

        return $content;
    }else{
        // if not a post/page then don't include sharing button
        return $content;
    }
};
add_filter( 'the_content', 'social_sharing_buttons');

//display post "A proximité"
function proposition_post(){?>

<section id="last-projects">
    <div class="container">
        <div class="row">

            <div class="col-lg-12">
                <p id="a-proximite">à promixité</p>
            </div>

            <?php
            //get the terms for the particular item "categories"
            $terms = get_the_terms( $post->ID , 'categories' );
            // loop over each item since it's an array
            if ( $terms != null ){
                foreach( $terms as $term ) {
                    $cat[] = $term->slug ;

                    /*for each term, define taxonomy parameters
                    if($cat[0] == "design"){
                        $tax = array(
                            array(
                                'taxonomy' => 'categorie',
                                'field'    => 'slug',
                                'terms'    => array( 'design' ),
                            )
                        );
                    }*/
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

                <div class="all col-lg-3 col-md-3 col-sm-6 col-xs-12 portfolio-item <?php // echo $tax ?>">
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
                                <p><?php echo get_field('periode'); ?></p>
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