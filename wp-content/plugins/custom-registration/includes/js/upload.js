$(document).ready(function () {

    $("aks-file-upload").aksFileUpload({
        fileUpload: "#uploadInput",
        dragDrop: true,
        maxSize: "50 MB",
        multiple: true,
        maxFile: 3,
        fileType: [
            "jpg",
            "jpeg",
            "png",
        ],
        maxFileError: "File exceeds upload limit. - Max limit:",
        maxSizeError: "File exceeds size. - Max limit:",
        fileTypeError: "Disallowed file format.",
    });


    $("#name").filter_input({
        regex: "[a-zA-Z ]"
    });

    $('#mobile').filter_input({
        regex: "[0-9]"
    });

    $('#mobile').bind('keypress', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $("#email").filter_input({
        regex: "[a-z0-9@._ ]"
    });

    var options = {
        beforeSubmit: sRequest,
        success: sResponse
    }

    $('#submit-story').ajaxForm(options);
});

function sRequest(formData, jqForm, options) {
    $("#btnSubmit").attr('disabled', "true");
    var queryString = $.param(formData);

    var name = $("#name").val();
    var email = $("#email").val();
    var mobile = $("#mobile").val();
    var city = $("#city").val();
    var country = $("#country").val();

    if (name.trim() == "") {
        swal("Name Field Cannot Be Empty").then((value) => {
            $("#btnSubmit").removeAttr('disabled');
        });
        return false;
    } else if (email.trim() == "") {
        swal("Email ID Field Cannot Be Empty").then((value) => {
            $("#btnSubmit").removeAttr('disabled');
        });
        return false;
    } else if (email.trim() != "" && !(IsEmail(email))) {
        swal("Invalid Email ID").then((value) => {
            $("#btnSubmit").removeAttr('disabled');
        });
        return false;
    }  else if (mobile.trim() == "") {
        swal("Mobile Number Cannot Be Empty").then((value) => {
            $("#btnSubmit").removeAttr('disabled');
        });
        return false;
    } else if (mobile.trim().length != 10) {
        swal("Mobile Number is invalid").then((value) => {
            $("#btnSubmit").removeAttr('disabled');
        });
        return false;
    } else if (city.trim() == "") {
        swal("city Field Cannot Be Empty").then((value) => {
            $("#btnSubmit").removeAttr('disabled');
        });
        return false;
    }
    else if (country.trim() == "") {
        swal("country Field Cannot Be Empty").then((value) => {
            $("#btnSubmit").removeAttr('disabled');
        });
        return false;
    }
    return true;
}

function sResponse(responseText, statusText, xhr, $form) {
    var response = JSON.parse(responseText);
    //console.log(responseText);
    if (response.status == 'Success') {
        swal('Your entry submitted successfully.').then((value) => {
            $("#btnSubmit").removeAttr('disabled');
            window.location.href = "gallery/";
        });
    } else if (response.status == 'error') {
        swal(response.error).then((value) => {
            $("#btnSubmit").removeAttr('disabled');
        });
    } else {
        swal('Please try again.').then((value) => {
            $("#btnSubmit").removeAttr('disabled');
        });
    }
    $("#btnSubmit").removeAttr('disabled');
}

function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}