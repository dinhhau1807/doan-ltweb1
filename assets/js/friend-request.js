toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-bottom-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "3000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}

$(document).ready(_ => {
    $('.cancel-request').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: './async/remove-friend-async.php',
            data: $(this).serialize(),
            success: (response) => {
                var jsonData = JSON.parse(response);
                if (jsonData.success == true) {

                    toastr["info"]("Đã huỷ yêu cầu kết bạn!");

                    let div = $(this).parent();
                    $(this).remove();
                    div.append($(`<a href="./profile.php?id=${div.data('id')}" class="btn btn-light" target="_blank">Xem thông tin</a>`));
                } else {
                    toastr["error"]("Đã xảy ra lỗi!");
                }
            }
        });
    });

    $('.remove-request').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: './async/remove-friend-async.php',
            data: $(this).serialize(),
            success: (response) => {
                var jsonData = JSON.parse(response);
                if (jsonData.success == true) {
                    
                    toastr["info"]("Đã xoá lời mời kết bạn!");

                    let div = $(this).parent();
                    div.empty();
                    div.append($(`<a href="./profile.php?id=${div.data('id')}" class="btn btn-light" target="_blank">Xem thông tin</a>`));
                } else {
                    toastr["error"]("Đã xảy ra lỗi!");
                }
            }
        });
    });

    $('.accept-request').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: './async/add-friend-async.php',
            data: $(this).serialize(),
            success: (response) => {
                var jsonData = JSON.parse(response);
                if (jsonData.success == true) {

                    toastr["success"]("Đã xác nhận kết bạn!");

                    let div = $(this).parent();
                    div.empty();
                    div.append($(`<a href="./profile.php?id=${div.data('id')}" class="btn btn-success" target="_blank">Bạn bè</a>`));
                } else {
                    toastr["error"]("Đã xảy ra lỗi!");
                }
            }
        });
    });
});