<?php

require_once 'custom-fields.php';

/*********************
 * CPT ( CAMION / RESTAURANT )
 *********************/
add_action('after_switch_theme', 'rewrite_rules');

function rewrite_rules()
{
    flush_rewrite_rules();
}

add_action('init', 'register_camion');
add_action('init', 'register_restaurant');
add_action('init', 'add_taxonomies');

function register_camion()
{
    register_post_type('camion',
        array('labels' => array(
            'name' => 'Le camion',
            'singular_name' => 'Menu du Camion',
            'all_items' => 'Tous les Menus',
            'add_new' => 'Ajouter un menu',
            'add_new_item' => 'Ajouter un nouveau menu',
            'edit' => 'Editer le menu',
            'edit_item' => 'Editer',
            'new_item' => 'Nouveau menu',
            'view_item' => 'Voir le menu',
            'search_items' => 'Chercher un menu',
            'not_found' => 'Aucun menu trouvé',
            'not_found_in_trash' => 'Aucun menu trouvé dans la poubelle',
            'parent_item_colon' => 'Menu'
        ),
            'description' => 'Gestion des menus du camion',
            'public' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'show_ui' => true,
            'query_var' => true,
            'menu_position' => 3,
            'menu_icon' => 'dashicons-carrot',
            'has_archive' => 'false',
            'capability_type' => 'post',
            'hierarchical' => false,
            'supports' => array('title', 'editor', 'revisions')
        )
    );

}

function register_restaurant()
{
    register_post_type('restaurant',
        array('labels' => array(
            'name' => 'Le restaurant',
            'singular_name' => 'Menu du Restaurant',
            'all_items' => 'Tous les Menus',
            'add_new' => 'Ajouter un menu',
            'add_new_item' => 'Ajouter un nouveau menu',
            'edit' => 'Editer le menu',
            'edit_item' => 'Editer',
            'new_item' => 'Nouveau menu',
            'view_item' => 'Voir le menu',
            'search_items' => 'Chercher un menu',
            'not_found' => 'Aucun menu trouvé',
            'not_found_in_trash' => 'Aucun menu trouvé dans la poubelle',
            'parent_item_colon' => 'Menu'
        ),
            'description' => 'Gestion des menus du restaurant',
            'public' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'show_ui' => true,
            'query_var' => true,
            'menu_position' => 2,
            'menu_icon' => 'dashicons-carrot',
            'has_archive' => 'false',
            'capability_type' => 'post',
            'hierarchical' => false,
            'supports' => array('title', 'editor', 'revisions')
        )
    );

}

register_taxonomy('type',
    array('restaurant', 'camion'),
    array('hierarchical' => true,
        'labels' => array(
            'name' => 'Types',
            'singular_name' => 'Type de menu',
            'search_items' => 'Rechercher tous les types de menus',
            'all_items' => 'Tous les types de menus',
            'parent_item' => 'Parent',
            'parent_item_colon' => 'Parent',
            'edit_item' => 'Editer le type de menu',
            'update_item' => 'Mettre à jour le type de menu',
            'add_new_item' => 'Ajouter un nouveau type de menu',
            'new_item_name' => 'Nouveau type de menu'
        ),
        'show_admin_column' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'type'),
    )
);
register_taxonomy('liste',
    array('restaurant', 'camion'),
    array('hierarchical' => true,
        'labels' => array(
            'name' => 'Liste',
            'singular_name' => 'Liste',
            'search_items' => 'Rechercher toutes les listes',
            'all_items' => 'Toutes les listes',
            'parent_item' => 'Parent',
            'parent_item_colon' => 'Parent',
            'edit_item' => 'Editer la liste',
            'update_item' => 'Mettre à jour la liste',
            'add_new_item' => 'Ajouter une nouvelle liste',
            'new_item_name' => 'Nouvelle liste'
        ),
        'show_admin_column' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'lieu'),
    )
);
function add_taxonomies()
{
    //Add formule
    wp_insert_term(
        'Formule',
        'type',
        array(
            'description' => 'Une formule',
            'slug' => 'formule'
        )
    );
}

?>
