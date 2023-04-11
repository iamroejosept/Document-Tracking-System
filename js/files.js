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
    var file_frequency = button.getAttribute('data-file-frequency');
    var file_remark = button.getAttribute('data-file-remark');
    var file_uploadedBy = button.getAttribute('data-file-uploadedBy');

    document.getElementById('hiddenId').value = file_id;
    document.getElementById('labelEditInputFile').innerHTML = file;
    document.getElementById('frequency').innerHTML = file_frequency;
    document.getElementById('editCategoryName').value = file_category;
    document.getElementById('editBarcode').value = file_barcode;
    document.getElementById('uploadedBy').innerHTML = file_uploadedBy;
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

    $.ajax({
       url: "../php/fetchMunicipalities.php",
       method: "POST",
       data: { province: file_province },
       dataType: "html",
       success: function (data) {
          $('#editFileCityMunicipality').html(data);
          
          // Move the code that selects the option here
          var selectElement = document.getElementById("editFileCityMunicipality");
          var options = selectElement.options;

          for (var i = 0; i < options.length; i++) {
             if (options[i].value === file_cityMunicipality) {
                options[i].selected = true;
                break;
             }
          }
       }
    });


    var selectElement = document.getElementById("editRemark");
    var options = selectElement.options;

    for (var i = 0; i < options.length; i++) {
       if (options[i].value === file_remark) {
          options[i].selected = true;
          break;
       }
    }

    var selectElement = document.getElementById("editFileProvince");
    var options = selectElement.options;

    for (var i = 0; i < options.length; i++) {
       if (options[i].value === file_province) {
          options[i].selected = true;
          break;
       }
    }         
 }
 
 $(document).ready(function() {
    // Get the value of AOS parameter from the URL
    const urlParams = new URLSearchParams(window.location.search);
    const aos = urlParams.get("AOS");

    // If the value of AOS is "search", change the display of an HTML element
    if (aos === "search") {
       var element = document.getElementById("searchFields");
       element.style.display = "flex";

    }else{
       var element = document.getElementById("addNewButton");
       element.style.display = "inline-block";
    }

    const editButton = document.getElementById('editButton');
    const editIconUserButton = document.getElementById('editIconUserButton');

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

    $('#inputDlProvince').on('change', function() {
       var province = $(this).val();
       $.ajax({
          url:"../php/fetchMunicipalities.php",
          method:"POST",
          data:{province:province},
          dataType:"html", // set the expected data type to HTML
          success:function(data){
             $('#municipalities').html(data);
          }
       });
    });

    $('#editFileProvince').change(function(){
       var province = $(this).val();
       $.ajax({
          url:"../php/fetchMunicipalities.php",
          method:"POST",
          data:{province:province},
          dataType:"html", // set the expected data type to HTML
          success:function(data){
             $('#editFileCityMunicipality').html(data);
          }
       });
    });

    /* $('#fileCategory').change(function(){
       var category = $(this).val();
       
       $.ajax({
          url:"../php/fetchFrequency.php",
          method:"POST",
          data:{category:category},
          dataType:"xml", // set the expected data type to HTML
          success: function(xml) {
             $(xml).find('output').each(function()
             {
                var frequency = $(this).attr('frequency');

                if (frequency === 'Quarterly') {
                   // Disable all months except March, June, September, and December
                   $('#fetchDate').datepicker('destroy');
                   $('#fetchDate').datepicker({
                      format: 'yyyy-mm-dd',
                      autoclose: true,
                      startDate: '-20y', // Allow past dates up to 1 year ago
                      beforeShowMonth: function(date){
                         var month = date.getMonth();
                         if (month == 2 || month == 5 || month == 8 || month == 11) {
                            return true;
                         } else {
                            return false;
                         }
                      }
                   });
                } else {
                   // Re-enable all months
                   $('#fetchDate').datepicker('destroy');
                   $('#fetchDate').datepicker({
                      format: 'yyyy-mm-dd',
                      autoclose: true,
                      startDate: '-20y' // Allow past dates up to 1 year ago
                   });
                }
             });
          }
       });

    }); */

    editButton.addEventListener('click', function() {
       const disabledElements = document.querySelectorAll('[disabled]');

       disabledElements.forEach((element) => {
          if (element.id !== "doNotInclude") {
             element.removeAttribute('disabled');
          }
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
       document.getElementById('editRemark').disabled = true;
       document.getElementById('editDateUploaded').disabled = true;
       document.getElementById('editFileLocation').disabled = true;



    });

    editIconUserButton.addEventListener('click', function() {
       const disabledElements = document.querySelectorAll('[disabled]');

       disabledElements.forEach((element) => {
          element.removeAttribute('disabled');
       });

       document.getElementById('editIconUserButton').style.display = 'none';
       document.getElementById('saveIconUserButton').style.display = 'inline-block';

    });

    $('#editIconUser').on('hidden.bs.modal', function (e) {
       document.getElementById('editIconUserButton').style.display = 'inline-block';
       document.getElementById('saveIconUserButton').style.display = 'none';

       document.getElementById('idEditIconUserFullName').disabled = true;
       document.getElementById('idEditIconUserUsername').disabled = true;
       document.getElementById('idEditIconUserStatus').disabled = true;
       document.getElementById('idEditIconUserPassword').disabled = true;
       document.getElementById('idEditIconUserConfirmPassword').disabled = true;
       document.getElementById('idEditIconUserAccessLevel').disabled = true;

    });

    $('#inputDlProvince').on('input', function () {
       var inputVal = this.value;
       var columnIdx = 4; // Index of Province column in the table

       $('#fileDatatable').DataTable().column(columnIdx).search(inputVal).draw();
    });

    $('#inputDlMunicipality').on('input', function () {
       var inputVal = this.value;
       var columnIdx = 5; // Index of Province column in the table

       $('#fileDatatable').DataTable().column(columnIdx).search(inputVal).draw();
    });

    $('#inputDlCategories').on('input', function () {
       var inputVal = this.value;
       var columnIdx = 3; // Index of Province column in the table

       $('#fileDatatable').DataTable().column(columnIdx).search(inputVal).draw();
    });

    $.fn.dataTable.ext.search.push(
       function( settings, data, dataIndex ) {
          var min = $("#dateFrom").val();
          var max = $("#dateTo").val();
          var date = new Date( data[7] );
    
          if (
                ( min === "" && max === "" ) ||
                ( min === "" && date <= new Date(max) ) ||
                ( new Date(min) <= date && max === "" ) ||
                ( new Date(min) <= date && date <= new Date(max) )
          ) {
                return true;
          }
          return false;
       }
    );
    
    $("#dateFrom, #dateTo").on("change", function () {
       $('#fileDatatable').DataTable().draw();
    });

    $(function () {
       $("#fileDatatable").DataTable();
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

    //Function for updating file record
    $('#editFileForm').submit(function(event) {
       event.preventDefault(); // prevent the form from submitting normally
       var form_data = new FormData(this);
       form_data.append("target", "files");

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

    $('#editIconUserForm').submit(function(event) {
       event.preventDefault(); // prevent the form from submitting normally
       var form_data = new FormData(this);
       form_data.append("target", "user");

       var pass = document.getElementById("idEditIconUserPassword").value;
       var confirmpass = document.getElementById("idEditIconUserConfirmPassword").value;

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
    
    //Function for adding file record
    $('#addFileForm').submit(function(event) {
       event.preventDefault(); // prevent the form from submitting normally
       var form_data = new FormData(this);
       form_data.append("target", "files");

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
    $('#archive').on('show.bs.modal', function(e) {
       var fileID = $(e.relatedTarget).data('file-id');

       var form_data = new FormData();
       form_data.append("id", fileID);
       form_data.append("target", "file");
       form_data.append("action", "archive");

       $('.archive-link').click(function(event) {

          // Submit the form using AJAX
          $.ajax({
             url: "../php/archiveRestore.php",
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
                   content: 'Failed to archive file and record due to error',
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

    //Function for restoring file record
 $('#restore').on('show.bs.modal', function(e) {
   var fileID = $(e.relatedTarget).data('file-id');

   var form_data = new FormData();
   form_data.append("id", fileID);
   form_data.append("target", "file");
   form_data.append("action", "restore");

   $('.restore-link').click(function(event) {

      // Submit the form using AJAX
      $.ajax({
         url: "../php/archiveRestore.php",
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
               content: 'Failed to restore file due to error',
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