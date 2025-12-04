<?php $countries = csb_get_countries_from_cpt(); ?>

<form role="search" method="get" class="csb-search-form">

    <input type="hidden" name="post_type" value="product">

    <select name="product_country" class="csb-country-selector">
        <option value=""><?php echo esc_html('Select a country'); ?></option>
        <?php foreach ($countries as $c): ?>
            <option value="<?php echo esc_attr($c->id); ?>">
                <?php echo esc_html($c->title); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <input type="search"
           name="s"
           class="csb-search-field"
           placeholder="Search products..."
           value="<?php echo get_search_query(); ?>">

    <button type="submit" class="csb-search-submit">🔍</button>

</form>
