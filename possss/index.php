<?php 
	require('../core/validate/order.php');

	if(isset($_SESSION['admin']) AND !empty($_SESSION['admin'])){
		$user_id = $_SESSION['admin'];
		$getAdmin = $admin->fetchSingle('tbluser','user_id',$user_id);
		$getStoreData = $admin->fetch('tblsettings');
	}else{
		header('location: ../login');
	}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Bootstrap-ecommerce by Vosidiy">
	<title> POS</title>
	<link rel="shortcut icon" type="image/x-icon" href="assets/images/logos/squanchy.jpg" >
	<link rel="apple-touch-icon" sizes="180x180" href="assets/images/logos/squanchy.jpg">
	<link rel="icon" type="image/png" sizes="32x32" href="assets/images/logos/squanchy.jpg">
	<!-- jQuery -->
	<!-- Bootstrap4 files-->
	<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css"/> 
	<link href="assets/css/ui.css" rel="stylesheet" type="text/css"/>
	<link href="assets/fonts/fontawesome/css/fontawesome-all.min.css" type="text/css" rel="stylesheet">
	<link href="assets/css/OverlayScrollbars.css" type="text/css" rel="stylesheet"/>
	<!-- Font awesome 5 -->
	<style>
		.avatar {
			vertical-align: middle;
			width: 35px;
			height: 35px;
			border-radius: 50%;
		}
		.bg-default, .btn-default{
			background-color: #f2f3f8;
		}
		.btn-error{
			color: #ef5f5f;
		}
	</style>
	<!-- custom style -->
