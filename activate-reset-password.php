<?php
require_once 'init.php';
if ($currentUser) {
  header('Location: index.php');
  exit();
}
?>

<?php include 'header.php' ?>

<h1>Kích hoạt reset mật khẩu</h1>
<?php if (!(isset($_GET['code']))) : ?>
  <form action="activate-reset-password.php" method="GET">
    <div class="form-group">
      <label for="code">Mã kích hoạt</label>
      <input type="text" class="form-control" id="code" name="code" placeholder="Nhập mã để reset mật khẩu">
    </div>
    <button type="submit" class="btn btn-primary">Xác nhận</button>
  </form>
<?php else : ?>
  <?php
    // fetch from data
    $code = $_GET['code'];

    $success = checkValidCodeResetPassword($code);

    if(empty($code)){
      $success = false;
    }

    // check fields
    $errorPattern = "<div class='alert alert-danger' role='alert alert-dismissible fade show'>";
    $error = "";

    if ($success) {
      header("Location: reset-password.php?code=$code");
      exit();
    } else {
      $error .= $errorPattern . "Mã kích hoạt reset mật khẩu không hợp lệ!</div>";
    }

    if (!empty($error)) {
      echo $error;
    }
    ?>
  <a href="./activate-reset-password.php" class="btn btn-light">Thử lại</a>
  </div>
<?php endif; ?>

<?php include 'footer.php' ?>