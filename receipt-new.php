<?php 
include('header.php');

?>

<style>

    .border{
        border: solid 1px #e7e7e7;
        padding: 30px;
        background-color: #fafafab8;
    }
</style>

<?php

// Define the URL for the action



// require_once 'Payment/PaymentController.php';
// $controller = new PaymentController();
// $payments = $controller->get_payment_with_customer($_GET['id']);
// print_r($payments);
// if (!empty($payments)) {
//     echo "Payments for Inventory ID 33:\n";
//     foreach ($payments as $payment) {
//         echo "Payment Description: " . $payment['Payment_Description'] . "\n";
//         echo "Installment No: " . $payment['Installment_No'] . "<br>";
//         echo "Due Date: " . $payment['Due_Date'] . "<br>";
//         echo "Customer Name: " . $payment['customer_name'] . "<br>";
//         echo "Customer Email: " . $payment['customer_email'] . "<br>";
//         echo "Customer Phone: " . $payment['customer_phone'] . "<br>";
//         echo "---------------------------------<br>";
//     }
// } 
// die; 
?>
    <!-- End of preloader -->
 

    <div class="off-canvas-wrap" data-offcanvas>
      <!-- right sidebar wrapper -->
      <div class="inner-wrap">
                <?php include('includes/right-side.php') ?>

        <div class="wrap-fluid" id="paper-bg">
            <!-- top nav -->
        <?php include('includes/top-nav.php') ?>
            <!-- end of top nav -->

            <!-- breadcrumbs -->
        <?php //include('includes/breadcrum.php') ?>
            <!-- end of breadcrumbs -->

        <!-- ---------------------------------------------- -->
        <?php include('includes/alert.php');?>
        <!-- ---------------------------------------------- -->
                <!-- end of breadcrumbs -->


                       
                

                <div class="box">
                            <div class="box-header bg-transparent">
                                <!-- tools box -->
                                <div class="pull-right box-tools">

                                    <span class="box-btn" data-widget="collapse"><i class="icon-minus"></i>
                                    </span>
                                    <span class="box-btn" data-widget="remove"><i class="icon-cross"></i>
                                    </span>
                                </div>
                                <h3 class="box-title"><i class="fontello-th-large-outline"></i>
                                    <span>Create New RECEIVING</span>
                                </h3>
                                
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body " style="display: block;">
                            <div class="row ">
                                        <div class="columns large-10 large-centered medium-centered small-centered medium-10 small-12  border">
                                            <?php include('includes/Receipt/receipt-form-extended.php'); ?>
                                        </div>      
                                    </div>
                            </div>    
                </div> 
                
               








                <?php 
                    require('includes/footer.php');
                ?>
            </div>










           <?php include('includes/right-menu.php'); ?>


           
        </div>
        <!-- end paper bg -->

    </div>
    <!-- end of off-canvas-wrap -->

    <!-- end of inner-wrap -->

 

    <!-- main javascript library -->
    <script type='text/javascript' src="js/jquery.js"></script>
    <script type="text/javascript" src="js/waypoints.min.js"></script>
    <script type='text/javascript' src='js/preloader-script.js'></script>
    <!-- foundation javascript -->
    <script type='text/javascript' src="js/foundation.min.js"></script>
    <script type='text/javascript' src="js/foundation/foundation.dropdown.js"></script>
    <!-- main edumix javascript -->
    <script type='text/javascript' src='js/slimscroll/jquery.slimscroll.js'></script>
    <script type='text/javascript' src='js/slicknav/jquery.slicknav.js'></script>
    <script type='text/javascript' src='js/sliding-menu.js'></script>
    <script type='text/javascript' src='js/scriptbreaker-multiple-accordion-1.js'></script>
    <script type="text/javascript" src="js/number/jquery.counterup.min.js"></script>
    <script type="text/javascript" src="js/circle-progress/jquery.circliful.js"></script>
    <script type='text/javascript' src='js/app.js'></script>
    <!-- additional javascript -->

    <script src="js/datatables/jquery.dataTables.js" type="text/javascript"></script>


    <script src="js/footable/js/footable.js?v=2-0-1" type="text/javascript"></script>
    <script src="js/footable/js/footable.sort.js?v=2-0-1" type="text/javascript"></script>
    <script src="js/footable/js/footable.filter.js?v=2-0-1" type="text/javascript"></script>
    <script src="js/footable/js/footable.paginate.js?v=2-0-1" type="text/javascript"></script>
    <script src="js/footable/js/footable.paginate.js?v=2-0-1" type="text/javascript"></script>
    <!-- page script -->

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const floorInput = document.getElementById('floor');
        const sizeInput = document.getElementById('size');
        const noteInput = document.getElementById('description');

        const savedValueNote = localStorage.getItem('noteValue');
        const savedValueFloor = localStorage.getItem('floorValue');
        // Load saved value from localStorage
        const savedValueSize = localStorage.getItem('sizeValue');

        if (savedValueNote) {
            noteInput.value = savedValueNote; // Set the saved value
        }
        if (savedValueFloor) {
            floorInput.value = savedValueFloor; // Set the saved value
        }
        if (savedValueSize) {
            sizeInput.value = savedValueSize; // Set the saved value
        }

        noteInput.addEventListener('input', function () {
            localStorage.setItem('noteValue', noteInput.value);
        });

        sizeInput.addEventListener('input', function () {
            localStorage.setItem('sizeValue', sizeInput.value);
        });

        // Save value to localStorage on input
        floorInput.addEventListener('input', function () {
            localStorage.setItem('floorValue', floorInput.value);
        });
    });
