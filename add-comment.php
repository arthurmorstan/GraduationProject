<?php
require 'config/database.php';

if (isset($_POST['commentSubmit'])) {
    $user_uuid = $_POST['user_uuid'];
    $message = $_POST['message'];
    $post_id = $_POST['post_id'];

    $query = "INSERT INTO comments (user_uuid, post_id, message) 
              VALUES ('$user_uuid', '$post_id', '$message')";
    $result = mysqli_query($connection, $query);

    if(mysqli_errno($connection)) {
        echo "Lỗi: " . mysqli_error($connection);
    }
    else {
        echo "Đăng bình luận thành công. Vui lòng ấn quay lại trang!";
    }
}
