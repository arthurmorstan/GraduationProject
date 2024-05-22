<?php
require 'config/database.php';

    if (isset($_POST['submit'])) {
        $cid = $_POST['cid'];
        $message = $_POST['message'];

        $query = "UPDATE comments SET message = '$message' WHERE cid = $cid LIMIT 1";
        $result = mysqli_query($connection, $query);

        if(!mysqli_errno($connection)){
            echo "Chỉnh sửa bình luận thành công, vui lòng nhấn quay lại";
        }
    }