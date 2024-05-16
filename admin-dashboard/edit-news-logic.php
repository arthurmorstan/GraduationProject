<?php
require 'config/database.php';

// when edit news was clicked
if(isset($_POST['submit'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = $_POST['title'];
    $slug = $_POST['slug'];
    $body = $_POST['body'];
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $categories_id = filter_var($_POST['categories'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

    // set feature to 0 if uncheck
    $is_featured = $is_featured == 1 ?: 0;

    // check valid input
    if(!$title) {
        $_SESSION['edit-news'] = "Không thể chỉnh sửa tin tức. Vui lòng nhập đầy đủ thông tin";
    }
    elseif(!$body) {
        $_SESSION['edit-news'] = "Không thể chỉnh sửa tin tức. Vui lòng nhập đầy đủ thông tin";
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
                if($thumbnail['size'] < 2000000) {
                    // upload the file
                    move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
                }
                else {
                    $_SESSION['edit-news'] = "File ảnh không được lớn hơn 2mb";
                }
            }
            else {
                $_SESSION['edit-news'] = "File ảnh phải thuộc định dạng png, jpg hoặc jpeg";
            }
        }
    }

        // get back to add news page if there is any problem
        if (isset($_SESSION['edit-news'])) {
            header('location: ' . ROOT_URL . 'admin-dashboard/edit-news.php');
            die();
        }
        else {
            // set all other feature to 0 if this news is 1
            if($is_featured == 1) {
                $zero_all_is_featured_query = "UPDATE posts SET is_featured = 0 WHERE categories_id = $categories_id";
                $zero_all_is_featured_result = mysqli_query($connection, $zero_all_is_featured_query);
            }

            // set new thumbnail
            $thumbnail_to_insert = $thumbnail_name ?? $previous_thumbnail_name;
    
            // insert news to db
            $query = "UPDATE posts SET title='$title', slug='$slug', body='$body', categories_id = $categories_id, thumbnail='$thumbnail_to_insert', is_featured= $is_featured WHERE id = $id LIMIT 1";
            $result = mysqli_query($connection, $query);
    
        }

        if(!mysqli_errno($connection)){
            $_SESSION['edit-news-success'] = "chỉnh sửa tin thành công";
        }

}

header('location:' . ROOT_URL . 'admin-dashboard/manage-news.php');
die();