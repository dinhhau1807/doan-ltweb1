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
    <p class="pl-3">Lời mời kết bạn<p>
            <div class="friend-request">
                <div class="hover-secondary">
                    <div class="d-flex 
                    justify-content-between 
                    align-items-center 
                    border
                    border-right-0
                    border-left-0
                    border-bottom-0
                    px-3
                    py-2">
                        <!-- please links to user profile -->
                        <a href=" #" class="d-flex justify-content-center align-items-center">
                            <?php echo '<img class="rounded-circle" style="width:50px;height:50px;" src="data:image/jpeg;base64,' . base64_encode($currentUser['avatarImage']) . '"/>'; ?>
                            <span class="pl-2 text-success">Nguyen van a</span>
                        </a>
                        <div>
                            <button class="btn btn-success">Đồng ý</button>
                            <button class="btn btn-light">Hủy bỏ</button>
                        </div>
                    </div>
                </div>
                <div class="hover-secondary">
                    <div class="d-flex 
                    justify-content-between 
                    align-items-center 
                    border
                    border-right-0
                    border-left-0
                    border-bottom-0
                    px-3
                    py-2">
                        <a href=" #" class="d-flex justify-content-center align-items-center">
                            <?php echo '<img class="rounded-circle" style="width:50px;height:50px;" src="data:image/jpeg;base64,' . base64_encode($currentUser['avatarImage']) . '"/>'; ?>
                            <span class="pl-2 text-success">Nguyen van a</span>
                        </a>
                        <div>
                            <button class="btn btn-success">Đồng ý</button>
                            <button class="btn btn-light">Hủy bỏ</button>
                        </div>
                    </div>
                </div>
            </div>
</div>

<?php include 'footer.php' ?>