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
};

$(document).ready(_ => {
    $('#select-policy ul li').click(function(e) {
        e.preventDefault();
        var roleId = $(this).data('roleid');
        var postId = $(this).data('postid');
        $.ajax({
            type: 'POST',
            url: './async/change-post-privacy-async.php',
            data: `postId=${postId}&role=${roleId}`,
            success: (response) => {
                var jsonData = JSON.parse(response);
                if (jsonData.success == true) {
                    var newClass = "";
                    if (roleId == 1) newClass = "fas fa-globe-americas"
                    else if (roleId == 2) newClass = "fas fa-user-friends"
                    else newClass = "fas fa-lock"
                    toastr["success"]("Đã thay đổi quyền riêng tư!");
                    $(`#current-policy-${postId}`).attr('class', newClass);
                } else {
                    toastr["error"]("Đã xảy ra lỗi!");
                }
            }
        });
    });
});