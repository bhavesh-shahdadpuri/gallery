<?php

  include('custom-registration-form.php');
  include('user-register.php');
  include('user-login.php');
  include('upload-form.php');
  include('submit.php');
  include('gallery.php');
  include('settings.php');

  add_shortcode('registration', 'dm_registration_shortcode');
  add_shortcode('gallery', 'bs_gallery_shortcode');
  add_shortcode('upload-form', 'bs_upload_shortcode');

  add_role( 'web_user', "Web User");

  $object_type = 'user';

  $args1 = array(
    'type'      => 'string',
    'description'    => 'Country',
    'single'        => true,
    'show_in_rest'    => true,
  );

  register_meta( $object_type, 'country', $args1 );

  function bs_manage_users_columns( $columns ) {

    // $columns is a key/value array of column slugs and names
    $columns[ 'country' ] = 'Country';

    return $columns;
  }

  add_filter( 'manage_users_columns', 'bs_manage_users_columns', 10, 1 );

  function bs_manage_users_custom_column( $output, $column_key, $user_id ) {

    switch ( $column_key ) {
        case 'country':
            $value = get_user_meta( $user_id, 'country', true );

            return $value;
            break;
        default: break;
    }

    // if no column slug found, return default output value
    return $output;
  }

  add_action( 'manage_users_custom_column', 'bs_manage_users_custom_column', 10, 3 );

  add_action( 'wp_logout', 'redirect_after_logout');
  function redirect_after_logout(){
    wp_redirect( 'login/' );
    exit();
  }

  /*add_action('after_setup_theme', 'bs_remove_admin_bar');
    function bs_remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
      show_admin_bar(false);
    }
  }*/







?>