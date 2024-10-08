<?php 
  
  $pageTitle = "Stock Adjustment";
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
            <h1>Stock Adjustment</h1>
          </div>

          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Stock Adjustment</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>          
                            <th class="text-center">
                              #
                            </th>
                            <th>Image</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Unit</th>
                            <th>In Stock</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody> 
                          <?php
                            $i = 1;
                            foreach ($admin->selectAll('tblproduct') as $fetchProduct):
                          ?>

                          <tr>
                            <td>
                              <?= $i++; ?>
                            </td>
                            <td>
                              <img src="assets/product_image/<?= $fetchProduct->product_image; ?>" height="70" width="70" class="rounded-circle">    
                            </td>
                            <td><span class="badge badge-dark font-weight-bold"><?= $fetchProduct->product_code; ?></span></td>
                            <td class="font-weight-bold"><?= ucwords($fetchProduct->product_name); ?></td>
                            <td>
                              <?= number_format($fetchProduct->selling_price, 00); ?>    
                            </td>
                            <td>
                              <span class="badge badge-secondary"><?= $fetchProduct->unit; ?></span>
                            </td>
                            <td class="font-weight-bold">
                              <?= $fetchProduct->quantity; ?>
                            </td>
                            <td class="font-weight-bold">
                              <?php 

                                $getCategory = $admin->fetchSingle('tblcategory','cat_id',$fetchProduct->category_id);

                                echo ucwords($getCategory->name);

                              ?>
                            </td>
                            <td>
                              <?php $product->showProductBadge($fetchProduct->product_id); ?>
                            </td>
                            <td>
                              <a href="edit-stock?id=<?= $fetchProduct->product_id; ?>" class="btn btn-dark btn-sm mb-2" title="Adjust Product Quantity"><i class="fas fa-plus"></i></a>
                            </td>
                          </tr>
                          <?php endforeach; ?>
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
