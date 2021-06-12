<?php

function dm_registration_load_scripts()
{
    wp_enqueue_style('boot_css', plugins_url('css/bootstrap.min.css',__FILE__ ));
    wp_enqueue_style('font_awesome_min_css', plugins_url('css/font-awesome.min.css',__FILE__ ));
    wp_enqueue_style('form_css', plugins_url('css/form.css',__FILE__ ));
    wp_enqueue_script('jquery_js', plugins_url('js/jquery.min.js',__FILE__ ));
    wp_enqueue_script('boot_js', plugins_url('js/bootstrap.min.js',__FILE__ ));
    wp_enqueue_script('action_js', plugins_url('js/action.js',__FILE__ ));
    wp_enqueue_script('login_js', plugins_url('js/login.js',__FILE__ ));
    wp_enqueue_script('gcap_js', "https://www.google.com/recaptcha/api.js");
    wp_localize_script( 'action_js', 'my_ajax_object',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );


}

add_action('wp_enqueue_scripts', 'dm_registration_load_scripts');


function dm_registration_shortcode( $atts ) {
    global $wpdb;
    $opt = get_option('dmc_options');

    $html = '<div class="container sign-in-up">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                <br>
                <!-- Nav tabs -->
                <div class="text-center">
                    <div class="btn-group">
                        <a  href="#1a" data-toggle="tab" class="big btn btn-primary"><i class="fa fa-plus"></i> Sign Up</a>
                        <a href="#2a" data-toggle="tab" class="big btn btn-danger"><i class="fa fa-user"></i> Sign In</a>
                    </div>
                </div>
                <p class="click2select">Click to select</p>    
                <div class="tab-content clearfix">
                    <div class="tab-pane active" id="1a">
                            <!--<h2>Registration</h2>-->
                            <div class="form-group">
                                <div class="right-inner-addon">
                                    <label for="uname">Username:</label>
                                    <i class="fa fa-envelope"></i>
                                    <input
                                        type="text"                                                                                                             
                                        class="form-control input-lg"
                                        id="uname"
                                        name="uname"
                                        placeholder="Enter user name"
                                    />
                                </div>    
                            </div>
                            <div class="form-group">
                                <div class="right-inner-addon">
                                    <label for="email">Email:</label>
                                    <i class="fa fa-key"></i>
                                    <input
                                        type="email"
                                        class="form-control input-lg"
                                        id="email"                                                                          
                                        name="email"
                                        placeholder="Enter email"
                                    />
                                </div> 
                            </div>

                            <div class="form-group">
                                <div class="right-inner-addon">
                                    <label for="passwd">Password:</label>
                                    <i class="fa fa-key"></i>
                                    <input
                                        type="password"
                                        class="form-control input-lg"
                                        id="passwd"
                                        name="passwd"
                                        placeholder="Enter password"
                                    />
                                </div>    
                            </div>

                            
                            <button type="submit" id="submit" class="btn btn-default btn-lg btn-block"><i class="fa fa-plus"></i> Sign Up</button>
                            </div>    
                            <div class="tab-pane" id="2a">
                                <h2>Sign In</h2>
                                <div class="form-group">
                                        <div class="right-inner-addon">
                                            <label for="sign_in_email">Email:</label>
                                            <i class="fa fa-envelope"></i>
                                            <input
                                                type="email"
                                                class="form-control input-lg"
                                                id="sign_in_email"                                                                          
                                                name="sign_in_email"
                                                placeholder="Enter email"
                                            />
                                        </div>    
                                    </div>

                                    <div class="form-group">
                                        <div class="right-inner-addon">
                                            <label for="sign_in_passwd">Password:</label>
                                            <i class="fa fa-key"></i>
                                            <input
                                                type="password"
                                                class="form-control input-lg"
                                                id="sign_in_passwd"
                                                name="sign_in_passwd"
                                                placeholder="Enter password"
                                            />
                                        </div>    
                                    </div>

                                    <button type="submit" id="login_submit" class="btn btn-default btn-lg btn-block"><i class="fa fa-user"></i> Sign In</button>
                            </div>
                        </div>
                    </div>    
                </div>';

    return $html;
}


?>