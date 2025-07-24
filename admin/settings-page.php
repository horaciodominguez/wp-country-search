<?php
/**
 * WP Country Search - Admin Settings Page
 */

defined('ABSPATH') || exit;

/**
 * Register plugin settings
 */
function csb_register_settings() {
    register_setting('csb_options_group', 'csb_country_urls');

    add_settings_section(
        'csb_main_section',
        'Country Settings',
        null,
        'csb_settings'
    );

    add_settings_field(
        'csb_country_urls',
        'Country URLs',
        'csb_country_urls_field',
        'csb_settings',
        'csb_main_section'
    );
}

/**
 * Render the settings field for country URLs
 */
function csb_country_urls_field() {
    $value = get_option('csb_country_urls', []);
    if (!is_array($value)) $value = [];

    echo '<table id="csb-country-table"><thead><tr><th>Country</th><th>URL</th><th></th></tr></thead><tbody>';

    foreach ($value as $country => $url) {
        echo '<tr>
            <td><input type="text" name="csb_country_urls_keys[]" value="'. esc_attr($country) .'" /></td>
            <td><input type="text" name="csb_country_urls_values[]" value="'. esc_url($url) .'" /></td>
            <td><button class="button remove-row">Remove</button></td>
        </tr>';
    }

    echo '</tbody></table>';
    echo '<button class="button" id="add-country-row">Add Country</button>';

    // JavaScript to dynamically add/remove rows
    echo '<script>
    document.getElementById("add-country-row").addEventListener("click", function(e) {
        e.preventDefault();
        let row = `<tr>
            <td><input type="text" name="csb_country_urls_keys[]" /></td>
            <td><input type="text" name="csb_country_urls_values[]" /></td>
            <td><button class="button remove-row">Remove</button></td>
        </tr>`;
        document.querySelector("#csb-country-table tbody").insertAdjacentHTML("beforeend", row);
    });
    document.addEventListener("click", function(e) {
        if (e.target.classList.contains("remove-row")) {
            e.preventDefault();
            e.target.closest("tr").remove();
        }
    });
    </script>';
}

/**
 * Render the full options page
 */
function csb_options_page() {
    if (isset($_POST['csb_country_urls_keys']) && isset($_POST['csb_country_urls_values'])) {
        $keys = $_POST['csb_country_urls_keys'];
        $values = $_POST['csb_country_urls_values'];
        $assoc = array_combine($keys, $values);
        update_option('csb_country_urls', $assoc);
    }

    ?>
    <div class="wrap">
        <h1>WP Country Search Settings</h1>
        <form method="post" action="">
            <?php
            settings_fields('csb_options_group');
            do_settings_sections('csb_settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}
