<?php
/**
 * Plugin Name: WP Country Search
 * Description: A WordPress plugin that displays a search bar with a country selector.
 * Version: 1.0.0
 * Author: Horacio Dominguez
 * License: GPL2+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

defined('ABSPATH') || exit;

// logic
require_once plugin_dir_path(__FILE__) . 'includes/loader.php';

require_once plugin_dir_path(__FILE__) . 'admin/settings-page.php';

// Register admin page
add_action('admin_menu', function () {
    add_options_page(
        'WP Country Search',
        'Country Search',
        'manage_options',
        'csb_settings',
        'csb_options_page'
    );
});

add_action('admin_init', 'csb_register_settings');


/**
 * Enqueue plugin styles and scripts
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('csb-style', plugin_dir_url(__FILE__) . 'css/style.css');
    wp_enqueue_script('csb-script', plugin_dir_url(__FILE__) . 'js/script.js', [], false, true);

    $country_urls = get_option('csb_country_urls', []);
    wp_localize_script('csb-script', 'csbSettings', [
        'countryUrls' => $country_urls
    ]);
});

