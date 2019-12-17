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
                            <div>
                                <form action="./remove-friend.php" method="POST">
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
                            <div>
                                <form class="btn p-0" method="POST" action="add-friend.php">
                                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                    <button type="submit" class="btn btn-success">Xác nhận</button>
                                </form>
                                <form class="btn p-0" method="POST" action="remove-friend.php">
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

<?php include 'footer.php' ?>