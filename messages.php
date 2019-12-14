<?php
require_once 'init.php';
if (!$currentUser) {
    header('Location: index.php');
    exit();
}
//do something here 
?>
<?php include 'header.php' ?>
<div>
    <p class="pl-3">Tin nhắn<p>
            <div id="message-wrapper">
                <div class="message-box d-flex flex-column">
                    <span class="close">&times;</span>
                    <div class="px-3 py-2">
                        <?php echo '<img class="rounded-circle" style="width:60px;height:60px;" src="data:image/jpeg;base64,' . base64_encode($currentUser['avatarImage']) . '"/>'; ?>
                        <div class="d-inline-block text-success pl-2">
                            <h5 class="mb-2">Nguyen van a</h5>
                        </div>
                        <hr />
                    </div>
                    <div class="messages">
                        <p class="message message-left">
                            <span class="content">tinh yeu la gi, la nhung niem dau</span>
                        </p>
                        <p class="message message-right">
                            <span class="content">tinh yeu la gi, la nhung niem dau</span>
                        </p>
                        <p class="message message-left">
                            <span class="content">xin chao!</span>
                        </p>
                        <p class="message message-right">
                            <span class="content">tinh yeu la gi, la nhung niem dau</span>
                        </p>
                        <p class="message message-left">
                            <span class="content">xin chao!</span>
                        </p>
                        <p class="message message-right">
                            <span class="content">tinh yeu la gi, la nhung niem dau</span>
                        </p>
                        <p class="message message-left">
                            <span class="content">xin chao!</span>
                        </p>
                        <p class="message message-right">
                            <span class="content">tinh yeu la gi, la nhung niem dau</span>
                        </p>
                        <p class="message message-left">
                            <span class="content">xin chao!</span>
                        </p>
                        <p class="message message-right">
                            <span class="content">tinh yeu la gi, la nhung niem dau</span>
                        </p>
                        <p class="message message-left">
                            <span class="content">xin chao!</span>
                        </p>
                        <p class="message message-right">
                            <span class="content">tinh yeu la gi, la nhung niem dau</span>
                        </p>
                        <p class="message message-left">
                            <span class="content">xin chao!</span>
                        </p>
                    </div>
                    <div class="content-input py-2 px-4 pt-4">
                        <div class="row">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" placeholder="Nhập tin nhắn ở đây...">
                                <div class="input-group-append">
                                    <button style="width: 80px;" class="btn btn-success" type="button">
                                        <i class="fa fa-paper-plane"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="message-list">
                <!-- clicking on message element to show the message box -->
                <div class="message-bar hover-secondary" data-userId="1">
                    <div class="
                    border
                    border-right-0
                    border-left-0
                    border-bottom-0
                    px-3
                    py-2">
                        <?php echo '<img class="rounded-circle" style="width:100px;height:100px;" src="data:image/jpeg;base64,' . base64_encode($currentUser['avatarImage']) . '"/>'; ?>
                        <div class="d-inline-block text-success pl-2">
                            <h5 class="mb-2">Nguyen van a</h5>
                            <!-- should use subString that paragraph -->
                            <p class="text-secondary"><?php echo "sdasd"; ?></p>
                        </div>
                    </div>
                </div>
                <div class="message-bar hover-secondary" data-userid="2">
                    <div class="
                    border
                    border-right-0
                    border-left-0
                    border-bottom-0
                    px-3
                    py-2">
                        <?php echo '<img class="rounded-circle" style="width:100px;height:100px;" src="data:image/jpeg;base64,' . base64_encode($currentUser['avatarImage']) . '"/>'; ?>
                        <div class="d-inline-block text-success pl-2">
                            <h5 class="mb-2">sieu nhan gao</h5>
                            <!-- should use subString that paragraph -->
                            <p class="text-secondary"><?php echo "sdasd"; ?></p>
                        </div>
                    </div>
                </div>
            </div>
</div>

<?php include 'footer.php' ?>