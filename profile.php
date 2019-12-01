<?php
require_once 'init.php';
if (!$currentUser) {
  header('Location: index.php');
  exit();
} else {
  $newFeeds = findAllPosts();
}
?>

<?php include 'header.php' ?>
  
<section id="timeline-top-section">
    <div class="background-image">
        <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($currentUser['avatarImage']) . '"/>'; ?>  
    </div>
    <div class="container">
        <a id="update-profile" class="btn btn-light" href="./update-profile.php" data-toggle="tooltip" data-placement="bottom" title="Cập nhật thông tin">
            <i class="fa fa-pencil"></i>
            <span>Cập nhật thông tin</span>
        </a>
        <div class="timeline-profile">
            <div class="avatar-image">
                <a href="#">
                     <?php echo '<img class="rounded-circle" style="width:180px;height:180px;" src="data:image/jpeg;base64,' . base64_encode($currentUser['avatarImage']) . '"/>'; ?>
                </a>
            </div>
            <div class="user-name">
                <h4>From VN with Love</h4>
                <h5>(From VN with Love)</h5>
            </div>
            <div class="actions">
                <button class="btn btn-light">
                    <i class="fa fa-user-plus"></i>    
                    Thêm bạn bè
                </button>
                <button class="btn btn-light">
                    <i class="fa fa-rss"></i>
                    Theo dõi
                </button>
                <button class="btn btn-light">
                    <i class="fa fa-comment"></i>    
                    Nhắn tin
                </button>
            </div>
        </div>
    </div>
</section>

