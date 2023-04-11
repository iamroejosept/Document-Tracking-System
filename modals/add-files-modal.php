<div id="add" class="modal animated rubberBand delete-modal" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg">
         <div class="modal-content">
            <div class="modal-body text-center">
               <form action="../php/addRecord.php" method="post" id="addFileForm" enctype="multipart/form-data">
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
                                    <label class="float-left">Barcode</label>
                                    <input type="text" class="form-control" name="txtBarcode" placeholder="Barcode">
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="float-left">Category Name</label>
                                    <select class="form-control" name="fileCategory" id="fileCategory">
                                       <option selected disabled>Choose Category</option>
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
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="float-left">Date</label>
                                    <input type="date" id="fetchDate" class="form-control" name="fileDate" placeholder="Date">
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
                                    <label class="float-left">Remark</label>
                                    <select class="form-control" name="fileRemark" id="fileRemark">
                                       <option value="Submitted" selected>Submitted</option>
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
                     <a href="#" class="btn btn-danger" data-dismiss="modal">Cancel</a>
                     <button type="submit" class="btn btn-info" style="background-color: rgb(22,94,155);">Add</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>