<?php
require 'config/database.php';

if (isset($_GET['cid'])) {
  $cid = filter_var($_GET['cid'], FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT * FROM comments WHERE cid = $cid ";
  $result = mysqli_query($connection, $query);
  $comments = mysqli_fetch_assoc($result);
} 
  else {
  header('location: ' . ROOT_URL . 'index.php');
  die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đa Khoa G37</title>
</head>

<body>
  <style>
    body {
      background-color: white;
      background-size: 100% 300%;
      font-family: "Lora", serif;
      color: #000;
    }

    h1 {
      color: #000;
    }

    .post-content.post-container {
      margin-top: 1px;
    }

    img.header-image {
      width: 700px;
      height: 400px;
    }

    .post-header {
      width: 100%;
      height: 400px !important;
      background-color: var(--container-color);
    }

    .comments {
      height: auto;
      border: 1px solid #000;
    }

    .comments p {
      color: #4d92f4;
      text-align: center;
    }

    .comments textarea {
      width: -webkit-fill-available;
      height: 120px;
      background-color: #eee;
      resize: none;
      padding: 10px;
      margin: 10px;
      cursor: pointer;
      border: none;
      border-radius: 5px;
    }

    .comments .submit1 {
      margin: 10px;
      padding-left: 20px;
      padding-right: 20px;
      border: none;
      background-color: #4d92f4;
      color: #f6f6f6;
      cursor: pointer;
      border-radius: 2px;
      margin-bottom: 100px;
      display: flow-root;
    }

    .comments .submit1:hover {
      background-color: #257af1;
    }

    .comment-box {
      margin: 10px;
      padding: 10px;
      border-radius: 4px;
      border: 1px solid grey;
      line-height: 40px;
      position: relative;
    }

    .edit-form button {
      position: absolute;
      top: 0px;
      right: 0px;
      margin: 0;
      padding: 0;
      width: auto;
      height: 30px;
      font-size: 15px;
      background-color: #fff;
      color: grey;
      border: none;
    }

    .edit-form button:hover {
      color: #000;
    }
  </style>

  <section class="post-content post-container">
  <div class="comments" style="margin-top: 30px;">
      <form method="POST" action="<?= ROOT_URL ?>edit-comment-logic.php">
        <p>Ý kiến của bạn</p>
        <input type='hidden' name='cid' id='cid' value='<?= $comments['cid']?>'>
      <textarea name='message'><?= $comments['message'] ?></textarea><br>
      <button name='submit' type='submit' class='submit1'>Chỉnh sửa</button>
      </form>
    </div>
  </section>

</body>

</html>