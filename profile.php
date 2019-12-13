<?php
require_once 'init.php';
if (!$currentUser) {
    header('Location: index.php');
    exit();
}

$newFeeds = findAllPosts();

if (isset($_GET['id'])) {
    $user = findUserById($_GET['id']);
} else {
    header('Location: index.php');
}

$isFollowing  = getFriendShip($currentUser['id'], $user['id']);
$isFollower = getFriendShip($user['id'], $currentUser['id']);
?>

<?php include 'header.php' ?>

<?php if (!$user) : ?>
    <p class="text-center font-weight-bold">RẤT TIẾC, NGƯỜI DÙNG NÀY KHÔNG TỒN TẠI!</p>
<?php else : ?>
    <section id="timeline-top-section">
        <div class="background-image">
            <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($user['backgroundImage']) . '"/>'; ?>
        </div>
        <div class="container">
            <?php if ($user['id'] == $currentUser['id']) : ?>
                <a id="update-profile" class="btn btn-light" href="./update-profile.php" data-toggle="tooltip" data-placement="bottom" title="Cập nhật thông tin">
                    <i class="fa fa-pencil"></i>
                    <span>Cập nhật thông tin</span>
                </a>
            <?php endif; ?>
            <div class="timeline-profile">
                <div class="avatar-image">
                    <a href="#">
                        <?php echo '<img class="rounded-circle" style="width:180px;height:180px;" src="data:image/jpeg;base64,' . base64_encode($user['avatarImage']) . '"/>'; ?>
                    </a>
                </div>
                <div class="user-name">
                    <h4><?php echo $user['displayName']; ?></h4>
                    <?php if (!empty($user['nickName'])) : ?>
                        <h5>(<?php echo $user['nickName']; ?>)</h5>
                    <?php endif; ?>
                </div>
                <?php if ($user['id'] != $currentUser['id']) : ?>
                    <div class="actions">
                        <?php if ($isFollower && $isFollowing) : ?>
                            <form class="btn p-0" method="POST" action="remove-friend.php">
                                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                <button type="submit" class="btn btn-light">
                                    <i class="fa fa-user-plus"></i>
                                    Huỷ kết bạn
                                </button>
                            </form>
                        <?php else : ?>
                            <!-- Người kia đang gửi yêu cầu -->
                            <?php if ($isFollower && !$isFollowing) : ?>
                                <form class="btn p-0" method="POST" action="add-friend.php">
                                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                    <button type="submit" class="btn btn-light">
                                        <i class="fa fa-user-plus"></i>
                                        Xác nhận yêu cầu kết bạn
                                    </button>
                                </form>
                                <form class="btn p-0" method="POST" action="remove-friend.php">
                                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                    <button type="submit" class="btn btn-light">
                                        <i class="fa fa-user-plus"></i>
                                        Xoá yêu cầu kết bạn
                                    </button>
                                </form>
                            <?php endif; ?>
                            <!-- Người dùng đang gửi yêu cầu tới người kia -->
                            <?php if (!$isFollower && $isFollowing) : ?>
                                <form class="btn p-0" method="POST" action="remove-friend.php">
                                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                    <button type="submit" class="btn btn-light">
                                        <i class="fa fa-user-plus"></i>
                                        Huỷ yêu cầu kết bạn
                                    </button>
                                </form>
                            <?php endif; ?>
                            <!-- Cả hai đều chưa gửi yêu cầu cho nhau -->
                            <?php if (!$isFollower && !$isFollowing) : ?>
                                <form class="btn p-0" method="POST" action="add-friend.php">
                                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                    <button type="submit" class="btn btn-light">
                                        <i class="fa fa-user-plus"></i>
                                        Thêm bạn bè
                                    </button>
                                </form>
                            <?php endif; ?>
                        <?php endif; ?>
                        <button class="btn btn-light">
                            <i class="fa fa-rss"></i>
                            Theo dõi
                        </button>
                        <button class="btn btn-light">
                            <i class="fa fa-comment"></i>
                            Nhắn tin
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="timeline-main-section">
        <div class="row">
            <div class="col-md-4">
                <div class="introduce border w-100 p-3 mb-3">
                    <h5 class="mb-3">
                        <i class="text-success fa fa-question-circle-o"></i>
                        Giới thiệu
                    </h5>
                    <?php if (!empty($user['introContent'])) : ?>
                        <p class="text-center"><?php echo $user['introContent']; ?></p>
                    <?php endif; ?>
                    <hr />
                    <ul class="info">
                        <li>
                            <i class="fa fa-envelope"></i>
                            <span><?php echo $user['email']; ?></span>
                        </li>
                        <?php if (!empty($user['phoneNumber'])) : ?>
                            <li>
                                <i class="fa fa-phone"></i>
                                <span><?php echo $user['phoneNumber']; ?></span>
                            </li>
                        <?php endif; ?>
                        <?php if ($user['phoneNumber'] != 0) : ?>
                            <li>
                                <i class="fa fa-leaf"></i>
                                <span>Năm sinh <?php echo $user['yearOfBirth']; ?></span>
                            </li>
                        <?php endif; ?>
                        <li>
                            <i class="fa fa-clock-o"></i>
                            <span>Đã tham gia <?php echo date_format(date_create($user['createdDate']), 'd-m-Y'); ?></span>
                        </li>
                        <li>
                            <?php echo '<img style="width:100%;height:200px;" src="data:image/jpeg;base64,' . base64_encode($user['avatarImage']) . '"/>'; ?>
                        </li>
                    </ul>
                </div>
                <div class="list-image border w-100 p-3 mb-3">
                    <a class="text-dark" href="#">
                        <h5>
                            <i class="text-success fa fa-camera"></i>
                            Ảnh
                        </h5>
                    </a>
                    <hr />
                    <div class="row text-center text-lg-left">
                        <div class="col-lg-6 col-md-6 col-6">
                            <a href="#" class="d-block mb-4 h-100">
                                <img class="img-fluid" src="https://source.unsplash.com/pWkk7iiCoDM/400x300" alt="">
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-6">
                            <a href="#" class="d-block mb-4 h-100">
                                <img class="img-fluid" src="https://source.unsplash.com/aob0ukAYfuI/400x300" alt="">
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-6">
                            <a href="#" class="d-block mb-4 h-100">
                                <img class="img-fluid" src="https://source.unsplash.com/EUfxH-pze7s/400x300" alt="">
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-6">
                            <a href="#" class="d-block mb-4 h-100">
                                <img class="img-fluid" src="https://source.unsplash.com/M185_qYH8vg/400x300" alt="">
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-6">
                            <a href="#" class="d-block mb-4 h-100">
                                <img class="img-fluid" src="https://source.unsplash.com/sesveuG_rNo/400x300" alt="">
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-6">
                            <a href="#" class="d-block mb-4 h-100">
                                <img class="img-fluid" src="https://source.unsplash.com/AvhMzHwiE_0/400x300" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="list-friend border w-100 p-3 mb-3">
                    <a class="text-dark" href="#">
                        <h5>
                            <i class="text-success fa fa-users"></i>
                            Bạn bè
                            <span class="text-secondary" style="font-size:14px;">1.000 (1001 bạn chung)</span>
                        </h5>
                    </a>
                    <hr />
                    <div class="row text-center text-lg-left">
                        <div class="col-lg-6 col-md-6 col-6">
                            <a href="#" class="d-block mb-2 h-100">
                                <img class="img-fluid" src="https://source.unsplash.com/pWkk7iiCoDM/400x300" alt="">
                                <p class="friend-name text-center">Ng van a</p>
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-6">
                            <a href="#" class="d-block mb-2 h-100">
                                <img class="img-fluid" src="https://source.unsplash.com/aob0ukAYfuI/400x300" alt="">
                                <p class="friend-name text-center">Ng van a</p>
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-6">
                            <a href="#" class="d-block mb-2 h-100">
                                <img class="img-fluid" src="https://source.unsplash.com/EUfxH-pze7s/400x300" alt="">
                                <p class="friend-name text-center">Ng van a</p>
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-6">
                            <a href="#" class="d-block mb-2 h-100">
                                <img class="img-fluid" src="https://source.unsplash.com/M185_qYH8vg/400x300" alt="">
                                <p class="friend-name text-center">Ng van a</p>
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-6">
                            <a href="#" class="d-block mb-2 h-100">
                                <img class="img-fluid" src="https://source.unsplash.com/sesveuG_rNo/400x300" alt="">
                                <p class="friend-name text-center">Ng van a</p>
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-6">
                            <a href="#" class="d-block mb-2 h-100">
                                <img class="img-fluid" src="https://source.unsplash.com/AvhMzHwiE_0/400x300" alt="">
                                <p class="friend-name text-center">Ng van a</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <?php
                    $newFeeds = findAllPosts();
                    $success = true;
                    if (isset($_POST['content'])) {
                        $content = $_POST['content'];
                        $data = null;
                    if (isset($_FILES['imagePost'])) {
                        $data = file_get_contents($_FILES['imagePost']['tmp_name']);
                    }
                    $len = strlen($content);
                    if ($len == 0 || $len > 1024) {
                        $success = false;
                    } else {
                        createPost($currentUser['id'], $content, $data);                       
                        header("Location: profile.php?id=" . $currentUser['id']);
                        //exit();
                    }
                    }
                ?>
                <div class="inner">
                    <?php if (!$success) : ?>
                        <div class="alert alert-danger" role="alert">
                            Nội dung không được rỗng và dài quá 1024 ký tự!
                        </div>
                    <?php endif; ?>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <textarea class="form-control" id="content" name="content" rows="3" placeholder="<?php echo $currentUser['displayName'] ?> ơi, bạn đang nghĩ gì vậy?"></textarea>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="upload-btn-wrapper">
                                <button class="btn">🖼️ <strong>Ảnh/Video</strong></button>
                                <input type="file" id="postImage" name="postImage" />
                            </div>
                        <div class="select-privacy" style="width:260px;">
                        <select>
                            <option value="1">Công khai</option>
                            <option value="2">Bạn bè</option>
                            <option value="3">Chỉ mình tôi</option>
                        </select>
                        </div>
                            <button type="submit" class="btn btn-success">Cập nhật trạng thái</button>
                        </div>
                    </form>
                    <?php foreach ($newFeeds as $post) : ?>
                        <?php $userPost = findUserById($post['userId']); ?>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 mt-3">         
                                    <div class="card">
                                        <div class="card-horizontal">
                                            <div class="img-square-wrapper">
                                                <img class="rounded-circle" style="float: left;width:100px;height:100px;" src="<?php echo empty($userPost['avatarImage']) ? './assets/images/default-avatar.jpg' : 'view-image.php?userId=' . $post['userId'] ?>" alt="<?php echo $userPost['displayName'] ?>">
                                            </div>
                                            <div style="margin-left:100px;" class="card-body">
                                                <h4 class="card-title"><?php echo $post['displayName']; ?>&nbsp;<img src='https://i.imgur.com/l63JR5Q.png' title=' Verified profile ' width='20' /></h4>
                                                <small class="text-muted">Đăng lúc: <?php echo $post['createdAt']; ?></small>
                                                <p class="card-text"><?php echo $post['content']; ?></p>
                                                <?php if ($post['image'] != NULL) : ?>
                                                    <figure>
                                                        <img src="view-image.php?postId=<?php echo $post['id'] ?>" alt="<?php echo $post['id'] ?>" class="img-fluid">
                                                    </figure>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php endforeach; ?>               
            </div>
        </div>
    </section>
<?php endif; ?>
<?php include 'footer.php' ?>