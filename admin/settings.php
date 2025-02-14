<?php
if (!defined('ABSPATH')) {
    exit;
}


function qcb_add_admin_menu() {
    add_options_page('Quick Chat Button', 'Quick Chat Button', 'manage_options', 'quick-chat-button', 'qcb_settings_page');
}
add_action('admin_menu', 'qcb_add_admin_menu');

function qcb_settings_page() {
?>
    <div class="wrap">
        <h1>Quick Chat Button - Cài Đặt</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('qcb_settings_group');
            do_settings_sections('quick-chat-button');
            submit_button();
            ?>
        </form>
    </div>
<?php
}

function qcb_register_settings() {
    register_setting('qcb_settings_group', 'qcb_enable_messenger');
    register_setting('qcb_settings_group', 'qcb_messenger_link');
    register_setting('qcb_settings_group', 'qcb_enable_zalo');
    register_setting('qcb_settings_group', 'qcb_zalo_phone');

    add_settings_section('qcb_main_settings', 'Cấu hình', null, 'quick-chat-button');

    add_settings_field('qcb_enable_messenger', 'Bật Messenger', 'qcb_messenger_checkbox', 'quick-chat-button', 'qcb_main_settings');
    add_settings_field('qcb_messenger_link', 'Liên kết Messenger', 'qcb_messenger_input', 'quick-chat-button', 'qcb_main_settings');

    add_settings_field('qcb_enable_zalo', 'Bật Zalo', 'qcb_zalo_checkbox', 'quick-chat-button', 'qcb_main_settings');
    add_settings_field('qcb_zalo_phone', 'Số điện thoại Zalo', 'qcb_zalo_input', 'quick-chat-button', 'qcb_main_settings');
}
add_action('admin_init', 'qcb_register_settings');

function qcb_messenger_checkbox() {
    $value = get_option('qcb_enable_messenger', 'yes');
    echo '<input type="checkbox" name="qcb_enable_messenger" value="yes" ' . checked($value, 'yes', false) . ' />';
}

function qcb_messenger_input() {
    $value = get_option('qcb_messenger_link', '#');
    echo '<input type="text" name="qcb_messenger_link" value="' . esc_attr($value) . '" />';
}

function qcb_zalo_checkbox() {
    $value = get_option('qcb_enable_zalo', 'yes');
    echo '<input type="checkbox" name="qcb_enable_zalo" value="yes" ' . checked($value, 'yes', false) . ' />';
}

function qcb_zalo_input() {
    $value = get_option('qcb_zalo_phone', '');
    echo '<input type="text" name="qcb_zalo_phone" value="' . esc_attr($value) . '" />';
}
?>
