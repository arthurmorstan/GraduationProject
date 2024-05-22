<?php
include 'partials/header.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE id = $id";
    $result = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'index.php');
    die();
}

// fetch categories id from database
$query1 = "SELECT id FROM news_categories";
$categorie_id = mysqli_query($connection, $query1);

// show most viewed new from db
$query3 = "SELECT * FROM posts WHERE categories_id = $id AND active = 1 ORDER BY views DESC";
$most_views_news = mysqli_query($connection, $query3);

// fetch categories id from database 2
$view_all_query = "SELECT id FROM news_categories WHERE id = $id";
$view_all_result = mysqli_query($connection, $view_all_query);
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

    .section-header {
        display: flex;
        margin-bottom: 50px;
    }

    .section-header .dropdown {
        margin-left: 300px;
    }

    .dropdown button{
        background-color: #4d92f4;
        color: white;
        padding: 10px 15px;
        border: none;
        cursor: pointer;
    }

    .dropdown button:hover {
        background-color: #2f81f4;
    }

    .dropdown a{
        display: block;
        color: black;
        text-decoration: none;
        padding: 10px 15px;
    }

    .dropdown .content {
        display: none;
        position: absolute;
        background-color: hsl(0, 0%, 95%);
        min-width: 200px;
        box-shadow: 2px 2px 5px hsla(0, 0%, 0%, 0.8);
        padding-right: 0;
    }

    .dropdown:hover .content {
        display: block;
    }
</style>

<section class="main-content">
    <div class="container-xl">
        <div class="row gy-4">
            <div class="col-lg-8">
                <div class="section-header">
                    <h3 class="sectiob-title">
                        Tin tức
                    </h3>
                    <div class="dropdown">
                        <button>Tin Xem Nhiều</button>
                        <?php while ($view_all = mysqli_fetch_assoc($view_all_result)) : ?>
                        <div class="content">
                            <a href="<?= ROOT_URL ?>view-all-likes.php?id=<?= $view_all['id'] ?>">Tin Được Yêu Thích</a>
                        </div>
                        <?php endwhile ?>
                    </div>
                </div>
                    <div class="padding-30 rounded bordered">
                        <?php while ($most_views = mysqli_fetch_assoc($most_views_news)) : ?>
                            <div class="col-md-12 col-sm-6">
                                <!-- post -->
                                <div class="post post-list clearfix">
                                    <div class="thumb rounded">
                                        <a href="<?= ROOT_URL ?>count_views-logic.php?id=<?= $most_views['id'] ?>&slug=<?= $newss['slug'] ?>">
                                            <div class="inner">
                                                <img src="images/<?= $most_views['thumbnail'] ?>" alt="">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="details">
                                        <?php
                                        $author_id = $most_views['staff_uuid'];
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
                                            <li class="list-inline-item"><?= $most_views['views'] ?> lượt xem</li>

                                        </ul>

                                        <h5 class="post-title">
                                            <a href="<?= ROOT_URL ?>count_views-logic.php?id=<?= $most_views['id'] ?>&slug=<?= $most_views['slug'] ?>">
                                                <?= $most_views['title'] ?>
                                            </a>
                                        </h5>
                                        <p class="excerpt mb-0">
                                            <?= substr($most_views['body'], 0, 300) ?>....
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile ?>

                        <div class="text-center">
                            <button class="loadMore" id="loadMore">Xem Thêm</button>
                        </div>

                    </div>
            </div>
        </div>
    </div>
</section>

<?php
include 'partials/footer.php'
?>