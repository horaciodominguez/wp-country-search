<?php
defined('ABSPATH') || exit;

/**
 * Add tab to product editor
 */
add_filter('woocommerce_product_data_tabs', function($tabs) {

    $tabs['csb_country'] = [
        'label'    => 'Countries',
        'target'   => 'csb_country_product_data',
        'class'    => ['show_if_simple', 'show_if_variable'],
        'priority' => 80,
    ];

    return $tabs;
});


/**
 * Render countries panel inside product editor
 */
function csb_country_product_tab_render() {
    global $post;

    // Load countries from CPT
    $countries = csb_get_countries_from_cpt();
    $selected  = get_post_meta($post->ID, 'csb_product_countries', true);

    if (!is_array($selected)) {
        $selected = [];
    }
    ?>

    <div class="options_group">
        <p class="form-field">
            <label for="csb_product_countries">Select countries</label>

            <?php if (empty($countries)): ?>
                <em>No countries found. Create them under Products → Product Countries.</em>

            <?php else: ?>
                <div style="border:1px solid #ddd; padding:10px; max-height:220px; overflow:auto;">
                    <?php foreach ($countries as $c): ?>
                        <label style="display:block; margin:4px 0;">
                            <input type="checkbox"
                                   name="csb_product_countries[]"
                                   value="<?php echo esc_attr($c->id); ?>"
                                   <?php checked(in_array($c->id, $selected)); ?>
                            >
                            <?php echo esc_html($c->title); ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </p>
    </div>

    <?php
}


/**
 * Insert panel in WooCommerce layout
 */
add_action('woocommerce_product_data_panels', function() {
    echo '<div id="csb_country_product_data" class="panel woocommerce_options_panel">';
    csb_country_product_tab_render();
    echo '</div>';
});


/**
 * Save product countries
 */
add_action('woocommerce_admin_process_product_object', function($product) {

    if (!isset($_POST['csb_product_countries'])) {
        $countries = [];
    } else {
        $countries = array_map('intval', $_POST['csb_product_countries']);
    }

    update_post_meta($product->get_id(), 'csb_product_countries', $countries);

});
