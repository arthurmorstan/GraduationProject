<?php 
require 'config/database.php';

// update user when submit
if(isset($_POST['submit'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['role'], FILTER_SANITIZE_NUMBER_INT);

    if(!$firstname || !$lastname) {
        $_SESSION['edit-user'] = "Tên và họ không được để trống";
    }
    else {
        // update user
        $query = "UPDATE users SET firstname='$firstname', lastname='$lastname', is_admin=$is_admin WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);

        if(mysqli_errno($connection)) {
            $_SESSION['edit-user'] = "Chỉnh sửa người dùng thất bại";
        }
        else {
            $_SESSION['edit-user'] = "Chỉnh sửa người dùng thành công";
        }
    }
}

header('location: ' . ROOT_URL . 'admin-dashboard/manage-user.php');