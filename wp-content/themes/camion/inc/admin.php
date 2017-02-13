<?php

/************* CUSTOM DASHBOARD AND MENU *****************/

function custom_menu()
{

    $eles = get_field('affichage', 'option');

    if (count($eles) > 0) {
        if (is_array($eles)) {
            foreach ($eles as $ele) {
                remove_menu_page($ele);
            }
        } else {
            remove_menu_page($eles);
        }
    }
    $new_pages = get_field('icone', 'option');

    if (count($new_pages) > 0) {
        if (is_array($new_pages)) {
            foreach ($new_pages as $new_page) {
                add_menu_page($new_page['titre'], $new_page['titre_sidebar'], 'manage_options', $new_page['lien'], '', $new_page['icone'], $new_page['position']);
                if ($new_page['sous_menu']) {
                    add_submenu_page($new_page['lien'], $new_page['subpage_name'], $new_page['subpage_name'], 'manage_options', 'post.php?post=' . $new_page['id'] . '&action=edit');
                }
            }
        } else {
            add_menu_page($new_pages['titre'], $new_pages['titre_sidebar'], 'manage_options', $new_pages['lien'], '', $new_pages['icone'], $new_pages['position']);
            if ($new_pages['sous_menu']) {
                add_submenu_page($new_pages['lien'], $new_pages['subpage_name'], $new_pages['subpage_name'], 'manage_options', 'post.php?post=' . $new_pages['id'] . '&action=edit');
            }
        }
    }
}

function remove_widgets()
{
    global $wp_meta_boxes;
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
}

function remove_commentstatus_meta_box()
{
    remove_meta_box('commentstatusdiv', 'post', 'normal');
}

function remove_admin_bar_links()
{
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');          // Remove the WordPress logo
    $wp_admin_bar->remove_menu('about');            // Remove the about WordPress link
    $wp_admin_bar->remove_menu('wporg');            // Remove the WordPress.org link
    $wp_admin_bar->remove_menu('documentation');    // Remove the WordPress documentation link
    $wp_admin_bar->remove_menu('support-forums');   // Remove the support forums link
    $wp_admin_bar->remove_menu('feedback');         // Remove the feedback link
    $wp_admin_bar->remove_menu('updates');          // Remove the updates link
    $wp_admin_bar->remove_menu('comments');         // Remove the comments link
    $wp_admin_bar->remove_menu('w3tc');             // If you use w3 total cache remove the performance link
    $wp_admin_bar->remove_menu('my-account');       // Remove the user details tab
}

function home_widget()
{
    ?>
    <h1>P&G - Le Camion Gourmand</h1>
    <p>D'ici, vous pourrez mettre à jour les éléments du site :</p>
    <ul>
        <li><span class="wp-menu-image dashicons-before dashicons-carrot"></span> <strong>Les Menus : <a href="#">C'est
                    ici</a></strong></li>
        <li><span class="wp-menu-image dashicons-before dashicons-admin-page"></span> <strong>Les Pages : <a href="#">C'est
                    ici</a></strong></li>
        <li><span class="wp-menu-image dashicons-before dashicons-menu"></span> <strong>La Navigation : <a href="#">C'est
                    ici</a></strong></li>
    </ul>
    <small>Ce site à été réalisé avec amour par des élèves d'Hetic</small>
    <?php
}

function add_widget()
{
    wp_add_dashboard_widget('home_widget', 'Bienvenue', 'home_widget');
}

add_action('wp_dashboard_setup', 'remove_widgets');
add_action('wp_dashboard_setup', 'add_widget');
add_action('admin_menu', 'remove_commentstatus_meta_box');
add_action('admin_menu', 'custom_menu');
add_action('wp_before_admin_bar_render', 'remove_admin_bar_links');

?>
