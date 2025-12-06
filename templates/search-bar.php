<?php 
$countries = csb_get_countries_from_cpt(); 
$theme = get_option('csb_theme_style', 'light'); // light, dark, high-contrast
?>

<form role="search" method="get" class="csb-search-form csb-theme-<?php echo esc_attr($theme); ?>">

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
        <svg class="search-icon" viewBox="0 0 24 24" fill="none">
            <circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2.5"/>
            <path d="M16 16L21 21" stroke="currentColor" stroke-width="2.5"/>
        </svg>
    </button>

</form>
