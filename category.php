<?php 
  
  $pageTitle = "Category";
  require('core/validate/category.php');
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
            <h1>Category</h1>
          </div>

          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Product Categories</h4>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Create Category</button>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>          
                            <th class="text-center">
                              #
                            </th>
                            <th>Product Category</th>
                            <th>Product Count</th>
                            <th>Created On</th>
                            <th>Updated On</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody> 
                          <?php
                            $i = 1;
                            foreach ($admin->selectAll('tblcategory') as $fetchCategory):
                          ?>                                
                          <tr>
                            <td>
                              <?= $i++; ?>
                            </td>
                            <td><?= ucwords($fetchCategory->name); ?></td>
                            <td>
                              <div class="badge badge-primary">
                                <?= $admin->countByColumn('tblproduct','category_id',$fetchCategory->cat_id);
                                ?>
                              </div>
                            </td>
                            <td><div class="badge badge-dark"><?= $fetchCategory->created_date; ?></div></td>
                            <td><div class="badge badge-dark"><?= $fetchCategory->updated_date; ?></div></td>
                            <td>
                              <a href="edit-category?id=<?= $fetchCategory->cat_id; ?>" class="btn btn-warning btn-sm mb-2">Edit</a>
                              <form method="POST">
                                <input type="hidden" class="form-control" name="cat_id" value="<?= $fetchCategory->cat_id; ?>" readonly>
                                <input type="submit" class="btn btn-sm btn-danger" name="btnDeleteCategory" onclick="return confirm('Remove this category?')" value="Delete">
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

      <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Create Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-12 col-md-12 col-lg-12">
                    <form method="POST">
                      <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" class="form-control" name="name" placeholder="e.g. Beverages">
                      </div>
                      <input type="submit" class="btn btn-primary" name="btnAddCategory" value="Create">
                    </form>
                  </div>
                </div>
              </div>
              <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php include('includes/footer.php'); ?>
