<?php 
include 'partials/header.php';

// fetch user data from database but not current user
$current_admin_id = $_SESSION['user-id'];
$group_id = $_SESSION['group-id'];
$query = "SELECT users.gender AS gender, users.dob AS dob, users.first_name AS first_name, users.last_name AS last_name,group_users.*,logins.email AS email FROM group_users JOIN users ON users.uuid = group_users.user_uuid JOIN logins ON users.login_id = logins.id WHERE NOT group_users.group_id = $group_id";
$users = mysqli_query($connection, $query); 

// group slug
$groups_query = "SELECT * FROM `groups` WHERE id = $group_id";
$group_result = mysqli_query($connection, $groups_query);
$group_record = mysqli_fetch_assoc($group_result);
$group_slug = $group_record['slug'];
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
      <h2>Quản lý Người Dùng</h2>
      <table id="myTable">
        <thead>
          <tr>
            <th>Tên</th>
            <th>Email</th>
            <th>Giới Tính</th>
            <th>Ngày Sinh</th>
            <!-- <th>Chỉnh Sửa</th> -->
            <!-- <th>Xóa</th> -->
            <th>Role</th>
          </tr>
        </thead>
        <tbody>
          <?php while($user = mysqli_fetch_assoc($users)) : ?>
          <tr>
            <td><?= "{$user['last_name']} {$user['first_name']}" ?></td>
            <td><?= "{$user['email']}" ?></td>
            <td><?php echo ($user['gender'] == 1) ? "Nam" : "Nữ" ?></td>
            <td><?= "{$user['dob']}" ?></td>
            <!-- <td><a href="<?= ROOT_URL ?>admin-dashboard/edit-user.php?id=<?= $user['id'] ?>" class="btn sm">Chỉnh Sửa</a></td> -->
            <!-- <td><a href="<?= ROOT_URL ?>admin-dashboard/delete-user.php?id=<?= $user['id'] ?>" class="btn sm danger">Xóa</a></td> -->
            <td><?= ($_SESSION['user_is_admin'] == true) ? 'Author' : 'Admin' ?></td>
          </tr>
          <?php endwhile ?>
        </tbody>
      </table>
    </main>

<?php 
include 'partials/footer.php'
?>
