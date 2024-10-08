<?php 
  
  $pageTitle = "Edit Stock";
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
      header('location: stock-adjustment');
    }
    else if($admin->select('tblproduct','product_id',$product_id) === true){
      $fetchProductData = $admin->fetchSingle('tblproduct','product_id',$product_id);
    }
  }elseif(!isset($_GET['id']) AND empty($_GET['id'])){
    header('location: stock-adjustment');
  }

?>
<style>
  table{
    border: 1px solid black;
    border-spacing: 0px;
  }
  tr {
    padding: 10px;
    font-size: 14px;
    border: 1px solid black;
  }
  tbody tr, th, td {
    padding: 10px;
    border: 1px solid black;
  }
</style>

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
            <h1>Edit Stock</h1>
          </div>

          <div class="row">
              <div class="col-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Product Details</h4>
                  </div>
                  <div class="card-body">
                    <div class="col-12 col-md-12 col-lg-12 table-responsive">
                      <table class="table border font-weight-bold">
                        <tbody>
                          <tr>
                            <td>Product Image</td>
                            <td>
                              <img src="assets/product_image/<?= $fetchProductData->product_image; ?>" height="70" width="70" class="rounded-circle">
                            </td>
                          </tr>
                          <tr>
                            <td>Product Code</td>
                            <td><?= $fetchProductData->product_code; ?></td>
                          </tr>
                          <tr>
                            <td>Product Name</td>
                            <td><?= ucwords($fetchProductData->product_name); ?></td>
                          </tr>
                          <tr>
                            <td>Barcode</td>
                            <td><?= ucwords($fetchProductData->barcode); ?></td>
                          </tr>
                          <tr>
                            <td>Supplier</td>
                            <td>
                              <?php 
                                $getSupplier = $admin->fetchSingle('tblsupplier','supplier_id',$fetchProductData->supplier_id);

                                echo ucwords($getSupplier->fullname);
                              ?>    
                            </td>
                          </tr>
                          <tr>
                            <td>Category</td>
                            <td>
                              <?php 
                                $getCategory = $admin->fetchSingle('tblcategory','cat_id',$fetchProductData->category_id);

                                echo ucwords($getCategory->name);
                              ?>    
                            </td>
                          </tr>
                          <tr>
                            <td>Buying Price</td>
                            <td><?= $fetchProductData->buying_price; ?></td>
                          </tr>
                          <tr>
                            <td>Selling Price</td>
                            <td><?= $fetchProductData->selling_price; ?></td>
                          </tr>
                          <tr>
                            <td>Quantity</td>
                            <td><?= $fetchProductData->quantity; ?></td>
                          </tr>
                          <tr>
                            <td>Unit</td>
                            <td>
                              <?php 
                              switch($fetchProductData->unit):
                                case "kg":
                                echo "Kilogram";
                                break;
                                case "pack":
                                echo "Pack";
                                break;
                                case "piece":
                                echo "Pieces";
                                break;
                                case "size":
                                echo "Size";
                                break;
                                case "unit":
                                echo "Unit";
                                break;
                              endswitch;
                              ?>
                            </td>
                          </tr>
                          <tr>
                            <td>Manufactured date</td>
                            <td><?= $fetchProductData->manufacture_date; ?></td>
                          </tr>
                          <tr>
                            <td>Expiry Date</td>
                            <td><?= $fetchProductData->expiry_date; ?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Edit Stock</h4>
                  </div>
                  <div class="card-body">
                    <div class="col-12 col-md-12 col-lg-12">
                      <form method="POST" enctype="multipart/form-data">
                        <div class="row">
                          <div class="form-group col-md-6">
                            <label>Quantity</label>
                            <input type="hidden" class="form-control" name="product_id" value="<?= $fetchProductData->product_id; ?>" readonly>
                            <input type="text" class="form-control" name="quantity"  placeholder="20">
                          </div>
                          <div class="form-group col-md-6">
                            <label>Action</label>
                            <select name="action" class="form-control form-control-sm">
                              <option value="1">Add to Stock</option>
                              <option value="2">Remove from Stock</option>
                            </select>
                          </div>
                          <div class="form-group col-md-12">
                            <label>Reasons</label>
                            <textarea class="form-control" name="reasons"></textarea>
                          </div>
                          <div class="col-12">
                            <input type="submit" class="btn btn-primary" name="btnEditStock" value="Edit Stock">
                            <a href="stock-adjustment" class="btn btn-danger">Back</a>
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
