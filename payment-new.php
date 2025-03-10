<?php 
include('header.php');

?>
<style>
        #installmentTable {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            background: url('img/ajmir-group-logo') no-repeat center center;
            background-size: 50%; /* Adjust the size of the logo */
           
        }
        #installmentTable {
    width: 100%;
    border-collapse: collapse;
    text-align: center;
    position: relative;
    background: url('img/ajmair-logo-bg.png') no-repeat center center;
    background-size: 200px; /* Adjust logo size */
}

#installmentTable::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('img/ajmair-logo-bg.png') no-repeat center center;
    background-size: 400px;
    opacity: 0.2; /* Adjust opacity */
    z-index: 1;
}
     
#installmentTable th,
#installmentTable td {
 
    padding: 15px;

    position: relative;
    z-index: 2;
}
    </style>

<?php 

// Define the URL for the action

require_once 'Inventory/InventoryController.php';
require_once 'Customer/CustomerController.php';
$controller = new CustomerController();
$customers = $controller->viewAllCustomers();

$inv_controller = new InventoryController();
$inventories = $inv_controller->viewAllInventoryUnoccupied();
$inventories = json_decode($inventories, true);



?>
    <!-- End of preloader -->
 

    <div class="off-canvas-wrap" data-offcanvas>
             <!-- right sidebar wrapper -->
             <div class="inner-wrap">
            <?php include('includes/right-side.php') ?>

            <div class="wrap-fluid" id="paper-bg">
                <!-- top nav -->
                <?php //include('includes/top-nav.php') ?>
                <!-- end of top nav -->

                <!-- breadcrumbs -->
                <?php //include('includes/breadcrum.php') ?>
                <!-- end of breadcrumbs -->

           


<!-- Container Begin -->
<div class="row" style="margin-top:-20px">
<!-- ---------------------------------------------- -->
<?php include('includes/alert.php');?>
<!-- ---------------------------------------------- -->
    <div class="large-6 columns">
        <div class="box">
            <div class="box-header bg-transparent">
                <!-- tools box -->
                <div class="pull-right box-tools">
                    <span class="box-btn" data-widget="collapse"><i class="icon-minus"></i></span>
                    <span class="box-btn" data-widget="remove"><i class="icon-cross"></i></span>
                </div>
                <h3 class="box-title"><i class="fontello-th-large-outline"></i>
                    <span>Add Payment to the customer</span>
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body " style="display: block;">
            
           
                <h4 class="highlight"> <li style="list-style-type: none;" class="fontello-user sp-li"></li>Select Customer First</h4>
                <div class="custom-datalist-wrapper">
                    <label for="customerSelect">Select Customer:</label>
                    <input type="text" list="customers" id="customerInput" class="custom-datalist-input" placeholder="Type to search...">
                    <datalist id="customers" class="custom-datalist">
                        <?php foreach ($customers as $customer): ?>
                            <option data-id="<?php echo htmlspecialchars($customer['id']); ?>" value="<?php echo htmlspecialchars($customer['name']); ?>" data-id-card="<?php echo $customer['id_card']; ?>" data-fname="<?php echo $customer['fname']; ?>" data-name="<?php echo $customer['name']; ?>"
                            data-photo="<?php echo $customer['photo_path']; ?>">
                                <?php endforeach; ?>
                    </datalist>
                </div>
                <input type="hidden" class="selected_cus_id">


                


           
                            
    


                            
            
       
            
        


                            </div>
                            <!-- end .timeline -->
                        </div>
                        <!-- box -->
                    </div>

