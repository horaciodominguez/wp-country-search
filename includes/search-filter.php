<?php
defined('ABSPATH') || exit;


function csb_filter_products_by_country($wc_query) {

    if (is_admin()) {
        return;
    }

    if (!isset($_GET['product_country']) || empty($_GET['product_country'])) {
        return;
    }

    $country_id = intval($_GET['product_country']);
    if ($country_id <= 0) return;

    $meta_query = $wc_query->get('meta_query');
    if (!is_array($meta_query)) $meta_query = [];

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
