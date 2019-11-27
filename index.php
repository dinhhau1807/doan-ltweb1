<?php
require_once 'init.php';
$page = 'index';
?>

<?php include 'header.php' ?>

<div class="jumbotron">
  <?php if ($currentUser) : ?>
    <h1 class="display-4">Chào mừng trở lại, <?php echo $currentUser['displayName'] ?>!</h1>
  <?php else : ?>
    <h1 class="display-4">Lập trình Web 1</h1>
  <?php endif; ?>
  <p class="lead">Bài tập nhóm</p>
</div>

<?php include 'footer.php' ?>