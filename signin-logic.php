<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    // get form data
    $username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (!$username_email) {
        $_SESSION['signin'] = "Vui lòng nhập username hoặc email";
    } 
    elseif (!$password) {
        $_SESSION['signin'] = "Vui lòng nhập mật khẩu";
    } 
    else {
        //get user from database
        $fetch_login_query = "SELECT * FROM logins WHERE email='$username_email'";
        $fetch_login_result = mysqli_query($connection, $fetch_login_query);

        if (mysqli_num_rows($fetch_login_result) == 1) {
            // convert the result into assoc array
            $login_record = mysqli_fetch_assoc($fetch_login_result);
            $db_password = $login_record['password'];
            $login_id = $login_record['id'];
            // compare the form password to the database password
            if (password_verify($password, $db_password)) {
                $user_query = "SELECT * FROM users WHERE login_id = '$login_id'";
                $fetch_user_result = mysqli_query($connection, $user_query);
                // set access for access control
                if (mysqli_num_rows($fetch_user_result) == 1) {
                    $user_record = mysqli_fetch_assoc($fetch_user_result);
                    $user_uuid = $user_record['uuid'];
                    $group_users_query = "SELECT * FROM group_users WHERE user_uuid='$user_uuid'";
                    $fetch_group_users_result = mysqli_query($connection, $group_users_query);

                    if(mysqli_num_rows($fetch_group_users_result) == 1) {
                        $group_users_record = mysqli_fetch_assoc($fetch_group_users_result);
                        $group_id = $group_users_record['group_id'];
                        $groups_query = "SELECT * FROM `groups` WHERE id = $group_id";
                        $group_result = mysqli_query($connection, $groups_query);

                        if(mysqli_num_rows($group_result) == 1) {   
                            $group_record = mysqli_fetch_assoc($group_result);
                            $group_slug = $group_record['slug'];
                            $array = array('news-admin', 'author', 'user');
                            if(in_array($group_slug,$array)) {
                                $_SESSION['group-id'] = $group_id;
                                $_SESSION['user-id'] = $user_uuid;
                                if($group_slug == 'news-admin'){
                                    $_SESSION['user_is_admin'] = true;
                                }
                                if($group_slug == 'author') {
                                    $_SESSION['user_is_admin'] = false;
                                }
                                if($group_slug == 'user') {
                                    $_SESSION['user_is_admin'] = false;
                                }
                                // log user in
                                header('location: ' . ROOT_URL . 'index.php');
                            }
                        }

                    }
                } 
            }
            else {
                $_SESSION['signin'] = "Sai email hoặc mật khẩu";
        } 
        }
    }

    // if there is a problem, back to log in page with data
    if (isset($_SESSION['signin'])) {
        $_SESSION['signin-data'] = $_POST;
        header('location: ' . ROOT_URL . 'login.php');
        die();
    }
} else {
    header('location: ' . ROOT_URL . 'login.php');
    die();
}
