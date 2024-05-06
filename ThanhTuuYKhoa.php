<?php
include 'partials/header.php';

// Show featured post from database
$featured_query = "SELECT * FROM posts WHERE is_featured = 1 AND categories_id = 2";
$featured_result = mysqli_query($connection, $featured_query);
$featured = mysqli_fetch_assoc($featured_result);

// show news from db
$recent_query = "SELECT * FROM posts WHERE categories_id = 2 ORDER BY date_time DESC LIMIT 4";
$recent_news = mysqli_query($connection, $recent_query);

// show recent news from db
$query = "SELECT * FROM posts WHERE categories_id = 2 ORDER BY date_time DESC";
$news = mysqli_query($connection, $query);
?>


<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

    body {
        color: #8f9bad;
        background-color: #fff;
        font-family: 'Roboto', sans-serif;
        font-size: 15px;
        line-height: 1.7;
        overflow-x: hidden;
        -webkit-font-smoothing: antialiased;
    }

    img {
        max-width: 100%;
        height: auto;
    }

    .text-center {
        text-align: center;
    }

    .text-left {
        text-align: left;
    }

    .text-right {
        text-align: right;
    }

    .relative {
        position: relative;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        color: #203656;
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        line-height: 1.4;
        margin: 20px 0;
    }

    a {
        color: #ad1deb;
        outline: 0;
        text-decoration: none;
        transition: all 0.3s ease-in-out;
    }

    a:hover {
        color: #203656;
    }

    a:focus {
        outline: 0;
    }

    .nav-fill .nav-item>.nav-link {
        color: #8f9bad !important;
        margin-right: 10px;
    }

    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        color: #fff !important;
        background-color: #6e72fc;
        background-image: linear-gradient(315deg, #ad1deb 0%, #4d92f4 50%);
        border-color: transparent;
    }

    .widget ul.list {
        list-style: none;
        padding: 0;
        margin-bottom: 0;
    }

    .widget ul.list li {
        line-height: 40px;
    }

    .widget ul.list li a {
        color: #203656;
        font-weight: 700;
    }

    .widget ul.list li a::before {
        color: #9faabb;
        font-family: "simple-line-icon";
        font-size: 11px;
        vertical-align: middle;
        margin-right: 25px;
        content: "\22D7";
    }

    .widget ul.list li a:hover {
        color: #4d92f4;
    }

    .widget ul.list li::after {
        content: "";
        display: block;
        height: 1px;
        width: 100%;
        background: #ebebeb;
        background-image: linear-gradient(to right, #ebebeb 0%, transparent 100%);
    }

    .widget ul.list li span {
        float: right;
    }

    .widget ul.list:last-child::after {
        content: "";
        display: none;
    }
</style>

<!-- Welcome section -->
<section id="hero">
    <div class="container-xl">
        <div class="row gy-4">
            <div class="col-lg-8">

                <?php if (mysqli_num_rows($featured_result) == 1) : ?>
                    <div class="post featured-post-lg">
                        <div class="details clearfix">
                            <h2 class="post-title">
                                <a href="<?= ROOT_URL ?>single-posts.php?id=<?= $featured['id'] ?>"><?= $featured['title'] ?></a>
                            </h2>
                            <ul class="meta list-inline mb-0">
                                <?php
                                $author_id = $featured['staff_uuid'];
                                $author_query = "SELECT * FROM users WHERE uuid = '$author_id'";
                                $author_result = mysqli_query($connection, $author_query);
                                $author = mysqli_fetch_assoc($author_result);

                                ?>
                                <li class="list-inline-item">
                                    <a href="#"><?= $author['first_name'] ?></a>
                                </li>
                                <li class="list-inline-item"><?= date("M d, Y - H:i", strtotime($featured['date_time'])) ?></li>
                            </ul>
                        </div>
                        <a href="#">
                            <div class="thumb rounded">
                                <div class="inner data-bg-image"><img src="./images/<?= $featured['thumbnail'] ?>" alt=""></div>
                            </div>
                        </a>
                    </div>
                <?php endif ?>
            </div>
            <div class="col-lg-4">
                <div class="post-tabs rounded bordered">
                    <ul class="nav nav-tabs nav-pills nav-fill" id="postTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button aria-controls="popular" aria-selected="true" class="nav-link active" data-bs-target="#popular" data-bs-toggle="tab" id="popular-tab" role="tab" type="button">Xem Nhiều</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button aria-controls="popular" aria-selected="false" class="nav-link" data-bs-target="#recent" data-bs-toggle="tab" id="recent-tab" role="tab" type="button">Gần đây</button>
                        </li>
                    </ul>

                    <!-- content  -->
                    <div class="tab-content" id="postsTabContent">
                        <!-- loader -->
                        <div class="lds-dual-ring"></div>
                        <!-- pop post  -->

                        <div class="tab-pane fade show active" id="popular" aria-labelledby="popular-tab" role="tabpanel">
                            <!-- post  -->
                            <div class="post post-list-sm circle">
                                <div class="thumb circle">
                                    <a href="#">
                                        <div class="inner">
                                            <img src="images/robin.jpg" alt="">
                                        </div>
                                    </a>
                                </div>
                                <div class="details clearfix">
                                    <h6 class="post-title my-0">
                                        <a href="#">nguyen hoang duy, ngo cong hoang, pham hoang viet</a>
                                    </h6>
                                    <ul class="meta list-inline mt-1 mb-0">
                                        <li class="list-inline-item">09 January 2002</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- post2  -->
                            <div class="post post-list-sm circle">
                                <div class="thumb circle">
                                    <a href="#">
                                        <div class="inner">
                                            <img src="images/robin.jpg" alt="">
                                        </div>
                                    </a>
                                </div>
                                <div class="details clearfix">
                                    <h6 class="post-title my-0">
                                        <a href="#">nguyen hoang duy, ngo cong hoang, pham hoang viet</a>
                                    </h6>
                                    <ul class="meta list-inline mt-1 mb-0">
                                        <li class="list-inline-item">09 January 2002</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- post3  -->
                            <div class="post post-list-sm circle">
                                <div class="thumb circle">
                                    <a href="#">
                                        <div class="inner">
                                            <img src="images/robin.jpg" alt="">
                                        </div>
                                    </a>
                                </div>
                                <div class="details clearfix">
                                    <h6 class="post-title my-0">
                                        <a href="#">nguyen hoang duy, ngo cong hoang, pham hoang viet</a>
                                    </h6>
                                    <ul class="meta list-inline mt-1 mb-0">
                                        <li class="list-inline-item">09 January 2002</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- post4  -->
                            <div class="post post-list-sm circle">
                                <div class="thumb circle">
                                    <a href="#">
                                        <div class="inner">
                                            <img src="images/robin.jpg" alt="">
                                        </div>
                                    </a>
                                </div>
                                <div class="details clearfix">
                                    <h6 class="post-title my-0">
                                        <a href="#">nguyen hoang duy, ngo cong hoang, pham hoang viet</a>
                                    </h6>
                                    <ul class="meta list-inline mt-1 mb-0">
                                        <li class="list-inline-item">09 January 2002</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- recent -->
                        <div class="tab-pane fade" id="recent" aria-labelledby="recent-tab" role="tabpanel">
                            <!-- post  -->
                            <?php while ($recent_newss = mysqli_fetch_assoc($recent_news)) : ?>
                                <div class="post post-list-sm circle">
                                    <div class="thumb circle">
                                        <a href="#">
                                            <div class="inner">
                                                <img src="./images/<?= $recent_newss['thumbnail'] ?>" alt="">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="details clearfix">
                                        <h6 class="post-title my-0">
                                            <a href="<?= ROOT_URL ?>single-posts.php?id=<?= $recent_newss['id'] ?>"><?= $recent_newss['title'] ?></a>
                                        </h6>
                                        <ul class="meta list-inline mt-1 mb-0">
                                            <li class="list-inline-item"><?= date("M d, Y - H:i", strtotime($recent_newss['date_time'])) ?></li>
                                        </ul>
                                    </div>
                                </div>
                            <?php endwhile ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- main content -->

<section class="main-content">
    <div class="container-xl">
        <div class="row gy-4">
            <!-- left side section -->
            <div class="col-lg-8">
                <div class="section-header">
                    <h3 class="section-title">Tin Được Xem Nhiều</h3>
                </div>

                <div class="padding-30 rounded bordered">
                    <div class="row gy-5">
                        <div class="col-sm-6">
                            <!-- post -->
                            <div class="post">
                                <div class="thumb rounded">
                                    <a href="#">
                                        <div class="inner">
                                            <img src="images/robin.jpg" alt="">
                                        </div>
                                    </a>
                                </div>

                                <ul class="meta list-inline mt-4 mb-0">
                                    <li class="list-inline-item">
                                        <a href="#">
                                            <img class="author" src="images/Unknown_person.jpg" alt="">
                                            Hoàng Duy
                                        </a>
                                    </li>

                                    <li class="list-inline-item">09 January 2002</li>
                                </ul>

                                <h5 class="post-title mb-3 mt-3">
                                    <a href="#">Hoang Duy, Cong Hoang, Hoang Viet </a>
                                </h5>

                                <p class="excerpt mb-0">
                                    This is Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aut, aliquam.
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="post post-list-sm square">
                                <div class="thumb rounded">
                                    <a href="#">
                                        <div class="inner">
                                            <img src="images/robin.jpg" alt="">
                                        </div>
                                    </a>
                                </div>

                                <div class="details clearfix">
                                    <h6 class="post-title my-0">
                                        <a href="#">
                                            Hoang duy cong hoang hoang viet
                                        </a>
                                    </h6>
                                </div>
                            </div>

                            <div class="post post-list-sm square">
                                <div class="thumb rounded">
                                    <a href="#">
                                        <div class="inner">
                                            <img src="images/robin.jpg" alt="">
                                        </div>
                                    </a>
                                </div>

                                <div class="details clearfix">
                                    <h6 class="post-title my-0">
                                        <a href="#">
                                            Huu huan cao long trong luong
                                        </a>
                                    </h6>
                                </div>
                            </div>

                            <div class="post post-list-sm square">
                                <div class="thumb rounded">
                                    <a href="#">
                                        <div class="inner">
                                            <img src="images/robin.jpg" alt="">
                                        </div>
                                    </a>
                                </div>

                                <div class="details clearfix">
                                    <h6 class="post-title my-0">
                                        <a href="#">
                                            Quang vinh thanh nhan trung hieu
                                        </a>
                                    </h6>
                                </div>
                            </div>

                            <div class="post post-list-sm square">
                                <div class="thumb rounded">
                                    <a href="#">
                                        <div class="inner">
                                            <img src="images/robin.jpg" alt="">
                                        </div>
                                    </a>
                                </div>

                                <div class="details clearfix">
                                    <h6 class="post-title my-0">
                                        <a href="#">
                                            sang tran bao hoang cong hoang
                                        </a>
                                    </h6>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div style="height: 100px;"></div>

                <div class="section-header">
                    <h3 class="section-title">Những chủ đề tin tức nóng hổi khác</h3>
                    <div class="slick-arrows-top">
                        <buttton class="carousel-topNav-prev slick-custom-buttons" type="button" data-role="none" aria-label="Previous">
                            <i class="icon-arrow-left"></i>
                        </buttton>
                        <buttton class="carousel-topNav-next slick-custom-buttons" type="button" data-role="none" aria-label="Next">
                            <i class="icon-arrow-right"></i>
                        </buttton>
                    </div>
                </div>

                <div class="row post-carousel-twoCol post-carousel">
                    <div class="post post-over-content col-md-6">
                        <div class="details clearfix">
                            <h4 class="post-title">
                                <a href="TinNongYTe.php">Tin Nóng Y Tế</a>
                            </h4>
                        </div>
                        <a href="#">
                            <div class="thumb rounded">
                                <div class="inner">
                                    <img src="images/PickNewsTopic/TinNong.png" alt="">
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="post post-over-content col-md-6">
                        <div class="details clearfix">
                            <h4 class="post-title">
                                <a href="#">Blog Thầy Thuốc</a>
                            </h4>
                        </div>
                        <a href="#">
                            <div class="thumb rounded">
                                <div class="inner">
                                    <img src="images/PickNewsTopic/BlogThayThuoc.png" alt="">
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="post post-over-content col-md-6">
                        <div class="details clearfix">
                            <h4 class="post-title">
                                <a href="#">Những Hi Sinh Thầm Lặng</a>
                            </h4>
                        </div>
                        <a href="#">
                            <div class="thumb rounded">
                                <div class="inner">
                                    <img src="images/PickNewsTopic/HySinhThamLang.png" alt="">
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="post post-over-content col-md-6">
                        <div class="details clearfix">
                            <h4 class="post-title">
                                <a href="#">Mẹo Sống Khỏe</a>
                            </h4>
                        </div>
                        <a href="#">
                            <div class="thumb rounded">
                                <div class="inner">
                                    <img src="images/PickNewsTopic/MeoSongKhoe.png" alt="">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="spacer" data-height="50"></div>

                <!-- main news section -->

                <div class="section-header">
                    <h3 class="section-title">Tin Tức</h3>
                </div>

                <div class="padding-30 rounded bordered">

                    <div class="row">
                        <?php while ($newss = mysqli_fetch_assoc($news)) : ?>
                            <div class="col-md-12 col-sm-6">
                                <!-- post -->
                                <div class="post post-list clearfix">
                                    <div class="thumb rounded">
                                        <a href="<?= ROOT_URL ?>single-posts.php?id=<?= $newss['id'] ?>">
                                            <div class="inner">
                                                <img src="images/<?= $newss['thumbnail'] ?>" alt="">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="details">
                                        <?php
                                        $author_id = $newss['staff_uuid'];
                                        $author_image_query = "SELECT * FROM staffs_information WHERE staff_uuid = '$author_id'";
                                        $author_image_result = mysqli_query($connection, $author_image_query);
                                        $author_image = mysqli_fetch_assoc($author_image_result);

                                        $author_name_query = "SELECT * FROM users WHERE uuid = '$author_id'";
                                        $author_name_result = mysqli_query($connection, $author_name_query);
                                        $author_name = mysqli_fetch_assoc($author_name_result);

                                        ?>
                                        <ul class="meta list-inline mb-3">
                                            <li class="list-inline-item">
                                                    <img src="./images/<?= $author_image['image'] ?>" class="author" alt="">
                                                <?= $author_name['first_name'] ?>
                                            </li>
                                            <li class="list-inline-item"><?= date("M d, Y - H:i", strtotime($newss['date_time'])) ?></li>

                                        </ul>

                                        <h5 class="post-title">
                                            <a href="<?= ROOT_URL ?>single-posts.php?id=<?= $newss['id'] ?>">
                                                <?= $newss['title'] ?>
                                            </a>
                                        </h5>
                                        <p class="excerpt mb-0">
                                            <?= substr($newss['body'], 0, 300) ?>....
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile ?>

                        <div class="text-center">
                            <button class="loadMore" id="loadMore">Xem Thêm</button>
                        </div>

                    </div>
                    <!-- left part end here -->


                </div>
                <!-- right part start here -->
            </div>
            <!-- right side -->
            <div class="col-lg-4">
                <div class="sidebar">
                    <div class="widget rounded">
                        <div class="widget-about text-center">
                            <img src="images/favicon.png" class="logo" alt="">
                            <p class="mb-4" style="text-align: justify;">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi, corrupti illo placeat obcaecati magnam quod atque nemo nihil fugit voluptatibus molestiae pariatur ea? Illum molestias minus aut quod, veniam cumque!</p>
                        </div>
                    </div>

                    <div class="widget rounded">
                        <div class="widget-header text-center">
                            <h3 class="widget-title">Tin Tức Được Quan Tâm</h3>
                        </div>

                        <div class="widget-content">
                            <div class="post post-list-sm circle">
                                <div class="thumb circle">
                                    <span class="number">1</span>
                                    <a href="#">
                                        <div class="inner">
                                            <img src="images/robin.jpg" alt="">
                                        </div>
                                    </a>
                                </div>

                                <div class="details clearfix">
                                    <h6 class="post-title my-0">
                                        <a href="#">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Minima, quisquam?</a>
                                    </h6>
                                </div>
                            </div>

                            <div class="post post-list-sm circle">
                                <div class="thumb circle">
                                    <span class="number">2</span>
                                    <a href="#">
                                        <div class="inner">
                                            <img src="images/robin.jpg" alt="">
                                        </div>
                                    </a>
                                </div>

                                <div class="details clearfix">
                                    <h6 class="post-title my-0">
                                        <a href="#">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Minima, quisquam?</a>
                                    </h6>
                                </div>
                            </div>

                            <div class="post post-list-sm circle">
                                <div class="thumb circle">
                                    <span class="number">3</span>
                                    <a href="#">
                                        <div class="inner">
                                            <img src="images/robin.jpg" alt="">
                                        </div>
                                    </a>
                                </div>

                                <div class="details clearfix">
                                    <h6 class="post-title my-0">
                                        <a href="#">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Minima, quisquam?</a>
                                    </h6>
                                </div>
                            </div>

                            <div class="post post-list-sm circle">
                                <div class="thumb circle">
                                    <span class="number">4</span>
                                    <a href="#">
                                        <div class="inner">
                                            <img src="images/robin.jpg" alt="">
                                        </div>
                                    </a>
                                </div>

                                <div class="details clearfix">
                                    <h6 class="post-title my-0">
                                        <a href="#">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Minima, quisquam?</a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="widget rounded">
                        <div class="widget-header text-center">
                            <h3 class="widget-title">Chủ Đề</h3>
                        </div>
                        <div class="widget-content"></div>
                        <ul class="list">
                            <li><a href="#">#covid19</a><span>(7)</span></li>
                            <li><a href="#">#vaccine</a><span>(7)</span></li>
                            <li><a href="#">#benhmantinh</a><span>(7)</span></li>
                            <li><a href="#">#suckhoetamthan</a><span>(7)</span></li>
                        </ul>
                    </div>

                    <div class="widget rounded">
                        <div class="widget-header text-center">
                            <h3 class="widget-title">Đóng góp ý kiến</h3>
                        </div>
                        <div class="widget-content">
                            <span class="newsletter-headline text-center mb-3">Bạn muốn góp ý gì cho bệnh viện chúng tôi?</span>
                            <form action="#">
                                <div class="mb-2">
                                    <input type="email" class="form-control w-100 text-center">
                                </div>
                                <button class="btn btn-default btn-full">Xác Nhận</button>
                            </form>
                        </div>
                    </div>

                    <div class="widget rounded">
                        <div class="widget-header text-center">
                            <h3 class="widget-title">DÒNG SỰ KIỆN</h3>
                        </div>
                        <div class="widget-content">
                            <div class="post-carousel-widget">

                                <div class="post post-carousel">
                                    <div class="thumb rounded">
                                        <a href="#">
                                            <div class="inner">
                                                <img src="images/robin.jpg" alt="">
                                            </div>
                                        </a>
                                    </div>
                                    <h5 class="post-title mb-0 mt-4">
                                        <a href="#">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam, repellat!</a>
                                    </h5>
                                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Velit nam quibusdam autem delectus facilis voluptatum repellendus, pariatur reprehenderit repudiandae expedita?</p>
                                </div>

                                <div class="post post-carousel">
                                    <div class="thumb rounded">
                                        <a href="#">
                                            <div class="inner">
                                                <img src="images/gojou.jpg" alt="">
                                            </div>
                                        </a>
                                    </div>
                                    <h5 class="post-title mb-0 mt-4">
                                        <a href="#">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam, repellat!</a>
                                    </h5>
                                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Velit nam quibusdam autem delectus facilis voluptatum repellendus, pariatur reprehenderit repudiandae expedita?</p>
                                </div>

                                <div class="post post-carousel">
                                    <div class="thumb rounded">
                                        <a href="#">
                                            <div class="inner">
                                                <img src="images/Unknown_person.jpg" alt="">
                                            </div>
                                        </a>
                                    </div>
                                    <h5 class="post-title mb-0 mt-4">
                                        <a href="#">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam, repellat!</a>
                                    </h5>
                                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Velit nam quibusdam autem delectus facilis voluptatum repellendus, pariatur reprehenderit repudiandae expedita?</p>
                                </div>
                            </div>
                            <div class="slick-arrows-bot">
                                <buttton class="carousel-botNav-prev slick-custom-buttons" type="button" data-role="none" aria-label="Previous">
                                    <i class="icon-arrow-left"></i>
                                </buttton>
                                <buttton class="carousel-botNav-next slick-custom-buttons" type="button" data-role="none" aria-label="Next">
                                    <i class="icon-arrow-right"></i>
                                </buttton>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include 'partials/footer.php'
?>