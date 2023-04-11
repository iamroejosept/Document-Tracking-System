function populateEditModal(button) {
    var category_id = button.getAttribute('data-category-id');
    var category_name = button.getAttribute('data-category-name');
    var description = button.getAttribute('data-description');
    var frequency = button.getAttribute('data-frequency');
    
    document.getElementById('editTxtDCN').value = category_name;
    document.getElementById('editTADescription').value = description;
    document.getElementById('hiddenId').value = category_id;
    document.getElementById('editFrequency').value = frequency;
 }
 
 $(document).ready(function() {
    const editButton = document.getElementById('editButton');
    const editIconUserButton = document.getElementById('editIconUserButton');

    editButton.addEventListener('click', function() {
       const disabledElements = document.querySelectorAll('[disabled]');

       disabledElements.forEach((element) => {
          element.removeAttribute('disabled');
       });

       document.getElementById('editButton').style.display = 'none';
       document.getElementById('saveButton').style.display = 'inline-block';

    });

    $('#edit').on('hidden.bs.modal', function (e) {
       document.getElementById('editButton').style.display = 'inline-block';
       document.getElementById('saveButton').style.display = 'none';

       document.getElementById('editTxtDCN').disabled = true;
       document.getElementById('editTADescription').disabled = true;
       document.getElementById('editFrequency').disabled = true;

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

    $(function () {
       $("#example1").DataTable();
    });

    //Function for updating file record
    $('#editCategoryForm').submit(function(event) {
       event.preventDefault(); // prevent the form from submitting normally
       var form_data = new FormData(this);
       form_data.append("target", "document");

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
                content: 'Failed to update document category due to error',
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

    //Function for adding document category record
    $('#addCategoryForm').submit(function(event) {
       event.preventDefault(); // prevent the form from submitting normally
       var form_data = new FormData(this);
       form_data.append("target", "document");

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
                content: 'Failed to add category due to error',
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

    //Function for archiving document category record
 $('#archive').on('show.bs.modal', function(e) {
       var categoryID = $(e.relatedTarget).data('category-id');

       var form_data = new FormData();
       form_data.append("id", categoryID);
       form_data.append("target", "document");
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
                   content: 'Failed to archive document category due to error',
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

    //Function for archiving document category record
 $('#restore').on('show.bs.modal', function(e) {
   var categoryID = $(e.relatedTarget).data('category-id');

   var form_data = new FormData();
   form_data.append("id", categoryID);
   form_data.append("target", "document");
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
               content: 'Failed to restore document category due to error',
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

 