<section class="timeline-main-section">
    <div class="row">
        <div class="col-md-4">
            <div class="introduce border w-100 p-3 mb-3">
                <h5 class="mb-3">
                    <i class="text-success fa fa-question-circle-o"></i>
                    Giới thiệu
                </h5>
                <p class="text-center">😝 Cuộc sống mà ! 😝</p>
                <hr />
                <ul class="info">
                    <li>
                        <i class="fa fa-envelope"></i>
                        <span>test@gmail.com</span>
                    </li>
                    <li>
                        <i class="fa fa-phone"></i>
                        <span>08 888 888888</span>
                    </li>
                    <li>
                        <i class="fa fa-leaf"></i>
                        <span>Sinh ngày 01-01-1999</span>
                    </li>
                    <li>
                        <i class="fa fa-home"></i>
                        <span>Sống tại Hồ Chí Minh</span>
                    </li>
                    <li>
                        <i class="fa fa-clock-o"></i>
                        <span>Đã tham gia 10-10-2019</span>
                    </li>
                    <li>
                        <?php echo '<img style="width:100%;height:200px;" src="data:image/jpeg;base64,' . base64_encode($currentUser['avatarImage']) . '"/>'; ?>
                    </li>
                </ul>
            </div>
            <div class="list-image border w-100 p-3 mb-3">
                <a class="text-dark" href="#">
                    <h5>
                        <i class="text-success fa fa-camera"></i>
                        Ảnh
                    </h5>       
                </a>    
                <hr />  
                <div class="row text-center text-lg-left">
                    <div class="col-lg-6 col-md-6 col-6">
                    <a href="#" class="d-block mb-4 h-100">
                            <img class="img-fluid" src="https://source.unsplash.com/pWkk7iiCoDM/400x300" alt="">                           
                        </a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-6">
                    <a href="#" class="d-block mb-4 h-100">
                            <img class="img-fluid" src="https://source.unsplash.com/aob0ukAYfuI/400x300" alt="">
                        </a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-6">
                    <a href="#" class="d-block mb-4 h-100">
                            <img class="img-fluid" src="https://source.unsplash.com/EUfxH-pze7s/400x300" alt="">
                        </a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-6">
                    <a href="#" class="d-block mb-4 h-100">
                            <img class="img-fluid" src="https://source.unsplash.com/M185_qYH8vg/400x300" alt="">
                        </a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-6">
                    <a href="#" class="d-block mb-4 h-100">
                            <img class="img-fluid" src="https://source.unsplash.com/sesveuG_rNo/400x300" alt="">
                        </a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-6">
                    <a href="#" class="d-block mb-4 h-100">
                            <img class="img-fluid" src="https://source.unsplash.com/AvhMzHwiE_0/400x300" alt="">
                        </a>
                    </div>
                </div>         
            </div>
            <div class="list-friend border w-100 p-3 mb-3">
                <a class="text-dark" href="#">
                    <h5>
                        <i class="text-success fa fa-users"></i>
                        Bạn bè
                        <span class="text-secondary" style="font-size:14px;">1.000 (1001 bạn chung)</span>
                    </h5>       
                </a> 
                <hr />
                <div class="row text-center text-lg-left">
                    <div class="col-lg-6 col-md-6 col-6">
                    <a href="#" class="d-block mb-2 h-100">
                            <img class="img-fluid" src="https://source.unsplash.com/pWkk7iiCoDM/400x300" alt="">
                            <p class="friend-name text-center">Ng van a</p>
                        </a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-6">
                    <a href="#" class="d-block mb-2 h-100">
                            <img class="img-fluid" src="https://source.unsplash.com/aob0ukAYfuI/400x300" alt="">
                            <p class="friend-name text-center">Ng van a</p>
                        </a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-6">
                    <a href="#" class="d-block mb-2 h-100">
                            <img class="img-fluid" src="https://source.unsplash.com/EUfxH-pze7s/400x300" alt="">
                            <p class="friend-name text-center">Ng van a</p>
                        </a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-6">
                    <a href="#" class="d-block mb-2 h-100">
                            <img class="img-fluid" src="https://source.unsplash.com/M185_qYH8vg/400x300" alt="">
                            <p class="friend-name text-center">Ng van a</p>
                        </a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-6">
                    <a href="#" class="d-block mb-2 h-100">
                            <img class="img-fluid" src="https://source.unsplash.com/sesveuG_rNo/400x300" alt="">
                            <p class="friend-name text-center">Ng van a</p>
                        </a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-6">
                    <a href="#" class="d-block mb-2 h-100">
                            <img class="img-fluid" src="https://source.unsplash.com/AvhMzHwiE_0/400x300" alt="">
                            <p class="friend-name text-center">Ng van a</p>
                        </a>
                    </div>
                </div>                 
            </div>
        </div>
        <div class="col-md-8">
            <div class="posts w-100">
                <div class="post border">
                    <div class="title d-flex p-3">
                        <div class="avatar mr-3">
                            <a href="#">
                                <?php echo '<img class="rounded-circle" style="width:50px;height:50px;" src="data:image/jpeg;base64,' . base64_encode($currentUser['avatarImage']) . '"/>'; ?>
                            </a>
                        </div>
                        <div>
                            <a class="text-success" href="#">
                                <h5 style="margin-bottom:0;"><?php echo $currentUser["displayName"]; ?></h5>
                            </a>
                            <span class="text-secondary">
                                10-10-2019
                                <i class="fa fa-paper-plane-o"></i>
                            </span>
                        </div>
                    </div>
                    <div class="content px-3">
                        <p>
                            Hôm nay trời đẹp
                        </p>
                    </div>
                    <div class="image">
                        <a href="#">
                            <?php echo '<img style="width:100%;height:400px;" src="data:image/jpeg;base64,' . base64_encode($currentUser['avatarImage']) . '"/>'; ?>
                        </a>
                    </div>
                </div>
                <div class="post border">
                    <div class="title d-flex p-3">
                        <div class="avatar mr-3">
                            <?php echo '<img class="rounded-circle" style="width:50px;height:50px;" src="data:image/jpeg;base64,' . base64_encode($currentUser['avatarImage']) . '"/>'; ?>
                        </div>
                        <div>
                            <a class="text-success" href="#">
                                <h5 style="margin-bottom:0;"><?php echo $currentUser["displayName"]; ?></h5>
                            </a>
                            <span class="text-secondary">
                                10-10-2019
                                <i class="fa fa-paper-plane-o"></i>
                            </span>
                        </div>
                    </div>
                    <div class="content px-3">
                        <p>
                            Hôm nay trời đẹp
                        </p>
                    </div>
                    <div class="image">
                        <?php echo '<img style="width:100%;height:400px;" src="data:image/jpeg;base64,' . base64_encode($currentUser['avatarImage']) . '"/>'; ?>
                    </div>
                </div>
                <div class="post border">
                    <div class="title d-flex p-3">
                        <div class="avatar mr-3">
                            <?php echo '<img class="rounded-circle" style="width:50px;height:50px;" src="data:image/jpeg;base64,' . base64_encode($currentUser['avatarImage']) . '"/>'; ?>
                        </div>
                        <div>
                            <a class="text-success" href="#">
                                <h5 style="margin-bottom:0;"><?php echo $currentUser["displayName"]; ?></h5>
                            </a>
                            <span class="text-secondary">
                                10-10-2019
                                <i class="fa fa-paper-plane-o"></i>
                            </span>
                        </div>
                    </div>
                    <div class="content px-3">
                        <p>
                            Hôm nay trời đẹp
                        </p>
                    </div>
                    <div class="image">
                        <?php echo '<img class="img-fluid" style="width:100%;height:400px;" src="data:image/jpeg;base64,' . base64_encode($currentUser['avatarImage']) . '"/>'; ?>
                    </div>
                </div>
                <div class="post border">
                    <div class="title d-flex p-3">
                        <div class="avatar mr-3">
                            <?php echo '<img class="rounded-circle" style="width:50px;height:50px;" src="data:image/jpeg;base64,' . base64_encode($currentUser['avatarImage']) . '"/>'; ?>
                        </div>
                        <div>
                             <a class="text-success" href="#">
                                <h5 style="margin-bottom:0;"><?php echo $currentUser["displayName"]; ?></h5>
                            </a>
                            <span class="text-secondary">
                                10-10-2019
                                <i class="fa fa-paper-plane-o"></i>
                            </span>
                        </div>
                    </div>
                    <div class="content px-3">
                        <p>
                            Hôm nay trời đẹp
                        </p>
                    </div>
                    <div class="image">
                        <?php echo '<img style="width:100%;height:400px;" src="data:image/jpeg;base64,' . base64_encode($currentUser['avatarImage']) . '"/>'; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php' ?>