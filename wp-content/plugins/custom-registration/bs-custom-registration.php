<?php
/**
 * Plugin Name: BS Custom Registration
 * Plugin URI: 
 * Description: This plugin allows user registration, Sign in, User data upload and gallery functionalities.
 * Author: Bhavesh Shahdadpuri
 * Author URI: 
 * Version: 1.0
 */




if ( !defined( 'ABSPATH' ) ) exit;

include('includes/includes.php');
include('settings/settings.php');

function activate_bs_custom_registration() {

  

	
	init_db_myplugin();
}

// De-activate Plugin
function deactivate_bs_custom_registration() {

	
}

// Initialize DB Tables
function init_db_myplugin() {
    global $wpdb;           
    $wpdb->query("CREATE TABLE IF NOT EXISTS `wp_gallery` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(100) NOT NULL,
        `email` varchar(100) NOT NULL,
        `phone` varchar(100) NOT NULL,
        `country` varchar(100) NOT NULL,
        `city` varchar(100) NOT NULL,
        `path` text NOT NULL,
        `date` datetime NOT NULL,
        `status` varchar(100) NOT NULL,
        PRIMARY KEY (id)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
	
}

register_activation_hook( __FILE__, 'activate_bs_custom_registration' );
register_deactivation_hook( __FILE__, 'deactivate_bs_custom_registration' );
 ?>