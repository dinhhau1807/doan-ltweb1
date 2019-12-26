<?php
require_once 'init.php';
$page = 'index';
?>
<?php include 'header.php' ?>
<?php if (!$currentUser) : ?>
<div class="jumbotron">
    <section class="hero-section spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-10 offset-xl-1">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="hero-info">
                                <h5><strong>Yolo</strong> - Mạng xã hội dành cho sinh viên</h5>
                                <div>
                                    <p>Miễn phí mà. Tham gia đi chờ chi...</p>
                                    <p>
                                        <a href="./register.php" class="btn btn-light" role="button">Đăng ký</a>
                                        <a href="./login.php" class="btn btn-light" role="button">Đăng nhập</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <figure class="hero-image">
                                <img src="./assets/images/gif1.gif" alt="" class="img-fluid" alt="Responsive image">
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php else : ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<?php
    $newFeeds = array();
    if(isset($_POST['page'])) {
        $newFeeds = findAllPosts($currentUser['id'], $_POST['page']);
        $page = (int)$_POST['page'] + 1;
    }
    else {
        $newFeeds = findAllPosts($currentUser['id'], 1);
        $page = 2;
    }

    $success = true;
    if (isset($_POST['content'])) {
        $content = $_POST['content'];
        $data = null;
        if (isset($_FILES['postImage'])) {
            $fileTemp = $_FILES['postImage']['tmp_name'];
            if (!empty($fileTemp)) {
                $data = file_get_contents($fileTemp);
            }
        }
        $role = $_POST['role'];
        $len = strlen($content);
        if ($len == 0 || $len > 1024) {
            $success = false;
        } else {
            createPost($currentUser['id'], $content, $data, $role);
            header('Location: index.php');
            exit();
        }
    }
    ?>

<!-- ADD LIKE -->
<?php
    if (isset($_POST['currentUserId']) && isset($_POST['postLikeId'])) {
        $userId = $_POST['currentUserId'];
        $postLikeId = $_POST['postLikeId'];
        addLike($userId, $postLikeId);
        header("Location: index.php");
    }
?>

<!-- REMOVE LIKE -->
<?php
        if (isset($_POST['currentUserId']) && isset($_POST['postUnlikeId'])) {
            $userId = $_POST['currentUserId'];
            $postUnlikeId = $_POST['postUnlikeId'];
            removeLike($userId, $postUnlikeId);
            header("Location: index.php");
        }
    ?>

<?php
    if (isset($_POST['contentCMT'])) {
        $cmt = $_POST['contentCMT'];
        $cmtId =  $_POST['postIdCmt'];
        $len = strlen($cmt);
        if ($len == 0 || $len > 1024) {
            $success = false;
        } else {
            addComment($cmtId, $currentUser['id'], $cmt);
            header('Location: index.php');
            exit();
        }
    }
    ?>