</head>
<body>
	<section class="header-main">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-3">
					<div class="brand-wrap">
						<img class="logo" src="assets/images/logos/squanchy.jpg">
						<h3 class="logo-text"><?= ucwords($getStoreData->name); ?></h3>
					</div> <!-- brand-wrap.// -->
				</div>
				<div class="col-lg-6 col-sm-6">
					<form action="#" class="search-wrap">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Search">
							<div class="input-group-append">
								<button class="btn btn-primary" type="submit">
									<i class="fa fa-search"></i>
								</button>
							</div>
						</div>
					</form> <!-- search-wrap .end// -->
				</div> <!-- col.// -->
				<div class="col-lg-3 col-sm-6">
					<div class="widgets-wrap d-flex justify-content-end">
						<div class="widget-header">
							<a href="#" class="icontext">
								<a href="../dashboard" class="btn btn-primary m-btn m-btn--icon m-btn--icon-only">
									<i class="fa fa-home"></i>
								</a>
							</a>
						</div> <!-- widget .// -->
						<div class="widget-header dropdown">
							<a href="#" class="ml-3 icontext" data-toggle="dropdown" data-offset="20,10">
								<img src="assets/images/avatars/bshbsh.png" class="avatar" alt="">
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="#"><i class="fa fa-sign-out-alt"></i> Logout</a>
							</div> <!--  dropdown-menu .// -->
						</div> <!-- widget  dropdown.// -->
					</div>	<!-- widgets-wrap.// -->	
				</div> <!-- col.// -->
			</div> <!-- row.// -->
		</div> <!-- container.// -->
	</section>
	<!-- ========================= SECTION CONTENT ========================= -->
	<section class="section-content padding-y-sm bg-default ">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8 card padding-y-sm card table-responsive">
					<ul class="nav bg radius nav-pills nav-fill mb-3 bg" role="tablist">
						<li class="nav-item">
							<a class="nav-link active show" data-toggle="pill" href="#nav-tab-card">
								<i class="fa fa-tags"></i> All</a></li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="pill" href="#nav-tab-paypal">
										<i class="fa fa-tags "></i>  Category 1</a></li>
										<li class="nav-item">
											<a class="nav-link" data-toggle="pill" href="#nav-tab-bank">
												<i class="fa fa-tags "></i>  Category 2</a></li>
												<li class="nav-item">
													<a class="nav-link" data-toggle="pill" href="#nav-tab-bank">
														<i class="fa fa-tags "></i>  Category 3</a></li>
														<li class="nav-item">
															<a class="nav-link" data-toggle="pill" href="#nav-tab-bank">
																<i class="fa fa-tags "></i>  Category 4</a></li>
																<li class="nav-item">
																	<a class="nav-link" data-toggle="pill" href="#nav-tab-bank">
																		<i class="fa fa-tags "></i>  Category 5</a></li>
																	</ul>
																	<span id="items">
																		<div class="row">
																			<?php foreach ($product->fetchAllProduct() as $fetchProduct): ?>
																			<div class="col-md-3">
																				<figure class="card card-product">
																					<div class="img-wrap"> 
																						<img class="mt-2 mb-0" src="../assets/product_image/<?= $fetchProduct->product_image; ?>">
																					</div>
																					<figcaption class="info-wrap">
																						<a href="#" class="title"><?= ucwords($fetchProduct->product_name); ?></a>
																						<div class="action-wrap">
																							<a href="javascript:;" class="btn btn-primary btn-sm float-right" onclick="addToCart(<?= $fetchProduct->product_id; ?>)" id="cat_id"> <i class="fa fa-cart-plus"></i> Add </a>
																							<div class="price-wrap h5">
																								<span class="price-new small font-weight-bold">$<?= number_format($fetchProduct->selling_price, 2); ?></span>
																							</div> <!-- price-wrap.// -->
																						</div> <!-- action-wrap -->
																					</figcaption>
																				</figure> <!-- card // -->
																			</div> <!-- col // -->
																			<?php endforeach; ?>
																		</div> <!-- row.// -->
																	</span>
																</div>
																<div class="col-md-4">
																	<div class="card">
																		<span id="cart">
																			<table class="table table-hover shopping-cart-wrap">
																				<thead class="text-muted">
																					<tr>
																						<th scope="col">S/N</th>
																						<th scope="col">Item</th>
																						<th scope="col" width="120">Qty</th>
																						<th scope="col" width="120">Price</th>
																						<th scope="col" class="text-right" width="200">Remove</th>
																					</tr>
																				</thead>
																				<tbody class="fetch_cart">
																					
																				</tbody>
																			</table>
																		</span>
																	</div> <!-- card.// -->
																	<div class="box">
																		<dl class="dlist-align">
																			<dt>Payment Method: </dt>
																			<dd class="text-right">
																				<select name="paytype" id="paytype" class="form-control form-control-md">
						                              <option value="cash">Cash</option>
						                              <option value="card">Card</option>
						                            </select>
																			</dd>
																		</dl>
																		<hr>
																		<dl class="dlist-align">
																			<dt>Sub Total:</dt>
																			<dd class="text-right" id="subtotal">
																				<input type="text" class="form-control" readonly name="subtotal" id="subtotal" value="<?php if(isset($_SESSION["cart_item"])) { echo $_SESSION['total_price']; } else { echo '0.00'; } ?>">
																			</dd>
																		</dl>
																		<hr>
																		<dl class="dlist-align">
																			<dt>Total: </dt>
																			<dd class="text-right h4 b" id="total"> $215 </dd>
																		</dl>
																		<div class="row">
																			<div class="col-md-6">
																				<a href="#" class="btn  btn-default btn-error btn-lg btn-block"><i class="fa fa-times-circle "></i> Cancel </a>
																			</div>
																			<div class="col-md-6">
																				<a href="#" class="btn  btn-primary btn-lg btn-block"><i class="fa fa-shopping-bag" id="btnPlaceOrder"></i> Charge </a>
																				<input type="submit" class="btn btn-dark btn-block rounded" name="btnPlaceOrder" value="Place Order">
																			</div>
																		</div>
																	</div> <!-- box.// -->
																</div>
															</div>
														</div><!-- container //  -->
													</section>
													<!-- ========================= SECTION CONTENT END// ========================= -->
													<script src="assets/js/jquery-2.0.0.min.js" type="text/javascript"></script>
													<script src="assets/js/bootstrap.bundle.min.js" type="text/javascript"></script>
													<script src="assets/js/OverlayScrollbars.js" type="text/javascript"></script>
													<script src="../assets/modules/jquery.min.js"></script>
													<script>
														$(function() {
	//The passed argument has to be at least a empty object or a object with your desired options
	//$("body").overlayScrollbars({ });
															$("#items").height(552);
															$("#items").overlayScrollbars({overflowBehavior : {
																x : "hidden",
																y : "scroll"
															} });
															$("#cart").height(445);
															$("#cart").overlayScrollbars({ });
														});
													</script>

													<script>

														// var sub_total = <?= $_SESSION['total_price']; ?>;

														// document.getElementById('subtotal').value = sub_total;

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

										        function increaseItem(value){
										          var inc_item = value;

										          $.ajax({
										            url:'insertToCart.php',
										            method: 'POST',
										            data:{
										              inc_item: inc_item
										            },
										            function(data, status){
										                alert("Data: " + data + "\nStatus: " + status);
										            }
										          });

										        }

										        function decreaseItem(value){
										          var dec_item = value;

										          $.ajax({
										            url:'insertToCart.php',
										            method: 'POST',
										            data:{
										              dec_item: dec_item
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
												</body>
												</html>