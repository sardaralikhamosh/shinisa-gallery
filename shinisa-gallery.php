<?php
/*
Plugin Name: Random Image Gallery
Description: Display image galleries with random ordering option
Version: 1.0
Author: Your Name
*/

// Security check
defined('ABSPATH') or die('No script kiddies please!');

// Include necessary files
require_once plugin_dir_path(__FILE__) . 'includes/gallery-shortcode.php';
require_once plugin_dir_path(__FILE__) . 'includes/random-gallery-shortcode.php';
require_once plugin_dir_path(__FILE__) . 'includes/admin-settings.php';

// Enqueue styles and scripts
function rig_enqueue_assets() {
    wp_enqueue_style('rig-gallery-style', plugins_url('assets/css/gallery-style.css', __FILE__));
    wp_enqueue_script('rig-gallery-script', plugins_url('assets/js/gallery-script.js', __FILE__), array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'rig_enqueue_assets');