<?php
/**
 *
 * Template Name: Page d'accueil
 *
 * Created by PhpStorm.
 * User: juliengrelet
 * Date: 08/01/2017
 * Time: 17:22
 */

// Add custom class to site-inner (description in home page)
add_filter( 'genesis_attr_site-inner', 'attr_site_inner' );
function attr_site_inner( $attr ) {
    return add_class( $attr, 'home-content' );
}

// function search filter
add_action('genesis_after_header', 'filter_expositions', 15);
function filter_expositions()
{
    echo '<div id="filter-map">';

    echo '<div class="wrap">';

    echo do_shortcode('[searchandfilter id="503"]');

    echo '</div>';

    echo '</div>';
}


add_action('genesis_after_header','elleetla_geolocation',20);
function elleetla_geolocation()
{
    ?>
    <div class="locations">
        <div class="acf-map"></div>
        <div class="structure-places" id="list-events">
            <?php
            $args = [
                'post_type' => 'lieux',
                'order' => 'DESC',
                'orderby' => 'menu_order'

//                'orderby'   => 'rand'
            ];

            if (sizeof($_GET) > 0) {
                foreach ($_GET as $key => $value) {
                    switch ($key) {
                        case '_sft_categorie':
                            $args['categorie'] = $value;
                            break;
                        case '_sft_arrondissement':
                            $args['arrondissement'] = $value;
                            break;
                        case '_sft_dates':
                            $args['dates'] = $value;
                            break;
                        case '_sft_artiste':
                            $args['artiste'] = $value;
                            break;
                    }
                }
            }

            $the_query = new WP_Query($args);

            if ($the_query->have_posts()) {
                $i = 0;
                while ($the_query->have_posts()) {
                    $i++;
                    $the_query->the_post();
                    $address = get_field('google_maps');
                    ?>
                    <div class="linkage marker" id="p<?= get_the_ID() ?>" data-lat="<?= $address['lat'] ?>" data-lng="<?= $address['lng'] ?>">

                        <?php

                        if($i == 1 && sizeof($_GET) > 0){
                            $image = get_field('image_map');
                            echo '<img src="'.$image['url'].'" alt="'.$image['alt'].'" />';

                            echo '<div id="list-content">';

                            echo '<span class="cat-places"'.get_the_term_list(get_the_ID(), 'categorie','',',').'</span>';
                            echo '<h3 class="title">'.get_the_title().'</h3>';

                            //Display names of others events at the SAME place
                            // check if the repeater field has rows of data
                            if( have_rows('name-others-events') ){
                                // loop through the rows of data
                                while ( have_rows('name-others-events') ) : the_row();
                                    // display a sub field value
                                    echo '<h3 class="other-events-name">';
                                    echo the_sub_field('name-event');
                                    echo '</h3>';
                                endwhile;
                            }

                            echo '<div id="lieu-black">';

                            echo '<div class="address">'.get_field('nom_lieu').'</div>'; // ./address

                            echo '<div class="date">';
                            if(pll_current_language() =='en'){
                                echo get_field('time_period');
                            }
                            else{
                                echo get_field('periode');
                            }
                            echo '</div>'; // ./date

                            echo '</div>'; // ./lieu-black

                            /*
                            //* Display post content info
                            the_content();
                            //display all artists

                            $artistes = get_the_terms( $post->ID , 'artiste' );
                            $count = count($artistes);
                            $j = 1;
                            echo '<div class="list-artistes">';
                            foreach ($artistes as $artiste){

                                $separateur = ', ';
                                if($j % 2 == 0 && $j != $count){
                                    $separateur = ","."<br>";
                                }
                                else if( $j == $count){
                                    $separateur = '';
                                }

                                echo $artiste->name. $separateur;

                                $j ++;

                            }
                            echo '</div>'; // ./list-artistes


                            echo '<div class="post-credit"> © crédits : '.get_field('credits_lieux').'</div>'; // ./list-credit
                            */

                            echo '<a class="readmore" href="'.get_the_permalink().'">';
                            if(pll_current_language() =='en'){
                                echo 'more infos';
                            }
                            else{
                                echo 'en savoir +';
                            }
                            echo '</a>'; // ./readmmore

                            /*
                            //* Social Media sharing buttons
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
                            echo '<div class="social-share">';
                            echo '<div><a class="link facebook" href="'.$facebookURL.'" target="_blank"><img src="'.$icon_url.'/2017/06/facebook.png'.'"/></a></div>';
                            echo '<div><a class="link twitter" href="'. $twitterURL .'" target="_blank"><img src="'.$icon_url.'/2017/06/twitter.png'.'"/></a></div>';
                            echo '<div><a class="link googleplus" href="'.$googleURL.'" target="_blank"><img src="'.$icon_url.'/2017/06/google.png'.'"/></a></div>';
                            echo '<div><a class="link pinterest" href="'.$pinterestURL.'" data-pin-custom="true" target="_blank"><img src="'.$icon_url.'/2017/06/pinterest.png'.'"/></a></div>';
                            echo '<div><a class="link mail" href="'.$mailURL.'" ><img src="'.$icon_url.'/2017/06/mail.png'.'"/></a></div>';
                            echo '</div>'; // ./social-share
                            */

                            echo '</div>'; // ./list-content
                        }

                        else{

                            $image = get_field('image_map');
                            echo '<img src="'.$image['url'].'" alt="'.$image['alt'].'" style="display:none" />';

                            echo '<div id="list-content">';

                            echo '<span class="cat-places">';
                            $list_categories = get_the_term_list( $post->ID, 'categorie', '', ', ', '' ) ;
                            echo strip_tags($list_categories);
                            echo '</span>';

                            echo '<h3 class="title" style="color:#000000">'.get_the_title().'</h3>';

                            //Display names of others events at the SAME place
                            // check if the repeater field has rows of data
                            if( have_rows('name-others-events') ){
                                // loop through the rows of data
                                while ( have_rows('name-others-events') ) : the_row();
                                    // display a sub field value
                                    echo '<h3 class="other-events-name" style="color:#000000">';
                                    echo the_sub_field('name-event');
                                    echo '</h3>';
                                endwhile;
                            }


                            echo '<div id="lieu-grey">';

                            echo '<div class="address">';
                            echo get_field('nom_lieu');
                            $terms = get_the_terms($post->ID, 'arrondissement');
                            foreach ($terms as $term) {
                                echo '<span> - ' . $term->name . '</span>';
                            }
                            echo '</div>'; // ./address

                            echo '<div class="date">';
                            if(pll_current_language() =='en'){
                                echo get_field('time_period');
                            }
                            else{
                                echo get_field('periode');
                            }
                            echo '</div>'; // ./date

                            echo '</div>'; // ./lieu-grey

                            echo '<a class="readmore" href="'.get_the_permalink().'">';
                            if(pll_current_language() =='en'){
                                echo 'more infos';
                            }
                            else{
                                echo 'en savoir +';
                            }
                            echo '</a>'; // ./readmmore

                            echo '</div>'; // ./list-content
                        }

                        ?>
                    </div>

                    <?php
                }
                wp_reset_postdata();
            } else {
                if(pll_current_language() =='en'){
                    echo '<div class="linkage">Sorry, no content matches your criteria.</div>';
                }
                else{
                    echo '<div class="linkage">Désolé, aucun contenu ne correspond à vos critères.</div>';
                }
            }


            ?>
        </div>
    </div>
    <?php
}

