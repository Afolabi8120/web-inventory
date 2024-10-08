<?php 
  
  $pageTitle = "Create Product";
  require('core/validate/product.php');
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
            <h1>Create Product</h1>
          </div>

          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Add New Product</h4>
                  </div>
                  <div class="card-body">
                    <div class="col-12 col-md-12 col-lg-12">
                      <form method="POST" enctype="multipart/form-data">
                        <div class="row">
                          <div class="form-group col-md-4">
                            <label>Product Code</label>
                            <input type="text" class="form-control" name="product_code" value="<?= $product->generateProductCode(); ?>" readonly>
                          </div>
                          <div class="form-group col-md-5">
                            <label>Product Name</label>
                            <input type="text" class="form-control" name="product_name" placeholder="Coca Cola">
                          </div>
                          <div class="form-group col-md-3">
                            <label>Product Barcode <span class="small text-danger">(Scan barcode)</span></label>
                            <input type="text" class="form-control" name="barcode" placeholder="0000000000000">
                          </div>
                          <div class="form-group col-md-3">
                            <label>Supplier</label>
                            <select name="supplier_id" class="form-control form-control-sm">
                              <?php foreach($admin->selectAll('tblsupplier') as $getSupplier): ?>
                              <option value="<?= ucwords($getSupplier->supplier_id); ?>"><?= ucwords($getSupplier->fullname); ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                          <div class="form-group col-md-3">
                            <label>Category</label>
                            <select name="category_id" class="form-control form-control-sm">
                              <?php foreach($admin->selectAll('tblcategory') as $getCategory): ?>
                              <option value="<?= ucwords($getCategory->cat_id); ?>"><?= ucwords($getCategory->name); ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                          <div class="form-group col-md-2">
                            <label>Buying Price</label>
                            <input type="text" class="form-control" name="buying_price" placeholder="10.5">
                          </div>
                          <div class="form-group col-md-2">
                            <label>Selling Price</label>
                            <input type="text" class="form-control" name="selling_price" placeholder="13.5">
                          </div>
                          <div class="form-group col-md-2">
                            <label>Quantity</label>
                            <input type="text" class="form-control" name="quantity" placeholder="20">
                          </div>
                          <div class="form-group col-md-2">
                            <label>Unit</label>
                            <select name="unit" class="form-control form-control-sm">
                              <option value="kg">Kilogram</option>
                              <option value="pack">Pack</option>
                              <option value="piece">Pieces</option>
                              <option value="size">Size</option>
                              <option value="unit">Unit</option>
                            </select>
                          </div>
                          <div class="form-group col-md-4">
                            <label>Product Image</label>
                            <input type="file" class="form-control" name="product_image" >
                          </div>
                          <div class="form-group col-md-3">
                            <label>Reorder Level</label>
                            <input type="text" class="form-control" name="reorder_level" placeholder="10">
                          </div>
                          <div class="form-group col-md-3">
                            <label>Status</label>
                            <select name="status" class="form-control form-control-sm">
                              <option value="1">Available</option>
                              <option value="0">Not Available</option>
                            </select>
                          </div>
                          <div class="form-group col-md-3">
                            <label>Manufactured date</label>
                            <input type="date" class="form-control" name="manufacture_date" placeholder="10">
                          </div>
                          <div class="form-group col-md-3">
                            <label>Expiry Date</label>
                            <input type="date" class="form-control" name="expiry_date" placeholder="10">
                          </div>
                          <div class="form-group col-md-12">
                            <label>Description <span class="small">(optional)</span></label>
                            <textarea class="form-control summernote-simple" name="description"></textarea>
                          </div>
                          <div class="col-12">
                            <input type="submit" class="btn btn-primary" name="btnAddProduct" value="Create Product">
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