</script>
<script>
    
<?php include('includes/numbers-words.php'); ?>
function isValidIDCard(idCard) {
    // Check if the ID card is all numbers, exactly 13 characters, and no special characters
    return /^\d{13}$/.test(idCard);
}
$(document).ready(function() {
    // When a checkbox is clicked
    $('#receiptForm').on('submit', function (e) {
    e.preventDefault(); // Prevent form submission for testing purposes

    const paymentStatus = $('input[name="status"]:checked').attr('value');
    if(paymentStatus =='full'){

    }
    const formData = new FormData(this);
    $.ajax({
            url: 'Receipts/ReceiptsController?action=create_direct_receipt', // Your endpoint
            type: 'POST',
            data: formData,
            processData: false, // Required for FormData
            contentType: false, // Required for FormData
            beforeSend: function () {
                // Optional: Show a loader or disable the submit button
                $('.receipt-generate').prop('disabled', true).val('Submitting...');
            },
            success: function (response) {
                const data = JSON.parse(response);
                if (data.status === "success" && data.id) {
                    // Redirect to the receipt-view page with the ID
                    const baseUrl = window.location.pathname.split('/').slice(0, -1).join('/');
                    window.location.href = baseUrl + "/receipt-view?id=" + data.id;
                } else {
                    showResponse(response,'error');
                }
            },
            error: function (xhr, status, error) {
                // Handle error
                
                showResponse('An error occurred: ' + error,'error');
                console.error(xhr.responseText);
            },
            complete: function () {
                // Optional: Re-enable the submit button
                $('.receipt-generate').prop('disabled', false).val('Create Receipt');
            }
        
    });

    
    console.log('Selected Payment Status:', paymentStatus);

    // Continue form submission or perform additional logic here
});


    
    $('.number-input1').keyup(function(){
        $('.words1').val(inWords(this.value));
    });
    $('.number-input2').keyup(function(){
        $('.words2').val(inWords(this.value));
    });

    $('.number-input1').blur(function(){
       const result = parseInt(parseInt($('.number-input2').val(), 10) - $('.number-input1').val(), 10);
       $('.number-input3').val(result);
       $('.words3').val(inWords($('.number-input3').val()));

    });
    
    $('input[name="condition"]').on('change', function() {
        // Uncheck the other checkbox
        $('input[name="condition"]').not(this).prop('checked', false);

        // If 'CONDITIONAL' is selected, show the textarea
        if ($('#conditional').is(':checked')) {
            $('.condition').show('fast');
        } else {
            $('.condition').hide('fast');
        }
    });


    $('#id_card').keyup('input', function () {
        let idCard = $(this).val();
        if (!(isValidIDCard(idCard))) {
            $(this).focus();
            $('.id_card_error').show().text('Invalid ID Card number. Must be 13 digits without dashes.');
        } else {
            $('.id_card_error').hide();
        }
    });
    // --------------------------------------------

    $('.new-inv').on('click', function () {
       event.preventDefault();
        const InvName = $('#inv-name').val();
        const floor = $('#floor').val();
        const customer_id = $('#customer_id').val();
        
        const type = $('#type').val();

        if($('#inventory_id').val()==''){
            $('.inv_error').show().html('Create Inventory with the name first');
            $('#inv-name').focus();
        }

        if($('#number-input').val()==''){
            showResponse('Total Amount field is empty','error');
            $('#number-input').focus();
        }

       

        if($('#customer_id').val()==''){
            $('.id_card_error').show().html('Create Customer first');
            $('#name').focus();
        }
        
        if(InvName ==''){
                            $('.inv_error').show().html('Name Field is empty');
                            $('#inv-name').focus();
                            return;
        }
        if(floor ==''){
                            $('.inv_error').show().html('Phone Field is empty');
                            $('#floor').focus();
                            return;
        }

        if(customer_id ==''){
                            $('.inv_error').show().html('Select Customer first');
                            $('#id_card').focus();
                            return;
        }


        $.ajax({
        url: 'Inventory/InventoryController?action=store_inventory', // Adjust the endpoint
        type: 'POST',
        data: { name: InvName, floor: floor, customer_id: customer_id, type: type},
        success: function (response) {
            const data = JSON.parse(response); // Parse response if needed
            if (data.success) {
                $('#inventory_id').val(data.id);
                $('.inventory-results').removeClass('bg-red').addClass('bg-light-green').show().find('.text').text(data.message).end().delay(4000).fadeOut();
                $('.inv_error').hide();
                $('.new-inv').hide();
              
            } else {
                
                var msg ="Failed to add customer"+data.message;
               
                $('.inventory-results').removeClass('bg-light-green').addClass('bg-red').show().find('.text').text(data.message).end().delay(6000).fadeOut();
                
            }
        },
        error: function () {
            alert('Error while saving customer');
        }
    });




    });
    // --------------------------------------------

    $('.new-cus').on('click', function () {
        event.preventDefault();
        const name = $('#name').val();
        const phone = $('#phone').val();
        const idCard = $('#id_card').val();
        
        
        if(name ==''){
                            $('.id_card_error').show().html('Name Field is empty');
                            $('#name').focus();
                            return;
        }
        if(phone ==''){
                            $('.id_card_error').show().html('Phone Field is empty');
                            $('#phone').focus();
                            return;
        }


        if(idCard =='' && (!(isValidIDCard(idCard))) ){
                            $('.id_card_error').show().text('ID card Field is empty');
                            $('#id_card').focus();
                            return;
        }else{
            $('.id_card_error').hide();
        }
        $.ajax({
        url: 'Customer/CustomerController?action=store_customer', // Adjust the endpoint
        type: 'POST',
        data: { name: name, phone: phone, id_card: idCard },
        success: function (response) {
            const data = JSON.parse(response); // Parse response if needed
            if (data.success) {
                $('#customer_id').val(data.id);
                $('.customer-results').removeClass('bg-red').addClass('bg-light-green').show().find('.text').text('New Customer ADDED').end().delay(4000).fadeOut();
                $('.id_card_error').hide();
                $('.new-cus').hide();
                
                $('.receipt-generate').removeAttr('disabled');
            } else {

                var msg ="Failed to add customer"+data.message;
               
                $('.customer-results').removeClass('bg-light-green').addClass('bg-red').show().find('.text').text(msg).end().delay(6000).fadeOut();
                
            }
        },
        error: function () {
            alert('Error while saving customer');
        }
    });




    });
    //

    $('#inv-name').on('blur', function () {
        const name = $(this).val();
        if (name.trim() !== '') {
            $(this).append('<div class="spinner inv-spinner"></div>');
            $.ajax({
                url: 'Inventory/InventoryController?action=checkNameAvailable', // Path to your PHP file
                type: 'POST',
                data: { name: name },
                dataType: 'json',
                success: function(response) {
                    if (response.exists) {
                        $('.inv-spinner').hide();
                        $('.new-inv').show();
                        $('.receipt-generate').removeAttr('disabled');
                        $('.new-inv').show('fast');
                        //$('.inventory-results').removeClass('bg-red').addClass('bg-light-green').show().find('.text').text('Create New User').end().delay(4000).fadeOut();
                        
                    } else {
                        
                        
                        $('.receipt-generate').attr('title','Disabled, Create Inventory First');
                        $('.new-inv').hide('fast');
                        $('.receipt-generate').attr('title','');
                        $('.inv-spinner').hide();
                            if($('#inventory_id').val()==''){
                                $('.inventory-results').removeClass('bg-light-green').addClass('bg-red').show().find('.text').text('Inventory with Name '+ name+' Already Exist in Inventory change the Name').end().delay(10000).fadeOut();
                                $('#inv-name').focus();
                            }
                    }
                },
                error: function() {
                    $('.inv-spinner').hide();
                    $('#nameStatus').text('Error checking name.').css('color', 'red');
                }
            });
            } else {
                $('#nameStatus').text('');
            }
    });


    $('#id_card').on('blur', function () {
            const idCard = $(this).val();
            if(idCard ==''){
                            $('.id_card_error').show().html('ID card Field is empty');
                            $('#id_card').focus();
                            return;
            }else{
                $('.id_card_error').hide();
            }
            if (idCard) {
                $('.spinner').removeClass('hidden');
                $.ajax({
                    url: 'Customer/CustomerController?action=check_customer_by_id_card', // Adjust the endpoint if necessary
                    type: 'POST',
                    data: { id_card: idCard },
                    dataType: 'json', // Automatically parses the response as JSON
                    success: function (response) {
                        if (response.success) {
                            
                            $('#customer_id').val(response.data.id);
                            $('#name').val(response.data.name);
                            $('#phone').val(response.data.phone);
                            $('.spinner').addClass('hidden');
                            $('.receipt-generate').removeAttr('disabled');
                            if($('#customer_id').val()!=''){
                                $('.new-cus').hide();
                            }
                        } else {  
                            $('.new-cus').show('slow');
                           
                            $('.receipt-generate').attr('title','Create New Customer First');
                            $('.spinner').addClass('hidden');
                        }
                    },
                    error: function () {
                        alert('Error while checking ID card');
                        $('.spinner').addClass('hidden');
                    }
                });

            }
        });

        $('#photo_receipt').on('change', function () {
        const idCard = $('#id_card').val().trim(); // Get the ID card value
        const idCardError = $('.id_card_error'); // Reference to the error container
        var preview = $('#PhotoPreview');
        var photoImg =$('#photoImg');
        var loader = $('#Photoloader');
        var filename= 'document';
        var text_field = $('#photoPath_receipt');

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
        var timestamp = new Date().getTime();
        var timestampString = timestamp.toString();
        var inv_id = $('#inventory_id').val();
        var filename= timestampString + '_' + inv_id;
        const formData = new FormData();
        formData.append('nic', idCard); // Add the ID card value to the request
        formData.append('fileName',filename);
        formData.append('uploaded_file', file); // Add the file to the request

        $.ajax({
            url: 'includes/upload_receipts.php', // Your server-side file handler
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
                    localStorage.setItem('photoPath_receipt', result.filePath);
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

 

// end of Document REady
    });
    

    <?php
    // Contiains the function that render alert
    include('includes/alert-js.php');
    ?>
</script>
</body>

</html>
