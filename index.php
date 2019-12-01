<?php
require_once 'init.php';
$page = 'index';
?>
<?php include 'header.php' ?>
<?php if ($currentUser) : ?>
<?php include 'status.php' ?>
<?php else : ?>
<br>
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