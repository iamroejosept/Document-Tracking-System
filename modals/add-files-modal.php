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
                                    <label class="float-left">Barcode <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" fill="red" class="bi bi-asterisk" viewBox="0 0 16 16">
                                       <path d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1z"/>
                                       </svg></label>
                                    <input type="text" class="form-control" name="txtBarcode" placeholder="Barcode" required>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="float-left">Category Name <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" fill="red" class="bi bi-asterisk" viewBox="0 0 16 16">
                                       <path d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1z"/>
                                       </svg></label>
                                    <select class="form-control" name="fileCategory" id="fileCategory" required>
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
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label class="float-left">Region <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" fill="red" class="bi bi-asterisk" viewBox="0 0 16 16">
                                       <path d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1z"/>
                                       </svg></label>
                                    <select class="form-control" name="fileRegion" id="fileRegion" onchange="getProvinces(this.value)" required>
                                       <option selected disabled>Select a region first</option>
                                       <?php 
                                          $query = "SELECT DISTINCT Region FROM OfficeSettings ORDER BY Region ASC";  
                                          $result = mysqli_query($connect, $query);

                                          if(mysqli_num_rows($result) > 0){
                                             while($row = mysqli_fetch_array($result)){  
                                                $region = $row['Region'];
                                                
                                                echo "  
                                                <option value='$region'>$region</option>
                                                ";
                                             }  
                                          }  
                                       ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label class="float-left">Province <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" fill="red" class="bi bi-asterisk" viewBox="0 0 16 16">
                                       <path d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1z"/>
                                       </svg></label>
                                    <select class="form-control" name="fileProvince" id="fileProvince" onchange="getCities(this.value)" required>
                                       <option selected disabled>Select a region first</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label class="float-left">City/Municipality <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" fill="red" class="bi bi-asterisk" viewBox="0 0 16 16">
                                       <path d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1z"/>
                                       </svg></label>
                                    <select class="form-control" name="fileCityMunicipality" id="fileCityMunicipality" required>
                                       <option selected disabled>Select a province first</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="float-left">Date Uploaded <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" fill="red" class="bi bi-asterisk" viewBox="0 0 16 16">
                                       <path d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1z"/>
                                       </svg></label>
                                    <input type="date" id="fetchDate" class="form-control" name="fileDate" placeholder="Date" required>
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
                                    <label class="float-left">File Location <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" fill="red" class="bi bi-asterisk" viewBox="0 0 16 16">
                                       <path d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1z"/>
                                       </svg></label>
                                    <textarea class="form-control" name="fileFileLocation" placeholder="File Location" required></textarea>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="float-left">Remark <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" fill="red" class="bi bi-asterisk" viewBox="0 0 16 16">
                                       <path d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1z"/>
                                       </svg></label>
                                    <select class="form-control" name="fileRemark" id="fileRemark" required>
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