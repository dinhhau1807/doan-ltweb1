<?php
require_once 'init.php';
if (!$currentUser) {
    header('Location: index.php');
    exit();
}
$friendRequest = getFriendRequest($currentUser['id']);
?>
<?php include 'header.php' ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<div>
    <div class="friend-request">
        <p class="pl-3">Lời mời đã gửi<p>
                <?php foreach ($friendRequest as $request) : ?>
                    <?php $user = $request[0]; ?>
                    <?php if ($request[1] == "isFollowing") : ?>
                        <div class="hover-secondary">
                            <div class="d-flex justify-content-between align-items-center border border-right-0 border-left-0 border-bottom-0 px-3py-2 p-2">
                                <!-- please links to user profile -->
                                <a href="./profile.php?id=<?php echo $user['id'] ?>" target="_blank" class="d-flex justify-content-center align-items-center">
                                    <?php echo '<img class="rounded-circle" style="width:50px;height:50px;" src="data:image/jpeg;base64,' . base64_encode($user['avatarImage']) . '"/>'; ?>
                                    <span class="pl-2 text-success"><?php echo $user['displayName'] ?></span>
                                </a>
                                <div data-id="<?php echo $user['id']; ?>">
                                    <form class="cancel-request" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                        <button type="submit" class="btn btn-success">Huỷ yêu cầu kết bạn</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
                <p class="pl-3 mt-4">Trả lời lời mời kết bạn<p>
                        <?php foreach ($friendRequest as $request) : ?>
                            <?php $user = $request[0]; ?>
                            <?php if ($request[1] == "isFollower") : ?>
                                <div class="hover-secondary">
                                    <div class="d-flex  justify-content-between align-items-center border border-right-0 border-left-0 border-bottom-0 px-3py-2 p-2">
                                        <!-- please links to user profile -->
                                        <a href="./profile.php?id=<?php echo $user['id'] ?>" target="_blank" class="d-flex justify-content-center align-items-center">
                                            <?php echo '<img class="rounded-circle" style="width:50px;height:50px;" src="data:image/jpeg;base64,' . base64_encode($user['avatarImage']) . '"/>'; ?>
                                            <span class="pl-2 text-success"><?php echo $user['displayName'] ?></span>
                                        </a>
                                        <div data-id="<?php echo $user['id']; ?>">
                                            <form class="accept-request btn p-0" method="POST">
                                                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                                <button type="submit" class="btn btn-success">Xác nhận</button>
                                            </form>
                                            <form class="remove-request btn p-0" method="POST">
                                                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                                <button type="submit" class="btn btn-light">Xoá lời mời</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
    </div>
</div>

<script type="text/javascript">
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
</script>

<?php include 'footer.php' ?>