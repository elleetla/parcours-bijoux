<?php
/**
 * Created by PhpStorm.
 * User: ellela
 * Date: 10/05/2017
 * Time: 13:10
 */

//* Display picture of the slider and its title (/!\ display only slider of the 1st post)
add_action( 'genesis_after_header', 'slider_project', 10 );

//* Removes Title and Description on Archive, Taxonomy, Category, Tag
remove_action( 'genesis_before_loop', 'genesis_do_taxonomy_title_description', 15 );

//* Remove the standard loop
//remove_action ('genesis_loop', 'genesis_do_loop');

//* Remove title content
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

//* Remove post content
remove_action('genesis_entry_content', 'genesis_do_post_content');

//* Remove footer content
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );


//* Display post content
add_action('genesis_entry_content', 'post_content');
function post_content(){?>
    <div class="all col-lg-3 col-md-3 col-sm-6 col-xs-12 portfolio-item <?php // echo $tax ?>">
        <div class="bloc-project">
            <a href=" <?php the_permalink(); ?>">
                <img class="img-responsive" src="<?php
                $thumbnailURL = wp_get_attachment_image_src(get_post_thumbnail_id ( $post_ID ), 'slider-image');
                echo $thumbnailURL[0];  ?>" />

                <div class="caption-project">
                    <h4><?php echo get_the_term_list(get_the_ID(), 'categorie'); ?></h4>
                    <h1><?php the_title();?></h1>
                    <span><?php echo get_field('nom_lieu'); ?></span><br>
                    <span><?php echo get_field('periode'); ?></span>
                </div>
            </a>
        </div><!-- ./bloc-project -->
    </div><!-- ./all col-lg-3 -->
<?php
}


//* Display posts randomly
add_action('genesis_before_loop', 'random');
function random () {
    global $query_string;
    query_posts($query_string . "&orderby=rand");
}

//Load More button
add_action('genesis_before_loop', 'load_more');
add_action('genesis_after_loop', 'load_more');

function load_more () {?>
    <button class="load-more"">+ voir tous les évènements +</button>
<?php
}

genesis();
