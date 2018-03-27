<?php
add_action('admin_menu', 'bb_cart_create_menu');
function bb_cart_create_menu() {
    add_menu_page('BB Cart', 'BB Cart', 'administrator', 'bb_cart_settings', 'bb_cart_settings_page', 'dashicons-cart');
    add_submenu_page('bb_cart_settings', 'Settings', 'Settings', 'administrator', 'bb_cart_settings', 'bb_cart_settings_page', 'dashicons-cart');
}

add_action('admin_init', 'bb_cart_register_settings');
function bb_cart_register_settings() {
    register_setting('bb-cart-settings-group', 'bb_cart_default_fund_code');
}

function bb_cart_settings_page() {
?>
<div class="wrap">
    <h2>BB Cart Settings</h2>
    <form method="post" action="options.php">
    <?php settings_fields('bb-cart-settings-group'); ?>
    <?php do_settings_sections('bb-cart-settings-group'); ?>
    <table class="form-table">
        <tr valign="top">
            <th scope="row">Default Fund Code</th>
            <td>
                <select name="bb_cart_default_fund_code">
                    <option value="">Please Select</option>
<?php
    $args = array(
            'post_type' => 'fundcode',
            'posts_per_page' => -1,
            'orderby' => 'post_title',
            'order' => 'ASC',
    );
    $fund_codes = get_posts($args);
    foreach ($fund_codes as $fund_code) {
        echo '                    <option value="'.$fund_code->ID.'" '.selected($fund_code->ID, get_option('bb_cart_default_fund_code'), false).'>'.$fund_code->post_title.'</option>'."\n";
    }
?>
                </select>
            </td>
        </tr>
    </table>
    <?php submit_button(); ?>
</form>
</div>
<?php
}
