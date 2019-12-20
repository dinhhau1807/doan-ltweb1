<?php
require_once 'init.php';
$conversations = getLatestConversations($currentUser['id']);
?>
<?php include 'header.php' ?>
<p><a href="new-message.php" class="btn btn-outline-success btn-lg active" role="button" aria-pressed="true"> <i class="far fa-edit"></i> Tin nhắn mới</a></p>
<?php foreach ($conversations as $conversation) : ?>
<div class="card" style="margin-bottom: 10px;">
  <div class="card-body">
    <h4 class="card-title">
      <div class="row">
        <div class="col">
        <img class="rounded-circle" style="width:40px;height:40px;" src="<?php echo empty($conversation['avatarImage']) ? './assets/images/default-avatar.jpg' : 'view-image.php?userId=' . $conversation['id']; ?>" alt="<?php echo $conversation['displayName'] ?>">
        </div>
        <div class="col-11">
          <a class="text-success" href="conversation.php?id=<?php echo $conversation['id'] ?>"><?php echo $conversation['displayName'] ?></a>
        </div>
      </div>
    </h4>
    <p class="card-text">
    <small>Tin nhắn cuối: <?php echo $conversation['lastMessage']['createdAt'] ?></small>
    <p><?php echo $conversation['lastMessage']['content'] ?></p>
    </p>
  </div>
</div>
<?php endforeach; ?>
<?php include 'footer.php' ?>