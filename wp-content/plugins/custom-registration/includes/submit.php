<?php


        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $comment =  $_POST['comment'];

        //print_r($_FILES['aksfileupload']['name']);

        $dir  = 'uploads/';
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
        } else if($comment == "") {
            echo json_encode(array("status"=>'error', "error"=>'Please enter excuse.'));
            exit();
        } else if(!isset($_FILES['aksfileupload'])) {
            echo json_encode(array("status"=>'error', "error"=>'Please upload image.'));
            exit();
        } else {
            if(isset($_FILES['aksfileupload']))
            {
                $myFile = $_FILES['aksfileupload'];
                $fileCount = count($myFile["name"]);

                for ($i = 0; $i < $fileCount; $i++) {
                    $ext = end(explode(".", $myFile["name"][$i]));
                    if(in_array($ext, $valid_exts))
                    {
                        $fuid = uniqid();
                        $filepath = $dir.$fuid.'.'.$ext;
                        $fupstatus = move_uploaded_file($myFile['tmp_name'][$i], $filepath);
                        $file = $file . ",". $filepath;
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
            
            $ipaddress = get_client_ip();

            $rstring = $name.'|'.$email.'|'.$mobile.'|'.$comment.'|'.$file.'|'.$ipaddress;
                                
            $cipher_method = 'aes-128-ctr';
            $enc_key = "h6uyIK8rHB94S2BljdvTkDqVynvD1M";
            $enc_iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher_method));
            $crypted_token = openssl_encrypt($rstring, $cipher_method, $enc_key, 0, $enc_iv) . "::" . bin2hex($enc_iv);

            $sql = "INSERT INTO `bsid_olympics_stories`(`id`, `uid`, `data`, `status`, `date`) VALUES (NULL, '$unique_id', '$crypted_token', 0, now());";
            
            $rst = mysqli_query($conn, $sql);

            if(!$rst)
            {
                echo json_encode(array("status"=> 'Failed', "sql"=> $sql));
                exit();
            }
            else
            {
                $_SESSION["submit1"] = "yes";
                echo json_encode(array("status"=> 'Success', "sql"=> $sql));
                exit();
            }
        }
    
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
?>