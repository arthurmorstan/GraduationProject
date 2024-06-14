<?php
require 'config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);


    // approved news
    $approved_news_query = "UPDATE posts SET active = 1, is_featured = 1 WHERE id = $id LIMIT 1";
    $approved_news_result = mysqli_query($connection, $approved_news_query);

    // set all other feature to 0 if this news is 1

        // get categories_id of the news
        $get_categories_query = "SELECT categories_id FROM posts WHERE id = $id";
        $categories_result = mysqli_query($connection, $get_categories_query);
        $row = mysqli_fetch_assoc($categories_result);
        $categories_id = $row['categories_id'];

        $zero_all_is_featured_query = "UPDATE posts SET is_featured = 0 WHERE categories_id = $categories_id AND id != $id";
        $zero_all_is_featured_result = mysqli_query($connection, $zero_all_is_featured_query);

    if (mysqli_errno($connection)) {
        $_SESSION['delete-news'] = "thêm news thất bại";
    }
}

header('location: ' . ROOT_URL . "admin-dashboard/manage-news.php");
die();
