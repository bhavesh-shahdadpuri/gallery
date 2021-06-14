jQuery(document).ready(function ($) {

    $("#sign_in_email").on("keypress", function (event) {
        var regex = new RegExp("^[a-zA-Z0-9@. ]+$");
        var key = String.fromCharCode(
            !event.charCode ? event.which : event.charCode
        );
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });

    $("#sign_in_passwd").on("keypress", function (event) {
        var regex = new RegExp("^[a-zA-Z0-9$#@_ ]+$");
        var key = String.fromCharCode(
            !event.charCode ? event.which : event.charCode
        );
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });

    $("#login_submit").click(function () {
        var email = $("#sign_in_email").val();
        var passwd = $("#sign_in_passwd").val();
       
        if (email == "") {
            swal("Please enter email id to continue.");
        } else if (email.trim() != "" && !IsEmail(email.trim())) {
            swal("Invalid Email");
        } else if (passwd == "") {
            swal("Please enter password to continue.");
        } else {
            var data = {
                action: "bs_user_login",
                email: $("#sign_in_email").val(),
                passwd: passwd,
            };
            $.post(my_ajax_object.ajax_url, data, function (response) {
                console.log("response = " + response);
                var data = JSON.parse(response);
                if (data.status == "success") {
                    $("#sign_in_email, #sign_in_passwd").val("");
                    window.location.href = "gallery/";
                } else if (data.status == "error") {
                    swal(data.error);
                }
            });
        }
    });
});

function IsEmail(a) {
    var b = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return b.test(a);
}
