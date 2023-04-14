$(document).ready(function() {
    const editIconUserButton = document.getElementById('editIconUserButton');

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

    $(function () {
        $("#example1").DataTable();
     });
});