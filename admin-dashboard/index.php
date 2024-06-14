<?php
include 'partials/header.php';

// fetch current user id posts from db
$current_user_id = $_SESSION['user-id'];
$query = "SELECT * FROM posts WHERE active = 0 ORDER BY id DESC";
$news = mysqli_query($connection, $query);
?>

<body>
  <style>
    main {
      margin-top: 60px;
      margin-left: 300px;
      padding: 20px 30px;
      transition: all 0.3s;
    }

    @media (max-width: 1199px) {
      #main {
        padding: 20px;
      }
    }

    .btn.sm.danger {
      background-color: rgb(248, 59, 59);
    }

    .btn.sm.danger:hover {
      background-color: rgb(244, 40, 40);
    }

    .btn.sm.success {
      background-color: #03fc84
    }

    .btn.sm.success:hover {
      background-color: #03fc84
    }

    .btn.sm.warning {
      background-color: #fcf403
    }

    .btn.sm.warning:hover {
      background-color: #fcf403
    }

    main h2 {
      margin: 20px 0px 30px 0px;
    }

    main table {
      width: 100%;
      text-align: left;
    }

    main table th {
      background-color: #e9e6e6;
      padding: 10px;
      color: #000;
      border-right: 2px solid black;
    }

    main table td {
      padding: 10px;
      border-bottom: 2px solid black;
    }

    main table tr:hover td {
      background-color: #6c6969;
      color: white;
      transition: background-color 0.3s ease;
    }

    main img {
      width: 150px;
    }

    main a {
      color: #000;
    }

    main table tr:hover td a {
      color: #fff;
    }
  </style>

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Thêm</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="add-news.php">
              <i class="bi bi-circle"></i><span>Thêm Tin Tức</span>
            </a>
          </li>
          <?php if ($group_slug == 'news-admin') : ?>
            <li>
              <a href="add-user.php">
                <i class="bi bi-circle"></i><span>Thêm Nhân Viên</span>
              </a>
            </li>
            <li>
              <a href="add-categories.php">
                <i class="bi bi-circle"></i><span>Thêm Phân Loại</span>
              </a>
            </li>
          <?php endif ?>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Quản Lý</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="my-post.php">
              <i class="bi bi-circle"></i><span>Bài Viết Của Tôi</span>
            </a>
          </li>
          <?php if ($group_slug == 'news-admin') : ?>
            <li>
              <a href="manage-user.php">
                <i class="bi bi-circle"></i><span>Quản Lý Nhân Viên</span>
              </a>
            </li>
            <li>
              <a href="manage-categories.php">
                <i class="bi bi-circle"></i><span>Quản Lý Phân Loại</span>
              </a>
            </li>
            <li>
              <a href="manage-news.php">
                <i class="bi bi-circle"></i><span>Quản Lý Tin Tức</span>
              </a>
            </li>
          <?php endif ?>
      </li>
    </ul>
    </li><!-- End Forms Nav -->
    </ul>

  </aside><!-- End Sidebar-->

  <main>
  Chào mừng đến với dashboard trang tin tức của Đa Khoa G37
  <?php if ($group_slug == 'news-admin') : ?>
    <h2>Phê Duyệt Tin Tức</h2>
    <table id="myTable">
      <thead>
        <tr>
          <th>STT</th>
          <th>Ảnh Bìa</th>
          <th>Tiêu Đề</th>
          <th>Loại Tin</th>
          <th>Tác Giả</th>
          <th>Xem Trước</th>
          <th>Phê Duyệt</th>
          <!-- <th>Xóa</th> -->
        </tr>
      </thead>
      <tbody>
        <?php while ($newss = mysqli_fetch_assoc($news)) : ?>
          <?php
          // fetch categories in db to this site
          $categories_id = $newss['categories_id'];
          $categories_query = "SELECT title FROM news_categories WHERE id = $categories_id";
          $categories = mysqli_query($connection, $categories_query);
          $categoriess = mysqli_fetch_assoc($categories);
          ?>
          <tr>
            <?php
            $author_id = $newss['staff_uuid'];
            $author_query = "SELECT * FROM users WHERE uuid = '$author_id'";
            $author_result = mysqli_query($connection, $author_query);
            $author = mysqli_fetch_assoc($author_result);

            ?>
            <td><?= $newss['id'] ?></td>
            <td><img src="../images/<?= $newss['thumbnail'] ?>" alt=""></td>
            <td><?= $newss['title'] ?></td>
            <td><?= $categoriess['title'] ?></td>
            <td><?= $author['first_name'] ?></td>
            <td><a href="<?= ROOT_URL ?>admin-dashboard/review-news.php?id=<?= $newss['id'] ?>" class="btn sm warning">Xem Trước</a></td>
            <td><a href="<?= ROOT_URL ?>admin-dashboard/approved.php?id=<?= $newss['id'] ?>" class="btn sm success">Phê Duyệt</a></td>
            <!-- <td><a href="<?= ROOT_URL ?>admin-dashboard/delete-news.php?id=<?= $newss['id'] ?>" class="btn sm danger">Xóa</a></td> -->
          </tr>
        <?php endwhile ?>
      </tbody>
    </table>
    <?php endif ?>
  </main>

  <?php
  include 'partials/footer.php'
  ?>