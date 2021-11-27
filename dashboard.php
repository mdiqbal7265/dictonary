<?php
  session_start();
  require_once "function.php";
  $user_id = $_SESSION['id'] ?? 0;
  is_not_login($user_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Web Dictonary</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/css/all.min.css">
  <link rel="stylesheet" href="assets/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="assets/css/vendor.bundle.addons.css">
  <!-- endinject -->

  <!-- inject:css -->
  <link rel="stylesheet" href="assets/css/style.css">
  
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="index-2.html"><img src="assets/images/logo.png" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="index-2.html"><img src="assets/images/logo-mini.svg" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="fas fa-bars"></span>
        </button>
        
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="assets/images/avater.png" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="fas fa-cog text-primary"></i>
                Settings
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item logout" href="#">
                <i class="fas fa-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="profile-image">
                <img src="assets/images/avater.png" alt="image"/>
              </div>
              <div class="profile-name">
                <p class="name">
                  Welcome <?php echo $_SESSION['name']; ?>
                </p>
              </div>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link word-item" data-target="table" href="dashboard.php">
              <i class="fa fa-home menu-icon"></i>
              <span class="menu-title">All Words</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link word-item" data-target="form" href="#">
              <i class="fa fa-plus menu-icon"></i>
              <span class="menu-title">Add Words</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link word-item logout" href="#">
              <i class="fa fa-plus menu-icon"></i>
              <span class="menu-title">Logout</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Dashboard
            </h3>
          </div>
          <?php 
            $status = $_GET['status'] ?? 0;
            if($status):
          ?>
          <div class="alert alert-fill-danger" role="alert">
            <i class="fa fa-exclamation-triangle"></i>
            <?php echo getStatusMessage($status); ?>
          </div>
          <?php endif; ?>
          <!-- Table -->
          <div class="row word" id="table">
            <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">
              <h4 class="card-title">All Words</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th width="10">SI</th>
                            <th width="25">Word</th>
                            <th width="60">Meaning</th>
                            <th width="5">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $words = getWords($user_id);
                          if(count($words) > 0)
                          {
                            $length = count($words);
                            for($i = 0; $i < $length; $i++)
                            {
                              ?>
                        <tr>
                          <td width="10"><?php echo $i+1; ?></td>
                          <td width="25"><?php echo $words[$i]['word']; ?></td>
                          <td width="60"><?php echo $words[$i]['meaning']; ?></td>
                          <td width="5">
                            <a href="#" class="btn btn-outline-danger delete" data-taskid="<?php echo $words[$i]['id']; ?>">
                              <i class="fa fa-trash"></i>
                            </a>
                          </td>
                        </tr>

                         <?php }} ?>
                      
                      </tbody>
                    </table>
                    <form action="process.php" method="post" id="deleteform">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="taskid" id="taskid">
                    </form>
                    <form action="process.php" method="post" id="logout_form">
                      <input type="hidden" name="action" value="logout">
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
            </div>
          </div>
          <!-- Table -->
          <!-- Form -->
          <div class="row word" id="form" style="display: none;">
          <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add Word</h4>
                  <p class="card-description">
                    Add Word With Meaning
                  </p>
                  <form class="forms-sample" action="process.php" method="post">
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Word</label>
                      <div class="col-sm-9">
                        <input type="text" name="word" class="form-control" id="exampleInputUsername2" placeholder="Word">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleTextarea1" class="col-sm-3 col-form-label">Meaning</label>
                      <div class="col-sm-9">
                        <textarea class="form-control" name="meaning" id="exampleTextarea1" rows="4" placeholder="Meaning..."></textarea>
                      </div>
                    </div>
                    <input type="hidden" name="action" value="addword">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Form -->
        </div>
       
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2018. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="far fa-heart text-danger"></i></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="assets/js/vendor.bundle.base.js"></script>
  <script src="assets/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/hoverable-collapse.js"></script>
  <script src="assets/js/misc.js"></script>
  <script src="assets/js/settings.js"></script>
  <script src="assets/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="assets/js/data-table.js"></script>
  <script src="assets/js/script.js"></script>
</body>


</html>
