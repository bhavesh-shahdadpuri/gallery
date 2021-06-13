<?php
function bs_gallery_upload(){

        global $wpdb;

        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $country =  $_POST['country'];
        $city =  $_POST['city'];

        //print_r($_FILES['aksfileupload']['name']);

        
        $path = plugin_dir_path( __FILE__ )."/uploads";
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $dir  = "../wp-content/plugins/custom-registration/includes/uploads/";
        $valid_exts = array('jpeg', 'jpg', 'png');

        $unique_id = uniqid();

        $pattern = "/^[0-9]{10}$/";

        if($name == "") {
            echo json_encode(array("status"=>'error', "error"=>'Please enter your full name.'));
            exit();
        } else if($mobile == "") {
            echo json_encode(array("status"=>'error', "error"=>'Please enter your phone number.'));
            exit();
        } else if(!preg_match($pattern, $mobile)) {
            echo json_encode(array("status"=>'error', "error"=>'Invalid phone number.'));
            exit();
        } else if($country == "") {
            echo json_encode(array("status"=>'error', "error"=>'Please enter country.'));
            exit();
        } else if($city == "") {
            echo json_encode(array("status"=>'error', "error"=>'Please enter city.'));
            exit();
        } else if(!isset($_FILES['aksfileupload'])) {
            echo json_encode(array("status"=>'error', "error"=>'Please upload image.'));
            exit();
        } else {
            if(isset($_FILES['aksfileupload']))
            {
                $myFile = $_FILES['aksfileupload'];
                $fileCount = count($myFile["name"]);

                $file = "";

                for ($i = 0; $i < $fileCount; $i++) {
                    $ext = end(explode(".", $myFile["name"][$i]));
                    if(in_array(strtolower($ext), $valid_exts))
                    {
                        $fuid = uniqid();
                        $filepath = $dir.$fuid.'.'.$ext;
                        $fupstatus = move_uploaded_file($myFile['tmp_name'][$i], $filepath);
                        if($file != ""){
                            $file = $file . ",". $filepath;
                        }
                        else{
                            $file = $filepath;
                        }
                        $file = str_replace('\\', '/', $file);
                    }
                    else
                    {
                        echo json_encode(array("status"=>'error', "error"=>'Invalid image'));
                        exit();
                    }
                }
            }
            else
            {
                $images = '';
            }

            $sql = $wpdb->query("INSERT INTO `wp_gallery` (`id`,`name`, `email`, `phone`, `country`, `city`, `path`, `date`) values (NULL, '$name', '$email', '$mobile', '$country', '$city', '$file', now())");

            if($sql){
                echo json_encode(array("status"=> 'Success', "sql"=> $sql));
                exit();
            }
            else{
                echo json_encode(array("status"=> 'Failed', "sql"=> "INSERT INTO `wp_gallery` (`id`,`name`, `email`, `phone`, `country`, `city`, `path`, `date`) values (NULL, '$name', '$email', '$mobile', '$country', '$city', '$file', now())"));
                exit();
            }

        }
    
            

            wp_die();
}

add_action( 'wp_ajax_bs_gallery_upload', 'bs_gallery_upload' );
add_action( 'wp_ajax_nopriv_bs_gallery_upload', 'bs_gallery_upload' );    
?>