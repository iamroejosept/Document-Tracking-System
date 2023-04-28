<?php  
   require '../php/centralConnection.php';
   session_start();
   if(empty($_SESSION['logged_in'])){
      header('Location: ../index.html');
   } 

   if(isset($_REQUEST['list'])){
      if($_REQUEST['list'] == "document"){
         $query ="SELECT * FROM DocumentCategory WHERE ArchiveStatus = 'Archived'";  
         $result = mysqli_query($connect, $query);
         $header = "Document Category Archives";

      }
   }else{
      $query ="SELECT * FROM DocumentCategory WHERE ArchiveStatus != 'Archived'";  
      $result = mysqli_query($connect, $query);
      $header = "Document Category";
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
   <!-- jQuery -->
   <script src="../asset/js/bootstrap.bundle.min.js"></script>
   <script src="../asset/js/adminlte.js"></script>
   <!-- DataTables  & Plugins -->
   <script src="../asset/tables/datatables/jquery.dataTables.min.js"></script>
   <script src="../asset/tables/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
   <script src="../asset/tables/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
   <script src="../js/category.js"></script>
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
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                     <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="rgb(22,94,155)" class="bi bi-bookmark-fill" viewBox="0 0 16 16">
                     <path d="M2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2z"/>
                     </svg>
                        <p>
                           Categories
                        </p>
                        <i class="right fas fa-angle-left"></i>
                     </a>
                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                           <a href="category.php" class="nav-link">
                              <i class="nav-icon far fa-circle"></i>
                              <p>Document Category</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="settings.php" class="nav-link">
                              <i class="nav-icon far fa-circle"></i>
                              <p>Office Category</p>
                           </a>
                        </li>
                     </ul>
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
                  <li class="nav-item adminOnly">
                     <a href="#" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="rgb(22,94,155)" class="bi bi-gear-fill" viewBox="0 0 16 16">
                        <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                        </svg>
                        <p>
                           Settings
                        </p>
                        <i class="right fas fa-angle-left"></i>
                     </a>
                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                           <a href="logs.php" class="nav-link">
                              <i class="nav-icon far fa-circle"></i>
                              <p>Logs</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#" class="nav-link">
                              <i class="nav-icon far fa-circle"></i>
                              <p>Database</p>
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
                  <form action="../php/addRecord.php" method="post" id="addCategoryForm">
                     <div class="card-body">
                        <div class="row">
                           <div class="col-md-4" id="categoryAddSection">
                              <div class="card-header">
                                 <span class="fa"> Document Category Information</span>
                              </div>
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label>Document Category Name <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" fill="red" class="bi bi-asterisk" viewBox="0 0 16 16">
                                       <path d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1z"/>
                                       </svg></label>
                                       <input type="text" class="form-control" name="addDCN" placeholder="Document Name" required>
                                    </div>
                                 </div>
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label>Frequency <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" fill="red" class="bi bi-asterisk" viewBox="0 0 16 16">
                                       <path d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1z"/>
                                       </svg></label>
                                       <select name="addFrequency" class="form-control" id="addFrequency" required>
                                          <option value="Monthly" selected>Monthly</option>
                                          <option value="Quarterly">Quarterly</option>
                                          <option value="Daily">Daily</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label>Description</label>
                                      <textarea class="form-control" name="addDescription" placeholder="Description"></textarea>
                                    </div>
                                 </div>
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label>Due Date <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" fill="red" class="bi bi-asterisk" viewBox="0 0 16 16">
                                       <path d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1z"/>
                                       </svg></label>
                                       <input type="date" class="form-control" name="addDueDate" required>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12" id="addButton">
                                 <button type="submit" class="btn btn-primary"><i
                        class="fa fa-plus-square"></i> Add</button>
                              </div>
                  </form>
               </div>

               <div class="col-md-8" id="categoryLists" style="border-left: 1px solid #ddd;">
                  <table id="example1" class="table table-bordered table-hover">
                     <thead>
                        <tr>
                           <th>Document Category Name</th>
                           <th>Frequency</th>
                           <th>Description</th>
                           <th>Due Date</th>
                           <th class="text-center">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                           <?php        
                              if($result != ''){
                                 while($row = mysqli_fetch_array($result)){  
                                    $DocumentCategoryName = $row['DocumentCategoryName'];
                                    $Frequency = $row['Frequency'];
                                    $Description = $row['Description'];
                                    $DueDateNumFormat = $row['DueDate'];
                                    $DocumentCategoryId = $row['id_num'];
                                    $DueDate = "";

                                    if($DueDateNumFormat != ''){
                                       $dueTimestamp = strtotime($DueDateNumFormat);
                                       $DueDate = date('F j, Y', $dueTimestamp);
                                    }
                                    
                                    echo "  
                                    <tr>
                                          <td>$DocumentCategoryName</td>
                                          <td>$Frequency</td>
                                          <td>$Description</td>
                                          <td>$DueDate</td>
                                          <td class='text-center'>
                                             <a class='btn btn-sm btn-success' href='#' data-toggle='modal' data-target='#edit' data-category-id='$DocumentCategoryId' data-category-name='$DocumentCategoryName' data-description='$Description' data-frequency='$Frequency' data-dueDate='$DueDateNumFormat' onclick='populateEditModal(this)'><i class='fa fa-search'></i> View</a>
                                             <a class='btn btn-sm btn-danger adminOnly archiveButton' href='#' data-toggle='modal' data-target='#archive' data-category-id='$DocumentCategoryId'>
                                                <i class='fa fa-archive'></i> Archive
                                             </a>
                                             <a class='btn btn-sm btn-danger adminOnly restoreButton' href='#' data-toggle='modal' data-target='#restore' data-category-id='$DocumentCategoryId'>
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
      include '../modals/edit-category-modal.php'; 
      include '../modals/archive-modal.php'; 
      include '../modals/restore-modal.php'; 

      if(isset($_REQUEST['list'])){
         if($_REQUEST['list'] == "document"){
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

               #categoryLists{
                  border-left: 0px !important;
               }

            </style>
            <script>
               var element = document.getElementById('categoryLists');
               element.classList.remove('col-md-8');
               element.classList.add('col-md-12');
            </script>";
   
         }
      }
   ?>
   
</body>

</html>