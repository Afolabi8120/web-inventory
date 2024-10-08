<?php 
  
  $pageTitle = "Create Supplier";
  require('core/validate/supplier.php');
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
            <h1>Create Supplier</h1>
          </div>

          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Add New Supplier</h4>
                  </div>
                  <div class="card-body">
                    <div class="col-12 col-md-12 col-lg-12">
                      <form method="POST">
                        <div class="row">
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
                          <div class="form-group col-md-12">
                            <label>Address <span class="small">(optional)</span></label>
                            <textarea class="form-control" name="address"></textarea>
                          </div>
                          <div class="col-12">
                            <input type="submit" class="btn btn-primary" name="btnAddSupplier" value="Create Account">
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
                    <h4>All Suppliers</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>          
                            <th class="text-center">
                              #
                            </th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Created On</th>
                            <th>Updated On</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody> 
                          <?php
                            $i = 1;
                            foreach ($admin->selectAll('tblsupplier') as $fetchSupplier):
                          ?>                                
                          <tr>
                            <td>
                              <?= $i++; ?>
                            </td>
                            <td><?= ucwords($fetchSupplier->fullname); ?></td>
                            <td><?= $fetchSupplier->email; ?></td>
                            <td><div class="badge badge-dark"><?= $fetchSupplier->created_date; ?></div></td>
                            <td><div class="badge badge-dark"><?= $fetchSupplier->updated_date; ?></div></td>
                            <td>
                              <a href="edit-supplier?id=<?= $fetchSupplier->supplier_id; ?>" class="btn btn-warning btn-sm mb-2">Edit</a>
                              <form method="POST">
                                <input type="hidden" class="form-control" name="supplier_id" value="<?= $fetchSupplier->supplier_id; ?>" readonly>
                                <input type="submit" class="btn btn-sm btn-danger" name="btnDeleteSupplier" onclick="return confirm('Remove this supplier account?')" value="Delete">
                              </form>
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
