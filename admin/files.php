<?php  
   require '../php/centralConnection.php';
   session_start();
   if(empty($_SESSION['logged_in'])){
      header('Location: ../index.html');
   } 

   $query ="SELECT * FROM Files";  
   $result = mysqli_query($connect, $query);
?>  

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Document Tracking System</title>
   <!-- Font Awesome -->
   <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css">
   <link rel="stylesheet" href="../asset/css/adminlte.min.css">
   <link rel="stylesheet" href="../asset/css/style.css">
   <link rel="stylesheet" href="../asset/tables/datatables-bs4/css/dataTables.bootstrap4.min.css">
   <script src="../asset/jquery-3.6.0.min.js"></script>
   <link rel="stylesheet" href="../asset/jquery-confirm.min.css">
   <script src="../asset/jquery-confirm.min.js"></script>

</head>
   <script>
      $(document).ready(function() {
         //Function for updating file record
         $('#editFileForm').submit(function(event) {
            event.preventDefault(); // prevent the form from submitting normally
            var form_data = new FormData(this);

            // Submit the form using AJAX
            $.ajax({
               url: $(this).attr('action'),
               type: $(this).attr('method'),
               data: form_data,
               contentType: false,
               processData: false,
               cache: false,
               dataType: 'xml', // Tell jQuery to expect an XML response
               success: function(xml) {
                  $(xml).find('output').each(function()
                  {
                     var message = $(this).attr('message');
                     var status = $(this).attr('status');
                     
                     if(status == "success"){
                        $.alert({
                        title: 'Success!',
                        content: message,
                        type: 'green',
                        buttons: {
                           ok: {
                           text: 'OK',
                           btnClass: 'btn-green',
                           action: function() {
                              // Reload the page
                              location.reload();
                           }
                           }
                        }
                        });
                     }else{
                        $.alert({
                        title: 'Failed!',
                        content: message,
                        type: 'red',
                        buttons: {
                           ok: {
                           text: 'OK',
                           btnClass: 'btn-red',
                           action: function() {
                           }
                           }
                        }
                        });
                     }
                  });
               },
               error: function(e) {
                  $.alert({
                     title: 'Error!',
                     content: 'Failed to update file due to error',
                     type: 'red',
                     buttons: {
                        ok: {
                        text: 'OK',
                        btnClass: 'btn-red'
                        }
                     }
                  });
               }
            });
         });
         
         //Function for adding file record
         $('#addFileForm').submit(function(event) {
            event.preventDefault(); // prevent the form from submitting normally
            var form_data = new FormData(this);

            // Submit the form using AJAX
            $.ajax({
               url: $(this).attr('action'),
               type: $(this).attr('method'),
               data: form_data,
               contentType: false,
               processData: false,
               cache: false,
               dataType: 'xml', // Tell jQuery to expect an XML response
               success: function(xml) {
                  $(xml).find('output').each(function()
                  {
                     var message = $(this).attr('message');
                     var status = $(this).attr('status');
                     
                     if(status == "success"){
                        $.alert({
                        title: 'Success!',
                        content: message,
                        type: 'green',
                        buttons: {
                           ok: {
                           text: 'OK',
                           btnClass: 'btn-green',
                           action: function() {
                              // Reload the page
                              location.reload();
                           }
                           }
                        }
                        });
                     }else{
                        $.alert({
                        title: 'Failed!',
                        content: message,
                        type: 'red',
                        buttons: {
                           ok: {
                           text: 'OK',
                           btnClass: 'btn-red',
                           action: function() {
                           }
                           }
                        }
                        });
                     }
                  });
               },
               error: function(e) {
                  $.alert({
                     title: 'Error!',
                     content: 'Failed to add file due to error',
                     type: 'red',
                     buttons: {
                        ok: {
                        text: 'OK',
                        btnClass: 'btn-red'
                        }
                     }
                  });
               }
            });
         });

         //Function for deleting file record
         $('#delete').on('show.bs.modal', function(e) {
            var fileID = $(e.relatedTarget).data('file-id');

            var form_data = new FormData();
            form_data.append("id", fileID);

            $('#delete-file-link').click(function(event) {

               // Submit the form using AJAX
               $.ajax({
                  url: "../php/deleteFile.php",
                  type: "post",
                  data: form_data,
                  contentType: false,
                  processData: false,
                  cache: false,
                  dataType: 'xml', // Tell jQuery to expect an XML response
                  success: function(xml) {
                     $(xml).find('output').each(function()
                     {
                        var message = $(this).attr('message');
                        var status = $(this).attr('status');
                        
                        if(status == "success"){
                           $.alert({
                           title: 'Success!',
                           content: message,
                           type: 'green',
                           buttons: {
                              ok: {
                              text: 'OK',
                              btnClass: 'btn-green',
                              action: function() {
                                 // Reload the page
                                 location.reload();
                              }
                              }
                           }
                           });
                        }else{
                           $.alert({
                           title: 'Failed!',
                           content: message,
                           type: 'red',
                           buttons: {
                              ok: {
                              text: 'OK',
                              btnClass: 'btn-red',
                              action: function() {
                              }
                              }
                           }
                           });
                        }
                     });
                  },
                  error: function(e) {
                     $.alert({
                        title: 'Error!',
                        content: 'Failed to delete file and record due to error',
                        type: 'red',
                        buttons: {
                           ok: {
                           text: 'OK',
                           btnClass: 'btn-red'
                           }
                        }
                     });
                  }
               });
            });

         });

         
      });
   </script>
   <style type="text/css">
      table tr td {
         padding: 0.3rem !important;
      }
      table tr td p{
         margin-top: -0.8rem !important;
         margin-bottom: -0.8rem !important;
         font-size: 0.9rem;
      }
      td a.btn{
         font-size: 0.7rem;
      }
      .btn-primary{
         background-color: rgb(22,94,155);
      }
      .iconsTop{
         color: white !important;
      }

      #File2{
         display: inline-block;
         width: 100%;
         height: 100%;
      }

      #File1{
         display: none;
         width: 100%;
      }

   </style>
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
               <a class="nav-link iconsTop" href="#" role="button" style="margin-top: -3%;">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                     <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                     <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                   </svg>
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link iconsTop" href="../index.html">
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
                     <a href="files.php" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="rgb(22,94,155)" class="bi bi-file-earmark-text-fill" viewBox="0 0 16 16">
                           <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM4.5 9a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1h-7zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 1 0-1h4a.5.5 0 0 1 0 1h-4z"/>
                         </svg>
                        <p>
                           Files
                        </p>
                     </a>
                  </li>
                 <!--  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <img src="../asset/img/commit.png" width="30">
                        <p>
                           Commit Files
                        </p>
                        <i class="right fas fa-angle-left"></i>
                     </a>
                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                           <a href="commit-file.html" class="nav-link">
                              <i class="nav-icon far fa-circle"></i>
                              <p>Commit Files</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="commit-details.html" class="nav-link">
                              <i class="nav-icon far fa-circle"></i>
                              <p>Commit Details</p>
                           </a>
                        </li>
                     </ul>
                  </li> 
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="rgb(22,94,155)" class="bi bi-person-fill-check" viewBox="0 0 16 16">
                           <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514ZM11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                           <path d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z"/>
                         </svg>
                        <p>
                           Logs
                        </p>
                        <i class="right fas fa-angle-left"></i>
                     </a>
                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                           <a href="document-logs.html" class="nav-link">
                              <i class="nav-icon far fa-circle"></i>
                              <p>Document Logs</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="user-logs.html" class="nav-link">
                              <i class="nav-icon far fa-circle"></i>
                              <p>User Logs</p>
                           </a>
                        </li>
                     </ul>
                  </li> -->
                  <li class="nav-item">
                     <a href="users.php" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="rgb(22,94,155)" class="bi bi-people-fill" viewBox="0 0 16 16">
                           <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                         </svg>
                        <p>
                           Users
                        </p>
                     </a>
                  </li>
                  <!-- <li class="nav-item">
                     <a href="database.html" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="rgb(22,94,155)" class="bi bi-database-fill" viewBox="0 0 16 16">
                           <path d="M3.904 1.777C4.978 1.289 6.427 1 8 1s3.022.289 4.096.777C13.125 2.245 14 2.993 14 4s-.875 1.755-1.904 2.223C11.022 6.711 9.573 7 8 7s-3.022-.289-4.096-.777C2.875 5.755 2 5.007 2 4s.875-1.755 1.904-2.223Z"/>
                           <path d="M2 6.161V7c0 1.007.875 1.755 1.904 2.223C4.978 9.71 6.427 10 8 10s3.022-.289 4.096-.777C13.125 8.755 14 8.007 14 7v-.839c-.457.432-1.004.751-1.49.972C11.278 7.693 9.682 8 8 8s-3.278-.307-4.51-.867c-.486-.22-1.033-.54-1.49-.972Z"/>
                           <path d="M2 9.161V10c0 1.007.875 1.755 1.904 2.223C4.978 12.711 6.427 13 8 13s3.022-.289 4.096-.777C13.125 11.755 14 11.007 14 10v-.839c-.457.432-1.004.751-1.49.972-1.232.56-2.828.867-4.51.867s-3.278-.307-4.51-.867c-.486-.22-1.033-.54-1.49-.972Z"/>
                           <path d="M2 12.161V13c0 1.007.875 1.755 1.904 2.223C4.978 15.711 6.427 16 8 16s3.022-.289 4.096-.777C13.125 14.755 14 14.007 14 13v-.839c-.457.432-1.004.751-1.49.972-1.232.56-2.828.867-4.51.867s-3.278-.307-4.51-.867c-.486-.22-1.033-.54-1.49-.972Z"/>
                         </svg>
                        <p>
                           Database
                        </p>
                     </a>
                  </li> -->
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
               </ul>
            </nav>
         </div>
      </aside>
      <div class="content-wrapper">
         <div class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-6">
                     <h1 class="m-0">List of Files</h1>
                  </div>
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Files</li>
                     </ol>
                  </div><br>
                  <a class="btn btn-sm btn-info elevation-4" href="#" data-toggle="modal" data-target="#add" style="margin-left: 7px; background-color: rgb(22,94,155);"><i
                        class="fa fa-plus-square"></i>
                     Add New</a>
               </div>
            </div>
         </div>
         <section class="content">
            <div class="container-fluid">
               <div class="card card-info">
                  <br>
                  <div class="col-md-12">
                     <table id="example1" class="table table-hover">
                        <thead>
                           <tr>
                              <th>File Type</th>
                              <th>File Name</th>
                              <th>Barcode</th>
                              <th>Category</th>
                              <th>Description</th>
                              <th>File Location</th>
                              <th>Uploaded by</th>
                              <th>Date Uploaded</th>
                              <th>Office</th>

                              <th class="text-center">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php        
                              if($result != ''){
                                 while($row = mysqli_fetch_array($result)){  
                                    $FileType = pathinfo($row['File'], PATHINFO_EXTENSION);
                                    $FileName = pathinfo($row['File'], PATHINFO_FILENAME);
                                    $Barcode = $row['Barcode'];
                                    $FileId = $row['id_num'];
                                    $Category = $row['Category'];
                                    $Description = $row['Description'];
                                    $FileLocation = $row['FileLocation'];
                                    $File = $row['File'];
                                    $UploadedBy = $row['UploadedBy'];
                                    $Date = $row['Date'];
                                    $office_ID = $row['office_id_num'];
                                    $office="";
                                    $office_province="";
                                    $office_cityMunicipality="";
                                    $icon = '';

                                    $sql ="SELECT Province, cityMunicipality FROM OfficeSettings WHERE office_id_num='$office_ID'";  
                                    $result1 = mysqli_query($connect, $sql);

                                    if($result1){
                                       $row1 = mysqli_fetch_assoc($result1);
                                       $office_province=$row1['Province'];
                                       $office_cityMunicipality=$row1['cityMunicipality'];
                                       $office = "{$office_province}, {$office_cityMunicipality}";
                                    }

                                    if($FileType == 'docx' || $FileType == 'doc'){
                                       $icon = "<img src='../asset/img/word.png' width='50' height='50'>";
                                    }else if($FileType == 'xls' || $FileType == 'xlsx'){
                                       $icon = "<img src='../asset/img/excel.png' width='50' height='50'>";
                                    }else if($FileType == 'pptx' || $FileType == 'ppt'){
                                       $icon = "<img src='../asset/img/powerpoint.png' width='50' height='50'>";
                                    }else if($FileType == 'pdf'){
                                       $icon = "<img src='../asset/img/pdf-file.png' width='50' height='50'>";
                                    }else if($FileType == ''){
                                       $icon = "";
                                    }else{
                                       $icon = "<img src='../asset/img/file.png' width='50' height='50'>";
                                    }
                                    
                                    echo "  
                                    <tr>
                                          <td>$icon</td>   
                                          <td>$FileName</td>
                                          <td>$Barcode</td>
                                          <td>$Category</td>
                                          <td>$Description</td>
                                          <td>$FileLocation</td>
                                          <td>$UploadedBy</td>
                                          <td>$Date</td>
                                          <td>$office</td>
                                          <td class='text-center'>
                                             <a class='btn btn-sm btn-success' href='#' data-toggle='modal' data-target='#edit' data-file-id='$FileId' data-file='$File' data-file-category='$Category' data-file-barcode='$Barcode' data-file-description='$Description' data-file-fileLocation='$FileLocation' 
                                             data-file-dateUploaded='$Date' data-office-province='$office_province' data-office-cityMunicipality='$office_cityMunicipality' onclick='populateEditModal(this)'><i class='fa fa-edit'></i>View</a>
                                             <a class='btn btn-sm btn-danger' href='#' data-toggle='modal' data-target='#delete' data-file-id='$FileId'>
                                                <i class='fa fa-trash-alt'></i>Delete
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
         </section>
      </div>
   </div>
   <div id="edit" class="modal animated rubberBand delete-modal" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg">
         <div class="modal-content">
            <div class="modal-body text-center">
               <form action="../php/saveFile.php" method="post" id="editFileForm">
                  <div class="card-body">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="card-header">
                              <h5>File Information</h5>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group" id="File1">
                                    <label class="float-left" id="editFileLabel">Files</label>
                                    <div class="input-group">
                                       <div class="custom-file">
                                          <input type="file" class="custom-file-input" name="nameEditInputFile" id="editInputFile">
                                          <label class="custom-file-label" id="labelEditInputFile" for="editInputFile">File</label>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group my-3" id="File2">
                                    <iframe id="viewFileFrame" width="100%" height="500"></iframe>
                                    <a href="#" id="viewFileName"></a>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="float-left">Category Name</label>
                                    <select class="form-control" name="nameEditCategoryName" id="editCategoryName" disabled>
                                    <?php 
                                          $query = "SELECT * FROM DocumentCategory";  
                                          $result = mysqli_query($connect, $query);

                                          if($result != ''){
                                             while($row = mysqli_fetch_array($result)){  
                                                $DocumentCategoryName = $row['DocumentCategoryName'];
                                                
                                                echo "  
                                                <option value='$DocumentCategoryName'>$DocumentCategoryName</option>
                                                ";
                                             }  
                                          }  
                                       ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="float-left">Barcode</label>
                                    <input type="text" class="form-control" name="nameEditBarcode" id="editBarcode" placeholder="Barcode" disabled>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="float-left">Description</label>
                                    <textarea class="form-control" id="editDescription" name="nameEditDescription" placeholder="Description" disabled></textarea>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="float-left">File Location</label>
                                    <textarea class="form-control" id="editFileLocation" name="nameEditFileLocation" placeholder="File Location" disabled></textarea>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="float-left">Date Uploaded</label>
                                    <input type="date" id="editDateUploaded" class="form-control" name="nameEditDateUploaded" placeholder="Date Uploaded" disabled>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="float-left">Province</label>
                                    <select class="form-control" name="namefileProvince" id="editFileProvince" disabled>
                                       <?php 
                                          $query = "SELECT DISTINCT Province FROM OfficeSettings";  
                                          $result = mysqli_query($connect, $query);

                                          if($result != ''){
                                             while($row = mysqli_fetch_array($result)){  
                                                $Province = $row['Province'];
                                                
                                                echo "  
                                                <option value='$Province'>$Province</option>
                                                ";
                                             }  
                                          }  
                                       ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="float-left">City/Municipality</label>
                                    <select class="form-control" name="namefileCityMunicipality" id="editFileCityMunicipality" disabled>
                                       <?php 
                                          $query = "SELECT DISTINCT cityMunicipality FROM OfficeSettings";  
                                          $result = mysqli_query($connect, $query);

                                          if($result != ''){
                                             while($row = mysqli_fetch_array($result)){  
                                                $cityMunicipality = $row['cityMunicipality'];
                                                
                                                echo "  
                                                <option value='$cityMunicipality'>$cityMunicipality</option>
                                                ";
                                             }  
                                          }  
                                       ?>
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                     <a href="#" class="btn btn-danger" data-dismiss="modal">Cancel</a>
                     <input type="hidden" name="nameEditID" id="hiddenId">
                     <button type="button" id="editButton" class="btn btn-info" style="background-color: rgb(22,94,155);">Edit</button>
                     <button type="submit" id="saveButton" class="btn btn-info" style="background-color: rgb(22,94,155); display: none;">Save</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   
   <div id="delete" class="modal animated rubberBand delete-modal" role="dialog">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-body text-center">
               <img src="../asset/img/sent.png" alt="" width="50" height="46">
               <h3>Are you sure want to delete this File?</h3>
               <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                  <a type="submit" class="btn btn-danger" id="delete-file-link">Delete</a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div id="add" class="modal animated rubberBand delete-modal" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg">
         <div class="modal-content">
            <div class="modal-body text-center">
               <form action="../php/addFile.php" method="post" id="addFileForm" enctype="multipart/form-data">
                  <div class="card-body">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="card-header">
                              <h5>File Information</h5>
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label  class="float-left">Files</label>
                                    <div class="input-group">
                                       <div class="custom-file">
                                          <input type="file" class="custom-file-input" name="inputFile" id="exampleInputFile">
                                          <label class="custom-file-label" id="labelInputFile" for="exampleInputFile">Choose file</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="float-left">Category Name</label>
                                    <select class="form-control" name="fileCategory">
                                       <?php 
                                          $query = "SELECT * FROM DocumentCategory";  
                                          $result = mysqli_query($connect, $query);

                                          if($result != ''){
                                             while($row = mysqli_fetch_array($result)){  
                                                $DocumentCategoryName = $row['DocumentCategoryName'];
                                                
                                                echo "  
                                                <option>$DocumentCategoryName</option>
                                                ";
                                             }  
                                          }  
                                       ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="float-left">Barcode</label>
                                    <input type="text" class="form-control" name="txtBarcode" placeholder="Barcode">
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="float-left">Description</label>
                                    <textarea class="form-control" name="fileDescription" placeholder="Description"></textarea>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="float-left">File Location</label>
                                    <textarea class="form-control" name="fileFileLocation" placeholder="File Location"></textarea>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="float-left">Date</label>
                                    <input type="date" id="fetchDate" class="form-control" name="fileDate" placeholder="Date">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="float-left">Province</label>
                                    <select class="form-control" name="fileProvince" id="fileProvince">
                                       <option selected disabled>Choose Province</option>
                                       <?php 
                                          $query = "SELECT DISTINCT Province FROM OfficeSettings ORDER BY Province ASC";  
                                          $result = mysqli_query($connect, $query);

                                          if(mysqli_num_rows($result) > 0){
                                             while($row = mysqli_fetch_array($result)){  
                                                $province = $row['Province'];
                                                
                                                echo "  
                                                <option value='$province'>$province</option>
                                                ";
                                             }  
                                          }  
                                       ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="float-left">City/Municipality</label>
                                    <select class="form-control" name="fileCityMunicipality" id="fileCityMunicipality">
                                       <option selected disabled>Select a province first</option>
                                    </select>
                                 </div>
                              </div>

                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                     <a href="#" class="btn btn-danger" data-dismiss="modal">Cancel</a>
                     <button type="submit" class="btn btn-info" style="background-color: rgb(22,94,155);">Add</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   <!-- jQuery --> 
   <script src="../asset/js/bootstrap.bundle.min.js"></script>
   <script src="../asset/js/adminlte.js"></script>
   <!-- DataTables  & Plugins -->
   <script src="../asset/tables/datatables/jquery.dataTables.min.js"></script>
   <script src="../asset/tables/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
   <script src="../asset/tables/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
   <script src="../asset/tables/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
   <script>
      $(function () {
         $("#example1").DataTable();
      });

      // Update the label of the custom file input with the name of the selected file
      $('#exampleInputFile').on('change', function() {
         // Get the name of the selected file
         var fileName = $(this).val().split('\\').pop();
         // Update the label with the name of the file
         $('#labelInputFile').text(fileName);
      });

      // Update the label of the custom file input with the name of the selected file
      $('#editInputFile').on('change', function() {
         // Get the name of the selected file
         var fileName = $(this).val().split('\\').pop();
         // Update the label with the name of the file
         $('#labelEditInputFile').text(fileName);
      });

      function populateEditModal(button) {
         var file_id = button.getAttribute('data-file-id');
         var file = button.getAttribute('data-file');
         var file_category = button.getAttribute('data-file-category');
         var file_barcode = button.getAttribute('data-file-barcode');
         var file_description = button.getAttribute('data-file-description');
         var file_fileLocation = button.getAttribute('data-file-fileLocation');
         var file_dateUploaded = button.getAttribute('data-file-dateUploaded');
         var file_province = button.getAttribute('data-office-province');
         var file_cityMunicipality = button.getAttribute('data-office-cityMunicipality');

         document.getElementById('hiddenId').value = file_id;
         document.getElementById('labelEditInputFile').innerHTML = file;
         document.getElementById('editBarcode').value = file_barcode;
         document.getElementById('editDescription').value = file_description;
         document.getElementById('editFileLocation').value = file_fileLocation;
         document.getElementById('editDateUploaded').value = file_dateUploaded;

         if (file.endsWith('.pdf')) {
            document.getElementById('viewFileFrame').style.display = 'inline-block';
            document.getElementById('viewFileFrame').setAttribute('src', '../files/' + file);
            document.getElementById('viewFileName').style.display = 'none';
         } else {
            document.getElementById('viewFileFrame').style.display = 'none';
            document.getElementById('viewFileName').style.display = 'inline-block';
            document.getElementById('viewFileName').innerHTML = file;
            document.getElementById('viewFileName').setAttribute('href', '../files/' + file);
         }

         var selectElement = document.getElementById("editFileProvince");
         var options = selectElement.options;

         for (var i = 0; i < options.length; i++) {
            if (options[i].value === file_province) {
               options[i].selected = true;
               break;
            }
         }

         var selectElement = document.getElementById("editFileCityMunicipality");
         var options = selectElement.options;

         for (var i = 0; i < options.length; i++) {
            if (options[i].value === file_cityMunicipality) {
               options[i].selected = true;
               break;
            }
         }

         
      }

      $(document).ready(function(){
         const editButton = document.getElementById('editButton');

         $('#fileProvince').change(function(){
            var province = $(this).val();
            $.ajax({
               url:"../php/fetchMunicipalities.php",
               method:"POST",
               data:{province:province},
               dataType:"html", // set the expected data type to HTML
               success:function(data){
                  $('#fileCityMunicipality').html(data);
               }
            });
         });

         editButton.addEventListener('click', function() {
            const disabledElements = document.querySelectorAll('[disabled]');

            disabledElements.forEach((element) => {
               element.removeAttribute('disabled');
            });

            document.getElementById('editButton').style.display = 'none';
            document.getElementById('saveButton').style.display = 'inline-block';
            document.getElementById('File1').style.display = "inline-block";
            document.getElementById('File2').style.display = "none";

         });

         $('#edit').on('hidden.bs.modal', function (e) {
            document.getElementById('File1').style.display = "none";
            document.getElementById('File2').style.display = "inline-block";
            document.getElementById('editButton').style.display = 'inline-block';
            document.getElementById('saveButton').style.display = 'none';

            document.getElementById('editCategoryName').disabled = true;
            document.getElementById('editBarcode').disabled = true;
            document.getElementById('editDescription').disabled = true;
            document.getElementById('editFileProvince').disabled = true;
            document.getElementById('editFileCityMunicipality').disabled = true;
            document.getElementById('editDateUploaded').disabled = true;
            document.getElementById('editFileLocation').disabled = true;



         });

         $('#add').on('shown.bs.modal', function() {
            // create a new date object
            var today = new Date();
            
            // get the year, month, and day from the date object
            var year = today.getFullYear();
            var month = (today.getMonth() + 1).toString().padStart(2, "0");
            var day = today.getDate().toString().padStart(2, "0");
            
            // create a new date string in the format 'y-m-d'
            var newDateString = year + "-" + month + "-" + day;
            
            // set the value of the input field to the new date string
            $('#fetchDate').val(newDateString);
        });


      });


   </script>
</body>

</html>