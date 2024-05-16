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
</style>
<body>
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

    <script>
        const blob = document.getElementById("blob")
        
        document.body.onpointermove = event => {
            const { clientX, clientY } = event

            blob.animate({
                left: `${clientX}px`,
                top: `${clientY}px`
            }, {duration: 3000, fill:"forwards"});
        }
    </script>
</body>
</html>