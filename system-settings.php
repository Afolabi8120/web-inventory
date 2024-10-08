<?php 
  
  $pageTitle = "System Settings";
  require('core/validate/supplier.php');
  include('includes/head.php'); 

  if(isset($_SESSION['admin']) AND !empty($_SESSION['admin'])){
    $user_id = $_SESSION['admin'];
    $getAdmin = $admin->fetchSingle('tbluser','user_id',$user_id);
    $getStoreData = $admin->fetch('tblsettings');
  }else{
      header('location: login');
  }

?>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>

      <!-- Nav Bar Starts Here -->
      <?php include('includes/navbar.php'); ?>
      <!-- Nav Bar Ends Here -->

      <!-- Side Bar Starts Here -->
      <?php include('includes/sidebar.php'); ?>
      <!-- Side Bar Ends Here -->

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>System Settings</h1>
          </div>

          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>System Settings</h4>
                  </div>
                  <div class="card-body">
                    <div class="col-12 col-md-12 col-lg-12">
                      <form method="POST">
                        <div class="row">
                          <div class="form-group col-md-6">
                            <label>Store Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Elon Musk Store" value="<?= ucwords($getStoreData->name); ?>">
                          </div>
                          <div class="form-group col-md-6">
                            <label>Phone</label>
                            <input type="tel" class="form-control" name="phone" placeholder="08090949669" maxlength="11" value="<?= $getStoreData->phone; ?>">
                          </div>
                          <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="elon.musk@spacex.org" value="<?= $getStoreData->email; ?>">
                          </div>
                          <div class="form-group col-md-6">
                            <label>Motto</label>
                            <input type="text" class="form-control" name="motto" placeholder="low price always..." value="<?= $getStoreData->motto; ?>">
                          </div>
                          <div class="form-group col-md-12">
                            <label>Address</label>
                            <textarea class="form-control" name="address"><?= ucwords($getStoreData->address); ?></textarea>
                          </div>
                          <div class="col-12">
                            <input type="submit" class="btn btn-primary" name="btnSettings" value="Submit">
                            <a href="dashboard" class="btn btn-danger">Back</a>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </section>
      </div>

      <?php include('includes/footer.php'); ?>
