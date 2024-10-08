<?php 
  
  $pageTitle = "Profile";
  require('core/validate/user.php');
  include('includes/head.php'); 

  if(isset($_SESSION['admin']) AND !empty($_SESSION['admin'])){
    $user_id = $_SESSION['admin'];
    $getAdmin = $admin->fetchSingle('tbluser','user_id',$user_id);
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
            <h1>Profile</h1>
          </div>

          <div class="row">
              
              <div class="col-8">
                <div class="card">
                  <div class="card-header">
                    <h4>Edit Profile</h4>
                  </div>
                  <div class="card-body">
                    <div class="col-12 col-md-12 col-lg-12">
                      <form method="POST">
                        <div class="row">
                          <div class="form-group col-md-6">
                            <label>Username</label>
                            <input type="hidden" class="form-control" name="user_id" value="<?= ucwords($getAdmin->user_id); ?>" placeholder="ElonX" readonly>
                            <input type="text" class="form-control" name="username" value="<?= ucwords($getAdmin->username); ?>" placeholder="ElonX" readonly>
                          </div>
                          <div class="form-group col-md-6">
                            <label>Full Name</label>
                            <input type="text" class="form-control" name="fullname" value="<?= ucwords($getAdmin->fullname); ?>" placeholder="Elon Musk">
                          </div>
                          <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="<?= $getAdmin->email; ?>" placeholder="elon.musk@spacex.org" readonly>
                          </div>
                          <div class="form-group col-md-6">
                            <label>Phone</label>
                            <input type="tel" class="form-control" name="phone" value="<?= $getAdmin->phone; ?>" placeholder="08090949669" maxlength="11">
                          </div>
                          <div class="col-12">
                            <input type="submit" class="btn btn-primary" name="btnUpdateProfile" value="Save Changes">
                            <a href="dashboard" class="btn btn-danger">Back</a>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-4">
                <div class="card">
                  <div class="card-header">
                    <h4>Change Password</h4>
                  </div>
                  <div class="card-body">
                    <div class="col-12 col-md-12 col-lg-12">
                      <form method="POST">
                        <div class="row">
                          <div class="form-group col-md-12">
                            <label>Old Password</label>
                            <input type="hidden" class="form-control" name="user_id" value="<?= ucwords($getAdmin->user_id); ?>" placeholder="ElonX" readonly>
                            <input type="password" class="form-control" name="old_password" placeholder="***********">
                          </div>
                          <div class="form-group col-md-12">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" placeholder="***********">
                          </div>
                          <div class="form-group col-md-12">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" name="cpassword" placeholder="***********">
                          </div>
                          <div class="col-12">
                            <input type="submit" class="btn btn-primary" name="btnChangeProfilePassword" value="Change Password">
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
