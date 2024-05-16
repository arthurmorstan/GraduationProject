<?php
include 'partials/header.php';

// fetch the current user from database
if (isset($_SESSION['user-id'])) {
    $current_user_id = $_SESSION['user-id'];
    $query = "SELECT * FROM posts WHERE staff_uuid = '$id'";
    $news = mysqli_query($connection, $query);  
}

?>
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
    color: #fff;
    transition: background-color 0.3s ease;
  }

  main table tr:hover a {
    color: #fff;
  }

  a {
    color: #000;
    text-decoration: none;
  }

  main img {
    width: 150px;
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
            <a href="my-post.php">
              <i class="bi bi-circle"></i><span>Bài Viết Của Tôi</span>
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
  <h2>Bài Viết Của Tôi</h2>
  <table id="myTable">
    <thead>
      <tr>
        <th>STT</th>
        <th>Ảnh Bìa</th>
        <th>Tiêu Đề</th>
        <th>Loại Tin</th>
        <th>Tình Trạng</th>
        <th>Xóa</th>
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
          <td><a href="<?= ROOT_URL ?>admin-dashboard/edit-news.php?id=<?= $newss['id'] ?>"><?= $newss['title'] ?></a></td>
          <td><?= $categoriess['title'] ?></td>
          <td><?= ($newss['active'] == 1) ? 'Đã Duyệt' : 'Chờ Duyệt' ?></td>
          <td><a href="<?= ROOT_URL ?>admin-dashboard/delete-news.php?id=<?= $newss['id'] ?>" class="btn sm danger">Xóa</a></td>
        </tr>
      <?php endwhile ?>
    </tbody>
  </table>
</main>

<?php
include 'partials/footer.php'
?>