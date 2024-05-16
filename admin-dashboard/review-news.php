<?php
require 'config/database.php';

if ((isset($_GET['id']))) {
    // $slug = $_SERVER['PATH_INFO'];
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE id = $id";
    $result = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'index.php');
    die();
}

// fetch the current user from database
if(isset($_SESSION['user-id'])) {
    $id = $_SESSION['user-id'];
    $query = "SELECT image FROM staffs_information WHERE staff_uuid = '$id'";
    $result = mysqli_query($connection, $query);
    $avatar = mysqli_fetch_assoc($result);
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đa Khoa G37</title>
  <link rel="stylesheet" href="../CSS/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel=" stylesheet" href="../CSS/slick.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css">
  <link rel="stylesheet" href="../CSS/style.css">
  <link rel="icon" href="images/favicon.png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>
<style>
  .search{
    --padding: 14px;

    width: max-content;
    padding: var(--padding);
    border-radius: 28px;
    background-color: #f6f6f6;
  }
  .search:focus-within {
    box-shadow: 0 0 2px rgba(0, 0, 0 , 0.75)  ;
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
                    <li>
                      <a class="dropdown-item d-flex align-items-center" href="./admin-dashboard/index.php">
                        <i class="bi bi-gear"></i>
                        <span>Dashboard</span>
                      </a>
                    </li>
                    <li>
                      <hr class="dropdown-divider" />
                    </li>

                    <li>
                      <a class="dropdown-item d-flex align-items-center" href="logout.php">
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

    /* .post-content.post-container p{
        margin-top: 10px;
    } */

    .post-header {
    width: 100%;
    height: 400px !important;
    background-color: var(--container-color);
    }


</style>

<section class="post-header">
    <div class="header-content post-container">
        <!-- Back to pick topic section -->
        <a href="index.php" class="toPickTopic">Trở Về</a>
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
                <img src="../images/<?= $image['image'] ?>" class="author" alt="">
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

</section>

<footer>
    <div class="container-xl">
        <div class="footer-inner">
            <div class="row d-flex align-items-center gy-4">
                <div class="col-md-4">
                    <span class="copyright">&copy; 2024 Medicare</span>
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
<script src="../Javascript/bootstrap.min.js"></script>
<script src="../Javascript/jquery.min.js"></script>
<script src="../Javascript/jquery.sticky-sidebar.min.js"></script>
<script src="../Javascript/popper.min.js"></script>
<script src="../Javascript/slick.min.js"></script>
<script src="../Javascript/jquery.main.js"></script>

<!-- Vendor JS Files -->
<script src="./assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="./assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="./assets/vendor/chart.js/chart.umd.js"></script>
<script src="./assets/vendor/echarts/echarts.min.js"></script>
<script src="./assets/vendor/quill/quill.min.js"></script>
<script src="./assets/vendor/simple-datatables/simple-datatables.js"></script>
<!-- <script src="./assets/vendor/tinymce/tinymce.min.js"></script> -->
<script src="./assets/vendor/php-email-form/validate.js"></script>


<!-- Template Main JS File -->
<script src="./assets/js/main.js"></script>
<script src="../main.js"></script>
</body>

</html>