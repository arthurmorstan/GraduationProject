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
    <title>Đăng Nhập</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap");

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Josefin Sans", sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url(images/benhvien2.jpg) no-repeat;
            background-position: center;
            background-size: cover;
        }

        .wrapper {
            width: 420px;
            background: transparent;
            border: 2px solid rgba(255,255,255,.2);
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(0,0,0, .2);
            color: #000;
            padding: 30px 40px;
            border-radius: 10px;
        }
        .wrapper h1 {
            font-size: 36px;
            text-align: center;
        }
        .wrapper .input-box {
            position: relative;
            width: 100%;
            height: 50px;
            margin: 30px 0px;
        }

        .input-box input {
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            border: 2px solid rgba(255,255,255,.2);
            border-radius: 40px;
            font-size: 16px;
            color: #000;
            padding: 20px 45px 20px 20px;
        }
        .input-box input::placeholder {
            color: #000;
        }
        .input-box i {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
        }

        .wrapper .btn {
            width: 100%;
            height: 45px;
            background: #fff;
            border: none;
            outline: none;
            border-radius: 40px;
            box-shadow: 0 0 10px rgba(0,0,0, .1);
            cursor: pointer;
            font-size: 16px;
            color: #333;
            font-weight: 600;
            margin-bottom: 26px;
        }

        #error p {
            margin-top: 20px;
            text-align: center;
            color: red;
        }
    </style>

    <div class="wrapper">
        <form action="<?= ROOT_URL ?>signin-logic.php" method="POST">
            <h1>Đăng Nhập</h1>
            <?php if (isset($_SESSION['signup-success'])) : ?>
                <div class="alert_message succes">
                    <p>
                        <?= $_SESSION['signup-success'];
                        unset($_SESSION['signup-success']);
                        ?>
                    </p>
                </div>
            <?php elseif (isset($_SESSION['signin'])) : ?>
                <div class="alert_message error" id="error">
                    <p>
                        <?= $_SESSION['signin'];
                        unset($_SESSION['signin']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <div class="input-box">
                <input type="text" name="username_email" id="username" value="<?= $username_email ?>" placeholder="Email">
                <i class='bx bxs-envelope' ></i>
            </div>

            <div class="input-box">
                <input type="password" class="Btn" name="password" value="<?= $password ?>" id="password" placeholder="Mặt Khẩu">
                <i class='bx bxs-lock-alt' ></i>
            </div>

            <!-- <div class="remember">
                <label for=""><input type="checkbox">Ghi nhớ đăng nhập</label>
            </div> -->

            <button id="submitBtn" name="submit" class="btn">Đăng Nhập</button>
        </form>
    </div>
</body>
</html>