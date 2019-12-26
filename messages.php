<?php
require_once 'init.php';
if (!$currentUser) {
    header('Location: index.php');
    exit();
}
$conversations = getLatestConversations($currentUser['id']);
?>
<?php include 'header.php' ?>
<p><a href="new-message.php" class="btn btn-outline-success btn-lg active" role="button" aria-pressed="true"> <i
            class="far fa-edit"></i> Tin nhắn mới</a></p>
<?php foreach ($conversations as $conversation) : ?>
<div>
    <div id="message-wrapper">
        <div class="message-box d-flex flex-column">
            <span class="close">&times;</span>
            <div class="px-3 py-2">
                <?php echo '<img class="rounded-circle" style="width:60px;height:60px;" src="data:image/jpeg;base64,' . base64_encode($conversation['avatarImage']) . '"/>'; ?>
                <div class="d-inline-block text-success pl-2">
                    <h5 class="mb-2"><?php echo $conversation['displayName'] ?></h5>
                </div>
                <hr />
            </div>
            <div class="messages">
            </div>
            <div class="content-input py-2 px-4 pt-4">
                <form id="message-form">
                    <div class="row">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" placeholder="Nhập tin nhắn ở đây..." required>
                            <div class="input-group-append">
                                <button style="width: 80px;" class="btn btn-success" type="submit">
                                    <i class="fa fa-paper-plane"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="message-list">
        <!-- clicking on message element to show the message box -->
        <div class="message-bar hover-secondary" data-toUserId="<?php echo $conversation['id']; ?>">
            <div class="
                    d-flex
                    align-items-center
                    border
                    border-right-0
                    border-left-0
                    border-bottom-0
                    px-3
                    py-2">
                <?php echo '<img class="rounded-circle" style="width:100px;height:100px;" src="data:image/jpeg;base64,' . base64_encode($conversation['avatarImage']) . '"/>'; ?>
                <div class="d-inline-block text-success pl-2">
                    <h5 class="mb-2"><?php echo $conversation['displayName'] ?></h5>
                    <small class="custom-time">Tin nhắn cuối: <?php echo $conversation['lastMessage']['createdAt'] ?></small>
                    <!-- should use subString that paragraph -->
                    <p class="text-secondary"><?php echo $conversation['lastMessage']['content']; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
<?php include 'footer.php' ?>