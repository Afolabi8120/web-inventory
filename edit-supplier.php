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
  
  if(isset($_GET['id']) AND !empty($_GET['id'])){

    $_GET['id'] = stripcslashes($_GET['id']);
    $supplier_id = $_GET['id'];

    // check if user id exist
    if($admin->select('tblsupplier','supplier_id',$supplier_id) === false){
      header('location: create-user');
    }
    else if($admin->select('tblsupplier','supplier_id',$supplier_id) === true){
      $fetchSupplierData = $admin->fetchSingle('tblsupplier','supplier_id',$supplier_id);
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
            <h1>Edit Supplier</h1>
          </div>

          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Edit Supplier's Account</h4>
                  </div>
                  <div class="card-body">
                    <div class="col-12 col-md-12 col-lg-12">
                      <form method="POST">
                        <div class="row">
                          <div class="form-group col-md-5">
                            <label>Full Name</label>
                            <input type="hidden" class="form-control" name="supplier_id" value="<?= $fetchSupplierData->supplier_id; ?>" readonly>
                            <input type="text" class="form-control" name="fullname" value="<?= ucwords($fetchSupplierData->fullname); ?>" placeholder="Elon Musk">
                          </div>
                          <div class="form-group col-md-4">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="<?= $fetchSupplierData->email; ?>" placeholder="elon.musk@spacex.org">
                          </div>
                          <div class="form-group col-md-3">
                            <label>Phone</label>
                            <input type="tel" class="form-control" name="phone" value="<?= $fetchSupplierData->phone; ?>" placeholder="08090949669" maxlength="11">
                          </div>
                          <div class="form-group col-md-12">
                            <label>Address <span class="small">(optional)</span></label>
                            <textarea class="form-control" name="address"><?= $fetchSupplierData->address; ?></textarea>
                          </div>
                          <div class="col-12">
                            <input type="submit" class="btn btn-primary" name="btnEditSupplier" value="Edit Account">
                            <a href="create-supplier" class="btn btn-danger">Back</a>
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
