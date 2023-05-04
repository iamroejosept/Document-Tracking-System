<?php
require 'php/centralConnection.php';
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>DOCUTRACE</title>
      <link rel="icon" href="#" type="image/png">
      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="asset/fontStyle.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="asset/fontawesome/css/all.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="asset/css/adminlte.min.css">
      <script src="asset/jquery-3.6.0.min.js"></script>
      <link rel="stylesheet" href="asset/jquery-confirm.min.css">
      <script src="asset/jquery-confirm.min.js"></script>
      <script src="js/Login.js"></script>
      <link rel="stylesheet" href="css/style.css">
      <script>
         $(document).ready(function() 
         {
            $("#loginForm").submit(function(event)
            {                
               /* stop form from submitting normally */
               event.preventDefault();
               var form_data = new FormData(this);

               login(form_data);                  
            });    
         });

         function login(form_data) {   
            form_data.append('accessLevel',"admin");
            $.ajax({
               url:"php/login.php",
               method:"POST",
               data:form_data,
               contentType: false,
               processData: false,
               cache: false,
               dataType: "xml",
               success:function(xml) {
                     $(xml).find('output').each(function() {  
                        var message = $(this).attr('Message');
                        var verify = $(this).attr('Verify');
                        var accStatus = $(this).attr('AccStatus');

                        //if Account status is Active
                        if(accStatus == "Activated") {
                           //if login credentials is true
                           if (verify) {
                              window.location.href = 'admin/index.php';
                           } else {
                                 //Display Alert Box
                                 $.alert({
                                    theme: 'modern',
                                    content: message,
                                    title:'', 
                                    useBootstrap: false,
                                    buttons:{
                                       Ok:{
                                             text:'Ok',
                                             btnClass: 'btn-red'
                                       }
                                    }
                                 });
                                 $('#TxtUsername').val('');
                                 $('#TxtPassword').val('');
                           }
                        } else if(accStatus == "Blocked") {
                           //set variable message to be used for logs
                           message = 'Account blocked, ask admin regarding the issue.';
                           $.alert({
                                 theme: 'modern',
                                 content: message,
                                 title:'', 
                                 useBootstrap: false,
                                 buttons:{
                                    Ok:{
                                       text:'Ok',
                                       btnClass: 'btn-red'
                                    }
                                 }
                           });
                           $('#TxtUsername').val('');
                           $('#TxtPassword').val('');
                        } else {
                           //set variable message to be used for logs
                           $.alert({
                                 theme: 'modern',
                                 content: message,
                                 title:'', 
                                 useBootstrap: false,
                                 buttons:{
                                    Ok:{
                                       text:'Ok',
                                       btnClass: 'btn-red'
                                    }
                                 }
                           });
                           $('#TxtUsername').val('');
                           $('#TxtPassword').val('');
                        }
                     });
               },
               error: function (e) {
                     //Display Alert Box
                     $.alert({
                        theme: 'modern',
                        content:'Failed to search user due to errors',
                        title:'', 
                        useBootstrap: false,
                        buttons:{
                           Ok:{
                                 text:'Ok',
                                 btnClass: 'btn-red'
                           }
                        }
                     });
               }
            });
         }
      </script>
      <style>
         #docutraceLogo{
            width: 100%;
         }

         body {
            background: linear-gradient(-45deg, #1A1A1A, #ECECEC, #8EC2EA, #0A2743);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            height: 100vh;
         }

         .card{
            background-color: rgba(255, 255, 255, 0.5) !important; /* set the background color to light gray with 50% opacity */
         }

         @keyframes gradient {
            0% {
               background-position: 0% 50%;
            }
            50% {
               background-position: 100% 50%;
            }
            100% {
               background-position: 0% 50%;
            }
         }
      </style>
   </head>
   <body class="hold-transition login-page">
      <div class="login-box">
         <!-- /.login-logo -->
         <div class="card card-outline card-info">
            <div class="card-header">
               <?php
                     $queryLogo ="SELECT * FROM Logo";  
                     $resultLogo = mysqli_query($connect, $queryLogo);

                     if($resultLogo != ''){
                        while($rowLogo = mysqli_fetch_array($resultLogo)){
                           $logo_picture = $rowLogo['Logo_Picture'];
                           $logo_name = $rowLogo['Logo_Name'];
                           echo "
                              <img src='asset/img/logo/$logo_picture' alt='DOCUTRACE Logo' id='loginDocutraceLogo'>
                              <h3 id='logo_title'>$logo_name</h3>
                           ";

                           // JavaScript to change favicon href
                           echo "<script>
                              const favicon = document.querySelector('link[rel=\"icon\"]');
                              favicon.href = 'asset/img/logo/$logo_picture';
                           </script>";
                        }};
               ?>
            </div>
            <div class="card-body" >
               <form action="#" method="post" id="loginForm">
                  <div class="input-group mb-3">
                     <input type="text" class="form-control" name="TxtUsername" id="TxtUsername" placeholder="Username">
                     <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-user"></span>
                        </div>
                     </div>
                  </div>
                  <div class="input-group mb-3">
                     <input type="password" class="form-control" name="TxtPassword" id="TxtPassword" placeholder="Password">
                     <div class="input-group-append">
                       <div class="input-group-text" id="eyeHolder">
                         <span id="eye-icon1" class="fas fa-eye" onclick="togglePasswordVisibility('TxtPassword', 'eye-icon1')"></span>
                       </div>
                       <div class="input-group-text">
                         <span class="fas fa-lock"></span>
                       </div>
                     </div>
                   </div>
                  <div class="row">
                     <div class="col-6 offset-lg-3">
                        <button type="submit" class="btn btn-info btn-block" style="background-color: rgb(22,94,155)">Login</button>
                     </div>
                  </div>
               </form>
               <div class="text-center mt-2">
                    <a href="index.php" style="color: rgb(22,94,155);">Staff Login</a>
                </div>
            </div>
            <!-- /.card-body -->
         </div>
         <!-- /.card -->
      </div>
      <!-- /.login-box -->
   </body>
</html>