jQuery(document).ready(function ($) {

    $(".btnApprove").click(function () {
            var id = $(this).data("id");
            var data = {
                action: "bs_status_approve",
                id: id,
            };
            $.post(my_ajax_object.ajax_url, data, function (response) {
                console.log("response = " + response);
                var data = JSON.parse(response);
                if (data.status == "success") {
                    
                    swal('Status Approve').then((value) => {
                        $("#status_"+id).html("Approved")
                    });
                } else if (data.status == "error") {
                    swal(data.error);
                }
            });
    });

    $(".btnDisapprove").click(function () {
        var id = $(this).data("id");
        var data = {
            action: "bs_status_disapprove",
            id: id,
        };
        $.post(my_ajax_object.ajax_url, data, function (response) {
            console.log("response = " + response);
            var data = JSON.parse(response);
            if (data.status == "success") {
                
                swal('Status Disapprove').then((value) => {
                    $("#status_"+id).html("Disapproved")
                });
            } else if (data.status == "error") {
                swal(data.error);
            }
        });
});


});