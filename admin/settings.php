<?php
defined('ABSPATH') || exit;

/**
 * Settings page for selecting CSS theme
 */
function csb_register_settings() {
    add_option('csb_theme_style', 'light');
    register_setting('csb_settings_group', 'csb_theme_style');
}
add_action('admin_init', 'csb_register_settings');


function csb_add_settings_page() {
    add_options_page(
        'Country Search Bar Settings',
        'Country Search Bar',
        'manage_options',
        'csb-settings',
        'csb_render_settings_page'
    );
}
add_action('admin_menu', 'csb_add_settings_page');


function csb_render_settings_page() {
    ?>
    <div class="wrap">
        <h1>Country Search Bar - Settings</h1>

        <form method="post" action="options.php">
            <?php settings_fields('csb_settings_group'); ?>
            <?php $theme = get_option('csb_theme_style', 'light'); ?>

            <table class="form-table">

                <tr valign="top">
                    <th scope="row">Select a theme:</th>
                    <td>
                        <select name="csb_theme_style">
                            <option value="light" <?php selected($theme, 'light'); ?>>Light</option>
                            <option value="dark" <?php selected($theme, 'dark'); ?>>Dark</option>
                            <option value="high-contrast" <?php selected($theme, 'high-contrast'); ?>>High Contrast</option>
                        </select>
                    </td>
                </tr>

            </table>

            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
