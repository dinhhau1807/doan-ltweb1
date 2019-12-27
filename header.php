<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LTWEB1 - BTN</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css"
        integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://js.pusher.com/5.0/pusher.min.js"></script>
</head>

<body>
    <header id="header">
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-md fixed-top bg-success">
            <div class="container">
                <a href="./" class="navbar-brand text-light">
                    <h1 style="font-weight: 700;">Yolo</h1>
                </a>
                <?php if($currentUser): ?>
                
                <!-- search box -->
                <div class="search-box">
                    <form action="search.php" method="POST">
                        <div class="content-input">
                            <div class="row">
                                <div class="input-group">
                                    <input name="keyword" type="text" class="form-control" placeholder="Tìm kiếm bạn bè..." />
                                    <div class="input-group-append">
                                        <button class="btn btn-light" type="submit">
                                            <a href="search.php"><i class="fa fa-search"></i></a></a>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /search box -->
                <div>
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
                </div>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <main role="main" class="container pb-2">