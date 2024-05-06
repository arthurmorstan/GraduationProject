<?php 
include 'partials/header.php'
?>

  <body>
    <style>
      main {
        margin-top: 60px;
        margin-left: 500px;
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
      .btn {
        background-color: aqua;
      }
      .btn:hover {
        background-color: rgb(3, 188, 188);
      }

      main h2 {
        margin: 0px 0px 30px 0px;
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
          <?php if($group_slug == 'news-admin') : ?>
          <li>
            <a href="add-user.php">
              <i class="bi bi-circle"></i><span>Thêm Người Dùng</span>
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
            <a href="manage-news.php">
              <i class="bi bi-circle"></i><span>Quản Lý Tin Tức</span>
            </a>
          </li>
          <?php if($group_slug == 'news-admin') : ?>
          <li>
            <a href="manage-user.php">
              <i class="bi bi-circle"></i><span>Quản Lý Người Dùng</span>
            </a>
          </li>
          <li>
            <a href="manage-categories.php">
              <i class="bi bi-circle"></i><span>Quản Lý Phân Loại</span>
            </a>
          </li>
          <?php endif ?>
          </li>
        </ul>
      </li><!-- End Forms Nav -->
    </ul>

  </aside><!-- End Sidebar-->

  <main>
    <p>hello</p>
</main>

<?php 
include 'partials/footer.php'
?>