<?php 
  
  $pageTitle = "Create Expenses";
  require('core/validate/expense.php');
  include('includes/head.php'); 

  if(isset($_SESSION['admin']) AND !empty($_SESSION['admin'])){
    $user_id = $_SESSION['admin'];
    $getAdmin = $admin->fetchSingle('tbluser','user_id',$user_id);
  }else{
      header('location: login');
  }

  if(isset($_GET['id']) AND !empty($_GET['id'])){

    $_GET['id'] = stripcslashes($_GET['id']);
    $expense_id = $_GET['id'];

    // check if expense id exist
    if($admin->select('tblexpense','expense_id',$expense_id) === false){
      header('location: expense');
    }
    else if($admin->select('tblexpense','expense_id',$expense_id) === true){
      $fetchExpenseData = $admin->fetchSingle('tblexpense','expense_id',$expense_id);
    }
  }elseif(!isset($_GET['id']) AND empty($_GET['id'])){
    header('location: expense');
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
            <h1>Create Expenses</h1>
          </div>

          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Create New Expenses</h4>
                  </div>
                  <div class="card-body">
                    <div class="col-12 col-md-12 col-lg-12">
                      <form method="POST">
                        <div class="row">
                          <div class="form-group col-md-5">
                            <label>Title</label>
                            <input type="hidden" class="form-control" name="expense_id" value="<?= $fetchExpenseData->expense_id; ?>" readonly>
                            <input type="text" class="form-control" name="name" value="<?= ucwords($fetchExpenseData->title); ?>" placeholder="Staff Salary">
                          </div>
                          <div class="form-group col-md-12">
                            <label>Description </label>
                            <textarea class="summernote-simple" name="description"><?= html_entity_decode($fetchExpenseData->description); ?></textarea>
                          </div>
                          <div class="col-12">
                            <input type="submit" class="btn btn-primary" name="btnEditExpense" value="Edit Expense">
                            <a href="expense" class="btn btn-danger">Back</a>
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
