<?php
/**
 * Created by PhpStorm.
 * User: juliengrelet
 * Date: 08/01/2017
 * Time: 17:22
 */

// Add custom class to site-inner (description in home page)
add_filter( 'genesis_attr_site-inner', 'attr_site_inner' );
function attr_site_inner( $attr ) {
    return add_class( $attr, 'home-description' );
}

// function search filter
function filter_expositions()
{
    echo '<div id="filter-map">';

    echo '<div class="wrap">';

    echo do_shortcode('[searchandfilter id="503"]');

    echo '</div>';

    echo '</div>';
}
add_action('genesis_after_header', 'filter_expositions', 15);

function elleetla_geolocation()
{
    ?>
    <div class="locations">
        <div class="acf-map"></div>
        <div class="structure-places">
            <?php
            $args = [
                'post_type' => 'lieux',
                'orderby'   => 'rand'
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

                            echo '<span class="cat-places"'.get_the_term_list(get_the_ID(), 'categorie').'</span>';
                            echo '<h3 class="title">'.get_the_title().'</h3>';

                            echo '<div id="lieu-black">';

                            echo '<div class="address">'.get_field('nom_lieu').'</div>'; // ./address

                            echo '<div class="date">'.get_field('periode').'</div>'; // ./date

                            echo '</div>'; // ./lieu-black

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

                            echo '<a class="readmore" href="'.get_the_permalink().'">en savoir +</a>'; // ./readmmore

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

                            echo '</div>'; // ./list-content
                        }

                        else{
                            if($i == 2 && sizeof($_GET) > 0){
                                echo '<div id="list-proximite">à proximité</div>';
                            }
                            echo '<div id="list-content">';

                            echo '<span class="cat-places"'.get_the_term_list(get_the_ID(), 'categorie').'</span>';
                            echo '<h3 class="title" style="color:#000000">'.get_the_title().'</h3>';


                            echo '<div id="lieu-grey">';
                            echo '<div class="address">';

                            echo get_field('nom_lieu');
                            $terms = get_the_terms($post->ID, 'arrondissement');
                            foreach ($terms as $term) {
                                echo '<span> - ' . $term->name . '</span>';
                            }
                            echo '</div>'; // ./address

                            echo '<div class="date">'.get_field('periode').'</div>'; // ./date

                            echo '</div>'; // ./lieu-black

                            echo '<a class="readmore" href="'.get_the_permalink().'">en savoir +</a>'; // ./readmmore

                            echo '</div>'; // ./list-content
                        }

                        ?>
                    </div>

                    <?php
                }
                wp_reset_postdata();
            } else {
                echo '<div class="linkage">Désolé, aucun contenu ne correspond à vos critères.</div>';
            }
            ?>
        </div>
    </div>
    <?php
}

//add_action( 'wp_enqueue_scripts', 'io_enqueue_locations' );

add_action('genesis_after_header','elleetla_geolocation',20);

//the_content();


remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action('genesis_loop','home_description');
function home_description(){?>
    <p id="title-description">Un événement entièrement dédié au bijou</p>

    <p id="home-text"> Le Parcours Bijoux sera constitué d’une cinquantaine de manifestations autour du bijou
        qui se dérouleront à l’automne 2017 à Paris : expositions, performances, conférences …
        Le vernissage des évènements devra avoir lieu entre le 25 Septembre et le 15 novembre 2017.
        Le Parcours Bijoux est ouvert aux créateurs de bijoux, plasticiens ou photographes menant une réflexion sur le corps et la parure,
        joailliers, experts ou historiens, désireux de faire connaître la richesse de cet incontournable élément de parure.
        Chaque participant bénéficiera d’une totale autonomie dans le montage de son projet.
        Les participants seront par conséquent entièrement responsables de l’avancement et du financement de leur projet.
    </p>

    <p id="organisateur">Le Parcours Bijoux 2017 est organisé par l'association
        <a href="http://dunbijoualautre.com/" id="d1-bijou-a-lautre" target="_blank">D'un bijou à l'autre</a>
    </p>

    <img id="d1-bijou-a-lautre" src="<?php $folder_social_icon = wp_upload_dir();
    $icon_url = $folder_social_icon['baseurl'];
    echo $icon_url.'/2017/06/dun_bijou_a_lautre.png';
    ?>">

<?php
}

genesis();