<div class="large-6 columns">
    <div class="box">
        <div class="box-header bg-transparent">

            <div class="pull-right box-tools">

                <span class="box-btn" data-widget="collapse"><i class="icon-minus"></i>
                                    </span>
                <span class="box-btn" data-widget="remove"><i class="icon-cross"></i>
                                    </span>
            </div>
            <h3 class="box-title"><i class="fontello-th-outline"></i>
                                    <span>Select Inventory</span>
                                </h3>
        </div>
        <div class="box-body">
            <h4> <li style="list-style-type: none;" class="fontello-commerical-building sp-li"></li> Select Inventory</h4>
            <div class="custom-datalist-wrapper">
                <label for="customerSelect">Select Inventory: </label>
                <input type="text" list="inventory" id="inventoryInput" class="custom-datalist-input"  placeholder="<?= empty($inventories) ? 'No inventories available' : 'Type to search...' ?>">
                <datalist id="inventory" class="custom-datalist">
                    <?php if (!empty($inventories)): ?>
                        <?php foreach ($inventories as $item): ?>
                            <option value="<?php echo htmlspecialchars($item['name']); ?>" 
                                    data-id="<?php echo $item['id']; ?>" 
                                    data-code="<?php echo $item['code']; ?>" 
                                    data-project="<?php echo $item['project']; ?>" 
                                    data-type="<?php echo $item['type']; ?>" 
                                    data-size="<?php echo $item['size']; ?>"
                                    data-floor="<?php echo $item['floor']; ?>">
                            </option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option disabled>No inventory available</option>
                    <?php endif; ?>
                </datalist>

                <?php if (empty($inventories)): ?>
                    <p> <a href="#" data-reveal-id="firstModal" class="tiny radius" onclick="setCreateMode()"><i class=" fontello-doc-add" style="font-size:20px">  </i>Create New Inventory</a></p>
                <?php endif; ?>
            </div>
            <input type="hidden" class="selected_inv_id">
        </div>
    </div>
