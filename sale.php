<?php 
  
  $pageTitle = "Point of Sale";
  require('core/validate/order.php');
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
            <h1>Point of Sale</h1>
          </div>

          <div class="row">

              <div class="col-12">
                <div class="border p-3 rounded mt-2">
                  <a href="receipt?receiptno=<?= $order->getLastTransactionID(); ?>" class="btn btn-dark btn-lg">Print Last Transaction</a>
                  <a href="javascript;:" class="btn btn-warning btn-lg">Sales History</a>
                  <a href="javascript;:" class="btn btn-primary btn-lg">Change Password</a>
                </div>
              </div>

              <!-- Product Start Here -->
              <div class="col-7">
                <div class="border p-3 rounded mt-2">
                  
                  <div class="row g-3">
                    <div class="col-md-12">
                      <input type="text" name="search" class="form-control mb-3" placeholder="Type to search product...">
                    </div>
                    <hr>

                    <div class="col-md-12 table-responsive" style="height: 400px;">
                      <div class="row">
                        <?php foreach ($product->fetchAllProduct() as $fetchProduct): ?> 
                        <div class="card col-md-2 col-lg-2 ml-3 mr-1 rounded rounded-3 text-center" onclick="addToCart(<?= $fetchProduct->product_id; ?>)" id="cat_id" style="cursor: pointer;">
                          <center><img src="assets/product_image/<?= $fetchProduct->product_image; ?>" height="80" width="80" class="rounded-circle mt-3"></center>
                          <p class="font-weight-light mt-2 mb-1"><?= ucwords($fetchProduct->product_name); ?></p>
                          <p class="font-weight-bold small text-danger mt-1" style="font-weight: bolder;"><?= number_format($fetchProduct->selling_price, 2); ?></p>
                        </div>
                        <?php endforeach; ?>
                      </div>
                    </div>

                  </div> 
                </div>
              </div>
              <!-- Product Ends Here -->

              <!-- Sales Start Here -->
              <div class="col-5">

                <div class="border p-3 rounded mt-2">
                  <div class="row g-3">
                    <div class="table-responsive" style="height: 200px;">
                      <table class="table table-striped">
                        <thead class="font-weight-bold p">
                          <th>S/N</th>
                          <th>Product Name</th>
                          <th>Qty x Price</th>
                          <th>Amount</th>
                          <th>Action</th>
                        </thead>
                        <tbody class="fetch_cart">                          

                        </tbody>
                      </table>
                    </div>

                    <div class="col-12">
                      <table class="table border rounded">
                        <tbody class="fetch_cart_payment">
                          <form method="POST">
                          <tr>
                            <td class="font-weight-bold">Sub Total</td>
                            <td class="font-weight-bold">
                              <input type="text" class="form-control h4" name="subtotal" placeholder="00.00" value="<?php if(isset($_SESSION["cart_item"])) { echo $_SESSION['total_price']; } else { echo '0.00'; } ?>" id="subtotal" readonly>
                            </td>
                          </tr>
                          <tr>
                            <td class="font-weight-bold">Payment Method</td>
                            <td class="font-weight-bold">
                              <select name="paytype" id="paytype" class="form-control form-control-sm">
                              <option value="cash">Cash</option>
                              <option value="card">Card</option>
                            </select>
                            </td>
                          </tr>
                          <tr>
                            <td class="font-weight-bold">Total</td>
                            <td class="font-weight-bold">
                              <input type="text" class="form-control" name="total" value="<?php if(isset($_SESSION["cart_item"])) { echo $_SESSION['total_price']; } else { echo '0.00'; } ?>" placeholder="00.00" id="total" readonly>
                            </td>
                          </tr>
                          <tr>
                            <td class="font-weight-bold" colspan="2">
                              <input type="submit" class="btn btn-dark btn-block rounded" name="btnPlaceOrder" value="Place Order">
                            </td>
                          </tr>
                          </form>
                        </tbody>
                      </table>
                    </div>

                  </div> 
                </div>
              </div>
              <!-- Sales Ends Here -->

            </div>

        </section>
      </div>

      <?php include('includes/footer.php'); ?>

      <script>
        $('#btnPlaceOrder').on('click', function() {

          var paytype = $('#paytype').val();
          var subtotal = $('#subtotal').val();
          var total = $('#total').val();

          alert(paytype + " " + subtotal + " " + total);

          $.ajax({
            url:'makePayment.php',
            method: 'POST',
            data:{
              paytype: paytype,
              subtotal: subtotal,
              total: total
            },
            success:function(data) {
              if(data)
                $('#paytype').val();
              else alert('Unable to place order');

                fetchProduct();
            },
            error: function(jqXHR, status, message){
                console.error(message);
            }
          });
        });

        function addToCart(value){
          var product_id = value;

          $.ajax({
            url:'insertToCart.php',
            method: 'POST',
            data:{
              product_id: product_id
            },
            function(data, status){
                console.log("Data: " + data + "\nStatus: " + status);
            }
          });

        }

        function removeFromCart(value){
          var r_product_id = value;

          $.ajax({
            url:'insertToCart.php',
            method: 'POST',
            data:{
              r_product_id: r_product_id
            },
            function(data, status){
                alert("Data: " + data + "\nStatus: " + status);
            }
          });

        }

        const fetchProduct = () => {
          var receiver = true;
          $.ajax({
            url: 'fetchProduct.php',
            data: {
              receiver: receiver
            },
            method: 'post',
            success:function(data){
              console.log(data);
              $('.fetch_cart').html(data);
            },
            error:function(jqXHR, status, message){
              console.error(message);
            }
          })
        };

        fetchProduct();

        setInterval(() => {
          fetchProduct();
        }, 1000);
        
      </script>
