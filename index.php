<?php
require_once 'init.php';
if ($currentUser) {
  $newFeeds = findAllPosts();
}
$page = 'index';
?>
<?php include 'header.php' ?>
<?php if ($currentUser) : ?>
  <?php
    echo $currentUser ? '<h2>Xin chào, <b>' . $currentUser['displayName'] . '</b></h2>' : '';
    ?>
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
  <?php if (!$success) : ?>
    <div class="alert alert-danger" role="alert">
      Nội dung không được rỗng và dài quá 1024 ký tự!
    </div>
  <?php endif; ?>
  <form method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <textarea class="form-control" id="content" name="content" rows="3" placeholder="<?php echo $currentUser['displayName'] ?> ơi, bạn đang nghĩ gì vậy?"></textarea>
    </div>
    <div class="upload-btn-wrapper">
      <button class="btn">🖼️ <strong>Ảnh/Video</strong></button>
      <input type="file" id="imagePost" name="imagePost"/>
    </div>
    <div class="select-privacy" style="width:260px;">
      <select>
        <option value="1">Công khai</option>
        <option value="2">Bạn bè</option>
        <option value="3">Chỉ mình tôi</option>
      </select>
    </div>
    <p></p>
    <button type="submit" class="btn btn-primary">Cập nhật trạng thái</button>
  </form>
  <?php
    foreach ($newFeeds as $post) :  ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 mt-3">
          <div class="card">
            <div class="card-horizontal">
              <div class="img-square-wrapper">
                <img style="float: left;width: 128px;height: 128px;" src="avatar.php<?php echo "?id=";
                                                                                        echo $post['myImageID']; ?>" class="card-img-top" alt="<?php echo $post['displayName']; ?>">
              </div>
              <div style="margin-left:10px;" class="card-body">
                <h4 class="card-title"><?php echo $post['displayName']; ?>&nbsp;<img src='https://i.imgur.com/l63JR5Q.png' title=' Verified profile ' width='20' /></h4>
                <small class="text-muted">Đăng lúc: <?php echo $post['createdAt']; ?></small>
                <p class="card-text"><?php echo $post['content']; ?></p>
                <img style="width: 450px;" src='getImage.php<?php echo "?id=";
                                                                echo $post['id']; ?>'>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
  <br>
<?php else : ?>
  <div class="jumbotron">
    <section class="hero-section spad">
      <div class="container-fluid">
        <div class="row">
          <div class="col-xl-10 offset-xl-1">
            <div class="row">
              <div class="col-lg-6">
                <div class="hero-info">
                  <h2><strong>A2HL</strong> - Mạng xã hội dành cho sinh viên</h2>
                  <div>
                    <p><b> Miễn phí mà. Tham gia đi chờ chi....</b></p>
                    <p>
                      <a href="./register.php" class="btn btn-outline-primary" role="button">Đăng ký</a>
                      <a href="./login.php" class="btn btn-outline-success" role="button">Đăng nhập</a>
                    </p>
                    <p><a href="./forgot-password.php">Quên mật khẩu ?</a></p>
                    <br>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
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
<?php endif; ?>
<?php include 'footer.php' ?>