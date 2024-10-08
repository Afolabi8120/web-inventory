<footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; <?= date('Y'); ?> <div class="bullet"></div> Developed by <a href="#">Code Tree Technologies</a>
        </div>
        <div class="footer-right">
          
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="assets/modules/jquery.min.js"></script>
  <script src="assets/modules/popper.js"></script>
  <script src="assets/modules/tooltip.js"></script>
  <script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="assets/modules/moment.min.js"></script>
  <script src="assets/js/stisla.js"></script>

  <script src="assets/modules/chart.min.js"></script>
  
  <!-- JS Libraies -->
  <script src="assets/modules/summernote/summernote-bs4.js"></script>
  <!-- JS Libraies -->
  <script src="assets/modules/datatables/datatables.min.js"></script>
  <script src="assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
  <script src="assets/modules/jquery-ui/jquery-ui.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="assets/js/page/modules-datatables.js"></script>

  <!-- Sweet Alert -->
  <script src="assets/js/sweetalert.js"></script>

  <!-- Page Specific JS File -->
  <script src="assets/js/page/index-0.js"></script>
  
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>

  <script>
    var ctx = document.getElementById("myChart3").getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        datasets: [{
          data: [
            <?php 
            foreach($order->getChart1() as $result){
          ?>
          <?php echo json_encode($result->total).","; ?>

          <?php } ?>
          ],
          backgroundColor: [
            '#191d21',
            '#63ed7a',
            '#ffa426',
            '#fc544b',
            '#6770ef',
          ],
          label: 'Items Sold'
        }],
        labels: [
          <?php 
            foreach($order->getChart1() as $result){
          ?>
          <?php echo json_encode(ucwords($result->product_name)).","; ?>

          <?php } ?>
        ],
      },
      options: {
        responsive: true,
        legend: {
          position: 'top',
        },
      }
    });
  </script>

  <script>
    var ctx = document.getElementById("myChart4").getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'pie',
      data: {
        datasets: [{
          data: [
            <?php 
            foreach($order->getChart2() as $result){
          ?>
          <?php echo json_encode($result->qty).","; ?>

          <?php } ?>
          ],
          backgroundColor: [
            '#191d21',
            '#63ed7a',
            '#ffa426',
            '#fc544b',
            '#6777ef',
          ],
          label: 'Dataset 1'
        }],
        labels: [
          <?php 
            foreach($order->getChart2() as $result){
          ?>
          <?php echo json_encode(ucwords($result->product_name)).","; ?>

          <?php } ?>
        ],
      },
      options: {
        responsive: true,
        legend: {
          position: 'right',
        },
      }
    });
  </script>

  
</body>
</html>

<?php
  if(isset($_SESSION['messageTitle']) AND !empty($_SESSION['messageTitle'])){
  ?>
  <script>
    swal({
      title: '<?= $_SESSION['messageTitle']; ?>',
      text: '<?= $_SESSION['messageText']; ?>',
      icon: '<?= $_SESSION['messageIcon']; ?>',
      button: 'OK',
    })
  </script>
  <?php
    unset($_SESSION['messageTitle']);
    unset($_SESSION['messageText']);
    unset($_SESSION['messageIcon']);
  }

?>
