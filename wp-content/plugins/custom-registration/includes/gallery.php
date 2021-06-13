<?php

function bs_gallery_load_scripts()
{
    wp_enqueue_style('gallery_css', plugins_url('css/gallery.css',__FILE__ ));
    wp_localize_script( 'action_js', 'my_ajax_object',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );


}

add_action('wp_enqueue_scripts', 'bs_gallery_load_scripts');

function bs_gallery_shortcode( $atts ) {
    global $wpdb;
    if(is_user_logged_in() != 0)
    {
        $user_id = get_current_user_id();
        $country = get_user_meta($user_id, "country");
        if(count($country) > 0)
        {
            $images = $wpdb->get_results("SELECT * FROM  `wp_gallery` WHERE country = '$country[0]'");
            if(count($images) > 0)
            {
                $html = '';

                foreach($images as $image)
                {
                    $pictures = explode(",", $image->path);
                    foreach($pictures as $picture)
                    {
                        $html = $html. '<div class="responsive">
                                        <div class="gallery">
                                            <a target="_blank" href="'.$picture.'">
                                                <img src="'.$picture.'" alt="Cinque Terre" width="600" height="400">
                                            </a>
                                            <div class="desc">'.$image->name.'</div>
                                            <div class="desc">'.$image->email.'</div>
                                        </div>
                                    </div>';

                    }
                }
            }
            else
            {
                $html = '<h2>No data avalilable.</h2>';
            }    
        }
        else
        {
            $html = '<h2>No data avalilable.</h2>';
        }
        

        return $html;
    }
    else
    {
        $html = "<script>window.location.href='login/';</script>";
        return $html;
    }

    
}