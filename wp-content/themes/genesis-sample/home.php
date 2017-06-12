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
                while ($the_query->have_posts()) {
                    $the_query->the_post();
                    $address = get_field('google_maps');
                    ?>
                    <div class="linkage marker" id="p<?= get_the_ID() ?>" data-lat="<?= $address['lat'] ?>" data-lng="<?= $address['lng'] ?>">

                        <span class="cat-places"><?= get_the_term_list(get_the_ID(), 'categorie') ?></span>
                        <h3 class="title"><?= get_the_title() ?></h3>

                        <div class="address">
                            <p><?= $address['address'] ?></p>
                        </div>

                        <a class="readmore" href="<?= get_the_permalink() ?>">en savoir +</a>
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

genesis();