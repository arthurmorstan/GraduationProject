<?php
require 'config/database.php';
$requestUri = $_SERVER['REQUEST_URI'];

// Remove leading slash if present

  $requestUri =  explode('/',$requestUri);
  $id = $requestUri[3];
  $slug = $requestUri[4];
if ((isset($id))) {
  $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT * FROM posts WHERE id = $id LIMIT 1";
  $result = mysqli_query($connection, $query);
  $post = mysqli_fetch_assoc($result);
}

// fetch the current user from database to get avatar
if (isset($_SESSION['user-id'])) {
  $user_id = $_SESSION['user-id'];
  $query = "SELECT image FROM staffs_information WHERE staff_uuid = '$user_id'";
  $result = mysqli_query($connection, $query);
  $avatar = mysqli_fetch_assoc($result);
} else {
  $user_id = null; // Set $user_id to null if not logged in
}

// group slug
if (isset($_SESSION['group-id'])) {
  $group_id = $_SESSION['group-id'];
  $groups_query = "SELECT * FROM `groups` WHERE id = $group_id";
  $group_result = mysqli_query($connection, $groups_query);
  $group_record = mysqli_fetch_assoc($group_result);
  $group_slug = $group_record['slug'];
}

// like section
if (isset($_POST['liked'])) {
  $postid = $_POST['postid'];
  $result = mysqli_query($connection, "SELECT * FROM posts WHERE id = $postid");
  $row = mysqli_fetch_array($result);
  $n = $row['likes'];

  mysqli_query($connection, "UPDATE posts SET likes= $n + 1 WHERE id = $postid");
  mysqli_query($connection, "INSERT INTO likes (userid, postid) VALUES ('$user_id', $postid)");
  exit();
}

// unlike session
if (isset($_POST['unliked'])) {
  $postid = $_POST['postid'];
  $result = mysqli_query($connection, "SELECT * FROM posts WHERE id=$postid");
  $row = mysqli_fetch_array($result);
  $n = $row['likes'];

  mysqli_query($connection, "UPDATE posts SET likes= $n - 1 WHERE id = $postid");
  mysqli_query($connection, "DELETE FROM likes WHERE postid = $postid AND userid = '$user_id'");
  exit();
}

// comment section
$query = "SELECT comments.*, users.first_name, users.last_name FROM comments 
          JOIN users ON comments.user_uuid = users.uuid 
          WHERE post_id = $id ORDER BY date DESC";
$comments = mysqli_query($connection, $query);

