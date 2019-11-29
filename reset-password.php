<?php
require_once 'init.php';
if ($currentUser) {
  header('Location: index.php');
  exit();
}
?>

<?php include 'header.php' ?>

<?php
$code = NULL;
if (isset($_GET['code']) && !empty($_GET['code'])) {
  $code = $_GET['code'];
  $check = checkValidCodeResetPassword($code);
  if (!$check) {
    header('Location: activate-reset-password.php');
    exit();
  }
} else {
  header('Location: activate-reset-password.php');
  exit();
}
?>

<h1>Reset mật khẩu</h1>
<?php if (!(isset($_POST['newPassword']) || isset($_POST['newPasswordRepeat']))) : ?>
  <form action="reset-password.php?code=<?php echo $code ?>" method="POST">
    <div class="form-group">
      <label for="newPassword">Mật khẩu mới</label>
      <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Mật khẩu mới">
    </div>
    <div class="form-group">
      <label for="newPasswordRepeat">Mật khẩu mới (nhập lại)</label>
      <input type="password" class="form-control" id="newPasswordRepeat" name="newPasswordRepeat" placeholder="Mật khẩu mới (nhập lại)">
    </div>
    <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
  </form>
<?php else : ?>
  <?php
    // fetch from data
    $newPassword = $_POST['newPassword'];
    $newPasswordRepeat = $_POST['newPasswordRepeat'];

    $success = false;

    // check fields
    $errorPattern = "<div class='alert alert-danger' role='alert alert-dismissible fade show'>";
    $error = "";

    if (empty($newPassword) || empty($newPasswordRepeat)) {
      $error .= $errorPattern . "Bạn phải nhập đủ dữ liệu!</div>";
    } else {
      if ($newPassword == $newPasswordRepeat) {
        $success = resetPassword($code, $newPassword);
      } else {
        $error .= $errorPattern . "Mật khẩu nhập lại không trùng khớp!</div>";
      }
    }

    if ($success) {
      header('Location: login.php');
      exit();
    } else {
      $error .= $errorPattern . "Reset mật khẩu thất bại!</div>";
    }

    if (!empty($error)) {
      echo $error;
    }
    ?>
  <a href="./reset-password.php?code=<?php echo $code ?>" class="btn btn-light">Thử lại</a>
  </div>
<?php endif; ?>

<?php include 'footer.php' ?>