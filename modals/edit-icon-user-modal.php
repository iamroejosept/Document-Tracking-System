<div id="editIconUser" class="modal animated rubberBand delete-modal" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg">
         <div class="modal-content">
            <div class="modal-body text-center">
               <form action="../php/saveRecord.php" method="post" id="editIconUserForm">
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
                                    <input type="text" class="form-control" id="idEditIconUserFullName" name="nameEditUserFullName" placeholder="Full Name" disabled>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="float-left">Access Level</label>
                                    <select class="form-control" id="idEditIconUserAccessLevel" name="nameEditUserAccessLevel" disabled>
                                       <option>Admin</option>
                                       <option>Staff</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="float-left">Username</label>
                                    <input type="text" class="form-control" id="idEditIconUserUsername" name="nameEditUserUsername" placeholder="Username" disabled>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="float-left">Status</label>
                                    <select class="form-control" id="idEditIconUserStatus" name="nameEditUserStatus" disabled>
                                       <option>Activated</option>
                                       <option>Disabled</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="float-left">Password</label>
                                    <input type="password" class="form-control" id="idEditIconUserPassword" name="nameEditUserPassword" placeholder="**********" disabled>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="float-left">Confirm Password</label>
                                    <input type="password" class="form-control" name="nameEditUserConfirmPassword" id="idEditIconUserConfirmPassword" placeholder="**********" disabled>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                     <a href="#" class="btn btn-danger" data-dismiss="modal">Cancel</a>
                     <input type="hidden" name="editID" id="hiddenIconUserId">
                     <button type="button" id="editIconUserButton" class="btn btn-info" style="background-color: rgb(22,94,155);">Edit</button>
                     <button type="submit" id="saveIconUserButton" class="btn btn-info" style="background-color: rgb(22,94,155); display: none;">Save</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <?php
         $id = $_SESSION['user_id'];
         $sqlQuery ="SELECT * FROM Users WHERE users_id_num='$id'";  
         $resultQuery = mysqli_query($connect, $sqlQuery);

         if($resultQuery){
            $rowQuery = mysqli_fetch_assoc($resultQuery);
            $iconUserFullname=$rowQuery['Fullname'];
            $iconUserUsername=$rowQuery['Username'];
            $iconUserPassword=$rowQuery['Password'];
            $iconUserAccessLevel=$rowQuery['AccessLevel'];
            $iconUserStatus=$rowQuery['Status'];
         }

         echo "<script>
         document.getElementById('hiddenIconUserId').value = '$id';
         document.getElementById('idEditIconUserFullName').value = '$iconUserFullname';
         document.getElementById('idEditIconUserUsername').value = '$iconUserUsername';
         document.getElementById('idEditIconUserStatus').value = '$iconUserStatus';
         document.getElementById('idEditIconUserPassword').value = '$iconUserPassword';
         document.getElementById('idEditIconUserConfirmPassword').value = '$iconUserPassword';
         document.getElementById('idEditIconUserAccessLevel').value = '$iconUserAccessLevel';
         </script>";
      ?>
   </div>