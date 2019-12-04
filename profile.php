<?php
require_once 'init.php';
if (!$currentUser) {
  header('Location: index.php');
  exit();
} else {
  $newFeeds = findAllPosts();

  if(isset($_GET['id'])) {
    $user = findUserById($_GET['id']);

    if(!$user) {
        header('Location: index.php');
    }
  } else {
    header('Location: index.php');
  }  
}
?>

<?php include 'header.php' ?>
  
<section id="timeline-top-section">
    <div class="background-image">
        <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($user['backgroundImage']) . '"/>'; ?>  
    </div>
    <div class="container">
        <?php if($user['id'] == $currentUser['id']): ?>
            <a id="update-profile" class="btn btn-light" href="./update-profile.php" data-toggle="tooltip" data-placement="bottom" title="Cập nhật thông tin">
                <i class="fa fa-pencil"></i>
                <span>Cập nhật thông tin</span>
            </a>
        <?php endif; ?>        
        <div class="timeline-profile">
            <div class="avatar-image">
                <a href="#">
                     <?php echo '<img class="rounded-circle" style="width:180px;height:180px;" src="data:image/jpeg;base64,' . base64_encode($user['avatarImage']) . '"/>'; ?>
                </a>
            </div>
            <div class="user-name">
                <h4><?php echo $user['displayName']; ?></h4>
                <?php if(!empty($user['nickName'])): ?>
                    <h5>(<?php echo $user['nickName']; ?>)</h5>
                <?php endif; ?>                
            </div>
            <?php if($user['id'] != $currentUser['id']): ?>
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
            <?php endif; ?>
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
                <?php if(!empty($user['introContent'])): ?>
                    <p class="text-center"><?php echo $user['introContent']; ?></p>
                <?php endif; ?>
                <hr />
                <ul class="info">
                    <li>
                        <i class="fa fa-envelope"></i>
                        <span><?php echo $user['email']; ?></span>
                    </li>
                    <?php if(!empty($user['phoneNumber'])): ?>
                        <li>
                            <i class="fa fa-phone"></i>
                            <span><?php echo $user['phoneNumber']; ?></span>
                        </li>
                    <?php endif; ?>
                    <?php if($user['phoneNumber'] != 0): ?>
                        <li>
                            <i class="fa fa-leaf"></i>
                            <span>Năm sinh <?php echo $user['yearOfBirth']; ?></span>
                        </li>
                    <?php endif; ?>                    
                    <li>
                        <i class="fa fa-clock-o"></i>
                        <span>Đã tham gia <?php echo date_format(date_create($user['createdDate']), 'd-m-Y'); ?></span>
                    </li>
                    <li>
                        <?php echo '<img style="width:100%;height:200px;" src="data:image/jpeg;base64,' . base64_encode($user['avatarImage']) . '"/>'; ?>
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
                                <?php echo '<img class="rounded-circle" style="width:50px;height:50px;" src="data:image/jpeg;base64,' . base64_encode($user['avatarImage']) . '"/>'; ?>
                            </a>
                        </div>
                        <div>
                            <a class="text-success" href="#">
                                <h5 style="margin-bottom:0;"><?php echo $user["displayName"]; ?></h5>
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
                            <?php echo '<img style="width:100%;height:400px;" src="data:image/jpeg;base64,' . base64_encode($user['avatarImage']) . '"/>'; ?>
                        </a>
                    </div>
                </div>
                <div class="post border">
                    <div class="title d-flex p-3">
                        <div class="avatar mr-3">
                            <?php echo '<img class="rounded-circle" style="width:50px;height:50px;" src="data:image/jpeg;base64,' . base64_encode($user['avatarImage']) . '"/>'; ?>
                        </div>
                        <div>
                             <a class="text-success" href="#">
                                <h5 style="margin-bottom:0;"><?php echo $user["displayName"]; ?></h5>
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
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php' ?>