<div class="inner">
    <?php if (!$success) : ?>
    <div class="alert alert-danger" role="alert">
        Nội dung không được rỗng và dài quá 1024 ký tự!
    </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-12">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <textarea class="form-control" style="border-top-left-radius:0; border-top-right-radius: 0;"
                        id="content" name="content" rows="3"
                        placeholder="<?php echo $currentUser['displayName'] ?> ơi, bạn đang nghĩ gì vậy?"></textarea>
                </div>
                <div class="d-flex align-items-center">
                    <div class="upload-btn-wrapper mr-2">
                        <button class="btn"><i class="fas fa-image"><strong> Ảnh/Video</strong></i></button>
                        <input type="file" id="postImage" name="postImage" />
                    </div>
                    <div class="form-group m-0">
                        <div style="max-width: 200px; margin: 4px 0;" class="select-privacy">
                            <select class="form-control" id="role" name="role">
                                <option value="1">Công khai</option>
                                <option value="2">Bạn bè</option>
                                <option value="3">Chỉ mình tôi</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success ml-auto">Cập nhật trạng thái</button>
                </div>
            </form>
        </div>
    </div>
    <?php foreach ($newFeeds as $post) : ?>
    <?php
            $userPost = findUserById($post['userId']);
            $comments = commentWithPostId($post['id']);
            ?>
    <div class="row">
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex">
                        <div class="img-square-wrapper mr-2">
                            <a href="#">
                                <img class="rounded-circle" style="width:50px;height:50px;"
                                    src="<?php echo empty($userPost['avatarImage']) ? './assets/images/default-avatar.jpg' : 'view-image.php?userId=' . $post['userId'] ?>"
                                    alt="<?php echo $userPost['displayName'] ?>">
                            </a>
                        </div>
                        <div>
                            <a href="./profile.php?id=<?php echo $userPost['id']; ?>" class="text-success">
                                <h5 class="card-title mb-1"><?php echo $post['displayName']; ?>&nbsp;<img
                                        src='https://i.imgur.com/l63JR5Q.png' title=' Verified profile ' width='20' />
                                </h5>
                            </a>
                            <small class="text-muted">
                                <i class="custom-time"><?php echo $post['createdAt']; ?></i> ·
                                <?php if ($userPost['id'] != $currentUser['id']) : ?>
                                <i title="<?php if ($post['role'] == 1) echo 'Công khai';
                                                        elseif ($post['role'] == 2) echo 'Đã chia sẻ với: Bạn bè của ' . $post['displayName'];
                                                        else echo 'Chỉ mình tôi'; ?>"
                                    class="fas fa-<?php if ($post['role'] == 1) echo 'globe-americas';
                                                                                                    elseif ($post['role'] == 2) echo 'user-friends';
                                                                                                    else echo 'lock'; ?>"></i>
                                <?php else : ?>
                                <div class="btn-group" id="select-policy">
                                    <button class="fas fa-<?php if ($post['role'] == 1) echo 'globe-americas';
                                                                        elseif ($post['role'] == 2) echo 'user-friends';
                                                                        else echo 'lock'; ?>" data-toggle="dropdown"
                                        id="current-policy-<?php echo $post['id']; ?>"></button>
                                    <ul class="dropdown-menu">
                                        <a style="pointer-events:none;" class="dropdown-item">Ai sẽ thấy bài viết
                                            này?</a>
                                        <li data-postId="<?php echo $post['id']; ?>" data-roleId="1"><a
                                                class="dropdown-item" href="#"><i class="fas fa-globe-americas"></i>
                                                &nbsp;<strong> Công khai</strong></a></li>
                                        <li data-postId="<?php echo $post['id']; ?>" data-roleId="2"><a
                                                class="dropdown-item" href="#"><i
                                                    class="fas fa-user-friends"></i>&nbsp;<strong> Bạn bè</strong></a>
                                        </li>
                                        <li data-postId="<?php echo $post['id']; ?>" data-roleId="3"><a
                                                class="dropdown-item" href="#"><i class="fas fa-lock"></i>&nbsp;<strong>
                                                    &nbsp; Chỉ mình tôi</strong></a></li>
                                    </ul>
                                </div>
                                <?php endif; ?>
                            </small>
                        </div>
                    </div>
                    <p class="card-text mt-3"><?php echo $post['content']; ?></p>
                    <?php $numOfComment = count($comments);
                            $numOfComment = $numOfComment > 0 ? $numOfComment . ' bình luận' : ''; ?>
                    <?php if ($post['image'] != NULL) : ?>
                    <figure>
                        <img src="view-image.php?postId=<?php echo $post['id'] ?>" alt="<?php echo $post['id'] ?>"
                            class="img-fluid w-100">
                    </figure>
                    <?php endif; ?>
                    <div class="d-flex justify-content-between">
                        <div>
                            <span>
                                <i class="fa fa-thumbs-o-up"></i>

                                <?php echo countLike($post['id']); ?> lượt thích
                            </span>
                        </div>
                        <div class="comment-count" data-commentcount="<?php echo count($comments); ?>">
                            <span><?php echo $numOfComment ?></span>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="d-flex react-group">
                        <?php if (!wasLike($currentUser['id'], $post['id'])): ?>
                        <form method="POST" class="hover-secondary w-100 text-center">
                            <input type="hidden" name="currentUserId" value="<?php echo $currentUser['id']; ?>">
                            <input type="hidden" name="postLikeId" value="<?php echo $post['id']; ?>">
                            <button type="submit" class="hover-secondary w-100 text-center btn btn-like px-3 py-2">
                                <i class="fa fa-thumbs-o-up"></i> Thích
                            </button>
                        </form>
                        <?php else: ?>
                        <form method="POST" class="hover-secondary w-100 text-center">
                            <input type="hidden" name="currentUserId" value="<?php echo $currentUser['id']; ?>">
                            <input type="hidden" name="postUnlikeId" value="<?php echo $post['id']; ?>">
                            <button type="submit" class="hover-secondary w-100 text-center btn btn-like px-3 py-2">
                                <i class="fa fa-thumbs-up"></i> Bỏ thích
                            </button>
                        </form>
                        <?php endif; ?>
                        <div class="hover-secondary w-100 text-center">
                            <p class="btn-comment px-3 py-2"><i class="fa fa-comment"></i> Bình luận</p>
                        </div>
                    </div>
                    <!-- SHOW COMMENT POST -->
                    <div class="comments mb-4">
                        <?php foreach ($comments as $row) : ?>
                        <?php $userComment = findUserById($row['userId']); ?>
                        <div class="comment d-flex align-items-center mb-3">
                            <a href="./profile.php?id=<?php echo $row['userId']; ?>">
                                <img class="rounded-circle" style="width:40px;height:40px;"
                                    src="<?php echo empty($userComment['avatarImage']) ? './assets/images/default-avatar.jpg' : 'view-image.php?userId=' . $userComment['id'] ?>"
                                    alt="<?php echo $userComment['displayName'] ?>">
                            </a>
                            <p class="rounded p-2 mb-0 ml-2" style="background-color: #eee;">
                                <a href="./profile.php?id=<?php echo $row['userId']; ?>"
                                    class="text-success font-weight-bold"><?php echo $userComment['displayName'] ?></a>
                                <span><?php echo $row['content']; ?></span>
                            </p>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- ADD COMMENT-->
                    <form method="POST" class="comment-form">
                        <div class="content-input">
                            <div class="row">
                                <div class="input-group mb-2">
                                    <input type="hidden" value="<?php echo $post['id'] ?>" name="postIdCmt" />
                                    <input type="text" name="contentCMT" class="form-control"
                                        placeholder="Nhập bình luận ở đây..." required />
                                    <div class="input-group-append">
                                        <button style="width: 80px;" class="btn btn-success" type="submit">
                                            <i class="fa fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <?php if (count($newFeeds) != 0): ?>
    <div class="load-more text-center pt-5">
        <form method="POST">
            <input type="hidden" value="<?php echo $page; ?>" name="page" />
            <button type="submit" class="btn btn-outline-success">Tải thêm trạng thái</button>
        </form>
    </div>
    <?php endif; ?>
</div>

<script src="./assets/js/change-privacy.js"></script>
<?php endif; ?>

<?php include 'footer.php' ?>