<div id="edit" class="modal animated rubberBand delete-modal" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg">
         <div class="modal-content">
            <div class="modal-body text-center">
               <form action="../php/saveRecord.php" method="post" id="editFileForm">
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
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="float-left">Barcode</label>
                                    <input type="text" class="form-control" name="nameEditBarcode" id="editBarcode" placeholder="Barcode" disabled>
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
                                    <label class="float-left">Frequency</label>
                                    <span type="text" id="frequency" class="form-control border-0 bg-transparent d-flex"></span>
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
                                       
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="float-left">Uploaded By</label>
                                    <span type="text" id="uploadedBy" class="form-control border-0 bg-transparent d-flex"></span>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="float-left">Date Uploaded</label>
                                    <input type="date" id="editDateUploaded" class="form-control" name="nameEditDateUploaded" placeholder="Date Uploaded" disabled>
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
                                    <label class="float-left">Remark</label>
                                    <select class="form-control" name="nameEditRemark" id="editRemark" disabled>
                                       <option value="Submitted">Submitted</option>
                                       <option value="Not Submitted">Not Submitted</option>
                                    </select>
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