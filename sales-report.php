<?php 
  
  $pageTitle = "Sales Reports";
  require('core/init.php');
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
            <h1>Sales Reports</h1> 
          </div>

          <div class="row">
              
              <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <form method="POST">
                      <div class="row">
                        <div class="col-md-4">
                          <label>From</label>
                          <input type="date" name="date_from" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                          <label>To</label>
                          <input type="date" name="date_to" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                          <label>&nbsp;</label>
                          <input type="submit" class="btn btn-dark btn-block " name="btnViewSalesSummary" value="Get Report">
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <?php 
                if (isset($_POST['btnViewSalesSummary'])) {

                  $date_from = date('Y-m-d', strtotime($_POST['date_from']));
                  $date_to = date('Y-m-d', strtotime($_POST['date_to']));

                  if(empty($date_from) || empty($date_to)){
                    $_SESSION['messageTitle'] = "Empty Field";
                    $_SESSION['messageText'] = "Please select a date";
                    $_SESSION['messageIcon'] = "error";
                  }

              ?>
                  <div class="col-12 col-sm-12 col-lg-12">
                    <div class="card">
                      <div class="card-header">
                        <a href="export/export_sales_report_pdf?from=<?= $date_from; ?>&to=<?= $date_to; ?>" class="btn btn-primary mr-2"><i class="fas fa-file"></i> Export to PDF</a>
                        <a href="export/export_sales_report_excel?from=<?= $date_from; ?>&to=<?= $date_to; ?>" class="btn btn-primary"><i class="fas fa-file"></i> Export to Excel</a>
                      </div>
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="table table-striped" id="table-1">
                            <thead>          
                              <th class="text-center">
                                #
                              </th>
                              <th>Product Name</th>
                              <th>Qty</th>
                              <th>Price</th>
                              <th>Sub Total</th>
                              <th>Payment Type</th>
                              <th>Payment Status</th>
                              <th>Sold By</th>
                              <th>Date Sold</th>
                            </tr>
                          </thead>
                          <tbody> 
                            <?php
                            $i = 1;
                            foreach ($order->getSalesSummary($date_from,$date_to) as $fetchSalesSummary):
                              ?>

                              <tr>
                                <td>
                                  <?= $i++; ?>
                                </td>
                                <td class="font-weight-bold"><?= ucwords($fetchSalesSummary->product_name); ?></td>
                                <td>
                                  <?= $fetchSalesSummary->quantity; ?>    
                                </td>
                                <td>
                                  <?= number_format($fetchSalesSummary->price, 00); ?>    
                                </td>
                                <td>
                                  <?= number_format($fetchSalesSummary->total, 00); ?>
                                </td>
                                <td class="font-weight-bold">
                                  <span class="badge badge-secondary"><?= $fetchSalesSummary->paytype; ?></span>
                                </td>
                                <td class="font-weight-bold">
                                  <?= $order->printOrderStatusBadge($fetchSalesSummary->invoiceno); ?>
                                </td>
                                <td>
                                  <?php 

                                  $getSellerData = $admin->fetchSingle('tbluser','user_id',$fetchSalesSummary->user_id);
                                  echo strtoupper($getSellerData->username);
                                  ?>
                                </td>
                                <td>
                                  <?= $fetchSalesSummary->date_paid; ?>
                                </td>
                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
              <?php
                }
              ?>

          </div>
        </section>
      </div>

      <?php include('includes/footer.php'); ?>
