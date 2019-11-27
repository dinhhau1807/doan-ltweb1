<?php
require_once 'init.php';
if ($currentUser) {
  header('Location: index.php');
  exit();
}
?>

<?php include 'header.php' ?>

<h1>Quên mật khẩu</h1>
<?php if (!(isset($_POST['email']))) : ?>
  <form action="forgot-password.php" method="POST">
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="Email đăng nhập">
    </div>
    <button type="submit" class="btn btn-primary mr-2">Gửi code</button>
  </form>
<?php else : ?>
  <?php
    // fetch from data
    $email = $_POST['email'];

    $user = findUserByEmail($email);

    // check fields
    $errorPattern = "<div class='alert alert-danger' role='alert alert-dismissible fade show'>";
    $error = "";

    if ($user) {
      if ($user['status'] == 1) {
        sendCodeResetPassword($user);
      } else {
        $error .= $errorPattern . "Tài khoản này chưa được kích hoạt!</div>";
      }
    } else {
      $error .= $errorPattern . "Email đăng nhập không tồn tại!</div>";
    }
    ?>

  <?php if (!empty($error)) : ?>
    <?php echo $error; ?>
    <a href="./forgot-password.php" class="btn btn-light">Thử lại</a>
  <?php else : ?>
    <div class="alert alert-success">Vui lòng kiểm tra email để kích hoạt reset mật khẩu!</div>
    <a href="./activate-reset-password.php" class="btn btn-primary">Kích hoạt reset mật khẩu</a>
  <?php endif; ?>
  </div>
<?php endif; ?>

<?php include 'footer.php' ?>