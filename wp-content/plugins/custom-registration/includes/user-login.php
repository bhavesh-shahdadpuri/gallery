<?php


function bs_user_login(){

    $email = $_POST['email'];
    $passwd = $_POST['passwd'];

    if ( email_exists( $email ) ){  
        $user = get_user_by("email", $email);
        if(wp_check_password($passwd, $user->user_pass))
        {
            wp_set_current_user($user->ID, $user->user_login);
            wp_set_auth_cookie($user->ID);
            echo json_encode(array("status"=>"success", "response"=>$user));
        }
        else
        {
            echo json_encode(array("status"=>"error", "error"=>"Invalid Username or Password."));
        }
    }else{
        echo json_encode(array("status"=>"error", "error"=>"not registered"));
    }
    
    wp_die();
}

add_action( 'wp_ajax_bs_user_login', 'bs_user_login' );
add_action( 'wp_ajax_nopriv_bs_user_login', 'bs_user_login' ); 