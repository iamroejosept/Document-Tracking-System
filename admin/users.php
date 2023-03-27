<?php  
   require '../php/centralConnection.php';
   session_start();
   if(empty($_SESSION['logged_in'])){
      header('Location: ../index.html');
   } 

   $query ="SELECT * FROM Users";  
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
   <script>
      $(document).ready(function() {
         //Function for updating user record
         $('#editUserForm').submit(function(event) {
            event.preventDefault(); // prevent the form from submitting normally
            var form_data = new FormData(this);

            var pass = document.getElementById("idEditUserPassword").value;
            var confirmpass = document.getElementById("idEditUserConfirmPassword").value;

            if(pass != confirmpass){
               console.log("a");
               $.alert({
                        title: '',
                        content: 'Password and Confirm Password does not match. Please try again.',
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
               return false;
            }

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
                     content: 'Failed to update user due to error',
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
         
         //Function for adding user record
         $('#addUserForm').submit(function(event) {
            event.preventDefault(); // prevent the form from submitting normally
            var form_data = new FormData(this);

            var pass = document.getElementById("idAddUserPassword").value;
            var confirmpass = document.getElementById("idAddUserConfirmPassword").value;

            if(pass != confirmpass){
               console.log("a");
               $.alert({
                        title: '',
                        content: 'Password and Confirm Password does not match. Please try again.',
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
               return false;
            }

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
                     content: 'Failed to add user due to error',
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
            var userID = $(e.relatedTarget).data('user-id');

            var form_data = new FormData();
            form_data.append("id", userID);

            $('#delete-user-link').click(function(event) {

               // Submit the form using AJAX
               $.ajax({
                  url: "../php/deleteUser.php",
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
                        content: 'Failed to delete user due to error',
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
                 <!--  <li class="nav-item">
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
                     <h1 class="m-0">Users</h1>
                  </div>
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
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
                     <table id="example1" class="table">
                        <thead class="btn-cancel">
                           <tr>
                              <th>Full Name</th>
                              <th>Access Level</th>
                              <th>Account</th>
                              <th>Status</th>
                              <th class="text-center">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php        
                                 if($result != ''){
                                    while($row = mysqli_fetch_array($result)){  
                                       $Fullname = $row['Fullname'];
                                       $UserID = $row['id_num'];
                                       $Username = $row['Username'];
                                       $Password = $row['Password'];
                                       $AccessLevel = $row['AccessLevel'];
                                       $Status = $row['Status'];
                                       
                                       if($Status == "Activated"){
                                          echo "  
                                          <tr>
                                                <td>$Fullname</td>   
                                                <td>$AccessLevel</td>
                                                <td>
                                                   <p class='info'>
                                                      Username: <b>$Username</b>
                                                   </p>
                                                   <p class='info'>
                                                      Password: <b>$Password</b>
                                                   </p>
                                                </td>
                                                <td><span class='badge bg-success'>$Status</td>
                                                <td class='text-center'>
                                                   <a class='btn btn-sm btn-success' href='#' data-toggle='modal' data-target='#edit' data-user-id='$UserID' data-fullname='$Fullname' data-username='$Username' data-password='$Password' data-access-level='$AccessLevel' data-status='$Status' onclick='populateEditModal(this)'><i class='fa fa-edit'></i>Update</a>
                                                   <a class='btn btn-sm btn-danger' href='#' data-toggle='modal' data-target='#delete' data-user-id='$UserID'>
                                                      <i class='fa fa-trash-alt'></i>Delete
                                                   </a>
                                                </td>
                                          </tr>";
                                       }else{
                                          echo "  
                                          <tr>
                                                <td>$Fullname</td>   
                                                <td>$AccessLevel</td>
                                                <td>
                                                   <p class='info'>
                                                      Username: <b>$Username</b>
                                                   </p>
                                                   <p class='info'>
                                                      Password: <b>$Password</b>
                                                   </p>
                                                </td>
                                                <td><span class='badge bg-danger'>$Status</td>
                                                <td class='text-center'>
                                                   <a class='btn btn-sm btn-success' href='#' data-toggle='modal' data-target='#edit' data-user-id='$UserID' data-fullname='$Fullname' data-username='$Username' data-password='$Password' data-access-level='$AccessLevel' data-status='$Status' onclick='populateEditModal(this)'><i class='fa fa-edit'></i>Update</a>
                                                   <a class='btn btn-sm btn-danger' href='#' data-toggle='modal' data-target='#delete' data-user-id='$UserID'>
                                                      <i class='fa fa-trash-alt'></i>Delete
                                                   </a>
                                                </td>
                                          </tr>";
                                       }
                                       
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
   <div id="delete" class="modal animated rubberBand delete-modal" role="dialog">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-body text-center">
               <img src="../asset/img/sent.png" alt="" width="50" height="46">
               <h3>Are you sure want to delete this User?</h3>
               <div class="m-t-20">
                  <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                  <a type="submit" class="btn btn-danger" id="delete-user-link">Delete</a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div id="edit" class="modal animated rubberBand delete-modal" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg">
         <div class="modal-content">
            <div class="modal-body text-center">
               <form action="../php/saveUser.php" method="post" id="editUserForm">
                  <div class="card-body">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="card-header">
                              <h5>User Information</h5>
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="float-left">Full Name</label>
                                    <input type="text" class="form-control" id="idEditUserFullName" name="nameEditUserFullName" placeholder="Full Name">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="float-left">Access Level</label>
                                    <select class="form-control" id="idEditUserAccessLevel" name="nameEditUserAccessLevel">
                                       <option>Admin</option>
                                       <option>Staff</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="float-left">Username</label>
                                    <input type="text" class="form-control" id="idEditUserUsername" name="nameEditUserUsername" placeholder="Username">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="float-left">Status</label>
                                    <select class="form-control" id="idEditUserStatus" name="nameEditUserStatus">
                                       <option>Activated</option>
                                       <option>Disabled</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="float-left">Password</label>
                                    <input type="password" class="form-control" id="idEditUserPassword" name="nameEditUserPassword" placeholder="**********">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="float-left">Confirm Password</label>
                                    <input type="password" class="form-control" name="nameEditUserConfirmPassword" id="idEditUserConfirmPassword" placeholder="**********">
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
                     <button type="submit" class="btn btn-info" style="background-color: rgb(22,94,155);">Save</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   <div id="add" class="modal animated rubberBand delete-modal" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg">
         <div class="modal-content">
            <div class="modal-body text-center">
               <form action="../php/addUser.php" method="post" id="addUserForm">
                  <div class="card-body">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="card-header">
                              <h5>User Information</h5>
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="float-left">Full Name</label>
                                    <input type="text" class="form-control" name="addUserFullName" placeholder="Full Name">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="float-left">Access Level</label>
                                    <select class="form-control" name="addUserAccessLevel">
                                       <option>Admin</option>
                                       <option>Staff</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label class="float-left">Username</label>
                                    <input type="text" class="form-control" name="addUserUsername" placeholder="Username">
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label class="float-left">Password</label>
                                    <input type="password" class="form-control" id="idAddUserPassword" name="addUserPassword" placeholder="**********">
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label class="float-left">Confirm Password</label>
                                    <input type="password" class="form-control" id="idAddUserConfirmPassword" name="addUserConfirmPassword" placeholder="**********">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                     <a href="#" class="btn btn-danger" data-dismiss="modal">Cancel</a>
                     <button type="submit" class="btn btn-info" style="background-color: rgb(22,94,155);">Save</button>
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

      function populateEditModal(button) {
         var user_id = button.getAttribute('data-user-id');
         var fullname = button.getAttribute('data-fullname');
         var username = button.getAttribute('data-username');
         var password= button.getAttribute('data-password');
         var access_level = button.getAttribute('data-access-level');
         var status = button.getAttribute('data-status');
         
         document.getElementById('idEditUserFullName').value = fullname;
         document.getElementById('idEditUserAccessLevel').value = access_level;
         document.getElementById('idEditUserUsername').value = username;
         document.getElementById('idEditUserPassword').value = password;
         document.getElementById('idEditUserConfirmPassword').value = password;
         document.getElementById('hiddenId').value = user_id;
         document.getElementById('idEditUserStatus').value = status;

      }
   </script>
</body>

</html>