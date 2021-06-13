<?php

include('statusApprove.php');
    include('statusDisapprove.php');


function bs_options_page() {
    add_menu_page(
        'BS Uploaded Images',
        'BS Uploaded Images',
        'manage_options',
        'bs',
        'bs_options_page_html'
    );
}

/**
 * Register our bs_options_page to the admin_menu action hook.
 */
add_action( 'admin_menu', 'bs_options_page' );

function bs_settings_load_scripts()
    {
        wp_enqueue_script('sweetalertmin_js', plugins_url('js/sweetalert.min.js',__FILE__ ));
        wp_enqueue_script('settings_js', plugins_url('js/settings.js',__FILE__ ));
        wp_localize_script( 'settings_js', 'my_ajax_object',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );


    }

add_action('admin_enqueue_scripts', 'bs_settings_load_scripts');



function bs_options_page_html() {
    
    // check user capabilities
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    global $wpdb;
    $images = $wpdb->get_results("SELECT * FROM  `wp_gallery`");
?>
    <style>
        table, th, tr, td{
            border: 1px solid;
        }
        th, td {
        padding: 15px;
        text-align: left;
        }

    </style>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <table>
            <thead>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Country</th>
                <th>City</th>
                <th>Path</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
            </thead>    
            <tbody>
            <?php 
                foreach($images as $image){
                    $pictures = explode(",", $image->path);
                    foreach($pictures as $picture)
                    {
            ?>
                <tr>
                    <td><?php echo $image->id; ?></td>
                    <td><?php echo $image->name; ?></td>
                    <td><?php echo $image->email; ?></td>
                    <td><?php echo $image->phone; ?></td>
                    <td><?php echo $image->country; ?></td>
                    <td><?php echo $image->city; ?></td>
                    <td><img src="<?php echo $picture; ?>" width="200"></td>
                    <td><?php echo $image->date; ?></td>
                    <td id="status_<?php echo $image->id; ?>"><?php echo $image->status; ?></td>
                    <td><button class="btnApprove" data-id="<?php echo $image->id; ?>">Approve</button> <button class="btnDisapprove" data-id="<?php echo $image->id; ?>">Disapprove</button></td>
                </tr>


                <?php } } ?>    
            </tbody>
        
        </table>

    </div>

    <?php
}