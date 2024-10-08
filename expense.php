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
                            <input type="text" class="form-control" name="name" placeholder="Staff Salary">
                          </div>
                          <div class="form-group col-md-12">
                            <label>Description </label>
                            <textarea class="summernote-simple" name="description"></textarea>
                          </div>
                          <div class="col-12">
                            <input type="submit" class="btn btn-primary" name="btnAddExpense" value="Create Expense">
                            <a href="dashboard" class="btn btn-danger">Back</a>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>All Expenses</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>   
                          <tr>       
                            <th>
                              #
                            </th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Created On</th>
                            <th>Updated On</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody> 
                          <?php
                            $i = 1;
                            foreach ($admin->selectAll('tblexpense') as $fetchExpense):
                          ?>                                
                          <tr>
                            <td>
                              <?= $i++; ?>
                            </td>
                            <td><?= ucwords($fetchExpense->title); ?></td>
                            <td class="small"><?= html_entity_decode($fetchExpense->description); ?></td>
                            <td><div class="badge badge-dark"><?= $fetchExpense->created_date; ?></div></td>
                            <td><div class="badge badge-dark"><?= $fetchExpense->updated_date; ?></div></td>
                            <td>
                              <a href="edit-expense?id=<?= $fetchExpense->expense_id; ?>" class="btn btn-warning btn-sm mb-2">Edit</a>
                              <form method="POST">
                                <input type="hidden" class="form-control" name="expense_id" value="<?= $fetchExpense->expense_id; ?>" readonly>
                                <input type="submit" class="btn btn-sm btn-danger" name="btnDeleteExpense" onclick="return confirm('Remove this record?')" value="Delete">
                              </form>
                            </td>
                          </tr>
                          <?php
                            endforeach;
                          ?>
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
