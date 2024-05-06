<?php
include 'partials/header.php';

$first_name = $_SESSION['add-user-data']['first_name'] ?? null;
$last_name = $_SESSION['add-user-data']['last_name'] ?? null;
$email = $_SESSION['add-user-data']['email'] ?? null;
$phone = $_SESSION['add-user-data']['phone'] ?? null;
$sex = $_SESSION['add-user-data']['sex'] ?? null;
$dob = $_SESSION['add-user-data']['dateofbirth'] ?? null;
$is_admin = $_SESSION['add-user-data']['role'] ?? null;
$createpassword = $_SESSION['add-user-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['add-user-data']['confirmpassword'] ?? null;
// delete signup data session
unset($_SESSION['add-user-data']);
?>

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
      </ul>
    </li><!-- End Forms Nav -->
  </ul>

</aside><!-- End Sidebar-->

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Thêm Người Dùng</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">Thêm</li>
        <li class="breadcrumb-item active">Người Dùng</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-6">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Thêm Người Dùng</h5>

            <!-- General Form Elements -->
            <?php if (isset($_SESSION['add-user'])) : ?>
              <div class="alert_message error">
                <p>
                  <?= $_SESSION['add-user'];
                  unset($_SESSION['add-user']);
                  ?>
                </p>
              </div>
            <?php endif ?>
            <form enctype="multipart/form-data" action="<?php ROOT_URL ?>add-user-logic.php" method="POST">
              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Tên</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="first_name" value="<?= $first_name ?>">
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Họ</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="last_name" value="<?= $last_name ?>">
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" name="email" value="<?= $email ?>">
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">SĐT</label>
                <div class="col-sm-10">
                  <input type="tel" class="form-control" name="phone" value="<?= $phone ?>">
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Giới Tính</label>
                <div class="col-sm-10">
                  <select class="form-select" aria-label="Default select example" name="sex" >
                    <option selected>Chọn Giới Tính</option>
                    <option value="0">Nữ</option>
                    <option value="1">Nam</option>
                  </select>
                </div>
              </div>

              <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Ngày Sinh</label>
                <div class="col-sm-10">
                <input type="date" name="dateofbirth" class="form-control">
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Tạo Mật Khẩu</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" name="createpassword" value="<?= $createpassword ?>">
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Xác nhận Mật khẩu</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" name="confirmpassword" value="<?= $confirmpassword ?>">
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Role</label>
                <div class="col-sm-10">
                  <select class="form-select" aria-label="Default select example" name="role" >
                    <option selected>Phân Quyền</option>
                    <option value="2">Author</option>
                    <option value="1">Admin</option>
                  </select>
                </div>
              </div>

              <div class="row mb-3">
                <label for="avatar" class="col-sm-2 col-form-label">Avatar</label>
                <div class="col-sm-10">
                  <input class="form-control" type="file" id="avatar"  name="avatar">
                </div>
              </div>

              <div class="row mb-3">
                  <legend class="col-form-label col-sm-2 pt-0"></legend>
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="is_activated" value="1" id="is_activated" checked>
                      <label class="form-check-label" for="is_activated">
                        Activate
                      </label>
                    </div>
                  </div>
                </div>

              <div class="row mb-3">
                <div class="col-sm-10">
                  <button type="submit" name="submit" class="btn btn-primary">Thêm</button>
                </div>
              </div>

            </form><!-- End General Form Elements -->

          </div>
        </div>

      </div>
  </section>

</main><!-- End #main -->

<?php
include 'partials/footer.php'
?>