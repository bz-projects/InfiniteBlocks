<?php 
/* 
    Plugin Name: Infinite Blocks – Blocks for Gutenberg
    Description: Ultimative powerfull Gutenberg Blocks library.
    Author: Benjamin Zekavica
    Version: 1.0
*/

// HELPERS 
$pluginPath =  plugin_dir_path( __FILE__ );

// Permission EXIT
if ( ! defined( 'ABSPATH' )) {
    exit;
}

// Active WordPress REST API 
wp_enqueue_script( 'wp-api' );

// Plugin Settings  
require $pluginPath . 'options/block-manager.php';

// Includes
require $pluginPath . 'inc/block-category.php';
require $pluginPath . 'inc/block-loader.php';