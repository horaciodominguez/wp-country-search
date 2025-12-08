<?php
/**
 * Plugin Name: WP Country Search
 * Description: A WordPress plugin that displays a search bar with a country selector and integrates with WooCommerce products.
 * Version: 1.0.0
 * Author: Horacio Dominguez
 * License: GPL2+
 */

defined('ABSPATH') || exit;

// Includes
require_once plugin_dir_path(__FILE__) . 'includes/product-countries-cpt.php';
require_once plugin_dir_path(__FILE__) . 'includes/product-country-tab.php';
require_once plugin_dir_path(__FILE__) . 'includes/search-filter.php';
require_once plugin_dir_path(__FILE__) . 'includes/loader.php';

//admin
require_once plugin_dir_path(__FILE__) . 'admin/settings.php';

//css
function csb_enqueue_styles() {
    wp_enqueue_style(
        'csb-styles',
        plugin_dir_url(__FILE__) . 'css/style.css',
        [],
        '1.0'
    );
}
add_action('wp_enqueue_scripts', 'csb_enqueue_styles');

// REST endpoint to get countries (from CPT)
add_action('rest_api_init', function () {
    register_rest_route('csb/v1', '/countries', [
        'methods' => 'GET',
        'callback' => function () {
            $countries = get_posts([
                'post_type' => 'product_country',
                'numberposts' => -1,
                'post_status' => 'publish',
                'orderby' => 'title',
                'order' => 'ASC',
            ]);
            $out = [];
            foreach ($countries as $c) {
                $out[] = [
                    'id'    => (int) $c->ID,
                    'title' => get_the_title($c),
                    'slug'  => $c->post_name,
                ];
            }
            return rest_ensure_response($out);
        },
        'permission_callback' => '__return_true',
    ]);
});

/**
 * Helper: Get countries (as array of objects) from CPT
 * returns array of objects with id, title, slug
 */
function csb_get_countries_from_cpt() {
    $posts = get_posts([
        'post_type' => 'product_country',
        'numberposts' => -1,
        'post_status' => 'publish',
        'orderby' => 'title',
        'order' => 'ASC',
    ]);
    $out = [];
    foreach ($posts as $p) {
        $out[] = (object) [
            'id'    => (int) $p->ID,
            'title' => get_the_title($p),
            'slug'  => $p->post_name,
        ];
    }
    return $out;
}


add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script(
        'csb-search',
        plugin_dir_url(__FILE__) . 'js/script.js',
        [],
        '1.0',
        true
    );
    wp_localize_script('csb-search', 'CSB_VARS', [
        'home_url' => home_url('/'),
    ]);
});
