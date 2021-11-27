<?php
  session_start();
  require_once "function.php";
  $user_id = $_SESSION['id'] ?? 0;
  is_authenticate($user_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Melody Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/css/all.min.css">
  <link rel="stylesheet" href="assets/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="assets/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
              <div class="brand-logo">
                <img src="assets/images/logo.svg" alt="logo">
              </div>
            <!-- Start button -->
                <button class="btn btn-danger btn-fw menu-item" data-target="login">Login</button>
                <button class="btn btn-info btn-fw menu-item" data-target="register">Register</button>
                <hr>
            <!-- End Button -->
              <!-- Login -->
              <div id="login" class="auth">
                <?php 
                  $status = $_GET['status'] ?? 0;
                  if($status):
                ?>
                <div class="alert alert-fill-danger" role="alert">
                  <i class="fa fa-exclamation-triangle"></i>
                  <?php echo getStatusMessage($status); ?>
                </div>
                <?php endif; ?>

                <h4>Hello! let's get started</h4>
                <h6 class="font-weight-light">Sign in to continue.</h6>
                <form class="pt-3" action="process.php" method="post">
                    <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email...">
                    </div>
                    <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <input type="hidden" name="action" value="login">
                    <div class="mt-3">
                      <input class="btn btn-block btn-danger btn-lg font-weight-medium auth-form-btn" type="submit" value="Submit">
                    </div>
                    <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input">
                        Keep me signed in
                        </label>
                    </div>
                    <a href="#" class="auth-link text-black">Forgot password?</a>
                    </div>
                </form>
              </div>
              <!-- Register -->
              <div id="register" class="auth" style="display: none;"> 
                <h4>New here?</h4>
                <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
                <form class="pt-3" action="process.php" method="post">
                    <div class="form-group">
                    <input type="text" name="name" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Name">
                    </div>
                    <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email">
                    </div>
                    <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="mb-4">
                        <input type="hidden" name="action" value="register">
                    </div>
                    <div class="mt-3">
                      <input class="btn btn-block btn-info btn-lg font-weight-medium auth-form-btn" type="submit" value="Submit">
                    </div>
                </form>
              </div>
            <!-- End Register -->

            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="assets/js/vendor.bundle.base.js"></script>
  <script src="assets/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/hoverable-collapse.js"></script>
  <script src="assets/js/misc.js"></script>
  <script src="assets/js/settings.js"></script>
  <script src="assets/js/todolist.js"></script>
  <!-- endinject -->

  <script src="assets/js/script.js"></script>
</body>


</html>
