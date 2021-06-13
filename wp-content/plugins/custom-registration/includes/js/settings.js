jQuery(document).ready(function ($) {

    $(".btnApprove").click(function () {
        
            var data = {
                action: "dm_register_user",
                email: $("#email").val(),
                uname: uname,
                passwd: passwd,
                country: country,
            };
            $.post(my_ajax_object.ajax_url, data, function (response) {
                console.log("response = " + response);
                var data = JSON.parse(response);
                if (data.status == "success") {
                    $("#email, #uname, #passwd, #country").val("");
                    //swal("User registered successfully.");
                    swal('User registered successfully. Please sign in to continue').then((value) => {
                        $("#sign-in").trigger("click");
                    });
                } else if (data.status == "error") {
                    swal(data.error);
                }
            });
    });


});