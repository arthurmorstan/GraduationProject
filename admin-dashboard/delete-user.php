<?php
require 'config/database.php';

if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // get user from db
    $query = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);

    // make sure got back only 1 user
    if(mysqli_num_rows($result) == 1) {
        $avatar_name = $user['avatar'];
        $avatar_path = '../images/' . $avatar_name;
        // delete image
        if($avatar_path) {
            unlink($avatar_path);
        }
    }


    $thumbnails_query = "SELECT thumbnail FROM posts WHERE author_id = $id";
    $thumbnails_result = mysqli_query($connection, $thumbnails_query);
    if(mysqli_num_rows($thumbnails_result) > 0){
        while($thumbnail = mysqli_fetch_assoc($thumbnails_result)){
            $thumbnail_path = '../images/' . $thumbnail['thumbnail'];
            // delete thumbnail from images folder
            if($thumbnail_path) {
                unlink($thumbnail_path);
            }
        }
    }


    // delete user
    $delete_user_query = "DELETE FROM users WHERE id = $id";
    $delete_user_result = mysqli_query($connection, $delete_user_query);

    if(mysqli_errno($connection)) {
        $_SESSION['delete-user'] = "Xóa người dùng thất bại";
    }
    else {
        $_SESSION['delete-user'] = "Xóa người dùng thành công";
    }
}

header('location: ' . ROOT_URL . "admin-dashboard/manage-user.php");