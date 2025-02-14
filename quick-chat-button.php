<?php

if (!defined('ABSPATH')) {
    exit;
}

require_once plugin_dir_path(__FILE__) . 'admin-settings.php';

function qcb_enqueue_scripts() {
    wp_enqueue_style('qcb-style', plugin_dir_url(__FILE__) . 'style.css');
    wp_enqueue_script('qcb-script', plugin_dir_url(__FILE__) . 'script.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'qcb_enqueue_scripts');

function qcb_display_chat_button() {
    $enable_messenger = get_option('qcb_enable_messenger', 'yes');
    $enable_zalo = get_option('qcb_enable_zalo', 'yes');
    $messenger_link = esc_url(get_option('qcb_messenger_link', '#'));
    $zalo_phone = esc_attr(get_option('qcb_zalo_phone', ''));
    
    echo '<div class="qcb-chat-buttons">';
    if ($enable_messenger === 'yes') {
        echo '<a href="' . $messenger_link . '" class="qcb-btn messenger" target="_blank">
                <i class="fa fa-facebook-messenger"></i> Chat Messenger
              </a>';
    }
    if ($enable_zalo === 'yes' && !empty($zalo_phone)) {
        echo '<a href="https://zalo.me/' . $zalo_phone . '" class="qcb-btn zalo" target="_blank">
                <i class="fa fa-zalo"></i> Chat Zalo
              </a>';
    }
    echo '</div>';
}
add_action('wp_footer', 'qcb_display_chat_button');
?>
