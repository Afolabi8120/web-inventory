<?php 
  
  $pageTitle = "Edit Category";
  require('core/validate/category.php');
  include('includes/head.php'); 

  if(isset($_SESSION['admin']) AND !empty($_SESSION['admin'])){
    $user_id = $_SESSION['admin'];
    $getAdmin = $admin->fetchSingle('tbluser','user_id',$user_id);
  }else{
      header('location: login');
  }

  if(isset($_GET['id']) AND !empty($_GET['id'])){

    $_GET['id'] = stripcslashes($_GET['id']);
    $category_id = $_GET['id'];

    // check if category id exist
    if($admin->select('tblcategory','cat_id',$category_id) === false){
      header('location: category');
    }
    else if($admin->select('tblcategory','cat_id',$category_id) === true){
      $fetchCategoryData = $admin->fetchSingle('tblcategory','cat_id',$category_id);
    }
  }elseif(!isset($_GET['id']) AND empty($_GET['id'])){
    header('location: category');
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
            <h1>Category</h1>
          </div>

          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Edit Category</h4>
                  </div>
                  <div class="card-body">
                    <div class="col-12 col-md-12 col-lg-12">
                      <form method="POST">
                        <div class="form-group">
                          <label>Category Name</label>
                          <input type="hidden" class="form-control" name="cat_id" value="<?= $fetchCategoryData->cat_id; ?>" readonly>
                          <input type="text" class="form-control" name="name" value="<?= $fetchCategoryData->name; ?>">
                        </div>
                        <input type="submit" class="btn btn-primary" name="btnUpdate" value="Update">
                        <a href="category" class="btn btn-danger">Back</a>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </section>
      </div>

      <?php include('includes/footer.php'); ?>