</div>


                    <!-- Start of Box -->


                    <!-- End of Box -->


                                        <!-- Start of Box -->
                    <div class="large-12 columns payment-box hidden  ">
                        <div class="box">
                       
                            <div class="box-header bg-transparent">
                               
                                <div class="pull-right box-tools">

                                    <span class="box-btn" data-widget="collapse"><i class="icon-minus"></i>
                                    </span>
                                    <span class="box-btn" data-widget="remove"><i class="icon-cross"></i>
                                    </span>
                                </div>  
                                <h3 class="box-title"><i class="fontello-th-outline"></i>
                                    
                                </h3>
                            </div>
                            <div class="box-body">       
                            <div class="row">
                                <div class="columns large-12">
                                    <div class="row hidden user_data">
                                        <div class="columns large-6 little-highlight installment-form hidden">
                                        <div class="large-12 columns">
                        <div class="box">
                            <div class="box-header bg-transparent">
                               
                                <div class="pull-right box-tools">

                                    <span class="box-btn" data-widget="collapse"><i class="icon-minus"></i>
                                    </span>
                                    <span class="box-btn" data-widget="remove"><i class="icon-cross"></i>
                                    </span>
                                </div>
                                <h3 class="box-title"><i class="fontello-th-outline"></i>
                                    <span>Make Installments</span>
                                </h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="columns large-12">
                                        <h3>Create Installments Plan </h3>
                                        <form class="form" id="installmentForm">

                                            <div>
                                                <label for="size">Installments Start Date:</label>
                                                <input style="font-size:25px" type="date"   value="12/26/2024" class="" id="start_date" name="start_date" required>
                                            </div>
                                            <!-- <div>
                                                <label for="size">Total Price:</label>
                                                <input style="font-size:25px" type="text" oninput="formatNumber()"  value="9,035,000" class="formattedNumber" id="total_price" name="total_price" required>
                                            </div> -->
                                               <div>
                                                <label for="size">Installment Amount:</label>
                                                <input style="font-size:25px" type="text" oninput="formatNumber()"  value="" class="formattedNumber" id="installment_amount" name="installment_amount" required>
                                            </div>

                                            <div>
                                                <label for="size">Number of Installments :</label>
                                                <input style="font-size:25px" type="number"  value="36" class="" id="number_installments" name="number_installments" required>
                                            </div> 

                                            
                                            <div>
                                                <label for="size">Down Payment/Booking :</label>
                                                <input style="font-size:25px" type="text" oninput="formatNumber()"  value="1,000,000" class="formattedNumber" id="down_payment" name="down_payment" required>
                                            </div> 
                                            
                                            <div class="row">
                                                <div class="large-8 columns">
                                                    <label for="size">Processing Fee:</label>
                                                    <input style="font-size:25px" type="text" oninput="formatNumber()"  value="60,000" class="formattedNumber" id="processing_fee" name="processing_fee" >
                                                 </div>
                                                 <div class="large-4 columns switch-side">
                                                    <div class="switch">
                                                        <small>Disable/Enable</small><br>
                                                        <input id="processingcheckbox"  type="checkbox" >
                                                        <label for="processingcheckbox">Disable</label>
                                                    </div>
                                                 </div>   
                                                
                                            </div>


                                            <div class="row">
                                                <div class="large-12 columns">
                                                    <fieldset>
                                                        <legend>Invterval Payment</legend>
                                                            
                                                            <div class="large-4 columns">
                                                            <label style="line-height: 10px;">    &nbsp;</label>
                                                                <div class="row collapse">
                                                                    <div class="small-3 large-4 columns">
                                                                        <span class="prefix">Every</span>
                                                                    </div>
                                                                    <div class="small-6 large-4 columns">
                                                                       
                                                                    <input style="font-size:20px" type="number" id="interval_month" value="6" placeholder="">
                                                                    </div>

                                                                    <div class="small-3 large-4 columns">
                                                                        <a href="#" class="button postfix">Month</a>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="large-4 columns">
                                                                <label><small> Amount </small> 
                                                                        <input type="text" style="font-size:25px" value="435000" id="interval" name="interval" oninput="formatNumber()"  class="formattedNumber">
                                                                        
                                                                    </label>
                                                            </div>
                                                            <div class="large-4 columns">
                                                                <div class="switch">
                                                                    <small>Disable/Enable</small><br>
                                                                    <input id="intervalcheckbox" checked type="checkbox" >
                                                                    <label for="intervalcheckbox">Disable</label>
                                                                </div>
                                                            </div>

                                                   
                                                            

                                                    </fieldset>
                                                </div>
                                            </div> 
                                            
                                            
                                            
                                            <div class="row">
                                                <div class="large-8 columns">
                                                    <label for="size">On Posession:</label>
                                                    <input style="font-size:25px" type="text"  oninput="formatNumber()"  value="600000" class="formattedNumber" id="last_payment" name="balloting_fee"  >
                                                 </div>
                                                 <div class="large-4 columns switch-side">
                                                    <div class="switch">
                                                        <small>Disable/Enable</small><br>
                                                        <input id="lastpaymentcheckbox" checked type="checkbox" >
                                                        <label for="lastpaymentcheckbox">Disable</label>
                                                    </div>
                                                 </div>   
                                            </div>

                                            <div class="row">
                                                <div class="large-8 columns">
                                                    <label for="size">Digging :</label>
                                                    <input style="font-size:25px" type="text" oninput="formatNumber()"  value="" class="formattedNumber" id="balloting_fee" name="balloting_fee"  >
                                                 </div>
                                                 <div class="large-4 columns switch-side">
                                                    <div class="switch">
                                                        <small>Disable/Enable</small><br>
                                                        <input id="ballotingecheckbox" type="checkbox" >
                                                        <label for="ballotingecheckbox">Disable</label>
                                                    </div>
                                                 </div>   
                                            </div>
                                            


                                            <div class="row">
                                                <div class="large-8 columns">
                                                    <label for="size">Balloon Payment :</label>
                                                    <input style="font-size:25px" type="text" oninput="formatNumber()"  value="" class="formattedNumber" id="balloon_fee" name="balloon_fee" >
                                                 </div>
                                                 <div class="large-4 columns switch-side">
                                                    <div class="switch">
                                                        <small>Disable/Enable</small><br>
                                                        <input id="balloonecheckbox" type="checkbox" >
                                                        <label for="balloonecheckbox">Disable</label>
                                                    </div>
                                                 </div>   
                                            </div>
                                            
                                           
                                            
                                            
                                            <input class="tiny radius button bg-light-green" type="submit" value="Generate Plan" class="button">
                                            <button class="tiny button alert" id="resetForm">Reset</button>
                                            
                                        </form> 
                                    </div>
                                   
                                </div>        
                               

                                    

                            </div>  
                        </div>
                    </div>
                                        </div>
                                        

                                    <div class="columns large-6 little-highlight selectedinventory hidden contentToPrint" style="">
                                            
                                        <div class="columns large-12  " style="text-align: center;">
                                            <img id="user_profile_pic" src="img/user.png" alt="Profile Picture">
                                            <h5 class="user_name purple-heading" ></h5>
                                            <span class="fname"></span><br>
                                                <span class="idcard"></span>
                                                <br>
                                                <a class="tiny button booking-btn"><i class='fontello-attach'></i>Reserve Inventory </a> 
                                                <a class="tiny button bg-light-green payment-btn"><i class='fontello-doc-add'></i> Create Payment </a>
                                        </div>
                                                
                                        <div class="columns large-12 inventory-table hidden">

                                        
                                            <p class="purple-heading" style="text-align:center">Selected Inventory </p>
                                            
                                                <table class="table">
                                                    <tr>
                                                        <td>Name</td>
                                                        <td>Project</td>
                                                        <td>Type</td>
                                                        <td>Size</td>
                                                        <td>Floor</td>
                                                        <td>Code</td>
                                                        
                                                    </tr>
                                                    <tr>
                                                   
                                                    <td><h5 class="inventory_name"> </h5>  </td>
                                                    <td><span class="inventory_project"></span></td>
                                                    <td><span class="inventory_type"></span></td>
                                                    <td><span class="inventory_size"></span></td>
                                                    <td><span class="inventory_floor"></span>th</td>
                                                    <td><span class="inventory_code"></span></td>
                                                    </tr>

                                                </table>


                                                <div class="row">
                                                    <div class="columns large-12 results hidden">
                                                            <h2 class="custom-heading">Provisional Payment Plan</h2>
                                                            <h3 class="centered-text">Total Pricing Plan: <span class="total_value"></span></h3>
                                                            <h6 >Number of Installments: <span class="number_of_insatllemt"></span></h6>
                                                            <h6 >Down Payment: <span class="down_payment"></span></h6>
                                                            <h6 class="printedx">Print: <a style="font-size:12px" id="downloadPdf" href="#" class="button tiny bg-light-green radius"><i class="fontello-download"></i></a></h6>
                                                            <table id="installmentTable" class="table table-striped table-bordered display inventory-table dataTable no-footer" style="width:100%">
                                                                <thead>
                                                                    <th>Number of Months</th>
                                                                    <th>Payment Description</th>
                                                                    <th>Due Date</th>
                                                                    <th>Amount</th>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                        </div>
                                            
                                    
                                    </div>

                        
                                </div>
                               

                </div>
            </div>
                            
                            <br>
                            
                           
                           
                       
                            <!-- <a href="#" class="button tiny bg-dark-blue radius"><i class="fontello-wifi"></i></a> -->

                              
                                 
                            </div>    
                        </div>
                    </div>

                    <!-- End of Box -->

                    <div id="firstModal" class="reveal-modal open" data-reveal="" >
                            <?php include 'includes/inventory-form.php'; ?>

                        </div>
                        
                    



                </div>
                <!-- End of Container Begin -->









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

    function formatNumber(event) {
        const inputField = event.target;
        const value = inputField.value.replace(/,/g, ''); // Remove existing commas
        if (!isNaN(value) && value !== '') {
            inputField.value = parseFloat(value).toLocaleString('en-US');
        }
    }

    // Attach the 'oninput' event listener to all text fields with the class 'formattedNumber'
    document.querySelectorAll('.formattedNumber').forEach(inputField => {
        inputField.addEventListener('input', formatNumber);
    });



    $(document).ready(function () {

        setTimeout(function () {
                $('#toggle').click();
            }, 3000);
            
            
            
    $("#inventoryForm").submit(function (event) {
            event.preventDefault();

            const formData = $(this).serialize();

            $.ajax({
                url: 'Inventory/InventoryController.php',
                method: 'POST',
                data: formData,
                success: function (response) {
                   
                    
                    const result = JSON.parse(response);
                    console.log(result.message);
                    alert(result.message);
                    setTimeout(function () {
                       window.location.reload();
                    }, 1000);
                    
                    // Refresh the table
                    // resetForm();     // Reset the form
                },
                error: function () {
                    alert("Failed to process the request.");
                }
            });
        });
// -----------------------------------Printing code-----------------
    $('#printButton').on('click', function (event) {
        event.preventDefault(); // Prevent default button behavior
        // const styles = $('style, link[rel="stylesheet"]').map(function () {
        //     return this.outerHTML; // Get all style tags and linked stylesheets
        // }).get().join('\n');
        const hideElementsCSS = `
            <style>
                .payment-btn, .booking-btn, .printedx {
                    display: none !important;
                }
                    table tr.even, table tr.alt, table tr:nth-of-type(even) {
        background: #f9f9f9 !important;
    }
        .custom-heading{
        
        font-weight:500;
        text-align: center;
        background-color: #008cba !important;
        color: #ffffff !important;
        margin-top: 50px !important;
        padding: 11px !important;

    }
        table tr th, table tr td {
                    font-size: 12px !important; 
                        text-align: center;
                        line-height:7px !important;
                }
                        table thead tr th, table tfoot tr th, table tfoot tr td, table tbody tr th, table tbody tr td, table tr td{
                        line-height:7px !important;
                        }
                        table thead {
                            background: whitesmoke !important;
                        }
            </style>
        `;

        const printContent = $('.contentToPrint').html(); // Get the content of the div
        const printWindow = window.open('', '', 'width=800,height=600'); // Open a new window
        printWindow.document.write(`
            <html>
                <head>
                    <title>Provisional Payment Plan</title>
                    <link rel="stylesheet" href="http://localhost/paystream/css/style.css"> 
                    <link rel="stylesheet" href="http://localhost/paystream/css/foundation.css"> 
                    <link rel="stylesheet" href="http://localhost/paystream/css/theme.css"> 
                    <link rel="preconnect" href="https://fonts.googleapis.com">
                    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                
                    ${hideElementsCSS}
                </head>
                <body>${printContent}</body>
            </html>
        `);

        printWindow.document.close(); // Close the document
        printWindow.focus(); // Focus on the new window
        printWindow.print(); // Trigger the print dialog

        // Delay closing the window until the print dialog is complete
        setTimeout(() => {
            printWindow.close(); // Close the print window after a short delay
        }, 500); // Adjust delay if needed
    });

// -----------------------------------Printing code end-----------------



// _____________________________________AJAX from html table to db table______________________________

 
    $('.payment-btn').on('click', function () {

        const inventoryId = $('.selected_inv_id').val();
        const customerId = $('.selected_cus_id').val();       
        //         $.ajax({
        //         url: `Inventory/InventoryController.php?id=${inventoryId}&cusid=${customerId}&action=assign_customer&status=booked`,
        //         method: "GET",
        //         success: function (response) {
        //             $('.booking-btn').hide('slow');
        //             const result = typeof response === "string" ? JSON.parse(response) : response;
        //             showResponse(result.message,'success');
        //         },
        //         error: function (response) {
        //             $('.booking-btn').show('slow');
        //             // Display an error message in case of failure
        //             showResponse(result.message,'error');
        //         }
        //         });
        //         $('html, body').animate({
        //             scrollTop:0 // Scroll down 200 pixels from the current position
        //         }, 1000);



        const tableData = [];
        $('#installmentTable tbody tr').each(function () {

            let installmentNo = parseInt($(this).find('td:eq(0)').text());
        if (isNaN(installmentNo)) {
            installmentNo = 0; // Default value if not a number
        }

        // Extract and reformat Due_Date
        let dueDate = $(this).find('td:eq(2)').text();
      
            const row = {
                Installment_No: parseInt($(this).find('td:eq(0)').text()),
                Payment_Description: $(this).find('td:eq(1)').text(),
                Due_Date: $(this).find('td:eq(2)').text(),
                Due_Amt: parseFloat($(this).find('td:eq(3)').text().replace(/,/g, '')),
                Receipt_Amt: 0,
                OS_Amt: parseFloat($(this).find('td:eq(3)').text().replace(/,/g, '')),
                Discount_Amt: 0,
                Inventory_id: 1 // Replace with dynamic value if applicable
            };
            
            tableData.push(row);
        });
        console.log(tableData);

        // Send data to server using AJAX
        $.ajax({
            url: 'Payment/PaymentController.php', // Replace with your API endpoint
            type: 'POST',
            data: { 
                payments: tableData,
                inventoryId: inventoryId,
                customerId: customerId
             },
             
            dataType: 'json',
            success: function (response) {
                // $('.result-box').show('fast');
                
                $('html, body').animate({
                    scrollTop:0 // Scroll down 200 pixels from the current position
                }, 1000);
                if (response.status === 'success') {
                    // $("#result").html(response.message);
                    window.location.href = window.location.origin + "/ajmair/inventory-payment?id="+inventoryId;
                    //showResponse(response.message,'success');
                    // alert('Payments saved successfully!');
                } else {
                    showResponse(response.message,'error');
                    
                     $("#result").html('Error: ' + response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
                alert('An error occurred while saving payments.');
            }
        });
    });
    //

    <?php
    // Contiains the function that render alert
    include('includes/alert-js.php');
    ?>

// _____________________________________________________________________________________

        const formId = '#installmentForm';

        // Load form data from local storage
        const storedFormData = localStorage.getItem('installmentFormData');
        if (storedFormData) {
            const formData = JSON.parse(storedFormData);
            for (const key in formData) {
                $(`${formId} [name="${key}"]`).val(formData[key]);
                $(`${formId} [id="${key}"]`).val(formData[key]);
            }
        }

        // Save form data to local storage on input
        $(formId).on('input change', function () {
            const formData = {};
            $(this)
                .find('input, select, textarea')
                .each(function () {
                    formData[$(this).attr('name') || $(this).attr('id')] = $(this).val();
                });
            localStorage.setItem('installmentFormData', JSON.stringify(formData));
        });

        // Reset form and clear local storage
        $('#resetForm').on('click', function () {
            $(formId)[0].reset(); // Reset the form fields
            localStorage.removeItem('installmentFormData'); // Clear stored form data
        });
       
        function parseFormattedNumber(value) {
            return parseFloat(value.replace(/,/g, '')); // Remove commas and parse to float
        }


// ---------------------------------------------------------------
        $('#installmentForm').on('submit', function(event) {
        
        
        var grand_total = 0;
        event.preventDefault(); // Prevent the form from submitting normally
        // debugger;
        // Get form values
        //
        debugger;
        $('.results').show('fast');
       
        const installment_amount = parseFormattedNumber($('#installment_amount').val());
        const downPayment = parseFormattedNumber($('#down_payment').val());
        var last_payment = parseFormattedNumber($('#last_payment').val());
        var processing_fee = parseFormattedNumber($('#processing_fee').val());
        var balloting_fee = parseFormattedNumber($('#balloting_fee').val());
        var balloon_fee = parseFormattedNumber($('#balloon_fee').val());

        var numberOfInstallments = parseInt($('#number_installments').val());
        const startDate = new Date($('#start_date').val());
        const intervalMonths = parseFloat($('#interval_month').val());
        const intervalAmount = parseFormattedNumber($('#interval').val());
        
        
        if (!(numberOfInstallments % intervalMonths === 0)) {
                // $('.total_value').text(`${num1} is not completely divisible by ${num2}.`);
                $('#interval_month').focus();
                alert('Wrong Invterval selected, number should be fully dividing the '+numberOfInstallments+' Installments');
                return;
             
        }

        if(!$('#lastpaymentcheckbox').is(':checked')){
            last_payment = 0;
            lastmonth = 0;
        }
        else{
            lastmonth = 1;
        }
        if(!$('#processingcheckbox').is(':checked')){
            processing_fee = 0;
        }
        if(!$('#ballotingecheckbox').is(':checked')){
            balloting_fee = 0;
        }
        if(!$('#balloonecheckbox').is(':checked')){
            balloon_fee = 0;
        }

        
        var interval_instalment =(numberOfInstallments/ intervalMonths); // 4
        var install_months = (numberOfInstallments-interval_instalment).toFixed(0);
        var interval_total_amount = intervalAmount * interval_instalment;
        console.log(interval_total_amount);
        // const totalPrice = parseFormattedNumber($('#total_price').val());
        // const remainingAmount = totalPrice - (downPayment + processing_fee + last_payment + interval_total_amount + balloting_fee + balloon_fee);
        // Calculate the regular installment amount
        // const installmentAmount = remainingAmount / (install_months);

        const installmentAmount = installment_amount;

        // Clear previous results
        const tableBody = $('#installmentTable tbody');
        tableBody.empty();

        // Generate installment dates and amounts
        for (let i = 0; i < numberOfInstallments; i++) {
            payment_details = 'Installment';
            const installmentDate = new Date(startDate);
            installmentDate.setMonth(startDate.getMonth() + i); // Increment month

            // Determine the installment amount
            let currentInstallmentAmount = installmentAmount;

            
            // Check if this is an interval month
            if ((i + 1) % intervalMonths === 0) {
                payment_details = 'Every '+intervalMonths+' Month Installment';
                currentInstallmentAmount = intervalAmount; // Add interval amount
            }

            grand_total = grand_total+currentInstallmentAmount;

            // Create a new row
            const newRow = `<tr>
                <td>${i+1}</td>
                <td>${payment_details}</td>
                <td>${installmentDate.toLocaleDateString()}</td>
                <td>${currentInstallmentAmount.toLocaleString()}</td>
            </tr>`;
            tableBody.append(newRow);
            $date = installmentDate.toLocaleDateString();
        }

        $('html, body').animate({ scrollTop: 400 }, 'slow');


        // Display down payment
        const downPaymentRow = `<tr>
            <td>-</td>
            <td>Down payment</td>
            <td>${startDate.toLocaleDateString()}</td>
            <td>${downPayment.toLocaleString()}</td>
        </tr>`;
            grand_total = grand_total+downPayment;
            tableBody.prepend(downPaymentRow); // Add down payment row at the top
        
        // Display Ballon Payment
        const ballotingPaymentRow = `<tr>
            <td>-</td>
            <td>Balloting payment</td>
            <td>${startDate.toLocaleDateString()}</td>
            <td>${balloting_fee.toLocaleString()}</td>
        </tr>`;
        if($('#ballotingecheckbox').is(':checked')){
            grand_total = grand_total+balloting_fee;
            tableBody.prepend(ballotingPaymentRow); // Add down payment row at the top
        }
        
        const ballonPaymentRow = `<tr>
            <td>0</td>
            <td>Balloon Payment</td>
            <td>${startDate.toLocaleDateString()}</td>
            <td>${balloon_fee.toLocaleString()}</td>
        </tr>`;
        if($('#ballotingecheckbox').is(':checked')){
            grand_total = grand_total+balloon_fee;
            tableBody.prepend(ballonPaymentRow); // Add down payment row at the top
        }

 
 
        const processingFeeRow = `<tr>
            <td>0</td>
            <td>Processing Fee</td>
            <td>${startDate.toLocaleDateString()}</td>
            <td>${processing_fee.toLocaleString()}</td>
        </tr>`;
        
        if($('#processingcheckbox').is(':checked')){
            grand_total = grand_total+processing_fee;
            tableBody.prepend(processingFeeRow.toLocaleString());  
        }


        const lastpaymentRow = `<tr>
            <td>0</td>
            <td>Last Payment </td>
            <td>${$date}</td>
            <td>${last_payment.toLocaleString()}</td>
        </tr>`;
        
        if($('#lastpaymentcheckbox').is(':checked')){
            grand_total = grand_total+last_payment;
            tableBody.append(lastpaymentRow.toLocaleString());  
        }

        console.log('Grand Total '+ grand_total);
        $('.total_value').text(grand_total.toLocaleString());
        $('.number_of_insatllemt').text(numberOfInstallments.toLocaleString());
        $('.down_payment').text(downPayment.toLocaleString());

    });
  

          
        
        $('.booking-btn').click(function(){

            const inventoryId = $('.selected_inv_id').val();
            const customerId = $('.selected_cus_id').val();

            // Check if they are empty
            if (!inventoryId || !customerId) {
                alert('Customer or Inventory Selection is missing');
            } else {
                const url = `Inventory/InventoryController.php?id=${inventoryId}&cusid=${customerId}&action=assign_customer`;
                $.ajax({
                url: url,
                method: "GET",
                success: function (response) {
                    $('.booking-btn').hide('slow');
                    const result = typeof response === "string" ? JSON.parse(response) : response;
                    showResponse(result.message,'success');
                },
                error: function (response) {
                    $('.booking-btn').show('slow');
                    // Display an error message in case of failure
                    showResponse(result.message,'error');
                }
                });
                $('html, body').animate({
                    scrollTop:0 // Scroll down 200 pixels from the current position
                }, 1000);
            }

           

// Send AJAX GET request
            
        });
  
        $('#customerInput').on('input', function() {
                var selectedName = $(this).val();
                var selectedOption = $('#customers option').filter(function() {
                    return this.value === selectedName;
                });
                if (selectedOption.length) {
                    var photoPath = selectedOption.data('photo');
                    var name = selectedOption.data('name');
                    var customer_id = selectedOption.data('id');
                    $('.selected_cus_id').val(customer_id);
                    var fname = selectedOption.data('fname');
                    var idcard = selectedOption.data('id-card');
                    $('.payment-box').show();
                    $('.selectedinventory').show();
                    $('.user_data').show('fast');
                    $('.user_name').text(name);
                    $('.fname').text(fname);
                    $('.idcard').text(idcard);
                    $('#user_profile_pic').attr('src', photoPath).show();
                    $('html, body').animate({
                    scrollTop: $(window).scrollTop() + 500 // Scroll down 200 pixels from the current position
                }, 1000);
                } else {
                    $('.selected_cus_id').val('');
                    $('.user_data').hide('fast');
                    $('#user_profile_pic').hide();
                    $('.payment-box').hide();
                    $('.selectedinventory').hide();
                    
                    
                }
            });
           
            $('#inventoryInput').on('input', function() {
                //
                var selectedName = $(this).val();
                var selectedOption = $('#inventory option').filter(function() {
                    return this.value === selectedName;
                });

                if (selectedOption.length) {
                    $('.selectedinventory').show('fast');
                    $('.installment-form').show('fast');
                    
                    $('.inventory-table').show('fast');
                    
                    var code = selectedOption.data('code');
                    var inv_id = selectedOption.data('id');
                    $('.selected_inv_id').val(inv_id);
                    var size = selectedOption.data('size');
                    var floor = selectedOption.data('floor');
                    var type = selectedOption.data('type');
                    var project = selectedOption.data('project');
                    $('.inventory_name').text(selectedName);
                    $('.inventory_code').text(code);   
                    $('.inventory_floor').text(floor); 
                    $('.inventory_type').text(type); 
                    $('.inventory_project').text(project); 
                    $('.inventory_size').text(size); 

                $('.payment-btn').show('fast');
                $('html, body').animate({
                    scrollTop: $(window).scrollTop() + 800 // Scroll down 200 pixels from the current position
                }, 1000);

                }else{
                    $('.selected_inv_id').val('');
                    $('.selectedinventory').hide('fast');
                    $('.payment-btn').hide('fast');
                }


                
               
            });
      
    });
</script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.icon-menu').click();
        });
        //
    (function($) {
        "use strict";
        $('.inventory-table').dataTable({
            "order": [
                [3, "desc"]
            ]
        });
    })(jQuery);



    (function($) {
        "use strict";
        $('#footable-res2').footable().bind('footable_filtering', function(e) {
            var selected = $('.filter-status').find(':selected').text();
            if (selected && selected.length > 0) {
                e.filter += (e.filter && e.filter.length > 0) ? ' ' + selected : selected;
                e.clear = !e.filter;
            }
        });

        $('.clear-filter').click(function(e) {
            e.preventDefault();
            $('.filter-status').val('');
            $('table.demo').trigger('footable_clear_filter');
        });

        $('.filter-status').change(function(e) {
            e.preventDefault();
            $('table.demo').trigger('footable_filter', {
                filter: $('#filter').val()
            });
        });

        $('.filter-api').click(function(e) {
            e.preventDefault();

            //get the footable filter object
            var footableFilter = $('table').data('footable-filter');

            // alert('about to filter table by "tech"');
            //filter by 'tech'
            footableFilter.filter('tech');

            //clear the filter
            if (confirm('clear filter now?')) {
                footableFilter.clearFilter();
            }
        });
    })(jQuery);
    </script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
    document.getElementById('downloadPdf').addEventListener('click', () => {
        const element = document.querySelector('.contentToPrint');

        html2canvas(element, {
            scale: 2, // Higher scale for better quality
            useCORS: true,
        }).then((canvas) => {
            const imgData = canvas.toDataURL('image/jpeg', 1);

            // Initialize jsPDF
            const pdf = new jspdf.jsPDF('p', 'mm', 'a4');
            const imgWidth = 210; // A4 width in mm
            const pageHeight = 297; // A4 height in mm
            const imgHeight = (canvas.height * imgWidth) / canvas.width;

            let position = 0;
            let y = 0; // Y position for the image

            while (position < imgHeight) {
                pdf.addImage(imgData, 'JPEG', 0, y, imgWidth, imgHeight);

                position += pageHeight; // Move to the next page
                if (position < imgHeight) {
                    pdf.addPage();
                    y = -pageHeight; // Reset Y position for the next page
                }
            }

            pdf.save('Provisional_Payment_Plan.pdf');
        });
    });
</script>





    <script>
    $(document).foundation();
    </script>



</body>

</html>
