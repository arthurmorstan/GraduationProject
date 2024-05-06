<?php 
require 'config/database.php';

// create user when button was clicked
if (isset($_POST['submit'])){
    $first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $sex = $_POST['sex'];
    $phone = $_POST['phone'];
    $dob = date('Y-m-d', strtotime($_POST['dateofbirth']));
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['role'], FILTER_SANITIZE_NUMBER_INT);
    $avatar = $_FILES['avatar'];
    $is_activated = filter_var($_POST['is_activated'], FILTER_SANITIZE_NUMBER_INT);

    // check the valid of input's values
    if(!$first_name) {
        $_SESSION['add-user'] = "Vui lòng nhập tên";
    } 
    elseif (!$last_name){
        $_SESSION['add-user'] = "Vui lòng nhập họ";
    }
    elseif (!$email){
        $_SESSION['add-user'] = "Vui lòng điền một email hợp lệ";
    }
    elseif (!$phone){
        $_SESSION['add-user'] = "Vui lòng Nhập Số Điện Thoại";
    }
    elseif (strlen($createpassword) < 3 || strlen($confirmpassword) < 3){
        $_SESSION['add-user'] = "Mật khẩu phải dài hơn 3 ký tự";
    }
    elseif (!$avatar['name']){
        $_SESSION['add-user'] = "Hãy thêm ảnh đại diện";
    } 
    else {
        // check if password don't match 
        if($createpassword !== $confirmpassword) {
            $_SESSION['add-user']  = "Mật khẩu không trùng khớp";
        }
        else {
            // hash the password for security
            $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);

            // check if username or email already exist in the database
            $user_check_query = "SELECT * FROM logins WHERE email = '$email'";
            $user_check_result = mysqli_query($connection, $user_check_query);
            if(mysqli_num_rows($user_check_result) > 0) {
                $_SESSION['add-user'] = "Username hoặc email đã tồn tại";
            }
            else {
                // Avatar seciton
                // rename the avatar 
                $time = time();  //make each image name unique using current time
                $avatar_name = time() . $avatar['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_destination_path = '../images/' . $avatar_name;

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
                        $_SESSION['add-user'] = "File ảnh không được lớn hơn 1mb";
                    }
                }
                else {
                    $_SESSION['add-user'] = "File ảnh phải thuộc định dạng png, jpg hoặc jpeg";
                }
            }
        }
    }
    // get back to sign up page if there is any error
    if(isset($_SESSION['add-user'])) {
        // pass form data back to sign up page
        $_SESSION['add-user-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin-dashboard/add-user.php');
        die();
    }
    else {
        // insert user to users table
        $insert_user_query2 = "INSERT INTO logins SET email = '$email', phone_number = '$phone', password = '$hashed_password', activated = $is_activated";
        $insert_user_result2 = mysqli_query($connection, $insert_user_query2);

        $login_id = mysqli_insert_id($connection);

        $insert_user_query1 = "INSERT INTO users SET uuid = UUID(), first_name = '$first_name', last_name = '$last_name', gender = $sex, dob = '$dob', login_id = $login_id";
        $insert_user_result1 = mysqli_query($connection, $insert_user_query1);

        $user_uuid = "SELECT * FROM users ORDER BY created_at DESC LIMIT 1";
        $user_uuid_result = mysqli_query($connection, $user_uuid);
        $uuid = mysqli_fetch_assoc($user_uuid_result)['uuid'];

        $insert_user_query3 = "INSERT INTO staffs_information SET staff_uuid = '$uuid', image = '$avatar_name'";
        $insert_user_result3 = mysqli_query($connection, $insert_user_query3);

        $insert_user_query4 = "INSERT INTO group_users SET user_uuid = '$uuid', group_id = $is_admin";
        $insert_user_result4 = mysqli_query($connection, $insert_user_query4);

        if(!mysqli_errno($connection)){
            // get to sign in page
            $_SESSION['add-user-success'] = "Thêm thành công. Hãy kiểm tra";
            header('location: ' . ROOT_URL . 'admin-dashboard/manage-user.php');
            die();
        }
    }
}
else {
    header('location: ' . ROOT_URL . 'admin-dashboard/add-user.php');
    die();
}