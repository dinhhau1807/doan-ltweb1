<?php
require_once 'init.php';
if (isset($_POST['content'])) {
  sendMessage($currentUser['id'], $_GET['id'], $_POST['content']); 
}
$messages = getMessagesWithUserId($currentUser['id'], $_GET['id']);
$user = findUserById($_GET['id']);
?>
<?php include 'header.php' ?>
<h1><?php echo $user['displayName'] ?>&nbsp;<i style="font-size:15px; color:#33cc33;vertical-align:middle;"class="fas fa-circle" title="Đang online"></i></h1>
<?php foreach ($messages as $message) : ?>
<div class="card" style="margin-bottom: 10px;">
  <div class="card-body">
    <?php if ($message['type'] == 1) : ?>
    <p class="card-text">
      <img class="rounded-circle" style="width:40px;height:40px;" src="<?php echo empty($user['avatarImage']) ? './assets/images/default-avatar.jpg' : 'view-image.php?userId=' . $user['id']; ?>" alt="<?php echo $user['displayName'] ?>">
      <strong><?php echo $user['displayName'] ?></strong>:
      <?php echo $message['content'] ?>
    </p>
    <?php else: ?>
    <p class="card-text text-right">
      <?php echo $message['content'] ?>
    </p>
    <?php endif; ?>
  </div>
</div>
<?php endforeach; ?>
<form method="POST">
  <div class="form-group">
  <h5><label style="font-weight:bolder;" for="content">Nội dung: </label></h5>
    <textarea class="form-control" id="content" name="content" rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-success">Gửi tin nhắn</button>
</form>
<?php include 'footer.php' ?>