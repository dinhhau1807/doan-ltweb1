<?php
require_once 'init.php';
if (!$currentUser) {
    header('Location: index.php');
    exit();
}
include 'header.php';
$users = null;
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $success = true;
    if (isset($_GET['keyword'])) {
        $users = searchUsers((!isset($_GET['keyword']) ? null : $_GET['keyword']));
    }
    if ($users==null){
        $success = false;
    }
}
?>
<div class="inner">
    <?php if (!$success): ?>
        <div class="alert alert-success" role="alert">
            Không tìm thấy người dùng !
        </div>
    <?php endif; ?>
    <?php function searchUsers($name) 
    {
        $listUser = searchUserByName($name);
        if(count($listUser) == 0) {
            return null;
        }
    ?> 
    <?php foreach ($listUser as $usr) : ?>
    <div class="row">
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex">
                        <div class="img-square-wrapper mr-2">
                            <a href="#">
                                <img class="rounded-circle" style="width:50px;height:50px;"
                                    src="<?php echo empty($usr['avatarImage']) ? './assets/images/default-avatar.jpg' : 'view-image.php?userId=' . $usr['id'] ?>"
                                    alt="<?php echo $usr['displayName'] ?>">
                            </a>
                        </div>
                        <div>
                            <a href="./profile.php?id=<?php echo $usr['id']; ?>" class="text-success">
                                <h5 class="card-title mb-1 vertical-center"><?php echo $usr['displayName'];?></h5>
                            </a>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <?php endforeach; return "1";?>
    <?php } ?>
</div>
<?php include 'footer.php'?>