<?php 
 session_start();
  //stop returning from the same page when logout
  
  include "archive_query.php";

  $conn = mysqli_connect("bsu-info.tech", "u455679702_weleaves", "Y2iPs&>*iL1", "u455679702_weleaves");//connection to the database

    if(isset($_SESSION['id'])){
      $id = $_SESSION['id'];
        
      $level_description="";
      //reading data in the database
      $read = "SELECT * FROM tbl_employees WHERE id = '$id'";
      $result = mysqli_query($conn, $read);

      if($result && mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()){
          $emid = $row['EmployeeId'];
          $fname = $row['FirstName'];
          $lname = $row['LastName'];
          $dep = $row['Department'];
          $position = $row['Position'];
          $salary = $row['Salary'];
          $accesslevel = $row['AccessLevel'];
          
          $_SESSION['BSU_ID'] = $emid;
        }
      }
    }
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BSULeaves-Archive</title>

  <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
    <!-- Personal CSS -->
    <link rel="stylesheet" href="../assets/css/styles.css">

  <style type="text/css">
  .bun{
    float:left;
    margin:6px;
  }

  .bold{
    font-weight: bold;
  }


  </style>

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed py-5">
<div class="wrapper">
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../dist/img/bsu.png" alt="BSULogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
     <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" data-toggle="tooltip" data-placement="right" title="Adjust Sidebar"></i></a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="../backend/logout.php" role="button" data-toggle="tooltip" data-placement="right" title="Logout">
          <i class="fas fa-sign-out-alt fa-lg nav-icon" onclick="return confirm('Are you sure you want to Log Out?')"></i>
        </a>
      </li>
    </ul>




  </nav>
  <!-- /.navbar -->


  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../users/nte_leave_form.php" class="brand-link">
      <img src="../dist/img/bsu.png" alt="BSU Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Leave Mgmnt System</span>
    </a>





<!-- Sidebar Menu -->
    <div class="sidebar">
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="../dist/img/USER.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <p style="color:white;">
              Super Admin
              </p>
            </div>
          </div>
          <p style="font-size: 14px; color: white; font-weight: bold;text-transform: uppercase;">SUPER ADMIN CONTROLS</p>

          <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <!-- Sidebar Menu -->
              <?php 
              $loc="archive";
              include "admin_sidebar.php" ?>
            <!-- /.sidebar-menu -->
            
          </div>

    </div>
      <!-- Sidebar Menu -->
       

      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

</div>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
         
          <div class="col-sm-6">
            
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        

        <!-- /.row -->

        <!-- Card -->
      <div class="row">
          <!-- trading history area start -->


        <div class="card-body">

          <div class="card">
              <div class="card-body">
               
                                       
                <div class="single-table">
                  <div class="table-responsive">
                  <br/>
                    <table class="table table-hover table-bordered table-striped progress-table text-center" id="archive">
                      <thead class="text-uppercase">

                        <tr>
                        <th>No.</th>
                        <th>Leave Type</th>
                        <th>Details of Leave</th>
                        <th>Other Purpose</th>
                        <th>Availed Dates</th>
                        <th>Date Availed</th>
                        <th>Status</th>
                        <th>Remarks</th>
                        <th>Action</th>
                        </tr>
                      </thead>
                   
                   
                      <tbody>
                      <?php 
                      //$employeeId=$_SESSION['id'];
                      $read = "SELECT EmpId,id,LeaveType,DetailsLeave,DetailSpecify,OtherPurpose,IDFrom,IDTo,DateFiling,Status_Final,Remarks_Final,AvailedDates from tbl_archive ORDER BY id DESC";
                      $result = mysqli_query($conn, $read);

                      $cnt=1;
                      if($result && mysqli_num_rows($result) > 0){
                        foreach($result as $results){
                      ?> 
                      <tr>   
                        <td><?php echo htmlentities($cnt);?></td>
                        <td><?php echo $results['LeaveType'];?></td>
                        <td><?php echo $results['DetailsLeave'] ." ". $results['DetailSpecify'] ;?></td>
                        <td><?php echo $results['OtherPurpose'];?></td>
                        <td><?php if($results['AvailedDates'] != NULL){echo $results['AvailedDates']; }
                          else{ echo $results['IDFrom'] . " to " . $results['IDTo'];}?></td>
                        <td><?php echo $results['DateFiling'];?></td>
                        <td><?php echo $results['Status_Final'];?></td>
                        <td><?php echo $results['Remarks_Final'];?></td>
                        <td>
                            <form action="admin_view_details.php?EmpId=<?php echo $results['EmpId']; ?>" method="POST">
                             <button type="submit" name="submit" class="btn btn-secondary btn-sm" title="View"> 
                             <i class="fas fa-eye nav-icon"></i>
                             </button>
                            </form>
                        </td>
                      </tr>
                       <?php $cnt++;} }?>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div><!-- div-card-body -->
            </div>
          </div> <!-- div-card-body -->
          <!-- trading history area end -->
      </div> <!-- div-row -->


            </div> <!-- container-fluid -->
            <!-- /.card -->
       </section>
          <!-- /.col -->


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer removeFooter">


    <!--<strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>-->


  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="../plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="../plugins/raphael/raphael.min.js"></script>
<script src="../plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>


<!-- Data Tables -->

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

<script type="text/javascript">
     $(document).ready(function () {
  $('#archive').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
    </script>


</body>
</html>
