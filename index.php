<?php
require 'config/database.php';

// fetch categories from database
$query = "SELECT * FROM news_categories WHERE active = 1";
$categories = mysqli_query($connection, $query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin tức</title>
</head>
<style>
    *{
        margin: 0;
        padding: 0;
    }
    ::-webkit-scrollbar{
    background-color: transparent;
    }
    body {
        background-color: #000;
        color: #fff;
    }
    .container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 70%;
        height: 450px;
        display: flex;
        justify-content: center;
        gap: 10px;
        z-index: 100;
    }

    .container img {
        width: 10%;
        height: 100%;
        object-fit: cover;
        border-radius: 10px;
        border: 2px solid white;
        transition: all 0.5s ease-in-out;
    }

    .container img:hover {
        width: 25%;
    }

    .container .description {
        width: 100px;
        /* padding-left: 20px; */
        padding-right: 30px;
    }
    .container .description p {
        font-size: 17px;
    }
    a {
        text-decoration: none;
        color: #fff;
    }
    a:hover {
        color: aqua;
        transition: all 0.4s ease-in-out;
    }

    .ble h1 {
        z-index: 1000;
        text-align: center;
        font-size: 50px;
        margin-top: 15px;
    }

    .container h1 {
        margin-bottom: 40px;
    }

    .bubbles {
        position: relative;
        display: flex;
    }
    .bubbles span {
        position: relative;
        width: 30px;
        height: 30px;
        background-color: #4fc3dc;
        margin: 0px 4px;
        border-radius: 50%;
        box-shadow: 0 0 0 10px #4fc3dc44,
        0 0 50px #4fc3dc,
        0 0 100px #4fc3dc;
        animation: animate 15s linear infinite;
        animation-duration: calc(120s / var(--i));
        z-index: -10;
    }
    .bubbles span:nth-child(even) {
        background-color: #ff2d75;
        box-shadow: 0 0 0 10px #ff2d7544,
        0 0 50px #ff2d75,
        0 0 100px #ff2d75;
    }
    @keyframes animate {
        0% 
        {
            transform: translateY(100vh) scale(0);
        }
        100% 
        {
            transform: translateY(-10vh) scale(1);
        }
    }
</style>
<body>
    <div class="bubbles">
        <span style="--i:11"></span>
        <span style="--i:24"></span>
        <span style="--i:28"></span>
        <span style="--i:15"></span>
        <span style="--i:16"></span>
        <span style="--i:22"></span>
        <span style="--i:15"></span>
        <span style="--i:11"></span>
        <span style="--i:10"></span>
        <span style="--i:27"></span>
        <span style="--i:29"></span>
        <span style="--i:17"></span>
        <span style="--i:20"></span>
        <span style="--i:23"></span>
        <span style="--i:12"></span>
        <span style="--i:11"></span>
        <span style="--i:10"></span>
        <span style="--i:27"></span>
        <span style="--i:29"></span>
        <span style="--i:17"></span>
        <span style="--i:20"></span>
        <span style="--i:23"></span>
        <span style="--i:12"></span>
        <span style="--i:20"></span>
        <span style="--i:23"></span>
        <span style="--i:12"></span>
        <span style="--i:11"></span>
        <span style="--i:10"></span>
        <span style="--i:27"></span>
        <span style="--i:29"></span>
        <span style="--i:17"></span>
        <span style="--i:20"></span>
        <span style="--i:23"></span>
        <span style="--i:12"></span>
        <span style="--i:20"></span>
        <span style="--i:23"></span>
        <span style="--i:12"></span>
        <span style="--i:11"></span>
        <span style="--i:10"></span>
        <span style="--i:27"></span>
        <span style="--i:29"></span>
        <span style="--i:17"></span>
        <span style="--i:20"></span>
        <span style="--i:23"></span>
        <span style="--i:12"></span>
        <span style="--i:20"></span>
        <span style="--i:23"></span>
        <span style="--i:12"></span>
        <span style="--i:11"></span>
        <span style="--i:10"></span>
        <span style="--i:27"></span>
        <span style="--i:29"></span>
        <span style="--i:17"></span>
        <span style="--i:20"></span>
        <span style="--i:23"></span>
        <span style="--i:12"></span>
    </div>
    <div class="ble">
    <h1>Chọn Chủ Đề Tin Tức Bạn Muốn Xem</h1>
    </div>
    <div class="container">
    <?php while($categoriess = mysqli_fetch_assoc($categories)) : ?>
        <img src="images/<?= $categoriess['thumbnail'] ?>" alt="">
        <div class="description">
        <a href="<?= ROOT_URL ?><?= $categoriess['id'] ?>-<?= $categoriess['slug'] ?>"><h1><?= "{$categoriess['title']}" ?></h1></a>
        <p><?= "{$categoriess['description']}" ?></p>
        </div>
    <?php endwhile ?>
    </div>
</body>
</html>