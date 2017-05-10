<?php
/**
 * Created by PhpStorm.
 * User: juliengrelet
 * Date: 08/01/2017
 * Time: 17:22
 */

function elleetla_geolocation(){

    // accepts any wp_query args
    $args = (array(
        'post_type'      => 'lieux',
        'order'          => 'ASC',
        'orderby'       => 'title'
    ));

    // The Query
    $the_query = new WP_Query( $args );

    // The Loop
    if ( $the_query->have_posts() ) {
        echo '<div class="locations"><div class="acf-map"></div>';

        echo '<div id="listdata"></div><div id="newdiv">';
        while ( $the_query->have_posts() ) {
            $the_query->the_post();

            $address = get_field( 'google_maps' );
            printf( '<div class="marker" data-lat="%s" data-lng="%s">
						<h4 class="title">%s</h4>
							<div class="address"><i class="fa fa-map-marker" aria-hidden="true"></i> %s
							<a href="" target="_blank" class="website" title="%s"></a>
							<div class="address-item"><i class="fa fa-phone" aria-hidden="true"></i> %s</div>
							<div class="address-item">%s</div>
							</div>
						</div>',
                $address['lat'],
                $address['lng'],
                get_the_title(),
                $address['address'],
                get_the_title(),
                $contact_number,
                $opening_hours);
        }

        echo '</div></div>';

        /* Restore original Post Data */
        wp_reset_postdata();
    } else {
        // no posts found
    }

}

add_action( 'wp_enqueue_scripts', 'io_enqueue_locations' );

add_action('genesis_after_header','elleetla_geolocation',20);

genesis();