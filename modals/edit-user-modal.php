<div id="edit" class="modal animated rubberBand delete-modal" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg">
         <div class="modal-content">
            <div class="modal-body text-center">
               <form action="../php/saveRecord.php" method="post" id="editUserForm">
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
                                    <input type="text" class="form-control" id="idEditUserFullName" name="nameEditUserFullName" placeholder="Full Name" disabled>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="float-left">Access Level</label>
                                    <select class="form-control" id="idEditUserAccessLevel" name="nameEditUserAccessLevel" disabled>
                                       <option>Admin</option>
                                       <option>Staff</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="float-left">Username</label>
                                    <input type="text" class="form-control" id="idEditUserUsername" name="nameEditUserUsername" placeholder="Username" disabled>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="float-left">Status</label>
                                    <select class="form-control" id="idEditUserStatus" name="nameEditUserStatus" disabled>
                                       <option>Activated</option>
                                       <option>Disabled</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="float-left">Password</label>
                                    <input type="password" class="form-control" id="idEditUserPassword" name="nameEditUserPassword" placeholder="**********" disabled>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="float-left">Confirm Password</label>
                                    <input type="password" class="form-control" name="nameEditUserConfirmPassword" id="idEditUserConfirmPassword" placeholder="**********" disabled>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                     <a href="#" class="btn btn-danger" id="cancelButton" data-dismiss="modal">Cancel</a>
                     <input type="hidden" name="editID" id="hiddenId">
                     <button type="button" id="editButton" class="btn btn-info" style="background-color: rgb(22,94,155);">Edit</button>
                     <button type="submit" id="saveButton" class="btn btn-info" style="background-color: rgb(22,94,155); display: none;">Save</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>