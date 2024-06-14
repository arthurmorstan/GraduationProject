<?php
include 'partials/header.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    // $query = "SELECT * FROM posts WHERE id = $id";
    // $result = mysqli_query($connection, $query);
    // $post = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'index.php');
    die();
}

// fetch categories id from database 1
$query1 = "SELECT id FROM news_categories";
$categorie_id = mysqli_query($connection, $query1);

// fetch categories id from database 2
$view_all_query = "SELECT id FROM news_categories WHERE id = $id";
$view_all_result = mysqli_query($connection, $view_all_query);

// Show featured post from database
$featured_query = "SELECT * FROM posts WHERE is_featured = 1 AND categories_id = $id AND active = 1";
$featured_result = mysqli_query($connection, $featured_query);
$featured = mysqli_fetch_assoc($featured_result);

// show recent news from db
$recent_query = "SELECT * FROM posts WHERE categories_id = $id AND active = 1 ORDER BY date_time DESC LIMIT 4";
$recent_news = mysqli_query($connection, $recent_query);

// show news from db
$query2 = "SELECT * FROM posts WHERE categories_id = $id AND active = 1 ORDER BY date_time DESC";
$news = mysqli_query($connection, $query2);

// show most viewed new from db
$query3 = "SELECT * FROM posts WHERE categories_id = $id AND active = 1 ORDER BY views DESC LIMIT 4";
$most_views_news = mysqli_query($connection, $query3);

// fetch categories from database
$query4 = "SELECT * FROM news_categories WHERE active = 1 AND id != $id";
$categories = mysqli_query($connection, $query4);

// show most viewed new from db
$query5 = "SELECT * FROM posts WHERE categories_id = $id AND active = 1 ORDER BY views DESC LIMIT 1";
$most_views_newss = mysqli_query($connection, $query5);

// show most viewed new from db
$query6 = "SELECT * FROM posts WHERE categories_id = $id AND active = 1 ORDER BY views DESC LIMIT 4";
$most_views_newsss = mysqli_query($connection, $query6);

// show most liked news from db
$query7 = "SELECT * FROM posts WHERE categories_id = $id AND active = 1 ORDER BY likes DESC LIMIT 4";
$most_likes_news = mysqli_query($connection, $query7);

