<?php
/*
Plugin Name: Shinisa Image Gallery
Description: Display image galleries with random ordering option
Version: 1.0
Author: Sardar Ali
Plugin Url: https://shinisa.com
Author Url: https://shinisa.com/sardaralikhamosh
*/

// Security check
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Activation checks
register_activation_hook(__FILE__, 'shinisa_gallery_activate');
function shinisa_gallery_activate() {
    // Check WordPress version
    if (version_compare(get_bloginfo('version'), '5.0', '<')) {
        deactivate_plugins(plugin_basename(__FILE__));
        wp_die(__('This plugin requires WordPress 5.0 or later!', 'shinisa-gallery'));
    }
}

// Include necessary files with error handling
$includes = [
    'includes/gallery-shortcode.php',
    'includes/shinisa-gallery-shortcode.php',
    'includes/admin-settings.php'
];

foreach ($includes as $file) {
    $path = plugin_dir_path(__FILE__) . $file;
    if (file_exists($path)) {
        require_once $path;
    } else {
        // Log error but don't prevent activation
        error_log("Shinisa Gallery: Missing file - " . $file);
    }
}

// Enqueue styles and scripts
function shinisa_gallery_enqueue_assets() {
    wp_enqueue_style(
        'shinisa-gallery-style', 
        plugins_url('assets/css/gallery-style.css', __FILE__)
    );
    wp_enqueue_script(
        'shinisa-gallery-script', 
        plugins_url('assets/js/gallery-script.js', __FILE__), 
        array('jquery'), 
        '1.0', 
        true
    );
}
add_action('wp_enqueue_scripts', 'shinisa_gallery_enqueue_assets');