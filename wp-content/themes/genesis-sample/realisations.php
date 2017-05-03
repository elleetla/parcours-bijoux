<?php

// Template Name: Réalisations

function test_realisations() { ?>

            <?php
            $args = array(
                'post_type' => 'realisations',
                'posts_per_page' => -3,
                'order' => 'DESC',
            );

            $my_query = new WP_Query($args);

            if($my_query->have_posts()) : while ($my_query->have_posts() ) : $my_query->the_post(); ?>
                <div class="one-third last-post">
                    <div class="titre-cat">
                        <h4><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a></h4>
                        <?php echo the_category(); ?>
                    </div>


                </div>
                <?php
            endwhile;
            endif;

            wp_reset_postdata();
            ?>
<?php }

add_action( 'genesis_after_header', 'test_realisations',5 );

genesis();