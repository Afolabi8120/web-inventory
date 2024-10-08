<div class="row">
  <div class="col-lg-3 col-md-6 col-sm-12 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon bg-primary">
        <i class="fas fa-shipping-fast"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Total Supplier(s)</h4>
        </div>
        <div class="card-body">
          <?= $admin->count('tblsupplier'); ?>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon bg-danger">
        <i class="fas fa-bookmark"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Categories</h4>
        </div>
        <div class="card-body">
          <?= $admin->count('tblcategory'); ?>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon bg-warning">
        <i class="fas fa-users"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Total Users</h4>
        </div>
        <div class="card-body">
          <?= $admin->countByColumn('tbluser','usertype','u'); ?>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon bg-success">
        <i class="fas fa-boxes"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>All Product(s)</h4>
        </div>
        <div class="card-body">
          <?= $admin->count('tblproduct'); ?>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon bg-info">
        <i class="fas fa-box"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>All Active Product(s)</h4>
        </div>
        <div class="card-body">
          <?= $admin->countByColumn('tblproduct','status','1'); ?>
        </div>
      </div>
    </div>
  </div>   
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon bg-dark">
        <i class="fas fa-box"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>All Inactive Product(s)</h4>
        </div>
        <div class="card-body">
          <?= $admin->countByColumn('tblproduct','status','0'); ?>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon bg-primary">
        <i class="fas fa-boxes"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Stock on Hand</h4>
        </div>
        <div class="card-body">
          <?= $product->sumProductQuantity(); ?>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon bg-info">
        <i class="fas fa-boxes"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Overall Product Cost</h4>
        </div>
        <div class="card-body">
          <?= number_format($product->getItemsTotal()); ?>
        </div>
      </div>
    </div>
  </div>                  
</div>

<!-- Chart for expensive item sold  -->
<div class="row">
  <div class="col-lg-6 col-md-6 col-12 col-sm-12">
    <div class="card">
      <div class="card-header">
        <h4 class="text-center">Most Expensive Items Sold</h4>
      </div>
      <div class="card-body">
        <canvas id="myChart3"></canvas>
      </div>
    </div>
  </div>

  <!-- Chart for most sold items -->
  <div class="col-lg-6 col-md-6 col-12 col-sm-12">
    <div class="card">
      <div class="card-header">
        <h4 class="text-center">Top 5 Selling Items</h4>
      </div>
      <div class="card-body">
        <canvas id="myChart4"></canvas>
      </div>
    </div>
  </div>
</div>

<!-- Stock Alert -->
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
    <div class="card">
      <div class="card-header">
        <h4>Stock Alert <br><small class="small text-danger">These are items running out of stock, that are less than or equal to reorder level</small></h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped" id="table-3">
            <thead>          
              <th class="text-center">
                #
              </th>
              <th>Product Code</th>
              <th>Product Name</th>
              <th>In Stock</th>
              <th>Reorder Level</th>
            </tr>
          </thead>
          <tbody> 
            <?php
            $i = 1;
            foreach ($product->fetchAllLowStock() as $fetchProduct):
              ?>

              <tr>
                <td>
                  <?= $i++; ?>
                </td>
                <td class="font-weight-bold"><?= $fetchProduct->product_code; ?></td>
                <td class="font-weight-bold"><?= ucwords($fetchProduct->product_name); ?></td>
                <td class="font-weight-bold">
                  <?= $fetchProduct->quantity; ?>
                </td>
                <td><div class="badge badge-danger"><?= $fetchProduct->reorder_level; ?></div></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  </div>

  <!-- Sales Revenue for the day -->
  <div class="col-lg-6 col-md-6 col-12 col-sm-12">
    <div class="card">
      <div class="card-header text-center">
        <h4><?php echo date('M d, Y'); ?> Overall Sales Revenue Overview</h4>
      </div>
      <div class="card-body">
        <div class="summary">
          <div class="summary-info">
            <h4><?= number_format($order->getTodayTotalSales(), 00); ?></h4>
            <div class="text-muted">Sold <?= $order->getTodayTotalSalesProductCount(); ?> items</div>
          </div>
          <div class="summary-item">
            <h6>Item List <span class="text-muted small">(Last 3 items sold)</span></h6>
            <ul class="list-unstyled list-unstyled-border">
              <?php  
                foreach($order->getTodayTotalSalesProductLast3Item() as $fetchItems): 
                  # get product data
                  $getProduct = $admin->fetchSingle('tblproduct','product_id',$fetchItems->product_id);

                  # get seller data
                  $getSeller = $admin->fetchSingle('tbluser','user_id',$fetchItems->user_id);
              ?> 
              <li class="media">
                <a href="#">
                  <img class="mr-3 rounded" width="50" src="assets/product_image/<?= $getProduct->product_image; ?>" alt="product">
                </a>
                <div class="media-body">
                  <div class="media-right"><?= number_format($fetchItems->price); ?></div>
                  <div class="media-title"><a href="edit-stock?id=<?= $fetchItems->product_id; ?>"><?= ucwords($getProduct->product_name); ?></a></div>
                  <div class="text-muted text-small">sold by <a href="javascript:;"><?= ucwords($getSeller->username); ?></a></div>
                </div>
              </li>
              <?php endforeach; ?>

              <?php if(!$order->getTodayTotalSalesProductLast3Item()): ?>
              <li class="media">
                <h3 class="text-center">No Item Sold Today</h3>
              </li>
              <?php endif; ?>

            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Recent Sales -->
  <div class="col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="card">
      <div class="card-header">
        <h4>Recent Sales <small>(Last 5 transactions)</small></h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped" id="table-3">
            <thead>          
              <th class="text-center">
                #
              </th>
              <th>Invoice No</th>
              <th>Payment Mode</th>
              <th>Total</th>
              <th>Payment Status</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody> 
            <?php
            $i = 1;
            foreach ($order->getRecentSales() as $fetchRecentSales):
              ?>

              <tr>
                <td>
                  <?= $i++; ?>
                </td>
                <td class="font-weight-bold"><?= $fetchRecentSales->invoiceno; ?></td>
                <td>
                  <span class="badge badge-secondary"><?= ucwords($fetchRecentSales->paytype); ?></span>
                </td>
                <td>
                  <?= number_format($fetchRecentSales->total, 00); ?>
                </td>
                <td class="font-weight-bold">
                  <?= $order->printOrderStatusBadge($fetchRecentSales->invoiceno); ?>   
                </td>
                <td>
                  <?= $fetchRecentSales->date_paid; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>