// fetch dòng sự kiện
$query8 = "SELECT * FROM posts WHERE categories_id = $id AND active = 1 ORDER BY views DESC LIMIT 3";
$dongsukien = mysqli_query($connection, $query8);
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

    .newsletter-donggop input,
    textarea {
        margin-bottom: 20px;
        border-radius: 10px;
    }

    .logo {
        margin-bottom: 40px;
    }

    .section-header {
        display: flex;
    }

    .section-header .viewMore {
        margin-left: 300px;
        background-color: aqua;
        color: black;
        width: 120px;
        text-align: center;
        padding: 10px;
        border-radius: 30px;
    }
    .section-header .viewMore:hover {
        background-color: rgb(1, 227, 227);
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
                                <a href="<?= ROOT_URL ?>count_views-logic.php?id=<?= $featured['id'] ?>&slug=<?= $featured['slug'] ?>"><?= $featured['title'] ?></a>
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
                            <?php while ($most_views = mysqli_fetch_assoc($most_views_news)) : ?>
                                <div class="post post-list-sm circle">
                                    <div class="thumb circle">
                                        <a href="#">
                                            <div class="inner">
                                                <img src="images/<?= $most_views['thumbnail'] ?>" alt="">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="details clearfix">
                                        <h6 class="post-title my-0">
                                            <a href="<?= ROOT_URL ?>count_views-logic.php?id=<?= $most_views['id'] ?>&slug=<?= $most_views['slug'] ?>"><?= $most_views['title'] ?></a>
                                        </h6>
                                        <ul class="meta list-inline mt-1 mb-0">
                                            <li class="list-inline-item"><?= $most_views['views'] ?> lượt xem</li>
                                        </ul>
                                    </div>
                                </div>
                            <?php endwhile ?>
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
                                            <a href="<?= ROOT_URL ?>count_views-logic.php?id=<?= $recent_newss['id'] ?>&slug=<?= $recent_newss['slug'] ?>"><?= $recent_newss['title'] ?></a>
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
            <?php while ($view_all = mysqli_fetch_assoc($view_all_result)) : ?>
                <div class="section-header">
                    <h3 class="section-title">Tin Được Xem Nhiều</h3>
                    <a href="<?= ROOT_URL ?>view-all-views.php?id=<?= $view_all['id'] ?>" class="viewMore">Xem Thêm <i class="fa-solid fa-arrow-right"></i></a>
                    </form>
                </div>
            <?php endwhile ?>    

                <div class="padding-30 rounded bordered">
                    <div class="row gy-5">
                        <div class="col-sm-6">
                            <!-- post -->
                            <?php while ($most_viewss = mysqli_fetch_assoc($most_views_newss)) : ?>
                                <div class="post">
                                    <div class="thumb rounded">
                                        <a href="#">
                                            <div class="inner">
                                                <img src="images/<?= $most_viewss['thumbnail'] ?>" alt="">
                                            </div>
                                        </a>
                                    </div>

                                    <h5 class="post-title mb-3 mt-3">
                                        <a href="<?= ROOT_URL ?>count_views-logic.php?id=<?= $most_viewss['id'] ?>&slug=<?= $most_viewss['slug'] ?>"><?= $most_viewss['title'] ?></a>
                                    </h5>

                                    <p class="excerpt mb-0">
                                        <?= substr($most_viewss['body'], 0, 300) ?>....
                                    </p>
                                </div>
                            <?php endwhile ?>
                        </div>

                        <div class="col-sm-6">
                            <?php while ($most_viewsss = mysqli_fetch_assoc($most_views_newsss)) : ?>
                                <div class="post post-list-sm square">
                                    <div class="thumb rounded">
                                        <a href="#">
                                            <div class="inner">
                                                <img src="images/<?= $most_viewsss['thumbnail'] ?>" alt="">
                                            </div>
                                        </a>
                                    </div>

                                    <div class="details clearfix">
                                        <h6 class="post-title my-0">
                                            <a href="<?= ROOT_URL ?>count_views-logic.php?id=<?= $most_viewsss['id'] ?>&slug=<?= $most_viewsss['slug'] ?>">
                                                <?= $most_viewsss['title'] ?>
                                            </a>
                                        </h6>
                                    </div>
                                </div>
                            <?php endwhile ?>
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
                    <?php while ($categoriess = mysqli_fetch_assoc($categories)) : ?>
                        <div class="post post-over-content col-md-6">
                            <div class="details clearfix">
                                <h4 class="post-title">
                                    <a href="<?= ROOT_URL ?><?= $categoriess['id'] ?>-<?= $categoriess['slug'] ?>"><?= "{$categoriess['title']}" ?></a>
                                </h4>
                            </div>
                            <a href="<?= ROOT_URL ?><?= $categoriess['id'] ?>-<?= $categoriess['slug'] ?>">
                                <div class="thumb rounded">
                                    <div class="inner">
                                        <img src="images/<?= $categoriess['thumbnail'] ?>" alt="">
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endwhile ?>
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
                                            <a href="<?= ROOT_URL ?>count_views-logic.php?id=<?= $newss['id'] ?>&slug=<?= $newss['slug'] ?>">
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
                            <img src="images/logo.png" class="logo" alt="">
                            <p class="mb-4" style="text-align: justify;">
                                Chào mừng bạn đến với Đa khoa G37! Chúng tôi tự hào là một trong những cơ sở y tế hàng đầu, cam kết mang đến dịch vụ chăm sóc sức khỏe toàn diện và chất lượng cao. Với đội ngũ y bác sĩ tận tâm, trang thiết bị hiện đại, và môi trường điều trị thân thiện, chúng tôi luôn sẵn sàng đáp ứng mọi nhu cầu y tế của bạn và gia đình. Tại Đa khoa G37, sức khỏe của bạn là sứ mệnh của chúng tôi. Hãy để chúng tôi chăm sóc và đồng hành cùng bạn trên con đường giữ gìn sức khỏe và nâng cao chất lượng cuộc sống.</p>
                        </div>
                    </div>

                    <div class="widget rounded">
                        <div class="widget-header text-center">
                            <h3 class="widget-title">Tin Tức Được Quan Tâm</h3>
                        </div>

                        <div class="widget-content">
                            <?php while ($most_likes = mysqli_fetch_assoc($most_likes_news)) : ?>
                                <div class="post post-list-sm circle">
                                    <div class="thumb circle">
                                        <span class="number">1</span>
                                        <a href="#">
                                            <div class="inner">
                                                <img src="./images/<?= $most_likes['thumbnail'] ?>" alt="">
                                            </div>
                                        </a>
                                    </div>

                                    <div class="details clearfix">
                                        <h6 class="post-title my-0">
                                            <a href="<?= ROOT_URL ?>count_views-logic.php?id=<?= $most_likes['id'] ?>&slug=<?= $most_likes['slug'] ?>"><?= $most_likes['title'] ?></a>
                                        </h6>
                                        <ul class="meta list-inline mt-1 mb-0">
                                            <li class="list-inline-item"><?= $most_likes['likes'] ?> lượt yêu thích</li>
                                        </ul>
                                    </div>
                                </div>
                            <?php endwhile ?>
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
                        <div class="widget-content newsletter-donggop">
                            <span class="newsletter-headline text-center mb-3">Bạn muốn góp ý gì cho bệnh viện chúng tôi?</span>
                            <form action="https://api.web3forms.com/submit" method="POST">
                                <div class="mb-2">
                                    <input type="hidden" name="access_key" value="158a7052-6b5a-4aa3-8420-746f072906a5">
                                    <input type="text" name="name" id="name" class="form-control w-100 text-center" placeholder="Nhập tên của bạn (không bắt buộc)">
                                    <input type="email" name="email" id="email" class="form-control w-100 text-center" placeholder="Nhập email của bạn" required>
                                    <textarea rows="4" name="message" id="message" class="form-control w-100 text-center" placeholder="điền ý kiến của bạn vào đây"></textarea>
                                </div>
                                <button type="submit" class="btn btn-default btn-full">Gửi</button>
                            </form>
                        </div>
                    </div>

                    <div class="widget rounded">
                        <div class="widget-header text-center">
                            <h3 class="widget-title">DÒNG SỰ KIỆN</h3>
                        </div>
                        <div class="widget-content">
                            <div class="post-carousel-widget">
                                <?php while ($dongsukienn = mysqli_fetch_assoc($dongsukien)) : ?>
                                <div class="post post-carousel">
                                    <div class="thumb rounded">
                                        <a href="<?= ROOT_URL ?>count_views-logic.php?id=<?= $dongsukienn['id'] ?>&slug=<?= $dongsukienn['slug'] ?>">
                                            <div class="inner">
                                                <img src="images/<?= $dongsukienn['thumbnail'] ?>" alt="">
                                            </div>
                                        </a>
                                    </div>
                                    <h5 class="post-title mb-0 mt-4">
                                        <a href="<?= ROOT_URL ?>count_views-logic.php?id=<?= $dongsukienn['id'] ?>&slug=<?= $dongsukienn['slug'] ?>"><?= $dongsukienn['title'] ?></a>
                                    </h5>
                                    <p><?= substr($dongsukienn['body'], 0, 100) ?></p>
                                </div>
                                <?php endwhile ?>
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