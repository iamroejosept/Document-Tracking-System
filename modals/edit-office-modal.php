<!-- modal for update -->
<div id="edit" class="modal animated rubberBand delete-modal" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg">
         <div class="modal-content">
            <div class="modal-body text-center">
               <form action="../php/saveRecord.php" method="post" id="editOfficeForm">
                  <div class="card-body">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="card-header">
                              <h5>Office Category Information</h5>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="float-left">Province</label>
                                    <input id="editTxtProvince" type="text" name="editProvince" class="form-control" disabled>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="float-left">City/Municipality</label>
                                    <input id="editTxtCityMunicipality" type="text" name="editCityMunicipality" class="form-control" disabled>
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
                     <button id="officeCategorySave" type="submit" class="btn btn-info" style="background-color: rgb(22,94,155); display: none;">Save</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>