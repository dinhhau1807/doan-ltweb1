<?php
require_once 'init.php';
if (!$currentUser) {
    header('Location: index.php');
    exit();
}
if (isset($_POST['userId']) && isset($_POST['content'])) {
    sendMessage($currentUser['id'], $_POST['userId'], $_POST['content']);
    header('Location: messages.php');
}
$friends = getFriends($currentUser['id']);
?>
<?php include 'header.php' ?>
<div class="container">
    <div style="max-width: 640px;">
        <form method="POST">
            <div class="form-group">
                <h5><label style="font-weight:bolder;" for="userId">Người nhận: </label></h5>
                <select class="form-control" id="userId" name="userId">
                    <?php foreach ($friends as $friend) : ?>
                    <?php
                        $user = findUserById($friend['id']);
                        ?>
                    <option value="<?php echo $user['id'] ?>"><?php echo $user['displayName'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <h5><label style="font-weight:bolder;" for="content">Tin nhắn: </label></h5>
                <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-success"><i class="far fa-share-square"></i> Gửi</button>
        </form>
    </div>
</div>
<?php include 'footer.php' ?>