<?php 
  
  $pageTitle = "Barcode";
  require('core/validate/product.php');
  require('assets/phpqrcode/qrlib.php');

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
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?= $pageTitle; ?> &mdash; <?= ucwords($getStoreData->name); ?></title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="assets/modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="assets/modules/weather-icon/css/weather-icons.min.css">
  <link rel="stylesheet" href="assets/modules/weather-icon/css/weather-icons-wind.min.css">
  <link rel="stylesheet" href="assets/modules/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="assets/modules/datatables/datatables.min.css">
  <link rel="stylesheet" href="assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
</head>
<body>
  
  <div class="row">
    <div class="col-12 mt-3">
      <div class="row">
        <?php for($i = 1; $i <= 7; $i++): ?>
        <div class="col-md-2">
          <?= $admin->generateQRCode($fetchProductData->barcode,ucwords($fetchProductData->product_name),$fetchProductData->selling_price); ?>
        </div>
        <div class="col-md-2">
          <?= $admin->generateQRCode($fetchProductData->barcode,ucwords($fetchProductData->product_name),$fetchProductData->selling_price); ?>
        </div>
        <div class="col-md-2">
          <?= $admin->generateQRCode($fetchProductData->barcode,ucwords($fetchProductData->product_name),$fetchProductData->selling_price); ?>
        </div>
        <div class="col-md-2">
          <?= $admin->generateQRCode($fetchProductData->barcode,ucwords($fetchProductData->product_name),$fetchProductData->selling_price); ?>
        </div>
        <div class="col-md-2">
          <?= $admin->generateQRCode($fetchProductData->barcode,ucwords($fetchProductData->product_name),$fetchProductData->selling_price); ?>
        </div>
        <div class="col-md-2">
          <?= $admin->generateQRCode($fetchProductData->barcode,ucwords($fetchProductData->product_name),$fetchProductData->selling_price); ?>
        </div>
        <?php endfor; ?>
      </div>
    </div>
  </div>
  
  <script>
      window.addEventListener(window.print());
    </script>
  
</body>

