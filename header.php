<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>LTWEB1 - BTN</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
  <header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
      <span class="navbar-brand">WEB 1</span>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item <?php echo $page == 'index' ? 'active' : ''; ?>">
            <a class="nav-link" href="./">Trang chủ <span class="sr-only">(current)</span></a>
          </li>
          <?php if ($currentUser) : ?>
            <!-- Add private link -->
            <li class="nav-item <?php echo $page == 'update-profile' ? 'active' : ''; ?>">
              <a class="nav-link" href="./update-profile.php">Cá nhân</a>
            </li>
          <?php endif; ?>
        </ul>
        <?php if (!$currentUser) : ?>
          <div>
            <a href="./login.php" class="btn btn-outline-primary my-2 my-sm-0">Đăng nhập</a>
            <a href="./register.php" class="btn btn-primary my-2 my-sm-0">Đăng ký</a>
          </div>
        <?php else : ?>
          <span>Xin chào, <?php echo $currentUser['displayName'] . "!" ?></span>
          <a href="./logout.php" class="btn btn-primary ml-2 my-sm-0">Đăng xuất</a>
        <?php endif; ?>
      </div>
    </nav>
  </header>
  
  <main role="main" class="container pb-2">