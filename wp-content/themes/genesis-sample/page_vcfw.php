<?php

// Template Name: Visual Composer Full Width

//Ajout d'une class pour la structure de la page
function ohouais_body_class( $classes ) {

	$classes[] = 'vcfw';

	return $classes;
	
}

add_filter( 'body_class', 'ohouais_body_class' );


// Ajout d'une class pour header active
if(get_field('header_fixe_transparent')){

    //* Add Extra Fullwidth Class
    add_filter( 'body_class', 'header_fixe_class_body' );
    function header_fixe_class_body( $classes ) {

        $classes[] = 'site-header-active';
        return $classes;

    }

}

// affichage du titre bande de la page
if(get_field('title_image')){

    add_action( 'genesis_after_header', 'ohouais_title_image',5 );
    function ohouais_title_image() { ?>

        <!-- on déclare la variable background -->
        <?php $background = wp_get_attachment_image_src( get_post_thumbnail_id( $page->ID ), 'full' ); ?>

        <div id="test" style="background-image: url('<?php echo $background[0]; ?>'); text-align: center;
            background-size: cover; background-repeat: no-repeat; background-position: center top;">
            <div class="overlay">
                <div class="wrap">
                    <h1><?php the_title(); ?></h1>
                </div>
            </div>
        </div>

    <?php }

}

// affichage des 3 derniers articles
if(get_field('last_post')){

    add_action( 'genesis_before_footer', 'ohouais_last_post',5 );
    function ohouais_last_post() { ?>

        <div id="section-last-post">
            <h3>Nos derniers conseils</h3>
            <div class="wrap">

                <?php
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => -3,
                    'order' => 'DESC',
                );

                $my_query = new WP_Query($args);

                if($my_query->have_posts()) : while ($my_query->have_posts() ) : $my_query->the_post(); ?>
                    <div class="one-third last-post">
                        <figure>
                            <a href="<?php echo the_permalink(); ?>"><?php echo the_post_thumbnail(); ?></a>
                        </figure>
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
            </div>
        </div>

    <?php }

}

// affichage du breadcrumb
if(get_field('Showing_breadcrumb')){

    remove_action( 'genesis_after_header', 'genesis_do_breadcrumbs',10 );

}

// suppresion du titre genesis de la page
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

genesis();