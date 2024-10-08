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
            <h1>Create User</h1>
          </div>

          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Add New User</h4>
                  </div>
                  <div class="card-body">
                    <div class="col-12 col-md-12 col-lg-12">
                      <form method="POST">
                        <div class="row">
                          <div class="form-group col-md-3">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" placeholder="ElonX">
                          </div>
                          <div class="form-group col-md-5">
                            <label>Full Name</label>
                            <input type="text" class="form-control" name="fullname" placeholder="Elon Musk">
                          </div>
                          <div class="form-group col-md-4">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="elon.musk@spacex.org">
                          </div>
                          <div class="form-group col-md-3">
                            <label>Phone</label>
                            <input type="tel" class="form-control" name="phone" placeholder="08090949669" maxlength="11">
                          </div>
                          <div class="form-group col-md-3">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" placeholder="***********">
                          </div>
                          <div class="form-group col-md-3">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" name="cpassword" placeholder="***********">
                          </div>
                          <div class="form-group col-md-3">
                            <label>UserType</label>
                            <select name="usertype" class="form-control form-control-sm">
                              <option value="" selected readonly>Select Usertype</option>
                              <option value="a">Admin</option>
                              <option value="u">User</option>
                            </select>
                          </div>
                          <div class="col-12">
                            <input type="submit" class="btn btn-primary" name="btnAddUser" value="Create Account">
                            <a href="dashboard" class="btn btn-danger">Back</a>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>All Users</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>          
                            <th class="text-center">
                              #
                            </th>
                            <th>Username</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Usertype</th>
                            <th>Created On</th>
                            <th>Updated On</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody> 
                          <?php
                            $i = 1;
                            #foreach ($admin->selectWhere('tbluser','usertype','u') as $fetchUser):
                            foreach ($admin->selectAll('tbluser') as $fetchUser):
                          ?>                                
                          <tr>
                            <td>
                              <?= $i++; ?>
                            </td>
                            <td><?= ucwords($fetchUser->username); ?></td>
                            <td><?= ucwords($fetchUser->fullname); ?></td>
                            <td><?= $fetchUser->email; ?></td>
                            <td>
                              <?php $user->showUserBadge($fetchUser->user_id); ?>
                            </td>
                            <td><div class="badge badge-dark"><?= $fetchUser->created_date; ?></div></td>
                            <td><div class="badge badge-dark"><?= $fetchUser->updated_date; ?></div></td>
                            <td>
                              <a href="edit-user?id=<?= $fetchUser->user_id; ?>" class="btn btn-sm btn-warning mb-2">Edit</a>
                              <?php if($fetchUser->usertype == 'u'): ?>
                              <form method="POST">
                                <input type="hidden" class="form-control" name="user_id" value="<?= $fetchUser->user_id; ?>" readonly>
                                <input type="submit" class="btn btn-sm btn-danger" name="btnDeleteUser" onclick="return confirm('Remove this user account?')" value="Delete">
                              </form>
                              <?php endif; ?>
                            </td>
                          </tr>
                          <?php
                            endforeach;
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

            </div>
        </section>
      </div>

      <?php include('includes/footer.php'); ?>
