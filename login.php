<?php
require_once 'init.php';
if ($currentUser) {
  header('Location: index.php');
  exit();
}
?>

<?php include 'header.php' ?>

<?php if (!(isset($_POST['email']) || isset($_POST['password']))) : ?>
  <div class="inner">
    <h2 class="mb-2">Đăng nhập</h2>
    <form action="login.php" method="POST">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Email đăng nhập">
      </div>
      <div class="form-group">
        <label for="password">Mật khẩu</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu">
      </div>
      <button type="submit" class="btn btn-success mr-2">Đăng nhập</button>
      <a href="./forgot-password.php">Quên mật khẩu?</a>
    </form>
  </div>
<?php else : ?>
  <?php
    // fetch from data
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = findUserByEmail($email);

    // check fields
    $errorPattern = "<div class='alert alert-danger' role='alert alert-dismissible fade show'>";
    $error = "";

    if ($user) {
      if (password_verify($password, $user['password'])) {
        $_SESSION['userId'] = $user['id'];
        header('Location: index.php');
        exit();
      } else {
        $error .= $errorPattern . "Nhập mật khẩu không đúng!</div>";
      }
    } else {
      $error .= $errorPattern . "Email đăng nhập không tồn tại!</div>";
    }

    if (!empty($error)) {
      echo $error;
    }
    ?>
  <a href="./login.php" class="btn btn-light">Thử lại</a>
  </div>
<?php endif; ?>

<?php include 'footer.php' ?>