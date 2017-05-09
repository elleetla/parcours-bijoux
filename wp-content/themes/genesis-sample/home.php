<?php
/**
 * Created by PhpStorm.
 * User: juliengrelet
 * Date: 08/01/2017
 * Time: 17:22
 */

function elleetla_geolocation(){ ?>

    <div style="position: relative; overflow: hidden;">
        <div style="height: 100%; width: 35%; background-color: #ffffff; position: absolute; right: 0; display: block; z-index: 10;">
            <div style="max-height: 100%; overflow: scroll;">
                <?php

                $args = array(
                    'post_type' => 'lieux',
                    'order' => 'ASC',
                );

                $my_query = new WP_Query($args);

                if($my_query->have_posts()) : while ($my_query->have_posts() ) : $my_query->the_post(); ?>

                <div class="list-last-places">
                    <span><?php the_category(); ?></span>
                    <h3><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a></h3>
                    <p><?php echo get_field('event_adress'); ?></p>
                    <time><?php echo get_field('event_date'); ?></time>
                    <p><a href="<?php echo the_permalink(); ?>">En savoir plus</a></p>
                </div>

                <?php endwhile; endif; ?>
                <?php wp_reset_postdata(); ?>

            </div>

        </div>

        <div style="width: 65%; height: 800px; background-color: #dddddd; z-index: 0;" id="map"></div>

    </div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAo2vFww4DDQ5-LpuOKj0CAQiW19GddIks&callback=initMap" async defer></script>

<?php }

add_action('genesis_after_header','elleetla_geolocation',20);

genesis();