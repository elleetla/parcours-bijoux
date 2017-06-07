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
function filter_expositions(){
    /*
     * Filtres
     * Méthode 1: code de récupération des taxonomies

    if ( is_front_page() ){?>

        <div id="filter-expositions">
        <div class="wrap">
            <ul class="filter-nav">
                <li><a href="#">Événements</a></li>
                    <ul class="dropdown">
                        <?php
                            $events = get_terms('categorie' );

                            foreach( $events as $event ) {
                                echo '<li><a href="#" data-filter=".'.$event->slug.'">'.$event->name.'</a></li>';
                            }
                        ?>
                    </ul>
            </ul>

            <ul class="filter-nav">
                <li><a href="#">Lieux</a></li>
                    <ul class="dropdown">
                        <?php
                            $arrts = get_terms('arrondissement',
                                array(
                                        'orderby'   => 'slug'
                                ));

                            foreach( $arrts as $arrt ) {
                                echo '<li><a href="#" data-filter=".'.$arrt->slug.'">'.$arrt->name.'</a></li>';
                            }
                        ?>
                    </ul>
            </ul>

            <ul class="filter-nav">
                <li><a href="#">Dates</a></li>
                    <ul class="dropdown">
                        <?php
                            $dates = get_terms('dates',
                                array(
                                    'orderby'   => 'slug'
                                ));

                            foreach( $dates as $date ) {
                                echo '<li><a href="#" data-filter=".'.$date->slug.'">'.$date->name.'</a></li>';
                            }
                        ?>
                    </ul>
            </ul>

            <ul class="filter-nav">
                <li><a href="#">Artistes</a></li>
                    <ul class="dropdown">
                        <?php
                            $artistes = get_terms('artiste' );

                            foreach( $artistes as $artiste ) {
                                echo '<li><a href="#" data-filter=".'.$artiste->slug.'">'.$artiste->name.'</a></li>';
                            }
                        ?>
                    </ul>
            </ul>
            <button>Filtrer</button>
            <div style="width: 75%; display: block;">
            </div>
            <!--<button id="button-geolocation">Se géolocaliser</button>-->

        </div>
    </div>

    <?php
    *
    *  Méthode 2: utilisation du plugin "Search & Filter"

        echo do_shortcode( '[searchandfilter taxonomies="categorie,arrondissement,dates,artiste"
            order_by="slug,slug,slug,slug"
            all_items_labels="événements,lieux,dates,artistes"
            submit_label="Filtrer"]'

        );
        // show empty taxonomies hide_empty=0

    *
    * Méthode 2 bis: utilisation du plugin "Search & Filter Pro"
    */

    echo do_shortcode('[searchandfilter id="503"]');
    //echo do_shortcode('[searchandfilter id="505"]');

    //}

}

add_action('genesis_after_header','filter_expositions',15);
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