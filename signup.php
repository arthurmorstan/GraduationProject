<?php 
require 'config/constants.php';

// get back form data if there was a registration error
$firstname = $_SESSION['signup-data']['firstname'] ?? null;
$lastname = $_SESSION['signup-data']['lastname'] ?? null;
$username = $_SESSION['signup-data']['username'] ?? null;
$email = $_SESSION['signup-data']['email'] ?? null;
$createpassword = $_SESSION['signup-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['signup-data']['confirmpassword'] ?? null;
// delete signup data session
unset($_SESSION['signup-data']);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <title>Đăng ký</title>
</head>
<body>
    <style>
        body {
            color: #000;
            background-image: url("images/benhvien.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        h2 {
            color: #000;
        }
        p {
            color: #000;
        }
        label {
            color: grey;
        }
    </style>
    <section class="form-section">
        <div class="container form-section-container">
            <h2>Đăng Ký</h2>
            <?php if (isset($_SESSION['signup'])) : ?>
                <div class="alert_message error">
                    <p>
                        <?= $_SESSION['signup'];
                        unset($_SESSION['signup']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form action="<?=ROOT_URL  ?>signup-logic.php" enctype="multipart/form-data" method="POST">
                <div class="two-name">
                    <input type="text" name="firstname" value="<?= $firstname ?>" id="firstname" placeholder="Tên Đệm và Tên">
                    <input type="text" name="lastname" value="<?= $lastname ?>" id="lastname" placeholder="Họ">
                </div>

                <input type="text" name="username" value="<?= $username ?>" id="username" placeholder="Username">
                <input type="email" name="email" value="<?= $email ?>" id="email" placeholder="Email">
                <input type="password" name="createpassword" value="<?= $createpassword ?>" id="password" placeholder="Mặt Khẩu">
                <input type="password" name="confirmpassword" value="<?= $confirmpassword ?>" id="password" placeholder="Xác nhận mật khẩu">
                <div class="form-control">
                    <label for="avatar">Avatar người dùng</label>
                    <input type="file" id="avatar" name="avatar">
                </div>

                <button id="submitBtn" name="submit">Đăng Ký</button>
                <small>Đã có tài khoản? <a href="signin.php">Đăng Nhập</a> ngay</small>
            </form>
        </div>
    </section>

    <script src="./JAvascript/main.js"></script>
</body>
</html>