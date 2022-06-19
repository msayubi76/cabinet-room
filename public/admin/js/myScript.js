profile.onchange = evt => {
    const [file] = profile.files
    console.log('file', file);
    if (file) {
        image_preview.src = URL.createObjectURL(file)
    }
}
edit_profile.onchange = evt => {
    const [file] = edit_profile.files
    if (file) {
        edit_image_preview.src = URL.createObjectURL(file)
    }
}

function deleteUser(id) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        },
        url: "/users/" + id, // the endpoint
        type: "DELETE", // http method
        processData: false,
        contentType: false,
        success: function (data) {
            $('.alert-success').html(data.success).fadeIn('slow');
            $('.alert-success').delay(3000).fadeOut('slow');
            alert(data);
            document.getElementById("row_" + id).remove();
        },
        error: function (error) {
            alert(error);

            // toastr.error(errorMessage, "Error");
            // hideLoader();
        },
    });
}

function openEditModal(user) {
    document.getElementById('edit_name').value = user.name;
    document.getElementById('user_id').value = user.id;
    
    var image;
    if (user.image_url) {
        image = user.image_url;
    } else {
        image = base_url + '/storage/profile/default_image.png';
    }
    // document.getElementById('edit_profile').value = user.image_name;
    $('#edit_image_preview').attr('src', image)
    // document.getElementById('edit_image_preview').src = user.image_url;
    $("#editModalUser").modal()
}
function openViewModal(user){
    // document.getElementById('view_name').value = user.name;
    // document.getElementById('view_email').value = user.email;
    document.getElementById("view_name").innerHTML = user.name;
    document.getElementById("view_email").innerHTML = user.email;

    var image;
    if (user.image_url) {
        image = user.image_url;
    } else {
        image = base_url + '/storage/profile/default_image.png';
    }
    $('#view_image_preview').attr('src', image)
    $("#viewModalUser").modal()
}
function editUser() {
    var form = $('#edit-user-form')[0];
    user_id = form.user_id.value;
    console.log('user id ', user_id.value);
    const myFormData = new FormData(form);
    const formDataObj = {};
    myFormData.forEach((value, key) => (formDataObj[key] = value));
    console.log(formDataObj);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        },
        url: "/users/" + user_id, // the endpoint
        type: "POST", // http method
        processData: false,
        contentType: false,
        data: myFormData,
        beforeSend: function () {
            $(form)
                .find('[type="button"]')
                .prop("disabled", true);
        },
        success: function (data) {
            alert(data);
            $(form)
                .find('[type="button"]')
                .prop("disabled", false);
                swal({  
                    title: "",  
                    text: data.message,  
                    icon: "success",  
                  });  
        },
        error: function (error) {
            $(form)
                .find('[type="button"]')
                .prop("disabled", false);
            var errorMessage = error.statusText;
            var sweetMessage = error.statusText;
            if (error.status == 422) {
                errorMessage = handleValidationErrors(error, 'edit')
                sweetMessage = 'Invalid Data'
            }
            swal({  
                title: "Error",  
                text: sweetMessage,  
                icon: "error",  
              }); 
            // toastr.error(errorMessage, "Error");
            // hideLoader();
        },
    });
}

function submitUser() {
    var form = $('#user-form')[0];
    console.log('form ', form);

    const myFormData = new FormData(form);
    const formDataObj = {};
    myFormData.forEach((value, key) => (formDataObj[key] = value));
    console.log(formDataObj);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        },
        url: "/users", // the endpoint
        type: "POST", // http method
        processData: false,
        contentType: false,
        data: myFormData,
        beforeSend: function () {
            $(form)
                .find('[type="button"]')
                .prop("disabled", true);
        },
        success: function (data) {
            console.log('data',data);
            swal({  
                title: "",  
                text: data.message,  
                icon: "success",  
              });  
            $(form)
                .find('[type="button"]')
                .prop("disabled", false);
            document.getElementById("user-form").reset();
            
        },
        error: function (error) {
            $(form)
                .find('[type="button"]')
                .prop("disabled", false);
            var errorMessage = error.statusText;
            var sweetMessage = error.statusText;
            if (error.status == 422) {
                errorMessage = handleValidationErrors(error)
                sweetMessage ='Invalid Data'
            }
            swal({  
                title: "Error",  
                text: sweetMessage,  
                icon: "error",  
              });  
            // toastr.error(errorMessage, "Error");
            // hideLoader();
        },
    });
}

function handleValidationErrors(error, type = 'create') {
    let errors = error.responseJSON.errors;
    var errorMessage = error.responseJSON.message
    var element = '';
    $.each(errors, function (key, item) {
        element = key.split('.')
        if (element.length > 1) {
            element = `${element[0]}_${element[1]}`
        } else {
            element = `${element}`
        }
        // dataAttr = $(element).closest('.tab').data('id')
        // $(`.step-${dataAttr}`).addClass('backend-error')
        if (type == 'edit') {
            console.log('edit',element);
            $(`#edit_${element}_text`).text(item[0])
        } else if (type == 'create') {
            $(`#${element}_text`).text(item[0])
        }
    });

    return errorMessage;
}
// function showLoader(message, options) {
//   waitingDialog.show(message, options);
// }
