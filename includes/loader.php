<?php
/**
 * WP Country Search - Core Plugin Logic
 */

defined('ABSPATH') || exit;

/**
 * Register the [country_search_bar] shortcode
 */
add_shortcode('country_search_bar', 'csb_render_search_bar');

/**
 * Renders the search bar using an external template
 */
function csb_render_search_bar($atts = []) {
    ob_start();
    include plugin_dir_path(__FILE__) . '../templates/search-bar.php';
    return ob_get_clean();
}
