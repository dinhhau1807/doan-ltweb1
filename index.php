<?php
require_once 'init.php';
$page = 'index';
?>
<?php include 'header.php' ?>
<?php if ($currentUser) : ?>
<?php include 'status.php' ?>
<?php else : ?>
  <div class="jumbotron">
    <section class="hero-section spad">
      <div class="container-fluid">
        <div class="row">
          <div class="col-xl-10 offset-xl-1">
            <div class="row">
              <div class="col-lg-7">
                <div class="hero-info">
                  <h5><strong>Yolo</strong> - Mạng xã hội dành cho sinh viên</h5>
                  <div>
                    <p>Miễn phí mà. Tham gia đi chờ chi...</p>
                    <p>
                      <a href="./register.php" class="btn btn-light" role="button">Đăng ký</a>
                      <a href="./login.php" class="btn btn-light" role="button">Đăng nhập</a>
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-lg-5">
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