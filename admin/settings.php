<?php  
   require '../php/centralConnection.php';
   session_start();
   if(empty($_SESSION['logged_in'])){
      header('Location: ../index.html');
   } 

   if(isset($_REQUEST['list'])){
      if($_REQUEST['list'] == "office"){
         $query ="SELECT * FROM OfficeSettings WHERE ArchiveStatus = 'Archived'";  
         $result = mysqli_query($connect, $query);
         $header = "Office Archives";
      }
   }else{
      $query ="SELECT * FROM OfficeSettings WHERE ArchiveStatus != 'Archived'";  
      $result = mysqli_query($connect, $query);
      $header = "Office Category";
   }   
?>  

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>DOCUTRACE</title>
   <link rel="icon" href="../asset/img/icon.png" type="image/png">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css">
   <link rel="stylesheet" href="../asset/css/adminlte.min.css">
   <link rel="stylesheet" href="../asset/css/style.css">
   <link rel="stylesheet" href="../asset/tables/datatables-bs4/css/dataTables.bootstrap4.min.css">
   <link rel="stylesheet" href="../css/style.css">
   <?php
      if ($_SESSION['access_level'] == "Staff") {
         echo "<link rel='stylesheet' href='../css/HideAdminFeature.css'>";
      }
   ?>
   <script src="../asset/jquery-3.6.0.min.js"></script>
   <link rel="stylesheet" href="../asset/jquery-confirm.min.css">
   <script src="../asset/jquery-confirm.min.js"></script>
   <script src="../js/settings.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
   <div class="wrapper">
      <nav class="main-header navbar navbar-expand navbar-light" style="background-color: rgb(22,94,155)">
         <!-- Left navbar links -->
         <ul class="navbar-nav">
            <li class="nav-item">
               <a class="nav-link iconsTop" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
         </ul>
         <ul class="navbar-nav ml-auto">
            <li class="nav-item">
               <a class="nav-link iconsTop" href="#" data-toggle='modal' data-target='#editIconUser' role="button" style="margin-top: -3%;">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                     <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                     <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                   </svg>
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link iconsTop" href="../php/logout.php">
                  <i class="fas fa-sign-out-alt"></i>
               </a>
            </li>
         </ul>
      </nav>
      <aside class="main-sidebar sidebar-light-primary">
         <!-- Brand Logo -->
         <a href="index.php" class="brand-link">
     <!--  <img src="../asset/img/logo.png" alt="DSMS Logo" width="200"> -->
     <img src="../asset/img/DOCUTRACE.png" alt="DOCUTRACE Logo" id="docutraceLogo">
      </a>
      <div class="sidebar">
         <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
               data-accordion="false">
               <li class="nav-item">
                  <a href="index.php" class="nav-link">
                     <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="rgb(22,94,155)" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                        <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z"/>
                      </svg>
                     <p>
                        Dashboard
                     </p>
                  </a>
               </li>
               <li class="nav-item">
                  <a href="category.php" class="nav-link">
                     <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="rgb(22,94,155)" class="bi bi-bookmark-dash-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5zM6 6a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1H6z"/>
                      </svg>
                     <p>
                        Document Category
                     </p>
                  </a>
               </li>
               <li class="nav-item">
                  <a href="settings.php" class="nav-link">
                     <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="rgb(22,94,155)" class="bi bi-building-fill" viewBox="0 0 16 16">
                        <path d="M3 0a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h3v-3.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V16h3a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H3Zm1 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5ZM4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1ZM7.5 5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5Zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1ZM4.5 8h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5Zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5Z"/>
                      </svg>
                     <p>
                        Office Category
                     </p>
                  </a>
               </li> 
               <li class="nav-item">
                     <a href="#" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="rgb(22,94,155)" class="bi bi-file-earmark-text-fill" viewBox="0 0 16 16">
                           <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM4.5 9a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1h-7zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 1 0-1h4a.5.5 0 0 1 0 1h-4z"/>
                         </svg>
                        <p>
                           Files
                        </p>
                        <i class="right fas fa-angle-left"></i>
                     </a>
                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                           <a href="files.php?AOS=add" class="nav-link">
                              <i class="nav-icon far fa-circle"></i>
                              <p>Add Files</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="files.php?AOS=search" class="nav-link">
                              <i class="nav-icon far fa-circle"></i>
                              <p>Search Files</p>
                           </a>
                        </li>
                     </ul>
                  </li>  
               <li class="nav-item adminOnly">
                     <a href="logs.php" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="rgb(22,94,155)" class="bi bi-person-fill-check" viewBox="0 0 16 16">
                           <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514ZM11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                           <path d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z"/>
                        </svg>
                        <p>
                           Logs
                        </p>
                     </a>
                  </li>
               <li class="nav-item adminOnly">
                  <a href="users.php" class="nav-link">
                     <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="rgb(22,94,155)" class="bi bi-people-fill" viewBox="0 0 16 16">
                        <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                      </svg>
                     <p>
                        Users
                     </p>
                  </a>
               </li>
               <li class="nav-item adminOnly">
                     <a href="#" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="rgb(22,94,155)" class="bi bi-database-fill" viewBox="0 0 16 16">
                           <path d="M3.904 1.777C4.978 1.289 6.427 1 8 1s3.022.289 4.096.777C13.125 2.245 14 2.993 14 4s-.875 1.755-1.904 2.223C11.022 6.711 9.573 7 8 7s-3.022-.289-4.096-.777C2.875 5.755 2 5.007 2 4s.875-1.755 1.904-2.223Z"/>
                           <path d="M2 6.161V7c0 1.007.875 1.755 1.904 2.223C4.978 9.71 6.427 10 8 10s3.022-.289 4.096-.777C13.125 8.755 14 8.007 14 7v-.839c-.457.432-1.004.751-1.49.972C11.278 7.693 9.682 8 8 8s-3.278-.307-4.51-.867c-.486-.22-1.033-.54-1.49-.972Z"/>
                           <path d="M2 9.161V10c0 1.007.875 1.755 1.904 2.223C4.978 12.711 6.427 13 8 13s3.022-.289 4.096-.777C13.125 11.755 14 11.007 14 10v-.839c-.457.432-1.004.751-1.49.972-1.232.56-2.828.867-4.51.867s-3.278-.307-4.51-.867c-.486-.22-1.033-.54-1.49-.972Z"/>
                           <path d="M2 12.161V13c0 1.007.875 1.755 1.904 2.223C4.978 15.711 6.427 16 8 16s3.022-.289 4.096-.777C13.125 14.755 14 14.007 14 13v-.839c-.457.432-1.004.751-1.49.972-1.232.56-2.828.867-4.51.867s-3.278-.307-4.51-.867c-.486-.22-1.033-.54-1.49-.972Z"/>
                        </svg>
                        <p>
                           Database
                        </p>
                        <i class="right fas fa-angle-left"></i>
                     </a>
                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                           <a href="database-backup.php" class="nav-link">
                              <i class="nav-icon far fa-circle"></i>
                              <p>Backup Database</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="database-restore.php" class="nav-link">
                              <i class="nav-icon far fa-circle"></i>
                              <p>Restore Database</p>
                           </a>
                        </li>
                     </ul>
                  </li> 
               <li class="nav-item adminOnly">
                     <a href="#" class="nav-link">
                     <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="rgb(22,94,155)"  class="bi bi-archive-fill" viewBox="0 0 16 16">
                     <path d="M12.643 15C13.979 15 15 13.845 15 12.5V5H1v7.5C1 13.845 2.021 15 3.357 15h9.286zM5.5 7h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1zM.8 1a.8.8 0 0 0-.8.8V3a.8.8 0 0 0 .8.8h14.4A.8.8 0 0 0 16 3V1.8a.8.8 0 0 0-.8-.8H.8z"/>
                     </svg>
                        <p>
                           Archives
                        </p>
                        <i class="right fas fa-angle-left"></i>
                     </a>
                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                           <a href="category.php?list=document" class="nav-link">
                              <i class="nav-icon far fa-circle"></i>
                              <p>Document Archives</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="settings.php?list=office" class="nav-link">
                              <i class="nav-icon far fa-circle"></i>
                              <p>Office Archives</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="files.php?list=file" class="nav-link">
                              <i class="nav-icon far fa-circle"></i>
                              <p>File Archives</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="users.php?list=user" class="nav-link">
                              <i class="nav-icon far fa-circle"></i>
                              <p>User Archives</p>
                           </a>
                        </li>
                     </ul>
                  </li> 
               
            </ul>
         </nav>
      </div>
   </aside>
      <div class="content-wrapper">
         <div class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-6">
                        <h1 class="m-0"><?php echo $header; ?></h1>
                  </div>
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item" style="color: rgb(22,94,155);"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active"><?php echo $header; ?></li>
                     </ol>
                  </div>
               </div>
            </div>
         </div>
         <section class="content">
            <div class="container-fluid">
               <div class="card card-info">
                  <form action="../php/addRecord.php" method="post" id="addOfficeForm">
                     <div class="card-body">
                        <div class="row">
                           <div class="col-md-4" id="categoryAddSection">
                              <div class="card-header">
                                 <span class="fa"> Office Category Information</span>
                              </div>
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label>Province</label>
                                       <input type="text" class="form-control" name="addProvince" value="Benguet" >
                                    </div>
                                 </div>
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label>City/Municipality</label>
                                       <input type="text" class="form-control" name="addCityMunicipality" placeholder="ex. La Trinidad">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12" id="addButton">
                                 <button type="submit" class="btn btn-primary"><i
                        class="fa fa-plus-square"></i> Add</button>
                              </div>
                  </form>
               </div>

               <div class="col-md-8" id="officeList" style="border-left: 1px solid #ddd;">
                  <table id="example1" class="table table-bordered table-hover">
                     <thead>
                        <tr>
                           <th>Province</th>
                           <th>City/Municipality</th>
                           <th class="text-center">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                           <?php        
                              if($result != ''){
                                 while($row = mysqli_fetch_array($result)){  
                                    $officeProvince = $row['Province'];
                                    $officeIDNum = $row['office_id_num'];
                                    $officeCityMunicipality = $row['cityMunicipality'];

                                    echo "  
                                    <tr>
                                          <td>$officeProvince</td>
                                          <td>$officeCityMunicipality</td>
                                          <td class='text-center'>
                                             <a class='btn btn-sm btn-success' href='#' data-toggle='modal' data-target='#edit' data-office-id='$officeIDNum' data-office-province='$officeProvince' data-office-cityMunicipality='$officeCityMunicipality' onclick='populateEditModal(this)'><i class='fa fa-search'></i> View</a>
                                             <a class='btn btn-sm btn-danger adminOnly archiveButton' href='#' data-toggle='modal' data-target='#archive' data-office-id='$officeIDNum'>
                                                <i class='fa fa-archive'></i> Archive
                                             </a>
                                             <a class='btn btn-sm btn-danger adminOnly restoreButton' href='#' data-toggle='modal' data-target='#restore' data-office-id='$officeIDNum'>
                                             <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-arrow-counterclockwise' viewBox='0 0 16 16'>
                                             <path fill-rule='evenodd' d='M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z'/>
                                             <path d='M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z'/>
                                             </svg> Restore
                                             </a>
                                          </td>
                                    </tr>";
                                 }  
                              }  
                          ?>
                        
                        </tbody>
                  </table>
               </div>
            </div>
      </div>

   </div>
   </div>
   </div>
   </section>
   </div>
   </div>
   
   
   <!-- Modals -->
   <?php 
      include '../modals/edit-icon-user-modal.php'; 
      include '../modals/edit-office-modal.php'; 
      include '../modals/archive-modal.php';
      include '../modals/restore-modal.php'; 

      if(isset($_REQUEST['list'])){
         if($_REQUEST['list'] == "office"){
            echo "<style>
               #categoryAddSection, #cancelButton, #editButton{
                  display: none !important;
               }

               .restoreButton{
                  display: inline-block;
               }

               .archiveButton{
                  display: none;
               }

               #officeList{
                  border-left: 0px !important; 
               }

            </style>
            <script>
               var element = document.getElementById('officeList');
               element.classList.remove('col-md-8');
               element.classList.add('col-md-12');
            </script>";
   
         }
      }
   ?>
   <!-- jQuery -->
   <script src="../asset/js/bootstrap.bundle.min.js"></script>
   <script src="../asset/js/adminlte.js"></script>
   <!-- DataTables  & Plugins -->
   <script src="../asset/tables/datatables/jquery.dataTables.min.js"></script>
   <script src="../asset/tables/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
   <script src="../asset/tables/datatables-responsive/js/responsive.bootstrap4.min.js"></script>s
   <script src="../asset/tables/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
</body>

</html>