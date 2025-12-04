<?php
defined('ABSPATH') || exit;

/**
 * Robust filter: filter WooCommerce product listing & search by country id.
 * Matches serialized ints (i:84;) and serialized strings ("84") to be safe.
 */
function csb_filter_products_by_country($wc_query) {

    if (is_admin()) {
        return;
    }

    if (!isset($_GET['product_country']) || empty($_GET['product_country'])) {
        return;
    }

    $country_id = intval($_GET['product_country']);
    if ($country_id <= 0) return;

    // Get existing meta_query if any
    $meta_query = $wc_query->get('meta_query');
    if (!is_array($meta_query)) $meta_query = [];

    // We'll add a grouped meta_query with OR to match several serialization flavors:
    // 1) serialized integers: i:84;
    // 2) serialized strings: "84"
    $meta_query[] = [
        'relation' => 'OR',
        [
            'key'     => 'csb_product_countries',
            'value'   => 'i:' . $country_id . ';',
            'compare' => 'LIKE',
        ],
        [
            'key'     => 'csb_product_countries',
            'value'   => '"' . $country_id . '"',
            'compare' => 'LIKE',
        ],
    ];

    $wc_query->set('meta_query', $meta_query);
}
add_action('woocommerce_product_query', 'csb_filter_products_by_country', 20);
