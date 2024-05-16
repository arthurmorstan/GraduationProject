<?php 
require 'config/database.php';

if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // update categories to uncategorized if one category is deleted
    $update_query = "UPDATE posts SET categories_id = 9 WHERE categories_id = $id";
    $update_result = mysqli_query($connection, $update_query);

    if(!mysqli_errno($connection)){
    // delete the categories but not in database
    $query = "UPDATE news_categories SET active = 0 WHERE id = $id LIMIT 1";
    $result = mysqli_query($connection, $query);
    $_SESSION['delete-categories-success'] = "Xóa phân loại thành công";
    }
}

header('location: '. ROOT_URL . 'admin-dashboard/manage-categories.php');
die();