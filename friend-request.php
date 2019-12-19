<?php
require_once 'init.php';
if (!$currentUser) {
    header('Location: index.php');
    exit();
}
$friendRequest = getFriendRequest($currentUser['id']);
?>
<?php include 'header.php' ?>

<div>
    <div class="friend-request">
        <p class="pl-3">Lời mời đã gửi<p>
            <?php foreach ($friendRequest as $request) : ?>
                <?php $user = $request[0]; ?>
                <?php if ($request[1] == "isFollowing") : ?>
                    <div class="hover-secondary">
                        <div class="d-flex justify-content-between align-items-center border border-right-0 border-left-0 border-bottom-0 px-3py-2 p-2">
                            <!-- please links to user profile -->
                            <a href="./profile.php?id=<?php echo $user['id'] ?>" class="d-flex justify-content-center align-items-center">
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
                            <a href="./profile.php?id=<?php echo $user['id'] ?>" class="d-flex justify-content-center align-items-center">
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
                        let div = $(this).parent();
                        $(this).remove();
                        div.append($(`<a href="./profile.php?id=${div.data('id')}" class="btn btn-light">Xem thông tin</a>`));
                    } else {
                        alert('Có lỗi xảy ra!');
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
                        let div = $(this).parent();
                        div.empty();
                        div.append($(`<a href="./profile.php?id=${div.data('id')}" class="btn btn-light">Xem thông tin</a>`));
                    } else {
                        alert('Có lỗi xảy ra!');
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
                        let div = $(this).parent();
                        div.empty();
                        div.append($(`<a href="./profile.php?id=${div.data('id')}" class="btn btn-success">Bạn bè</a>`));
                    } else {
                        alert('Có lỗi xảy ra!');
                    }
                }
            });
        });
    });
</script>

<?php include 'footer.php' ?>