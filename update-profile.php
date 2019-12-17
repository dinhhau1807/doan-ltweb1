<?php
require_once 'init.php';
if (!$currentUser) {
  header('Location: index.php');
  exit();
}
?>
<?php include 'header.php' ?>

<?php if (!(isset($_POST['displayName']))) : ?>
  <div class="inner">
    <h2 class="mb-2">Cập nhật thông tin cá nhân</h1>
    <form action="update-profile.php" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="displayName">Họ và tên</label>
        <input type="text" class="form-control" id="displayName" name="displayName" placeholder="Họ và tên" value="<?php echo $currentUser['displayName'] ?>">
      </div>
      <div class="form-group">
        <label for="nickName">Nick name</label>
        <input type="text" class="form-control" id="nickName" name="nickName" placeholder="Nick name" value="<?php echo $currentUser['nickName'] ?>">
      </div>
      <div class="form-group">
        <label for="yearOfBirth">Năm sinh</label>
        <input type="text" class="form-control" id="yearOfBirth" name="yearOfBirth" placeholder="Năm sinh" value="<?php echo $currentUser['yearOfBirth'] ?>">
      </div>
      <div class="form-group">
        <label for="phoneNumber">Số điện thoại</label>
        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Số điện thoại" value="<?php echo $currentUser['phoneNumber'] ?>">
      </div>
      <div class="form-group">
        <label for="introContent">Giới thiệu bản thân</label>
        <input type="text" class="form-control" id="introContent" name="introContent" placeholder="Giới thiệu bản thân" value="<?php echo $currentUser['introContent'] ?>">
      </div>
      <div class="form-group">
        <label for="avatarImage">Ảnh đại diện</label>
        <input type="file" accept=".jpeg, .jpg, .png" class="form-control-file" id="avatarImage" name="avatarImage">
      </div>
      <div class="form-group">
        <label for="backgroundImage">Ảnh bìa</label>
        <input type="file" accept=".jpeg, .jpg, .png" class="form-control-file" id="backgroundImage" name="backgroundImage">
      </div>
      <button type="submit" class="btn btn-success">Cập nhật</button>  
    </form>
  </div>
<?php else : ?>
  <?php
    // fetch from data
    $displayName = $_POST['displayName'];
    $nickName = $_POST['nickName'];
    $yearOfBirth = $_POST['yearOfBirth'];
    $phoneNumber = $_POST['phoneNumber'];
    $introContent = $_POST['introContent'];
    $avatarImage = $currentUser['avatarImage'];
    $backgroundImage = $currentUser['backgroundImage'];

    // fetch avatar image
    if (isset($_FILES['avatarImage'])) {
      $fileName = $_FILES['avatarImage']['name'];
      $fileTemp = $_FILES['avatarImage']['tmp_name'];

      if (!empty($fileTemp)) {
        $avatarImage = file_get_contents($fileTemp);
      }
    }

    // fetch backgroundImage image
    if (isset($_FILES['backgroundImage'])) {
      $fileName = $_FILES['backgroundImage']['name'];
      $fileTemp = $_FILES['backgroundImage']['tmp_name'];

      if (!empty($fileTemp)) {
        $backgroundImage = file_get_contents($fileTemp);
      }
    }

    // check fields
    $errorPattern = "<div class='alert alert-danger' role='alert alert-dismissible fade show'>";
    $error = "";

    if (empty($displayName)) {
      $error .= "$errorPattern Bạn phải nhập tên hiển thị!</div>";
    } else {
      updateUserProfile($currentUser['id'], $displayName, $phoneNumber, $avatarImage, $yearOfBirth, $nickName, $introContent, $backgroundImage);
      header('Location: profile.php?id=' . $currentUser['id']);
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