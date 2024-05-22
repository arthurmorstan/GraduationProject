<?php
require 'config/database.php';

if (isset($_GET['cid'])) {
    $cid = filter_var($_GET['cid'], FILTER_SANITIZE_NUMBER_INT);

    // get newes from db
    $query = "SELECT * FROM comments WHERE cid = $cid";
    $result = mysqli_query($connection, $query);

    // make sure got back only 1 news
    if (mysqli_num_rows($result) == 1) {
            // delete news
            $delete_comment_query = "DELETE FROM comments WHERE cid = $cid LIMIT 1";
            $delete_comment_result = mysqli_query($connection, $delete_comment_query);

            if (mysqli_errno($connection)) {
                $_SESSION['delete-news'] = "Xóa comment thất bại";
            }
        }
}

echo "Xóa tin thành công vui lòng nhấn quay lại";
die();