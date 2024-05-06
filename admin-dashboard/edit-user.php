<?php 
include 'partials/header.php';

if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM users WHERE id = $id ";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
}
else{
  header('location: ' . ROOT_URL . 'admin-dashboard/manage-user.php');
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

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Chỉnh Sửa Người Dùng</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
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
              <h5 class="card-title">Chỉnh sửa Người Dùng</h5>

              <!-- General Form Elements -->
                <form action="<?= ROOT_URL ?>admin-dashboard/edit-user-logic.php" method="POST">
                      <div class="col-sm-10">
                        <input type="hidden" class="form-control" value="<?= $user['id'] ?>" name="id">
                      </div>
                    <div class="row mb-3">
                      <label for="inputText" class="col-sm-2 col-form-label">Tên Đệm và Tên</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?= $user['firstname'] ?>" name="firstname">
                      </div>
                    </div>

                    <form enctype="multipart/form-data">
                        <div class="row mb-3">
                          <label for="inputText" class="col-sm-2 col-form-label">Họ</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="lastname" value="<?= $user['lastname'] ?>">
                          </div>
                        </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Select</label>
                    <div class="col-sm-10">
                      <select class="form-select" aria-label="Default select example" name="role" value="role">
                        <option selected>Phân Quyền</option>
                        <option value="0">Author</option>
                        <option value="1">Admin</option>
                      </select>
                    </div>
                  </div>
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Chỉnh sửa</button>
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