<?php
defined('ABSPATH') || exit;

/**
 * Add custom tab in product data (WooCommerce) to select product countries.
 * This stores the selected country IDs in post meta 'csb_product_countries' as an array of ints.
 */

/* Add tab */
function csb_add_country_product_tab($tabs) {
    $tabs['csb_country'] = [
        'label'    => 'Country',
        'target'   => 'csb_country_product_data',
        'class'    => ['show_if_simple', 'show_if_variable'],
        'priority' => 70,
    ];
    return $tabs;
}
add_filter('woocommerce_product_data_tabs', 'csb_add_country_product_tab');

/* Panel content */
function csb_country_product_tab_content() {
    global $post;
    $countries = csb_get_countries_from_cpt(); // helper in main plugin file
    $selected = get_post_meta($post->ID, 'csb_product_countries', true);
    if (!is_array($selected)) {
        $selected = [];
    }
    ?>
    <div id="csb_country_product_data" class="panel woocommerce_options_panel">
        <div class="options_group">
            <p class="form-field">
                <label for="csb_country_field">Select countries</label>
                <br/>
                <?php if (empty($countries)) : ?>
                    <em>No countries created. Go to Products → Product Countries to add countries.</em>
                <?php else: ?>
                    <div style="max-height: 220px; overflow:auto; border:1px solid #ddd; padding:8px;">
                        <?php foreach ($countries as $c): ?>
                            <?php $checked = in_array($c->id, $selected) ? 'checked' : ''; ?>
                            <label style="display:block; margin:3px 0;">
                                <input type="checkbox" name="csb_country_field[]" value="<?php echo esc_attr($c->id); ?>" <?php echo $checked; ?> />
                                <?php echo esc_html($c->title); ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                    <p class="description">Select one or more countries for this product.</p>
                <?php endif; ?>
            </p>
        </div>
    </div>
    <?php
}
add_action('woocommerce_product_data_panels', 'csb_country_product_tab_content');

/* Save data */
function csb_save_country_product_tab($post_id) {
    // Only save for products (woocommerce_process_product_meta passes product id)
    if (isset($_POST['csb_country_field']) && is_array($_POST['csb_country_field'])) {
        $countries = array_map('intval', $_POST['csb_country_field']);
        update_post_meta($post_id, 'csb_product_countries', $countries);
    } else {
        // If nothing sent, remove meta / save empty array
        delete_post_meta($post_id, 'csb_product_countries');
    }
}
add_action('woocommerce_process_product_meta', 'csb_save_country_product_tab');
