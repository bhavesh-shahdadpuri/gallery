<?php
include('custom-registration-form.php');
include('user-register.php');
include('user-login.php');
include('upload-form.php');
include('gallery.php');
//include('captcha-setting.php');

add_shortcode('registration', 'dm_registration_shortcode');
add_shortcode('gallery', 'bs_gallery_shortcode');
add_shortcode('upload-form', 'bs_upload_shortcode');

$object_type = 'user';

function bs_gallery_activate() {

    add_option( 'Activated_Plugin', 'dmc' );
  
    /* activation code here */
  }
  register_activation_hook( __FILE__, 'bs_gallery_activate' );




?>