<?php 
  
  $pageTitle = "Reports";
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
            <h1>Records & Reports</h1>
          </div>

          <div class="row">
              
              <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Records & Reports</h4>
                  </div>
                  <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="salessummary-tab2" data-toggle="tab" href="#salessummary2" role="tab" aria-controls="home" aria-selected="true">Sales Summary</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="stock_inventoty-tab2" data-toggle="tab" href="#stock_inventoty2" role="tab" aria-controls="profile" aria-selected="false">Stock Inventory</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="contact-tab2" data-toggle="tab" href="#contact2" role="tab" aria-controls="contact" aria-selected="false">Stock Adjustment History</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" id="loghistory-tab2" data-toggle="tab" href="#loghistory2" role="tab" aria-controls="loghistory" aria-selected="true">Log History</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="profit-tab2" data-toggle="tab" href="#profit2" role="tab" aria-controls="profit" aria-selected="false">Profit</a>
                      </li>
                    </ul>
                    <div class="tab-content tab-bordered" id="myTab3Content">
                      <div class="tab-pane fade show active" id="salessummary2" role="tabpanel" aria-labelledby="salessummary-tab2">
                        <div class="col-12">
                          <!-- Sales Summary Starts Here -->
                            
                            <div class="row g-3">
                              <div class="col-md-3">
                                <label>From</label>
                                <input type="date" name="date_from" class="form-control">
                              </div>
                              <div class="col-md-3">
                                <label>To</label>
                                <input type="date" name="date_to" class="form-control">
                              </div>
                              <div class="col-md-2">
                                <label>&nbsp;</label>
                                <input type="submit" class="btn btn-dark btn-block " name="btnViewSalesSummary" value="View">
                              </div>
                            </div>

                            <div class="card">
                              <div class="card-body">
                                <div class="table-responsive">
                                  <table class="table table-striped" id="table-1">
                                    <thead>          
                                        <th class="text-center">
                                          #
                                        </th>
                                        <th>Invoice No</th>
                                        <th>Total Amount</th>
                                        <th>Payment Type</th>
                                        <th>Payment Status</th>
                                        <th>Sold By</th>
                                        <th>Date Sold</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody> 
                                      <?php
                                        $i = 1;
                                        foreach ($admin->selectAll('tblpayment') as $fetchSalesSummary):
                                      ?>

                                      <tr>
                                        <td>
                                          <?= $i++; ?>
                                        </td>
                                        <td class="font-weight-bold">
                                          <?= $fetchSalesSummary->invoiceno; ?>
                                        </td>
                                        <td>
                                          <?= number_format($fetchSalesSummary->total, 00); ?>
                                        </td>
                                        <td class="font-weight-bold">
                                          <span class="badge badge-secondary"><?= ucwords($fetchSalesSummary->paytype); ?></span>
                                        </td>
                                        <td class="font-weight-bold">
                                          <?= $order->printOrderStatusBadge($fetchSalesSummary->invoiceno); ?>
                                        </td>
                                        <td>
                                          <?php 
                                             
                                            $getCartData = $admin->fetchSingle('tblcart','invoiceno',$fetchSalesSummary->invoiceno);
                                            $getUserID = $admin->fetchSingle('tbluser','user_id',$getCartData->user_id);
                                            echo strtoupper($getUserID->username);
                                          ?>
                                        </td>
                                        <td>
                                          <?= $fetchSalesSummary->date_paid; ?>
                                        </td>
                                        <td>
                                          <a href="view_sales_summary?invoiceno=<?= $fetchSalesSummary->invoiceno; ?>" class="btn btn-info"><i class="fas fa-eye"></i></a>
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
                      <div class="tab-pane fade" id="stock_inventoty2" role="tabpanel" aria-labelledby="stock_inventoty-tab2">
                        Sed sed metus vel lacus hendrerit tempus. Sed efficitur velit tortor, ac efficitur est lobortis quis. Nullam lacinia metus erat, sed fermentum justo rutrum ultrices. Proin quis iaculis tellus. Etiam ac vehicula eros, pharetra consectetur dui. Aliquam convallis neque eget tellus efficitur, eget maximus massa imperdiet. Morbi a mattis velit. Donec hendrerit venenatis justo, eget scelerisque tellus pharetra a.
                      </div>
                      <div class="tab-pane fade" id="contact2" role="tabpanel" aria-labelledby="contact-tab2">
                        Vestibulum imperdiet odio sed neque ultricies, ut dapibus mi maximus. Proin ligula massa, gravida in lacinia efficitur, hendrerit eget mauris. Pellentesque fermentum, sem interdum molestie finibus, nulla diam varius leo, nec varius lectus elit id dolor. Nam malesuada orci non ornare vulputate. Ut ut sollicitudin magna. Vestibulum eget ligula ut ipsum venenatis ultrices. Proin bibendum bibendum augue ut luctus.
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
        </section>
      </div>

      <?php include('includes/footer.php'); ?>