date_default_timezone_set('Asia/Ho_Chi_Minh');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đa Khoa G37</title>
  <link rel="stylesheet" href="<?= ROOT_URL ?>CSS/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="<?= ROOT_URL ?>CSS/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css">
  <link rel="stylesheet" href="<?= ROOT_URL ?>CSS/style.css">
  <link rel="icon" href="images/favicon.png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>
  <style>
    .search {
      --padding: 14px;

      width: max-content;
      padding: var(--padding);
      border-radius: 28px;
      background-color: #f6f6f6;
    }

    .search:focus-within {
      box-shadow: 0 0 2px rgba(0, 0, 0, 0.75);
    }

    .search-input {
      font-size: 16px;
      font-family: 'lexend', sans-serif;
      color: #333333;
      margin-left: var(--padding);
      background: transparent;
      border: none;
      outline: none;
      width: 300px;
      transition: box-shadow 0.25s;
    }

    .search button {
      padding: 2px;
      border: none;
      background: linear-gradient(to right, #b2fefa, #0ed2f7);
      border-radius: 10px;
      width: 50px;
    }
  </style>

  <!-- Header -->
  <header class="header-default">
    <nav class="navbar navbar-expand-lg">
      <div class="container-xl">
        <!-- logo  -->
        <a href="<?= ROOT_URL ?>" class="navbar-brand">
          <img src="images/favicon.jpg" alt="">
        </a>

        <div class="collapse navbar-collapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown active">
              <a href="<?= ROOT_URL ?>" class="nav-link">Trang chủ</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">Dịch vụ</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">Đặt lịch</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">Về chúng tôi</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">Liên hệ</a>
            </li>
            <?php if (isset($_SESSION['user-id'])) : ?>
              <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                  <img src="<?= ROOT_URL . 'images/' . $avatar['image'] ?>" alt="Profile" class="rounded-circle" width="27px" />

                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                  <?php if($group_slug != 'user') : ?>
                    <li>
                      <a class="dropdown-item d-flex align-items-center" href="./admin-dashboard/index.php">
                        <i class="bi bi-gear"></i>
                        <span>Dashboard</span>
                      </a>
                    </li>
                    <?php endif ?>
                    <li>
                      <hr class="dropdown-divider" />
                    </li>

                    <li>
                      <a class="dropdown-item d-flex align-items-center" href="<?= ROOT_URL ?>logout.php">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Đăng Xuất</span>
                      </a>
                    </li>
                  </ul>
                  <!-- End Profile Dropdown Items -->
              </li>
            <?php else : ?>
              <li class="nav-item">
                <a href="<?= ROOT_URL ?>login.php" class="nav-link">Đăng nhập</a>
              </li>
            <?php endif ?>
            <!-- End Profile Nav -->
          </ul>
        </div>

        <form action="<?= ROOT_URL ?>search.php" method="GET">
          <div class="search">
            <span class="search-icon material-symbols-outlined"></span>
            <input type="search" name="search" class="search-input" placeholder="Tìm kiếm">
            <button class="submit" name="submit" type="submit">Tìm</button>
          </div>
        </form>
  </header>
  <!-- End of the header -->
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
      background-color: #fff;
    }

    .comments h6 {
      color: #4d92f4;
      text-align: center;
      font-size: 25px;
      margin-top: 10px;
    }

    .comments p {
      margin-bottom: 0;
      font-weight: bold;
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

    .comment-box a {
      color: grey;
    }
    .comment-box a:hover {
      color: #000;
    }

    .comment-box .edit {
      position: absolute;
      top: 0px;
      right: 50px;
    }
    .comment-box .delete {
      position: absolute;
      top: 0px;
      right: 0px;
    }
  </style>

  <section class="post-header">
    <div class="header-content post-container">
      <!-- Back to pick topic section -->
      <a href="<?= ROOT_URL ?>index.php" class="toPickTopic">Xem tin tức chủ đề khác</a>
      <!-- Title -->
      <h1 class="header-title">
        <?= $post['title'] ?>
      </h1>
      <!-- post author -->
      <div class="post-author">
        <?php
        $author_id = $post['staff_uuid'];
        $author_query = "SELECT * FROM users WHERE uuid = '$author_id'";
        $author_result = mysqli_query($connection, $author_query);
        $author = mysqli_fetch_assoc($author_result);

        $image_query = "SELECT * FROM staffs_information WHERE staff_uuid = '$author_id'";
        $image_result = mysqli_query($connection, $image_query);
        $image = mysqli_fetch_assoc($image_result);

        ?>
        <div class="post-author-avatar">
          <img src="<?= ROOT_URL ?>images/<?= $image['image'] ?>" class="author" alt="">
        </div>
        <div class="post-author-infor">
          <h5><?= $author['first_name'] ?></h5>
          <small><?= date("M d, Y - H:i", strtotime($post['date_time'])) ?></small>
        </div>
      </div>
    </div>
  </section>

  <section class="post-content post-container">
    <p><?= $post['body'] ?></p>

    <div style="padding: 2px; margin-top: 5px;">
      <?php
      // determine if user has already liked this post
      if (isset($user_id)) {
        $results = mysqli_query($connection, "SELECT * FROM likes WHERE userid='$user_id' AND postid=" . $post['id'] . "");

        if (mysqli_num_rows($results) == 1) : ?>
          <!-- user already likes post -->
          <span><a href="" class="unlike fa fa-thumbs-down" id="<?= $post['id'] ?>"></a></span>
        <?php else : ?>
          <!-- user has not yet liked post -->
          <span><a href="" class="like fa fa-thumbs-up" id="<?= $post['id'] ?>"></a></span>
      <?php endif;
      }
      ?>

      <span class="likes_count"><?php echo $post['likes']; ?> likes</span>
    </div>

    <div class="comments" style="margin-top: 30px;">
      <form method="POST" action="<?= ROOT_URL ?>add-comment.php">
        <h6>Ý kiến của bạn</h6>
        <input type="hidden" name="user_uuid" value="<?= $user_id ?>">
        <input type='hidden' name='date' value=''>
        <input type="hidden" name="post_id" value="<?= $id ?>">
      <textarea name='message' id=''></textarea><br>
      <?php if (isset($_SESSION['user-id'])) : ?>
      <button name='commentSubmit' type='submit' class='submit1'>Bình luận</button>
      <?php else : ?>
        <p>Vui lòng đăng nhập để bình luận</p>
      <?php endif ?>
      </form>

      <?php while ($comment = mysqli_fetch_assoc($comments)) : ?>
      <div class="comment-box">
        <?= $comment['first_name']?><br>
        <?= $comment['date'] ?><br>
        <p> <?= $comment['message'] ?></p><br>
        <?php if ($user_id === $comment['user_uuid']) : ?>
        <a href="<?= ROOT_URL ?>edit-comment.php?cid=<?= $comment['cid'] ?>" class="edit">Chỉnh sửa</a>
        <?php endif; ?>
        <?php if (($user_id === $comment['user_uuid']) || (isset($group_slug) && ($group_slug === 'news-admin'))) : ?>
        <a href="<?= ROOT_URL ?>delete-comment.php?cid=<?= $comment['cid'] ?>" class="delete">Xóa</a>
        <?php endif; ?>
      </div>
      <?php endwhile ?>
    </div>
  </section>

  <footer>
    <div class=" container-xl">
        <div class="footer-inner">
          <div class="row d-flex align-items-center gy-4">
            <div class="col-md-4">
              <span class="copyright">&copy; 2024 G37 General Hospital</span>
            </div>
            <div class="col-md-4 text-center">
              <ul class="social-icons list-unstyled list-inline mb-0">
                <li class="list-inline-item">
                  <a href="#">
                    <i class="fab fa-facebook-f"></i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a href="#">
                    <i class="fab fa-instagram"></i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a href="#">
                    <i class="fab fa-pinterest"></i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a href="#">
                    <i class="fab fa-itunes"></i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a href="#">
                    <i class="fab fa-youtube"></i>
                  </a>
                </li>
              </ul>
            </div>
            <div class="col-md-4">
              <a href="#" id="return-to-top" class="float-md-end">
                <i class="icon-arrow-up"></i>
                Back to Top
              </a>
            </div>
          </div>
        </div>
    </div>
    </footer>

    <!-- Javascript -->
    <script src="<?= ROOT_URL ?>Javascript/bootstrap.min.js"></script>
    <script src="<?= ROOT_URL ?>Javascript/jquery.min.js"></script>
    <script>
      $(document).ready(function() {
        // when the user clicks on like
        $('.like').click(function() {
          var postid = $(this).attr('id');

          $.ajax({
            url: 'single-posts.php',
            type: 'post',
            async: true,
            data: {
              'liked': 1,
              'postid': postid
            },
            success: function() {}
          });
        });

        // when the user clicks on unlike
        $('.unlike').click(function() {
          var postid = $(this).attr('id');

          $.ajax({
            url: 'single-posts.php',
            type: 'post',
            async: true,
            data: {
              'unliked': 1,
              'postid': postid
            },
            success: function() {}
          });
        });


      });
    </script>
    <script src="<?= ROOT_URL ?>Javascript/jquery.sticky-sidebar.min.js"></script>
    <script src="<?= ROOT_URL ?>Javascript/popper.min.js"></script>
    <script src="<?= ROOT_URL ?>Javascript/slick.min.js"></script>
    <script src="<?= ROOT_URL ?>Javascript/jquery.main.js"></script>

    <!-- Vendor JS Files -->
    <script src="<?= ROOT_URL ?>admin-dashboard/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="<?= ROOT_URL ?>admin-dashboard/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= ROOT_URL ?>admin-dashboard/assets/vendor/chart.js/chart.umd.js"></script>
    <script src="<?= ROOT_URL ?>admin-dashboard/assets/vendor/echarts/echarts.min.js"></script>
    <script src="<?= ROOT_URL ?>admin-dashboard/assets/vendor/quill/quill.min.js"></script>
    <script src="<?= ROOT_URL ?>admin-dashboard/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <!-- <script src="./assets/vendor/tinymce/tinymce.min.js"></script> -->
    <script src="<?= ROOT_URL ?>admin-dashboard/assets/vendor/php-email-form/validate.js"></script>


    <!-- Template Main JS File -->
    <script src="<?= ROOT_URL ?>admin-dashboard/assets/js/main.js"></script>
    <script src="<?= ROOT_URL ?>main.js"></script>
</body>

</html>