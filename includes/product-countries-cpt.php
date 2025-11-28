<?php
defined('ABSPATH') || exit;

/**
 * Register CPT 'product_country' to manage countries under Products menu.
 * It will appear as: Products -> Product Countries
 */

function csb_register_product_country_cpt() {
    $labels = [
        'name'               => 'Product Countries',
        'singular_name'      => 'Product Country',
        'menu_name'          => 'Product Countries',
        'name_admin_bar'     => 'Product Country',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Country',
        'new_item'           => 'New Country',
        'edit_item'          => 'Edit Country',
        'view_item'          => 'View Country',
        'all_items'          => 'All Countries',
        'search_items'       => 'Search Countries',
        'not_found'          => 'No countries found.',
        'not_found_in_trash' => 'No countries found in trash.',
    ];

    $args = [
        'labels'             => $labels,
        'public'             => false,            // not publicly queryable
        'show_ui'            => true,
        'show_in_menu'       => 'edit.php?post_type=product', // appear under Products menu
        'capability_type'    => 'post',
        'supports'           => ['title'],        // just title needed (country name)
        'has_archive'        => false,
        'rewrite'            => false,
    ];

    register_post_type('product_country', $args);
}
add_action('init', 'csb_register_product_country_cpt', 10);
