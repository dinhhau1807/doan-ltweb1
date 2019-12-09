<?php
require_once 'init.php';
if ($currentUser) {
  $newFeeds = findAllPosts();
}
$page = 'status';
?>
<?php if ($currentUser) : ?>
  <?php
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
          <div class="post border">
            <div class="title d-flex p-3">
              <div class="avatar mr-3">
                <?php echo '<img class="rounded-circle" style="width:50px;height:50px;" src="data:image/jpeg;base64,' . base64_encode($currentUser['avatarImage']) . '"/>'; ?>
              </div>
              <div>
                <a class="text-success" href="#">
                  <h5 style="margin-bottom:0;"><?php echo $currentUser["displayName"]; ?></h5>
                </a>
                <span class="text-secondary">
                      10-10-2019
                      <i class="fa fa-paper-plane-o"></i>
                </span>
              </div>
            </div>
            <div class="content px-3">
              <p>
                  Hôm nay trời đẹp
              </p>
            </div>
            <div class="image">
                <?php echo '<img style="width:100%;height:400px;" src="data:image/jpeg;base64,' . base64_encode($currentUser['avatarImage']) . '"/>'; ?>
            </div>
        </div>
    </div>
          <div class="card">
            <div class="card-horizontal">
              <div class="img-square-wrapper">
                <img style="float: left; width: 96px; height: 96px;" src="<?php echo empty($userPost['avatarImage']) ? './assets/images/default-avatar.jpg' : 'view-image.php?userId=' . $post['userId'] ?>" alt="<?php echo $userPost['displayName'] ?>">
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
<?php endif; ?>
</div>