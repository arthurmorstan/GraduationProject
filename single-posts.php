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

?>
<style>
    body {
        background-color: white;
        background-size: 100% 300%;
        font-family: "Lora", serif;
        color: #000;
    }

    h1 {
        color: #000;
    }
    .post-content.post-container {
        margin-top: 300px;
    }
    img.header-image {
        width: 700px;
        height: 400px;
    }

    .post-content.post-container p{
        margin-top: 30px;
    }


</style>

<section class="post-header">
    <div class="header-content post-container">
        <!-- Back to pick topic section -->
        <a href="index.php" class="toPickTopic">Xem tin tức chủ đề khác</a>
        <!-- Title -->
        <h1 class="header-title">
            <?= $post['title'] ?>
        </h1>
        <!-- post author -->
        <div class="post-author">
            <?php
            $author_id = $post['staff_uuid'];
            $author_query = "SELECT * FROM users WHERE uuid = '$author_id'";
            $author_result = mysqli_query($connection, $author_query);
            $author = mysqli_fetch_assoc($author_result);

            $image_query = "SELECT * FROM staffs_information WHERE staff_uuid = '$author_id'";
            $image_result = mysqli_query($connection, $image_query);
            $image = mysqli_fetch_assoc($image_result);

            ?>
            <div class="post-author-avatar">
                <img src="images/<?= $image['image'] ?>" class="author" alt="">
            </div>
            <div class="post-author-infor">
                <h5><?= $author['first_name'] ?></h5>
                <small><?= date("M d, Y - H:i", strtotime($post['date_time'])) ?></small>
            </div>
        </div>
        <!-- post Image -->
        <img src="images/<?= $post['thumbnail'] ?>" class="header-image">
    </div>
</section>

<section class="post-content post-container">
    <p><?= $post['body'] ?></p>

</section>

<?php
include 'partials/footer.php'
?>