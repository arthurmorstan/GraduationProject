<?php
require 'config/database.php';

// get Sign up form data if sign up button was clicked
if(isset($_POST['submit'])) {
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $avatar = $_FILES['avatar'];

    // check the valid of input's values
    if(!$firstname) {
        $_SESSION['signup'] = "Vui lòng nhập tên của bạn";
    } 
    elseif (!$lastname){
        $_SESSION['signup'] = "Vui lòng nhập họ của bạn";
    }
    elseif (!$username){
        $_SESSION['signup'] = "Vui lòng nhập username của bạn";
    }
    elseif (!$email){
        $_SESSION['signup'] = "Vui lòng điền một email hợp lệ";
    }
    elseif (strlen($createpassword) < 3 || strlen($confirmpassword) < 3){
        $_SESSION['signup'] = "Mật khẩu phải dài hơn 3 ký tự";
    }
    elseif (!$avatar['name']){
        $_SESSION['signup'] = "Hãy thêm ảnh đại diện";
    } 
    else {
        // check if password don't match 
        if($createpassword !== $confirmpassword) {
            $_SESSION['signup']  = "Mật khẩu không trùng khớp";
        }
        else {
            // hash the password for security
            $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);

            // check if username or email already exist in the database
            $user_check_query = "SELECT * FROM users WHERE username='$username' OR email = '$email'";
            $user_check_result = mysqli_query($connection, $user_check_query);
            if(mysqli_num_rows($user_check_result) > 0) {
                $_SESSION['signup'] = "Username hoặc email đã tồn tại";
            }
            else {
                // Avatar seciton
                // rename the avatar 
                $time = time();  //make each image name unique using current time
                $avatar_name = time() . $avatar['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_destination_path = 'images/' . $avatar_name;

                // make sure file is an image
                $allowed_files = ['png', 'jpg', 'jpeg'];
                $extension = explode('.', $avatar_name);
                $extension = end($extension);
                if(in_array($extension, $allowed_files)) {
                    // make sure the image file not to large (1mb+)
                    if($avatar['size'] < 1000000) {
                        // upload the file
                        move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                    }
                    else {
                        $_SESSION['signup'] = "File ảnh không được lớn hơn 1mb";
                    }
                }
                else {
                    $_SESSION['signup'] = "File ảnh phải thuộc định dạng png, jpg hoặc jpeg";
                }
            }
        }
    }
    // get back to sign up page if there is any error
    if(isset($_SESSION['signup'])) {
        // pass form data back to sign up page
        $_SESSION['signup-data'] = $_POST;
        header('location: ' . ROOT_URL . 'signup.php');
        die();
    }
    else {
        // insert user to users table
        $insert_user_query = "INSERT INTO users SET firstname = '$firstname', lastname = '$lastname', username = '$username', email = '$email', password = '$hashed_password', avatar = '$avatar_name', is_admin = 0";
        $insert_user_result = mysqli_query($connection, $insert_user_query);

        if(!mysqli_errno($connection)){
            // get to sign in page
            $_SESSION['signup-success'] = "Đăng ký thành công. Hãy đăng nhập";
            header('location: ' . ROOT_URL . 'signin.php');
            die();
        }
    }
}
else {
    header('location: ' . ROOT_URL . 'signup.php');
    die();
}