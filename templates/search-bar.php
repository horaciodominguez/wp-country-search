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

    <button type="submit" class="csb-search-submit">
        <svg class="search-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M16 16L21 21" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </button>

</form>
