<?php
require_once 'init.php';
if ($currentUser) {
  header('Location: index.php');
  exit();
}
?>

<?php include 'header.php' ?>

<h1>Kích hoạt tài khoản</h1>
<?php if (!(isset($_GET['code']))) : ?>
  <form method="GET">
    <div class="form-group">
      <label for="code">Mã kích hoạt</label>
      <input type="text" class="form-control" id="code" name="code" placeholder="Mã kích hoạt">
    </div>
    <button type="submit" class="btn btn-primary">Kích hoạt tài khoản</button>
  </form>
<?php else : ?>
  <?php
    // fetch from data
    $code = $_GET['code'];

    $success = activateUser($code);

    // check fields
    $errorPattern = "<div class='alert alert-danger' role='alert alert-dismissible fade show'>";
    $error = "";

    if ($success) {
      header('Location: index.php');
      exit();
    } else {
      $error .= $errorPattern . "Kích hoạt tài khoản thất bại!</div>";
    }

    if (!empty($error)) {
      echo $error;
    }
    ?>
  <a href="./activate.php" class="btn btn-light">Thử lại</a>
  </div>
<?php endif; ?>

<?php include 'footer.php' ?>