<?php
require 'config/database.php';

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
  <link rel="stylesheet" href="CSS/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel=" stylesheet" href="CSS/slick.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css">
  <link rel="stylesheet" href="CSS/style.css">
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