<?php 
  
  $pageTitle = "Current Stock";
  require('core/validate/user.php');
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
            <h1>Current Stock</h1>
          </div>

          <div class="row">
              
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <a href="export/export_current_stock_pdf" class="btn btn-primary mr-2"><i class="fas fa-file"></i> Export to PDF</a>
                    <a href="export/export_current_stock_excel" class="btn btn-primary"><i class="fas fa-file"></i> Export to Excel</a>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>          
                            <th class="text-center">
                              #
                            </th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>In Stock</th>
                          </tr>
                        </thead>
                        <tbody> 
                          <?php
                            $i = 1;
                            foreach ($admin->selectAllAsc('tblproduct','product_name') as $fetchProduct):
                          ?>

                          <tr>
                            <td>
                              <?= $i++; ?>
                            </td>
                            <td><span class="badge badge-dark font-weight-bold"><?= $fetchProduct->product_code; ?></span></td>
                            <td class="font-weight-bold"><?= ucwords($fetchProduct->product_name); ?></td>
                            <td class="font-weight-bold">
                              <?= $fetchProduct->quantity; ?>
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
