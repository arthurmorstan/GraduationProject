<?php
include 'partials/header.php';

if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM news_categories WHERE id = $id ";
    $result = mysqli_query($connection, $query);
    if(mysqli_num_rows($result) == 1){
        $categories = mysqli_fetch_assoc($result);
    }
}
else{
  header('location: ' . ROOT_URL . 'admin-dashboard/manage-categories.php');
  die();
}
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
    <h1>Chỉnh Sửa Phân Loại</h1>
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
            <h5 class="card-title">Chỉnh Sửa Phân Loại</h5>

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
            <form action="<?php ROOT_URL ?>edit-categories-logic.php" method="POST" enctype="multipart/form-data">
                <div class="col-sm-10">
                  <input type="hidden" class="form-control" name="id" value="<?= $categories['id'] ?>">
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-sm-10">
                  <input type="hidden" name="previous_thumbnail_name" class="form-control" value="<?= $categories['thumbnail'] ?>">
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Tên Loại</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="title" id="title" value="<?= $categories['title'] ?>">
                </div>
              </div>

              <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Slug</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="slug" id="slug" value="<?= $categories['slug'] ?>">
                  </div>
                </div>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Miêu tả</label>
                <div class="col-sm-10">
                  <textarea name="description" rows="4" cols="57" ><?= $categories['description'] ?></textarea>
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
                  <button type="submit" name="submit" class="btn btn-primary">Edit</button>
                </div>
              </div>

            </form><!-- End General Form Elements -->

          </div>
        </div>

      </div>
  </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
        <div class="copyright">
          &copy; Copyright <strong><span>Hoàng Duy</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
          Designed by <a href="#">Nguyễn Hoàng Duy</a>
        </div>
      </footer>
      <!-- End Footer -->

      <!-- Vendor JS Files -->
      <script src="./assets/vendor/apexcharts/apexcharts.min.js"></script>
      <script src="./assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="./assets/vendor/chart.js/chart.umd.js"></script>
      <script src="./assets/vendor/echarts/echarts.min.js"></script>
      <script src="./assets/vendor/quill/quill.min.js"></script>
      <script src="./assets/vendor/simple-datatables/simple-datatables.js"></script>
      <!-- <script src="./assets/vendor/tinymce/tinymce.min.js"></script> -->
      <script src="./assets/vendor/php-email-form/validate.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

      <!-- Template Main JS File -->
      <script src="admin-dashboard/assets/js/main.js"></script>
      <script src="main.js"></script>

      <!-- slug -->
      <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

      <script>
        jQuery('#title').change(function() {
          var title = jQuery('#title').val();
          jQuery.ajax({
              url: 'get-slug.php',
              type: 'POST',
              data: 'title='+title,
              success:function(result){
                jQuery('#slug').val(result);
              }
          })
        })

        jQuery('#btn').click(function() {
          var title = jQuery('#title').val();
          var slug = jQuery('#slug').val();
          jQuery.ajax({
              url: 'add-news-logic.php',
              type: 'POST',
              data: 'title='+title+'&slug='+slug,
              success:function(result){
                // jQuery('#slug').val(result);
              }
          })
        })
      </script>
      </body>

      </html>