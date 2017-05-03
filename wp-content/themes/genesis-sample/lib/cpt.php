<?php
if( ! function_exists( 'quote_create_post_type' ) ) :
    function quote_create_post_type() {
        $labels = array(
            'name' => 'Réalisations',
            'singular_name' => 'realisations',
            'add_new' => 'Ajouter',
            'all_items' => 'toutes les réalisations',
            'add_new_item' => 'Ajouter une réalisation',
            'edit_item' => 'Editer une réalisations',
            'new_item' => 'Nouveau',
            'view_item' => 'Voir la réalisation',
            'search_items' => 'Rechercher',
            'not_found' => 'Aucune réalisation',
            'not_found_in_trash' => 'Aucune réalisation dans la corbeille',
            'parent_item_colon' => 'Réalisation parente'
            //'menu_name' => default to 'name'
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'has_archive' => true,
            'publicly_queryable' => true,
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'supports' => array(
                'title',
                'editor',
                'excerpt',
                'thumbnail',
                //'author',
                //'trackbacks',
                //'custom-fields',
                //'comments',
                'revisions',
                //'page-attributes', // (menu order, hierarchical must be true to show Parent option)
                //'post-formats',
            ),
            'taxonomies' => array( 'category', 'post_tag' ), // add default post categories and tags
            'menu_position' => 5,
            'exclude_from_search' => false,
            'register_meta_box_cb' => 'quote_add_post_type_metabox'
        );
        register_post_type( 'realisations', $args );
        //flush_rewrite_rules();

        register_taxonomy( 'quote_category', // register custom taxonomy - category
            'quote',
            array(
                'hierarchical' => true,
                'labels' => array(
                    'name' => 'categories',
                    'singular_name' => 'categories',
                )
            )
        );
        register_taxonomy( 'quote_tag', // register custom taxonomy - tag
            'quote',
            array(
                'hierarchical' => false,
                'labels' => array(
                    'name' => 'Étiquettes',
                    'singular_name' => 'etiquettes',
                )
            )
        );
    }
    add_action( 'init', 'quote_create_post_type' );

endif; // end of function_exists()
?>