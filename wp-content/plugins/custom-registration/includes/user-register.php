<?php


function dm_register_user(){

    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $passwd = $_POST['passwd'];
    $country = $_POST['country'];

    $user_id = username_exists( $uname );

    if($user_id){
        echo json_encode(array("status"=>"error", "error"=>"Username already exists."));
    } else if ( ! $user_id && false == email_exists( $email ) ) {
        $user_id = wp_create_user( $uname, $passwd, $email );
        add_user_meta($user_id, "country", $country);
        $user = new WP_User($user_id);
        $user->set_role('web_user');
        echo json_encode(array("status"=>"success", "response"=>$user_id));
    } else {
        echo json_encode(array("status"=>"error", "error"=>"User already exists."));
    }

    wp_die();
}

add_action( 'wp_ajax_dm_register_user', 'dm_register_user' );
add_action( 'wp_ajax_nopriv_dm_register_user', 'dm_register_user' );

?>