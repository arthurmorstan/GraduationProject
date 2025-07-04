<?php
require 'config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // get newes from db
    $query = "SELECT * FROM posts WHERE id = $id";
    $result = mysqli_query($connection, $query);

    // make sure got back only 1 news
    if (mysqli_num_rows($result) == 1) {
            // delete news
            $delete_news_query = "UPDATE posts SET active = 0 WHERE id = $id LIMIT 1";
            $delete_news_result = mysqli_query($connection, $delete_news_query);

            if (mysqli_errno($connection)) {
                $_SESSION['delete-news'] = "Xóa news thất bại";
            }
        }
}

header('location: ' . ROOT_URL . "admin-dashboard/manage-news.php");
die();
