<?php 
  
  $pageTitle = "Create User";
  require('core/validate/user.php');
  include('includes/head.php'); 

  if(isset($_SESSION['admin']) AND !empty($_SESSION['admin'])){
    $user_id = $_SESSION['admin'];
    $getAdmin = $admin->fetchSingle('tbluser','user_id',$user_id);
  }else{
      header('location: login');
  }
  
  if(isset($_GET['id']) AND !empty($_GET['id'])){

    $_GET['id'] = stripcslashes($_GET['id']);
    $user_id = $_GET['id'];

    // check if user id exist
    if($admin->select('tbluser','user_id',$user_id) === false){
      header('location: create-user');
    }
    else if($admin->select('tbluser','user_id',$user_id) === true){
      $fetchUserData = $admin->fetchSingle('tbluser','user_id',$user_id);
    }
  }elseif(!isset($_GET['id']) AND empty($_GET['id'])){
    header('location: create-user');
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
            <h1>Edit User</h1>
          </div>

          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Edit User Info</h4>
                  </div>
                  <div class="card-body">
                    <div class="col-12 col-md-12 col-lg-12">
                      <form method="POST">
                        <div class="row">
                          <div class="form-group col-md-5">
                            <label>Username</label>
                            <input type="hidden" class="form-control" name="user_id" value="<?= $fetchUserData->user_id; ?>" readonly>
                            <input type="text" class="form-control" name="username" value="<?= $fetchUserData->username; ?>" placeholder="ElonX">
                          </div>
                          <div class="form-group col-md-7">
                            <label>Full Name</label>
                            <input type="text" class="form-control" name="fullname" value="<?= $fetchUserData->fullname; ?>" placeholder="Elon Musk">
                          </div>
                          <div class="form-group col-md-4">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="elon.musk@spacex.org" value="<?= $fetchUserData->email; ?>">
                          </div>
                          <div class="form-group col-md-4">
                            <label>Phone</label>
                            <input type="tel" class="form-control" name="phone" placeholder="08090949669" maxlength="11" value="<?= $fetchUserData->phone; ?>">
                          </div>
                          <div class="form-group col-md-4">
                            <label>UserType</label>
                            <select name="usertype" class="form-control form-control-sm">
                              <option value="" selected disabled>Select Usertype</option>
                              <option value="a" <?php if($fetchUserData->usertype == 'a'){ echo "selected"; } ?>>Admin</option>
                              <option value="u" <?php if($fetchUserData->usertype == 'u'){ echo "selected"; } ?>>User</option>
                            </select>
                          </div>
                          <div class="col-12">
                            <input type="submit" class="btn btn-primary" name="btnEditUser" value="Edit Account">
                            <a href="create-user" class="btn btn-danger">Back</a>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Change User Password</h4>
                  </div>
                  <div class="card-body">
                    <div class="col-12 col-md-12 col-lg-12">
                      <form method="POST">
                          <div class="form-group col-md-12">
                            <label>Password</label>
                            <input type="hidden" class="form-control" name="user_id" value="<?= $fetchUserData->user_id; ?>" readonly>
                            <input type="password" class="form-control" name="password" placeholder="***********">
                          </div>
                          <div class="form-group col-md-12">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" name="cpassword" placeholder="***********">
                          </div>
                          <div class="col-12">
                            <input type="submit" class="btn btn-primary" name="btnChangeUserPassword" value="Change Password">
                            <a href="create-user" class="btn btn-danger">Back</a>
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
