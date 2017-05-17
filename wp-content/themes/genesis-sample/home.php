<?php
/**
 * Created by PhpStorm.
 * User: juliengrelet
 * Date: 08/01/2017
 * Time: 17:22
 */

function elleetla_geolocation(){

    do_action('show_beautiful_filters');

    echo '<div class="locations">';

    echo '<div class="acf-map"></div>';

    // accepts any wp_query args
    $args = (array(
        'post_type'      => 'lieux',
        //'orderby'       => 'rand',
    ));

    $the_query = new WP_Query( $args );

    if ( $the_query->have_posts() ) {

        echo '<div class="structure-places"></div>';

        echo '<div id="newdiv">';

        echo '<div class="list-last-places">';

        while ( $the_query->have_posts() ) {

            $the_query->the_post();

            $address = get_field('google_maps');

            printf( '<div class="marker" data-lat="%s" data-lng="%s">

                                <span class="cat-places">'.get_the_term_list(get_the_ID(), 'categorie').'</span>
                                <h3 class="title">'.get_the_title().'</h3>
                                
                                    <div class="address">
                                        <p>'.$address['address'].'</p>
                                    </div>
                                
                                <a class="readmore" href="'.get_the_permalink().'">en savoir +</a>

                            </div>',
                $address['lat'],
                $address['lng']
            );
        }

        echo '</div>';

        echo '</div>';

        echo '</div>';

        /* Restore original Post Data */
        wp_reset_postdata();

    } else {

        echo do_shortcode('[searchandfilter id="503" show="results"]');

    }

}

add_action( 'wp_enqueue_scripts', 'io_enqueue_locations' );

add_action('genesis_after_header','elleetla_geolocation',20);

genesis();