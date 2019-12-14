<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LTWEB1 - BTN</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <header id="header">
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-md fixed-top bg-success">
            <div class="container">
                <a href="./" class="navbar-brand text-light">
                    <h1 style="font-weight: 700;">Yolo</h1>
                </a>
                <div>
                    <?php if ($currentUser) : ?>
                    <div class="d-flex justify-content-center align-items-center ml-auto">
                        <a data-toggle="tooltip" title="Thông tin cá nhân"
                            href="./profile.php?id=<?php echo $currentUser['id']; ?>"
                            class="btn btn-success d-flex justify-content-center align-items-center">
                            <i style="margin-right: 6px;" class="fa fa-user"></i>
                            <?php echo $currentUser['displayName']; ?>
                        </a>
                        <span class="divider"></span>
                        <a href="./" class="btn btn-success">Trang chủ</a>
                        <span class="divider"></span>
                        <div class="icon-group">
                            <a class="icon" data-toggle="tooltip" href="./friend-request.php" title="Lời mời kết bạn">
                                <i class="fa fa-users">
                                </i>
                            </a>
                            <a class="icon" data-toggle="tooltip" href="./messages.php" title="Tin nhắn">
                                <i class="fa fa-comment">
                                </i>
                            </a>
                            <a class="icon" href="./logout.php" data-toggle="tooltip" title="Đăng xuất">
                                <i class="fa fa-sign-out"></i>
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>

    <main role="main" class="container pb-2">