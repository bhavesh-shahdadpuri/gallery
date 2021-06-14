<?php

function bs_upload_load_scripts()
{
    wp_enqueue_style('upload_css', plugins_url('css/upload.css',__FILE__ ));
    wp_enqueue_style('aksFileUpload_css', plugins_url('css/aksFileUpload.min.css',__FILE__ ));
    wp_enqueue_script('aksFileUpload_js', plugins_url('js/aksFileUpload.min.js',__FILE__ ));
    wp_enqueue_script('sweetalertmin_js', plugins_url('js/sweetalert.min.js',__FILE__ ));
    wp_enqueue_script('upload_js', plugins_url('js/upload.js',__FILE__ ));
    wp_enqueue_script('jqueryfilterinput_js', plugins_url('js/jquery.filter_input.js',__FILE__ ));
    wp_enqueue_script('jqueryform_js', plugins_url('js/jquery.form.js',__FILE__ ));
    wp_localize_script( 'action_js', 'my_ajax_object',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );


}

add_action('wp_enqueue_scripts', 'bs_upload_load_scripts');

function bs_upload_shortcode( $atts ) {
    global $wpdb;
    if(is_user_logged_in() != 0)
    {
        if(!empty($atts))
        {
            $class = $atts["class"];
        }
        else{
            $class = "";
        }
        $html = '<div class="container '.$class.'">
        <form id="submit-story" action="'.admin_url( 'admin-ajax.php' ).'" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="bs_gallery_upload">
            <div class="form-group">
                <label for="name">Your Full Name<sup>*</sup></label>
                <input type="text" id="name" name="name" placeholder="Enter Your Name" class="form-control input-lg">
            </div>

            <div class="form-group">
                <label for="email">Your Email ID</label>
                <input type="email" id="email" name="email" placeholder="xyz@abc.com" class="form-control input-lg">
            </div>

            <div class="form-group">
                <label for="mobile">Your Mobile Number<sup>*</sup></label>
                <input type="text" id="mobile" name="mobile" placeholder="0000000000" class="form-control input-lg" maxlength="10">
            </div>

            <div class="form-group">
                <label for="comment">Please enter country<sup>*</sup></label>
                <input type="text" id="country" name="country" placeholder="Please enter country" class="form-control input-lg" maxlength="10">
            </div>

            <div class="form-group">
                <label for="comment">Please enter country<sup>*</sup></label>
                <input type="text" id="city" name="city" placeholder="Please enter city" class="form-control input-lg" maxlength="10">
            </div>

            <div class="input-upload">
                <aks-file-upload></aks-file-upload>
            </div>

            <div class="text-center">
                <button type="submit" class="submit-story-btn btn-lg btn-block" id="btnSubmit">SUBMIT</button>
            </div>

       
    </form>  ';

            return $html;
    }
    else
    {
        $html = "<script>window.location.href='login/';</script>";
        return $html;
    }

    
}