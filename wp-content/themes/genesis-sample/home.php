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
                $i = 0;
                while ($the_query->have_posts()) {
                    $i++;
                    $the_query->the_post();
                    $address = get_field('google_maps');
                    ?>
                    <div class="linkage marker" id="p<?= get_the_ID() ?>" data-lat="<?= $address['lat'] ?>" data-lng="<?= $address['lng'] ?>">

                        <span class="cat-places"><?= get_the_term_list(get_the_ID(), 'categorie') ?></span>
                        <h3 class="title"><?= get_the_title() ?></h3>

                        <div class="address">
                            <?php
                            echo get_field('nom_lieu');
                            if($i > 1) {
                                $terms = get_the_terms($post->ID, 'arrondissement');
                                foreach ($terms as $term) {
                                    echo '<span> - ' . $term->name . '</span>';
                                }
                            }
                            ?>
                        </div>

                        <div class="date">
                            <?= get_field('periode') ?>
                        </div>

                        <?php if($i == 1){ ?>
                        <div class="caption-detail">

                            <?php
                            //display all artists
                            /*
                            $artistes = get_the_terms( $post->ID , 'artiste' );
                            $count = count($artistes);
                            $j = 1;
                            echo "<div class='list-artistes'>";
                            foreach ($artistes as $artiste){

                                $separateur = ', ';
                                if($j % 2 == 0){
                                    $separateur = ","."<br>";
                                }
                                else if( $j == $count){
                                    $separateur = '.';
                                }

                                echo $artiste->name. $separateur;

                                $j ++;

                            }
                            */

                            echo get_field('credits_lieux');
                            ?>
                        </div>

                        <?php } ?>

                        <?php the_content() ?>


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

the_content();

genesis();