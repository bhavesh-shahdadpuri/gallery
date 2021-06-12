<?php


function bs_gallery_shortcode( $atts ) {
    global $wpdb;
    if(is_user_logged_in() != 0)
    {

        $html = '<div class="container">
                <ul class="nav nav-pills" id="myTab" role="tablist">
                <li class="active">
                    <a  href="#1a" data-toggle="tab">Sign Up</a>
                </li>
                <li>
                    <a href="#2a" data-toggle="tab">Sign In</a>
                </li>
                </ul>
                <div class="tab-content clearfix">
                <div class="tab-pane active" id="1a">
                        <h2>Registration</h2>
                            <div class="form-group">
                                <label for="uname">Username:</label>
                                <input
                                    type="text"                                                                                                             
                                    class="form-control"
                                    id="uname"
                                    name="uname"
                                    placeholder="Enter user name"
                                />
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    id="email"                                                                          
                                    name="email"
                                    placeholder="Enter email"
                                />
                            </div>

                            <div class="form-group">
                                <label for="passwd">Password:</label>
                                <input
                                    type="password"
                                    class="form-control"
                                    id="passwd"
                                    name="passwd"
                                    placeholder="Enter password"
                                />
                            </div>
                            <div class="form-group">
                                <label for="sq">Security Question:</label>
                                <textarea class="form-control" name="sq" id="sq"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="sq">Security Answer:</label>
                                <textarea class="form-control" name="sa" id="sa"></textarea>
                            </div>

                            <!--<div class="form-group">
                                <div class="g-recaptcha" data-sitekey=""></div>
                            </div>-->
                            <button type="submit" id="submit" class="btn btn-default">Submit</button>
                    </div>    
                    <div class="tab-pane" id="2a">
                        <h2>Sign In</h2>
                        <div class="form-group">
                                <label for="sign_in_email">Email:</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    id="sign_in_email"                                                                          
                                    name="sign_in_email"
                                    placeholder="Enter email"
                                />
                            </div>

                            <div class="form-group">
                                <label for="sign_in_passwd">Password:</label>
                                <input
                                    type="password"
                                    class="form-control"
                                    id="sign_in_passwd"
                                    name="sign_in_passwd"
                                    placeholder="Enter password"
                                />
                            </div>

                            <button type="submit" id="login_submit" class="btn btn-default">Submit</button>
                    </div>
            </div>';

            return $html;
    }
    else
    {
        $html = "<script>window.location.href='login/';</script>";
        return $html;
    }

    
}