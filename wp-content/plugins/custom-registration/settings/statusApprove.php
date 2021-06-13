<?php


function bs_status_approve(){

    $id = $_POST['id'];
    global $wpdb;

    $sql = $wpdb->query("UPDATE `wp_gallery` set status = 'Approved' WHERE id= '$id'");
    echo json_encode(array("status"=>"success"));
    
    wp_die();
}

add_action( 'wp_ajax_bs_status_approve', 'bs_status_approve' );
add_action( 'wp_ajax_nopriv_bs_status_approve', 'bs_status_approve' ); 