//add_action( 'wp_enqueue_scripts', 'io_enqueue_locations' );

//* Remove title content
//remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
add_filter( 'genesis_attr_entry', 'attr_post_class' );
function attr_post_class( $attr ) {
    if( is_user_logged_in() ) {
        return add_class($attr, 'display-none');
    }
}

add_action('genesis_after_header','all_posts_title', 30);
function all_posts_title(){

        if(pll_current_language() =='en'){
            echo '<p id="all-events"> all events </p>';
        }
        else{
            echo '<p id="all-events"> tous les événements </p>';
        }

}

add_action('genesis_loop','timeline');
function timeline(){
    $folder_doc = wp_upload_dir();
    $doc_url = $folder_doc['baseurl'];
    ?>
        <a href="<?php echo $doc_url?>/2017/07/timeline.pdf" target="_blank" id="timeline" >
<!--            <img src=" --><?php //echo $img_url ?><!--/2017/07/vignette_timeline2.png">-->
            <div>
                <img src="http://demo.elle-et-la.com/parcours-bijoux/wp-content/themes/genesis-sample/images/fleche_timeline_right.svg">
                <?php
                if(pll_current_language() =='en'){
                    ?>
                        <p>see events timeline</p>
                    <?php
                }
                else{
                    ?>
                        <p>voir la timeline des événements</p>
                    <?php
                }
                ?>

            </div>
        </a>
    <?php
}


//* Button return to the top of the page
add_action('genesis_before_footer','return_top_page');
function return_top_page(){
    echo '<div>';
    echo '<a id="return-top" class="return-top-invisible" href="#"><img src="'.get_stylesheet_directory_uri().'/images/return-top.png"></a>';
    echo '</div>';
}



genesis();