# WP Country Search

WP Country Search is a simple WordPress plugin that allows WooCommerce stores to filter products by country. The plugin provides a custom search bar with a country selector and integrates directly with WooCommerce product queries.

## Features

- Custom post type **Product Country** to manage available countries.
- Additional tab/box inside WooCommerce product editing to assign one or multiple countries.
- Search bar template to allow users to filter products by country.
- Internal product filtering using the `product_country` GET parameter.
- Optional admin settings page to configure plugin behavior.

## How It Works

1. Create countries in **Product Countries** (added by the plugin).
2. Edit any WooCommerce product and assign one or more countries using the plugin’s product tab.
3. Display the search bar:

<?php echo csb_get_search_bar(); ?>

### **Shortcode**

[wp_country_search_bar]

Place it anywhere in:
- Pages
- Posts
- Elementor/Divi text widgets
- Block Editor shortcode block

4. The search bar sends a `product_country` parameter via GET.
5. The plugin modifies WooCommerce's main query and displays only products that match the selected country.

## Main Files

- **wp-country-search.php** — main loader for the plugin.
- **includes/product-countries-cpt.php** — registers the Product Country custom post type.
- **includes/product-country-tab.php** — adds the edit-product tab for assigning countries.
- **includes/search-filter.php** — filters WooCommerce products by country.
- **templates/search-bar.php** — HTML search bar template.
- **admin/settings.php** — plugin settings (optional).

## Requirements

- WordPress 5.0+
- WooCommerce 7.0+
- PHP 7.4+

## Installation

1. Upload the plugin folder to `/wp-content/plugins/`.
2. Activate it in **Plugins**.
3. Create countries and assign them to products.
4. Add the search bar where you need it.

## Notes

- The plugin does not modify product pricing, inventory, or any WooCommerce core functionality.
- No external APIs are required.
- Fully compatible with any WooCommerce theme.

## License

GPL2+
