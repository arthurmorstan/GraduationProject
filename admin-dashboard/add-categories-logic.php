<?php 
require 'config/database.php';

if(isset($_POST['submit'])) {
    // get form data
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $thumbnail = $_FILES['thumbnail'];

    if(!$title){
        $_SESSION['add-categories'] = 'Vui lòng nhập tiêu đề';
    }
    elseif (!$description) {
        $_SESSION['add-categories'] = 'Vui lòng nhập miêu tả';
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

    // get back to add categories if there is an error
    if(isset($_SESSION['add-categories'])) {
        $_SESSION['add-categories-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin-dashboard/add-categories.php');
        die();
    } 
    else {
        // insert categories into db
        $query = "INSERT INTO news_categories (title, description, thumbnail) VALUES ('$title', '$description', '$thumbnail_name')";
        $result = mysqli_query($connection, $query);
        if(mysqli_errno($connection)) {
            $_SESSION['add-categories'] = "Không thể thêm phân loại";
            header('location: '. ROOT_URL . './admin-dashboard/add-categories.php');
            die();
        }
        else {
            $_SESSION['add-categories-success'] = "Phân loại $title đã thêm thành công";
            header('location: '. ROOT_URL . './admin-dashboard/manage-categories.php');
            die();
        }
    }
}