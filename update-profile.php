<?php
require_once 'init.php';
if (!$currentUser) {
  header('Location: index.php');
  exit();
}
?>
<?php include 'header.php' ?>

<h1>Cập nhật thông tin cá nhân</h1>
<?php if (!(isset($_POST['displayName']))) : ?>
  <form action="update-profile.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="displayName">Họ và tên</label>
      <input type="text" class="form-control" id="displayName" name="displayName" placeholder="Họ và tên" value="<?php echo $currentUser['displayName'] ?>">
    </div>
    <div class="form-group">
      <label for="phoneNumber">Số điện thoại</label>
      <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Số điện thoại" value="<?php echo $currentUser['phoneNumber'] ?>">
    </div>
    <div class="form-group">
      <label for="avatarImage">Ảnh đại diện</label>
      <input type="file" accept=".jpeg, .jpg .png" class="form-control-file" id="avatarImage" name="avatarImage">
    </div>
    <button type="submit" class="btn btn-primary">Cập nhật thông tin cá nhân</button>
  </form>
<?php else : ?>
  <?php
    // fetch from data
    $displayName = $_POST['displayName'];
    $phoneNumber = $_POST['phoneNumber'];
    $avatarImage = $currentUser['avatarImage'];

    // fetch image
    if (isset($_FILES['avatarImage'])) {
      $fileName = $_FILES['avatarImage']['name'];
      $fileTemp = $_FILES['avatarImage']['tmp_name'];

      if (!empty($fileTemp)) {
        $avatarImage = file_get_contents($fileTemp);
      }
    }

    // check fields
    $errorPattern = "<div class='alert alert-danger' role='alert alert-dismissible fade show'>";
    $error = "";

    if (empty($displayName)) {
      $error .= "$errorPattern Bạn phải nhập tên hiển thị!</div>";
    } else {
      updateUserProfile($currentUser['id'], $displayName, $phoneNumber, $avatarImage);
      header('Location: profile.php');
      exit();
    }

    if (!empty($error)) {
      echo $error;
    }
    ?>
  <a href="./update-profile.php" class="btn btn-light">Thử lại</a>
  </div>
<?php endif; ?>

<?php include 'footer.php' ?>