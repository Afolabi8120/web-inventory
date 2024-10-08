<?php 
  
  $pageTitle = "Edit Product";
  require('core/validate/product.php');
  include('includes/head.php'); 

  if(isset($_SESSION['admin']) AND !empty($_SESSION['admin'])){
    $user_id = $_SESSION['admin'];
    $getAdmin = $admin->fetchSingle('tbluser','user_id',$user_id);
  }else{
      header('location: login');
  }

  if(isset($_GET['id']) AND !empty($_GET['id'])){

    $_GET['id'] = stripcslashes($_GET['id']);
    $product_id = $_GET['id'];

    // check if product id exist
    if($admin->select('tblproduct','product_id',$product_id) === false){
      header('location: product');
    }
    else if($admin->select('tblproduct','product_id',$product_id) === true){
      $fetchProductData = $admin->fetchSingle('tblproduct','product_id',$product_id);
    }
  }elseif(!isset($_GET['id']) AND empty($_GET['id'])){
    header('location: product');
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
            <h1>Edit Product</h1>
          </div>

          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Edit Product</h4>
                  </div>
                  <div class="card-body">
                    <div class="col-12 col-md-12 col-lg-12">
                      <form method="POST" enctype="multipart/form-data">
                        <div class="row">
                          <div class="form-group col-md-4">
                            <label>Product Code</label>
                            <input type="hidden" class="form-control" name="product_id" value="<?= $fetchProductData->product_id; ?>" readonly>
                            <input type="text" class="form-control" name="product_code" value="<?= $fetchProductData->product_code; ?>" readonly>
                          </div>
                          <div class="form-group col-md-5">
                            <label>Product Name</label>
                            <input type="text" class="form-control" name="product_name" value="<?= ucwords($fetchProductData->product_name); ?>" placeholder="Coca Cola">
                          </div>
                          <div class="form-group col-md-3">
                            <label>Product Barcode</label>
                            <input type="text" class="form-control" name="barcode" placeholder="0000000000000" value="<?= $fetchProductData->barcode; ?>">
                          </div>
                          <div class="form-group col-md-3">
                            <label>Supplier</label>
                            <select name="supplier_id" class="form-control form-control-sm">
                              <?php foreach($admin->selectAll('tblsupplier') as $getSupplier): ?>
                              <option value="<?= ucwords($getSupplier->supplier_id); ?>" <?php if($getSupplier->supplier_id == $fetchProductData->supplier_id){ echo "selected"; } ?> ><?= ucwords($getSupplier->fullname); ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                          <div class="form-group col-md-3">
                            <label>Category</label>
                            <select name="category_id" class="form-control form-control-sm">
                              <?php foreach($admin->selectAll('tblcategory') as $getCategory): ?>
                              <option value="<?= ucwords($getCategory->cat_id); ?>" <?php if($getCategory->cat_id == $fetchProductData->category_id){ echo "selected"; } ?> ><?= ucwords($getCategory->name); ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                          <div class="form-group col-md-2">
                            <label>Buying Price</label>
                            <input type="text" class="form-control" name="buying_price" value="<?= $fetchProductData->buying_price; ?>" placeholder="10.5">
                          </div>
                          <div class="form-group col-md-2">
                            <label>Selling Price</label>
                            <input type="text" class="form-control" name="selling_price" value="<?= $fetchProductData->selling_price; ?>" placeholder="13.5">
                          </div>
                          <div class="form-group col-md-2">
                            <label>Quantity</label>
                            <input type="text" class="form-control" name="quantity" value="<?= $fetchProductData->quantity; ?>" placeholder="20">
                          </div>
                          <div class="form-group col-md-2">
                            <label>Unit</label>
                            <select name="unit" class="form-control form-control-sm">
                              <option value="kg" <?php if($fetchProductData->unit == "kg"){ echo "selected"; } ?> >Kilogram</option>
                              <option value="pack" <?php if($fetchProductData->unit == "pack"){ echo "selected"; } ?>>Pack</option>
                              <option value="piece" <?php if($fetchProductData->unit == "piece"){ echo "selected"; } ?>>Pieces</option>
                              <option value="size" <?php if($fetchProductData->unit == "size"){ echo "selected"; } ?>>Size</option>
                              <option value="unit" <?php if($fetchProductData->unit == "unit"){ echo "selected"; } ?>>Unit</option>
                            </select>
                          </div>
                          <div class="form-group col-md-4">
                            <label>Product Image</label>
                            <input type="file" class="form-control" name="product_image" >
                          </div>
                          <div class="form-group col-md-3">
                            <label>Reorder Level</label>
                            <input type="text" class="form-control" name="reorder_level" value="<?= $fetchProductData->reorder_level; ?>" placeholder="10">
                          </div>
                          <div class="form-group col-md-3">
                            <label>Status</label>
                            <select name="status" class="form-control form-control-sm">
                              <option value="1" <?php if($fetchProductData->status == "1"){ echo "selected"; } ?> >Available</option>
                              <option value="0" <?php if($fetchProductData->status == "0"){ echo "selected"; } ?> >Not Available</option>
                            </select>
                          </div>
                          <div class="form-group col-md-3">
                            <label>Manufactured date</label>
                            <input type="date" class="form-control" name="manufacture_date" value="<?= $fetchProductData->manufacture_date; ?>" placeholder="10">
                          </div>
                          <div class="form-group col-md-3">
                            <label>Expiry Date</label>
                            <input type="date" class="form-control" name="expiry_date" value="<?= $fetchProductData->expiry_date; ?>" placeholder="10">
                          </div>
                          <div class="form-group col-md-12">
                            <label>Description <span class="small">(optional)</span></label>
                            <textarea class="form-control" name="description"><?= $fetchProductData->description; ?></textarea>
                          </div>
                          <div class="col-12">
                            <input type="submit" class="btn btn-primary" name="btnEditProduct" value="Edit Product">
                            <a href="product" class="btn btn-danger">Back</a>
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
