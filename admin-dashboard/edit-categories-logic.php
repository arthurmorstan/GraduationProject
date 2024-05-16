<?php 
require 'config/database.php';

if(isset($_POST['submit'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $slug = $_POST['slug'];
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $thumbnail = $_FILES['thumbnail'];

    // check input
    if(!$title || !$description) {
        $_SESSION['edit-categories'] = "Tiêu đề hoặc nội dung không được để trống";
    }
    else {
        // delete previoust thumbnail
        if($thumbnail['name']){
            $previous_thumbnail_path = '../images/' . $previous_thumbnail_name;
            if($previous_thumbnail_path) {
                unlink($previous_thumbnail_path);
            }


            // work on new thumbnail
            // rename image
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
                if($thumbnail['size'] < 5000000) {
                    // upload the file
                    move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
                }
                else {
                    $_SESSION['edit-categories'] = "File ảnh không được lớn hơn 5mb";
                }
            }
            else {
                $_SESSION['edit-categories'] = "File ảnh phải thuộc định dạng png, jpg hoặc jpeg";
            }
        }
    }

        // get back to add news page if there is any problem
        if (isset($_SESSION['edit-categories'])) {
            header('location: ' . ROOT_URL . 'admin-dashboard/edit-categories.php');
            die();
        }     
        else {
            // set new thumbnail
            $thumbnail_to_insert = $thumbnail_name ?? $previous_thumbnail_name;
    
            $query = "UPDATE news_categories SET title = '$title', slug='$slug', description = '$description', thumbnail='$thumbnail_to_insert' WHERE id=$id LIMIT 1";
            $result = mysqli_query($connection, $query);
    
            if(mysqli_errno($connection)){
                $_SESSION['edit-categories'] = "Error";
            }
            else {
                $_SESSION['edit-categories-success'] = "OK";
            }
        }

        if(!mysqli_errno($connection)){
            $_SESSION['edit-categories-success'] = "chỉnh sửa phân loại thành công";
        }
}

header('location: '. ROOT_URL . 'admin-dashboard/manage-categories.php');
die();