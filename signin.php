<?php
require 'config/constants.php';

// get back form data if there was a log in error
$username_email = $_SESSION['signin-data']['username_email'] ?? null;
$password = $_SESSION['signin-data']['password'] ?? null;

unset($_SESSION['signin-data']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <title>Đăng nhập</title>
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

        .form-section-container {
            height: 420px;
        }

        small {
            padding-top: 30px;
        }

        .alert_message.error {
            text-align: center;
        }
    </style>
    <section class="form-section">
        <div class="container form-section-container">
            <h2>Đăng Nhập</h2>
            <?php if (isset($_SESSION['signup-success'])) : ?>
                <div class="alert_message succes">
                    <p>
                        <?= $_SESSION['signup-success'];
                        unset($_SESSION['signup-success']);
                        ?>
                    </p>
                </div>
            <?php elseif (isset($_SESSION['signin'])) : ?>
                <div class="alert_message error">
                    <p>
                        <?= $_SESSION['signin'];
                        unset($_SESSION['signin']);
                        ?>
                    </p>
                </div>
            <?php endif ?>

            <form action="<?= ROOT_URL ?>signin-logic.php" method="POST">
                <input type="text" name="username_email" id="username" value="<?= $username_email ?>" placeholder="Email">
                <input type="password" name="password" value="<?= $password ?>" id="password" placeholder="Mặt Khẩu">

                <button id="submitBtn" name="submit">Đăng Nhập</button>
                <!-- <small>Chưa có tài khoản? <a href="signup.php">Đăng Ký</a> ngay</small> -->
            </form>
        </div>
    </section>

    <script src="./Javascript/main.js"></script>
</body>

</html>