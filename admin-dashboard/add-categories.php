<?php
include 'partials/header.php';

$title = $_SESSION['add-categories-data']['title'] ?? null;
$description = $_SESSION['add-categories-data']['description'] ?? null;
// delete signup data session
unset($_SESSION['add-categories-data']);
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
    <h1>Thêm Phân Loại</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">Thêm</li>
        <li class="breadcrumb-item active">Phân Loại</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-6">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Thêm Phân Loại</h5>

            <!-- General Form Elements -->
            <?php if (isset($_SESSION['add-categories'])) : ?>
              <div class="alert_message error">
                <p>
                  <?= $_SESSION['add-categories'];
                  unset($_SESSION['add-categories']);
                  ?>
                </p>
              </div>
            <?php endif ?>
            <form action="<?php ROOT_URL ?>add-categories-logic.php" enctype="multipart/form-data" method="POST">
              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Tên Loại</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="title" value="<?= $title ?>">
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Miêu tả</label>
                <div class="col-sm-10">
                  <textarea name="description" rows="4" cols="57" value="<?= $description ?>"></textarea>
                </div>
              </div>

              <div class="row mb-3">
                  <label for="thumbnail" class="col-sm-2 col-form-label">Thumb</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" id="thumbnail" name="thumbnail">
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