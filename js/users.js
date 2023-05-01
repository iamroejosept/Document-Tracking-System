function populateEditModal(button) {
    var user_id = button.getAttribute('data-user-id');
    var user_profile = button.getAttribute('data-user-profile');
    var fullname = button.getAttribute('data-fullname');
    var username = button.getAttribute('data-username');
    var password= button.getAttribute('data-password');
    var access_level = button.getAttribute('data-access-level');
    var status = button.getAttribute('data-status');

    var user_profile_full_path = "../asset/img/profile-picture/" + user_profile;
    
    document.getElementById('idEditUserFullName').value = fullname;
    document.getElementById('idEditUserAccessLevel').value = access_level;
    document.getElementById('idEditUserUsername').value = username;
    document.getElementById('idEditUserPassword').value = password;
    document.getElementById('idEditUserConfirmPassword').value = password;
    document.getElementById('hiddenId').value = user_id;
    document.getElementById('idEditUserStatus').value = status;
    document.getElementById('edit-picture-container').style.backgroundImage = `url(${user_profile_full_path})`;
    $('#editlabelProfilePicture').text(user_profile);
    document.getElementById('anchorEditPictureContainer').href = user_profile_full_path;
 }

$(document).ready(function() {
 const editButton = document.getElementById('editButton');
 const editIconUserButton = document.getElementById('editIconUserButton');

 editButton.addEventListener('click', function() {
    const disabledElements = document.querySelectorAll('[disabled]');

    disabledElements.forEach((element) => {
      if (!document.getElementById('editIconUser').contains(element)) {
        element.removeAttribute('disabled');
      }
    });

    $('.eyeHolder').css('background-color', 'white');
    $('.eyeHolder').css('pointer-events', 'auto');

    document.getElementById('editButton').style.display = 'none';
    document.getElementById('saveButton').style.display = 'inline-block';

 });

 $('#edit').on('hidden.bs.modal', function (e) {
    document.getElementById('editButton').style.display = 'inline-block';
    document.getElementById('saveButton').style.display = 'none';

    document.getElementById('idEditUserFullName').disabled = true;
    document.getElementById('idEditUserAccessLevel').disabled = true;
    document.getElementById('idEditUserUsername').disabled = true;
    document.getElementById('idEditUserStatus').disabled = true;
    document.getElementById('idEditUserPassword').disabled = true;
    document.getElementById('idEditUserConfirmPassword').disabled = true;
    document.getElementById('editProfilePicture').disabled = true;

    $('.eyeHolder').css('background-color', '#E9ECEF');
    $('.eyeHolder').css('pointer-events', 'none');
    document.getElementById('eye-icon3').classList.remove("fa-eye-slash");
      document.getElementById('eye-icon4').classList.remove("fa-eye-slash");
      document.getElementById('eye-icon3').classList.remove("fa-eye");
      document.getElementById('eye-icon4').classList.remove("fa-eye");
      document.getElementById('eye-icon3').classList.add("fa-eye");
      document.getElementById('eye-icon4').classList.add("fa-eye");
      document.getElementById('idEditUserPassword').type = "password";
      document.getElementById('idEditUserConfirmPassword').type = "password";

 });

 editIconUserButton.addEventListener('click', function() {
    const disabledElements = document.querySelectorAll('[disabled]');

    disabledElements.forEach((element) => {
      if (!document.getElementById('edit').contains(element)) {
        element.removeAttribute('disabled');
      }
    });

    $('.eyeHolder').css('background-color', 'white');
    $('.eyeHolder').css('pointer-events', 'auto');

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
    document.getElementById('editIconProfilePicture').disabled = true;

    $('.eyeHolder').css('background-color', '#E9ECEF');
    $('.eyeHolder').css('pointer-events', 'none');
    document.getElementById('eye-icon-nav1').classList.remove("fa-eye-slash");
      document.getElementById('eye-icon-nav2').classList.remove("fa-eye-slash");
      document.getElementById('eye-icon-nav1').classList.remove("fa-eye");
      document.getElementById('eye-icon-nav2').classList.remove("fa-eye");
      document.getElementById('eye-icon-nav1').classList.add("fa-eye");
      document.getElementById('eye-icon-nav2').classList.add("fa-eye");
      document.getElementById('idEditIconUserPassword').type = "password";
      document.getElementById('idEditIconUserConfirmPassword').type = "password";

 });

 $(function () {
    $("#example1").DataTable();
 });

 // Update the label of the custom file input with the name of the selected file
 $('#profilePicture').on('change', function() {
   // Get the name of the selected file
   var profileName = $(this).val().split('\\').pop();
   // Update the label with the name of the file
   $('#labelProfilePicture').text(profileName);

   const file = this.files[0];
   const reader = new FileReader();

   reader.addEventListener('load', () => {
      $('#picture-container').css('background-image', `url(${reader.result})`);
      const url = URL.createObjectURL(file); // Create temporary URL
      $('#anchorPictureContainer').attr('href', url)
   });

   reader.readAsDataURL(file);
});

// Update the label of the custom file input with the name of the selected file
$('#editProfilePicture').on('change', function() {
   // Get the name of the selected file
   var profileName = $(this).val().split('\\').pop();
   // Update the label with the name of the file
   $('#editlabelProfilePicture').text(profileName);

   const file = this.files[0];
   const reader = new FileReader();

   reader.addEventListener('load', () => {
      $('#edit-picture-container').css('background-image', `url(${reader.result})`);
   });

   reader.readAsDataURL(file);
});

 //Function for updating user record
 $('#editUserForm').submit(function(event) {
    event.preventDefault(); // prevent the form from submitting normally
    var form_data = new FormData(this);
    form_data.append("target", "user");

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
 
 //Function for adding user record
 $('#addUserForm').submit(function(event) {
    event.preventDefault(); // prevent the form from submitting normally
    var form_data = new FormData(this);
    form_data.append("target", "user");

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
 $('#archive').on('show.bs.modal', function(e) {
    var userID = $(e.relatedTarget).data('user-id');

    var form_data = new FormData();
    form_data.append("id", userID);
    form_data.append("target", "user");
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
                content: 'Failed to archive user due to error',
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

 //Function for restoring user record
 $('#restore').on('show.bs.modal', function(e) {
   var userID = $(e.relatedTarget).data('user-id');

   var form_data = new FormData();
   form_data.append("id", userID);
   form_data.append("target", "user");
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
               content: 'Failed to restore user due to error',
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