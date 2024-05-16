<?php 
require 'config/database.php';

if(isset($_POST['submit'])) {
    $staff_uuid = $_SESSION['user-id'];
    $title = $_POST['title'];
    $slug = $_POST['slug'];
    $body = $_POST['body'];
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $categories_id = filter_var($_POST['categories'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

    // set feature to 0 if uncheck
    $is_featured = $is_featured == 1 ?: 0;

    // check form data
    if(!$title) {
        $_SESSION['add-news'] = "Điền tiêu đề";
    }
    elseif(!$body) {
        $_SESSION['add-news'] = "Điền nội dung";
    }
    elseif(!$thumbnail['name']) {
        $_SESSION['add-news'] = "Chọn ảnh cho bài viết";
    }
    else {
        // Thumbnail section
        // rename the thumbnail
        $time = time();  //make each image name unique using current time
        $thumbnail_name = $time . $thumbnail['name'];
        $thumbnail_tmp_name = $thumbnail['tmp_name'];
        $thumbnail_destination_path = '../images/' . $thumbnail_name;

        // make sure file is an image
        $allowed_files = ['png', 'jpg', 'jpeg'];
        $extension = explode('.', $thumbnail_name);
        $extension = end($extension);
        if(in_array($extension, $allowed_files)) {
            // make sure the image file not to large (1mb+)
            if($thumbnail['size'] < 2000000) {
                // upload the file
                move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
            }
            else {
                $_SESSION['add-news'] = "File ảnh không được lớn hơn 2mb";
            }
        }
        else {
            $_SESSION['add-news'] = "File ảnh phải thuộc định dạng png, jpg hoặc jpeg";
        }
    }

    // get back to add news page if there is any problem
    if (isset($_SESSION['add-news'])) {
        $_SESSION['add-news-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin-dashboard/add-news.php');
        die();
    }
    else {
        // set all other feature to 0 if this news is 1
        if($is_featured == 1) {
            $zero_all_is_featured_query = "UPDATE posts SET is_featured = 0 WHERE categories_id = $categories_id";
            $zero_all_is_featured_result = mysqli_query($connection, $zero_all_is_featured_query);
        }

        // insert news to db
        $query = "INSERT INTO posts (title, slug, body, thumbnail, categories_id, staff_uuid, is_featured, active) VALUES ('$title', '$slug', '$body', '$thumbnail_name', $categories_id, '$staff_uuid', $is_featured, 0)";
        $result = mysqli_query($connection, $query);

    }

    if(!mysqli_errno($connection)){
        // get to sign in page
        $_SESSION['add-news-success'] = "Thêm tin thành công";
        header('location: ' . ROOT_URL . 'admin-dashboard/manage-news.php');
        die();
    }
}

header('location: ' . ROOT_URL . 'admin-dashboard/add-news.php');
die();