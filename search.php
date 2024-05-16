<?php 
require 'partials/header.php';

if(isset($_GET['search']) && isset($_GET['submit'])) {
    $search = filter_var($_GET['search'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $query = "SELECT * FROM posts WHERE title LIKE '%$search%' ORDER BY date_time DESC";
    $news = mysqli_query($connection, $query);
}
else {
    header('location: ' . ROOT_URL . 'index.php');
    die();
}

?>

<style>
    body {
        background: #fff;
    }

    .excerpt {
        color: black;
    }

    .post.post-list {
        margin-left: 200px;
    }
    p {
        color: black;
    }
</style>

<div class="row">
<?php while ($newss = mysqli_fetch_assoc($news)) : ?>
    <div class="col-md-12 col-sm-6">
        <!-- post -->
        <div class="post post-list clearfix">
            <div class="thumb rounded">
                <a href="<?= ROOT_URL ?><?= $newss['id'] ?>/<?= $newss['slug'] ?>">
                    <div class="inner">
                        <img src="images/<?= $newss['thumbnail'] ?>" alt="">
                    </div>
                </a>
            </div>
            <div class="details">
                <?php
                        $author_id = $newss['author_id'];
                        $author_query = "SELECT * FROM users WHERE id = '$author_id'";
                        $author_result = mysqli_query($connection, $author_query);
                        $author = mysqli_fetch_assoc($author_result);

                ?>
                <ul class="meta list-inline mb-3">
                    <li class="list-inline-item">
                        <a href="single-posts.php" target="_blank">
                            <img src="./images/<?= $author['avatar'] ?>" class="author" alt="">
                        </a>
                        <?= $author['firstname'] ?>
                    </li>
                    <li class="list-inline-item"><?= date("M d, Y - H:i", strtotime($newss['date_time'])) ?></li>

                </ul>

                <h5 class="post-title">
                    <a href="<?= ROOT_URL ?><?= $newss['id'] ?>/<?= $newss['slug'] ?>">
                        <?= $newss['title'] ?>
                    </a>
                </h5>
                <p class="excerpt mb-0">
                    <?= substr($newss['body'], 0, 200) ?>....
                </p>
            </div>
        </div>
    </div>
<?php endwhile ?>
</div>

<?php include 'partials/footer.php' ?>