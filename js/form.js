
    document.getElementById('idCardFrontUpload').addEventListener('change', function () {
    const fileName = this.files[0] ? this.files[0].name : 'No file selected';
    document.getElementById('idCardFrontFileName').textContent = fileName;
});

$(document).ready(function () {
    $('.error-box').hide();

    $('.success-box').hide();


    $('#photo').on('change', function () {
        const idCard = $('#id_card').val().trim(); // Get the ID card value
        const idCardError = $('.id_card_error'); // Reference to the error container
        var preview = $('#PhotoPreview');
        var photoImg =$('#photoImg');
        var loader = $('#Photoloader');
        var filename= 'photo';
        var text_field = $('#photoPath');

        if (idCard === '') {
            $('#id_card').focus();
            // Display an error if ID card is not provided
            idCardError.text('Please enter your ID Card number before uploading a file.');
            idCardError.show();
            $(this).val(''); // Clear the file input
            return;
        }

        idCardError.hide(); // Hide the error message

        const file = this.files[0];
        if (!file) {
            alert('No file selected!');
            return;
        }

        const formData = new FormData();
        formData.append('nic', idCard); // Add the ID card value to the request
        formData.append('fileName',filename);
        formData.append('uploaded_file', file); // Add the file to the request

        $.ajax({
            url: 'includes/upload_docs.php', // Your server-side file handler
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                // Show a preloader in the preview area

                loader.show();
                preview.show();
            },
            success: function (response) {
                let result;
                try {
                    result = JSON.parse(response); // Parse the JSON response
                } catch (e) {
                    alert('Unexpected response from the server.');
                    preview.hide();
                    loader.hide();
                    return;
                }

                if (result.success) {
                    // Update hidden input field
                 
                    // Show uploaded image
                    text_field.val(result.filePath);
                    photoImg.attr('src', result.filePath);
                    preview.show();
                    loader.hide();
                    localStorage.setItem('photoPath', result.filePath);
                } else {
                    alert('Upload failed: ' + result.message);
                    preview.hide();
                    loader.hide();
                }
            },
            error: function () {
                preview.hide();
                loader.hide();
                alert('An error occurred while uploading the file.');
            },
        });
    });

    
    $('#idCardFrontUpload').on('change', function () {
        const idCard = $('#id_card').val().trim(); // Get the ID card value
        const idCardError = $('.id_card_error'); // Reference to the error container

        if (idCard === '') {
            $('#id_card').focus();
            // Display an error if ID card is not provided
            idCardError.text('Please enter your ID Card number before uploading a file.');
            idCardError.show();
            $(this).val(''); // Clear the file input
            return;
        }

        idCardError.hide(); // Hide the error message

        const file = this.files[0];
        if (!file) {
            alert('No file selected!');
            return;
        }

        const formData = new FormData();
        formData.append('nic', idCard); // Add the ID card value to the request
        formData.append('fileName','front-side');
        formData.append('uploaded_file', file); // Add the file to the request

        $.ajax({
            url: 'includes/upload_docs.php', // Your server-side file handler
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                // Show a preloader in the preview area
                $('#idCardFrontLoader').show();
                $('#idCardFrontPreview').show();
            },
            success: function (response) {
                let result;
                try {
                    result = JSON.parse(response); // Parse the JSON response
                } catch (e) {
                    alert('Unexpected response from the server.');
                    $('#idCardFrontPreview').hide();
                    $('#idCardFrontLoader').hide();
                    return;
                }

                if (result.success) {
                    // Update hidden input field
                    $('#idCardFrontPath').val(result.filePath);
                    $('#idCardFrontLoader').hide();

                    // Show uploaded image
                    $('#idCardFrontImg').attr('src', result.filePath);
                    $('#idCardFrontPreview').html('<img id="idCardFrontImg" src="' + result.filePath + '" alt="Uploaded ID Card Front" style="width: 170px;" />');
                    $('#idCardFrontPreview').show();
                    localStorage.setItem('idCardFrontPath', result.filePath);
                } else {
                    $('#idCardFrontLoader').hide();
                    alert('Upload failed: ' + result.message);
                    $('#idCardFrontPreview').hide();
                }
            },
            error: function () {
                $('#idCardFrontLoader').hide();
                $('#idCardFrontPreview').hide();
                alert('An error occurred while uploading the file.');
            },
        });
    });
    
    $('#idCardBackUpload').on('change', function () {
        const idCard = $('#id_card').val().trim(); // Get the ID card value
        const idCardError = $('.id_card_error'); // Reference to the error container
        var preview = $('#idCardBackPreview');
        var photoImg =$('#idCardBackImg');
        var loader = $('#idCardBackLoader');
        var text_field = $('#idCardBackPath')
        var filename= 'back-side';

        if (idCard === '') {
            $('#id_card').focus();
            // Display an error if ID card is not provided
            idCardError.text('Please enter your ID Card number before uploading a file.');
            idCardError.show();
            $(this).val(''); // Clear the file input
            return;
        }

        idCardError.hide(); // Hide the error message

        const file = this.files[0];
        if (!file) {
            alert('No file selected!');
            return;
        }

        const formData = new FormData();
        formData.append('nic', idCard); // Add the ID card value to the request
        formData.append('fileName',filename);
        formData.append('uploaded_file', file); // Add the file to the request

        $.ajax({
            url: 'includes/upload_docs.php', // Your server-side file handler
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                // Show a preloader in the preview area

                loader.show();
                preview.show();
            },
            success: function (response) {
                let result;
                try {
                    result = JSON.parse(response); // Parse the JSON response
                } catch (e) {
                    alert('Unexpected response from the server.');
                    preview.hide();
                    loader.hide();
                    return;
                }

                if (result.success) {
                    // Update hidden input field
                 
                    // Show uploaded image
                    text_field.val(result.filePath);
                    photoImg.attr('src', result.filePath);
                    preview.show();
                    loader.hide();
                    localStorage.setItem('idCardBackPath', result.filePath);
                } else {
                    alert('Upload failed: ' + result.message);
                    preview.hide();
                    loader.hide();
                }
            },
            error: function () {
                preview.hide();
                loader.hide();
                alert('An error occurred while uploading the file.');
            },
        });
    });



    
    $('#idCardNOKFrontUpload').on('change', function () {

       
        const idCard = $('#id_card').val().trim(); // Get the ID card value
        const idCardError = $('.id_card_error'); // Reference to the error container
        var preview = $('#idCardNOKFrontPreview');
        var photoImg =$('#idCardNOKFrontImg');
        var loader = $('#idCardNOKFrontLoader');
        var text_field = $('#idCardNOKFrontPath')
        var filename= 'NOK-front-side';

        if (idCard === '') {
            $('#id_card').focus();
            // Display an error if ID card is not provided
            idCardError.text('Please enter your ID Card number before uploading a file.');
            idCardError.show();
            $(this).val(''); // Clear the file input
            return;
        }

        idCardError.hide(); // Hide the error message

        const file = this.files[0];
        if (!file) {
            alert('No file selected!');
            return;
        }

        const formData = new FormData();
        formData.append('nic', idCard); // Add the ID card value to the request
        formData.append('fileName',filename);
        formData.append('uploaded_file', file); // Add the file to the request

        $.ajax({
            url: 'includes/upload_docs.php', // Your server-side file handler
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                // Show a preloader in the preview area

                loader.show();
                preview.show();
            },
            success: function (response) {
                let result;
                try {
                    result = JSON.parse(response); // Parse the JSON response
                } catch (e) {
                    alert('Unexpected response from the server.');
                    preview.hide();
                    loader.hide();
                    return;
                }

                if (result.success) {
                    // Update hidden input field
                 
                    // Show uploaded image
                    text_field.val(result.filePath);
                    photoImg.attr('src', result.filePath);
                    preview.show();
                    loader.hide();
                    localStorage.setItem('idCardNOKFrontPath', result.filePath);
                } else {
                    alert('Upload failed: ' + result.message);
                    preview.hide();
                    loader.hide();
                }
            },
            error: function () {
                preview.hide();
                loader.hide();
                alert('An error occurred while uploading the file.');
            },
        });
    });



    $('#idCardNOKBackUpload').on('change', function () {
        const idCard = $('#id_card').val().trim(); // Get the ID card value
        const idCardError = $('.id_card_error'); // Reference to the error container
        var preview = $('#idCardNOKBackPreview');
        var photoImg =$('#idCardNOKBackImg');
        var loader = $('#idCardNOKBackLoader');
        var text_field = $('#idCardNOKBackPath')
        var filename= 'NOK-back-side';

        if (idCard === '') {
            $('#id_card').focus();
            // Display an error if ID card is not provided
            idCardError.text('Please enter your ID Card number before uploading a file.');
            idCardError.show();
            $(this).val(''); // Clear the file input
            return;
        }

        idCardError.hide(); // Hide the error message

        const file = this.files[0];
        if (!file) {
            alert('No file selected!');
            return;
        }

        const formData = new FormData();
        formData.append('nic', idCard); // Add the ID card value to the request
        formData.append('fileName',filename);
        formData.append('uploaded_file', file); // Add the file to the request

        $.ajax({
            url: 'includes/upload_docs.php', // Your server-side file handler
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                // Show a preloader in the preview area

                loader.show();
                preview.show();
            },
            success: function (response) {
                let result;
                try {
                    result = JSON.parse(response); // Parse the JSON response
                } catch (e) {
                    alert('Unexpected response from the server.');
                    preview.hide();
                    loader.hide();
                    return;
                }

                if (result.success) {
                    // Update hidden input field
                 
                    // Show uploaded image
                    text_field.val(result.filePath);
                    photoImg.attr('src', result.filePath);
                    preview.show();
                    loader.hide();
                    localStorage.setItem('idCardNOKBackPath', result.filePath);
                } else {
                    alert('Upload failed: ' + result.message);
                    preview.hide();
                    loader.hide();
                }
            },
            error: function () {
                preview.hide();
                loader.hide();
                alert('An error occurred while uploading the file.');
            },
        });
    });


        $('#customerForm').on('submit', function (e) {
        e.preventDefault(); // Prevent default form submission

        // Create a FormData object to handle the form submission
        let formData = new FormData(this);

        // Show loaders for file uploads
        $('#Photoloader, #idCardFrontLoader, #idCardBackLoader, #idCardNOKFrontLoader, #idCardNOKBackLoader').show();

        // Post the form data using AJAX
        $.ajax({
            url: 'Customer/CustomerController.php', // Replace with your actual controller endpoint
            type: 'POST',
            data: formData,
            processData: false, // Do not process data (required for FormData)
            contentType: false, // Do not set content type header
            dataType: 'json',
            success: function (response) {
                // Hide loaders
                $('#Photoloader, #idCardFrontLoader, #idCardBackLoader, #idCardNOKFrontLoader, #idCardNOKBackLoader').hide();

                if (response.success) {
                    // Show success message and hide error message
                    $('.success-box').show();
                    $('.error-box').hide();
                    $('.success-msg').text(response.message);
                    // $('#customerForm')[0].reset(); // Reset the form
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                } else {
                    // Show error message
                    $('.error-box').show();
                    $('.success-box').hide();
                    $('.error-msg').text(response.message);
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                }
            },
            error: function (xhr, status, error) {
                // Hide loaders
                $('#Photoloader, #idCardFrontLoader, #idCardBackLoader, #idCardNOKFrontLoader, #idCardNOKBackLoader').hide();
                
                console.error('An error occurred: ' + error);
            }
        });
    });
    


    $('.phone').on('blur', function () {
        const phoneNumber = $(this).val().trim();
        const phoneError = $(this).parent().next('.error'); // Reference to the error container

        // Regular expression to match exactly 12 digits
        const phonePattern = /^[0-9]{12}$/;

        if (!phonePattern.test(phoneNumber)) {
            phoneError.text('Phone number must be exactly 12 digits and contain only numbers. 923330000000');
            phoneError.show();
        } else {
            phoneError.hide(); // Hide error if phone number is valid
        }
    });

    // ID Card validation
    $('#id_card').on('input', function () {
        let idCard = $(this).val();
        if (!/^\d{13}$/.test(idCard)) {
            $(this).parent().next('.error').show().text('Invalid ID Card number. Must be 13 digits without dashes.');
        } else {
            $(this).parent().next('.error') .hide();
        }
    });
});




    



