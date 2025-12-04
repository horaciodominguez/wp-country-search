<?php
defined('ABSPATH') || exit;

/**
 * Register shortcode to display search bar
 */
function csb_register_shortcode() {
    add_shortcode('country_search_bar', 'csb_render_search_bar');
}
add_action('init', 'csb_register_shortcode');

/**
 * Render search bar template
 */
function csb_render_search_bar() {
    ob_start();
    include plugin_dir_path(__FILE__) . '../templates/search-bar.php';
    return ob_get_clean();
}
?>