<?php 
include('header.php');

?>
<?php

// Define the URL for the action


//Inventory/InventoryController.php?action=view_all

require_once 'Payment/PaymentController.php';
$controller = new PaymentController();
$payments = $controller->get_payment_with_customer($_GET['id']);
// echo'<pre>';
// print_r($payments);
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

                <!-- Receipt Form which will display on button click -->
                     <!-- Reveal Modals begin -->
                    <div id="firstModal" class="reveal-modal" data-reveal>
                       
                                    <?php include('includes/Receipt/receipt-form.php'); ?>
                                                    <a class="close-reveal-modal">&#215;</a>
                    </div>


                <!-- -----------------Receipt Form End-------------------------------- -->

                <!-- Container Begin -->
                <div class="row">
                <div class="columns large-12 small-12 medium-12   selectedinventory  contentToPrint" style="display: block;">
                                            
                                                    
                                            <div class="columns large-12 inventory-table " style="display: block;">
    
                                                            <?php
                                                                if (empty($payments['totals']['total_due_amt']) && empty($payments['totals']['total_receipt_amt'])) {
                                                                    echo"<br><br><br><br><h1>Payment Not Exist for this Inventory!</h1>
                                                                    <a class='button' href='payment-new'>Create Payment</a>
                                                                    ";
                                                                    
                                                        
                                                           }else{
                                                    ?>
                                                
                                                    <?php
                                                                        $total_due_amt = $payments['totals']['total_due_amt'];
                                                                        $total_receipt_amt = $payments['totals']['total_receipt_amt'];
                                                                        $outstanding = $total_due_amt - $total_receipt_amt;
                                                                        if ($total_due_amt != 0) {
                                                                        $percentage = round(($total_receipt_amt/ $total_due_amt)*100);}else{$percentage = 0;}
                                                    ?>
                                                    
                                                    
                                                  
                                                    
                                                      
                                                        <div class="row background-white contentToPrint" >

                                                        <!-- Customer -->
                                                        <div class="columns large-12  " style="text-align: center;">
                                                <img id="user_profile_pic" src="<?php echo $payments[0]['customer_photo']; ?>" alt="Profile Picture" style="display: inline-block;">
                                                
                                                <h5 class="user_name purple-heading"><?php echo $payments[0]['customer_name']; ?></h5>
                                                <span class="fname"><?php echo $payments[0]['customer_father']; ?></span><br>
                                                    <span class="idcard"><?php echo $payments[0]['customer_idCard']; ?></span><br>
                                                    <div class="row">
                                                    <img class="qr" src="qr-code.php"/>
                                                    </div>
                                                    
                                                    <br>
                                                    <!-- <a class="tiny button booking-btn">Reserve Inventory </a>  -->
                                                    <!-- <a class="tiny button bg-light-green payment-btn" style="">Create Payment </a> -->
                                            </div>
                                                        <!-- Customer -->


                                                        <!-- Inventory -->
                                                    <div class="row">
                                                        <div class="column large-12" style="display: flex; justify-content: space-between; align-items: center;">
                                                            <!-- Left Column -->

                                                            <div>
                                                                <h6 class="printedx">
                                                                    <a style="font-size:12px" id="printButton" href="#" class="button tiny radius">
                                                                        <i class="fontello-print"></i> Print
                                                                    </a>
                                                                    <a href="#" onclick="downloadTableAsExcel()" id="downloadButton" class="button tiny radius">
                                                                        <i class="fontello-download"></i> Download
                                                                    </a>
                                                                </h6>
                                                            </div>
                                                           

                                                            <!-- Right Column -->
                                                            <div class="circlestat" 
                                                                data-dimension="140" 
                                                                data-text="<?php echo $percentage; ?>% Received" 
                                                                data-width="8" 
                                                                data-fontsize="12" 
                                                                data-percent="<?php echo $percentage; ?>" 
                                                                data-fgcolor="#008cba" 
                                                                data-border="3" 
                                                                data-bgcolor="#f0f0f0" 
                                                                data-fill="#FFF">
                                                            </div>    
                                                        </div>
                                                    </div>

                                                       
                                                            <p class="purple-heading" style="">Selected Inventory </p>
                                                        <table class="table">
                                                    <tbody><tr>
                                                        <td>Name</td>
                                                        <td>Project</td>
                                                        <td>Type</td>
                                                        <td>Size</td>
                                                        <td>Floor</td>
                                                        <td>Code</td>
                                                        
                                                    </tr>
                                                    <?php 
                                                    //  
                                                    
                                                    ?>
                                                    <tr>  
                                                    <td><h5 class="inventory_name">fc-230</h5>  </td>
                                                    <td><span class="inventory_project">pearl-one</span></td>
                                                    <td><span class="inventory_type">apartment</span></td>
                                                    <td><span class="inventory_size">150</span></td>
                                                    <td><span class="inventory_floor">3</span>th</td>
                                                    <td><span class="inventory_code">FC-ABS-001</span></td>
                                                    </tr>
                                                    <?php
                                                        // 
                                                    ?>        
                                                </tbody></table>
                                                
                                                        <!-- Inventory -->
                                                        <h2 class="custom-heading">Payment Plan</h2>
                                                        <div class="custom-box">
                                                            <div class="columns large-12 results " style="display: block;">
                                                                            <?php  include('includes/print_payment.php');?>
                                                            </div>
                                                            <div class="columns large-12 results " style="display: block;">
                                                                    
                                                                    
                                                                    <div class="row not-for-print ">
                                                                        <div class="columns large-4 small-4">
                                                                            <div class="summary-nest">
                                                                                <h2 class="text-black total_value"><span class="counter-up-fast"><?php echo number_format($total_due_amt); ?></span><small>PKR</small></h2>
                                                                                <p>Total Price</p>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <!--  -->
                                                                        <div class="columns large-4 small-4 summary-border-left">
                                                                            <div class="summary-nest">
                                                                                <h2 class="text-black total_value"><span class="counter-up"><?php echo number_format($outstanding); ?></span><small>PKR</small></h2>
                                                                                <p>Total Outstanding</p>
                                                                            </div>
                                                                        </div>
                                                                        <!--  -->
                                                                        <div class="columns large-4  small-4 summary-border-left">
                                                                            <div class="summary-nest">
                                                                                <h2 class="text-black total_value"><span class="counter-up mint"><?php echo number_format($total_receipt_amt); ?></span><small>PKR</small></h2>
                                                                                <p class="mint">Total Received</p>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    
                                                                        
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row not-for-print ">
                                                                    <div class="columns large-4 small-4 counterdiv">
                                                                            <div class="summary-nest">
                                                                                <?php  $filtered_payments = array_filter($payments, function ($payment) {return isset($payment['Receipt_Amt']) && $payment['Receipt_Amt'] > 0;});$rec_count = count($filtered_payments); ?>
                                                                                    <h2 class="text-black total_value"><span class="counter-up-fast"><?php echo count($filtered_payments); ?></span><small></small></h2>
                                                                                    <p class="">  Number of Paid Installments </p>
                                                                               
                                                                                
                                                                               
                                                                            </div>
                                                                        </div>

                                                                        <div class="columns large-4 small-4 summary-border-left">
                                                                           
                                                                            <div class="summary-nest">
                                                                                <?php  $inst_count  = max(array_column($payments, 'Installment_No')); ?>
                                                                            <h2 class="text-black total_value"><span class="counter-up-fast"><?php echo $inst_count; ?></span><small></small></h2>
                                                                            <p class=""> Total Installments </p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="columns large-4  small-4 summary-border-left carriot">
                                                                            <div class="summary-nest">
                                                                            <h2 class="text-black total_value"><span class=" carriot toverdue"></span><small>PKR</small></h2>
                                                                                <p class=""> Total Over Due Amount </p>
                                                                            </div>
                                                                        </div>

                                                                        
                                                                    </div>
                                                                    <hr>
                                                                    
                                                                    
                                                                    <!-- <h6>Number of Installments: <span class="number_of_insatllemt">18</span></h6>
                                                                    <h6>Down Payment: <span class="down_payment">1000000</span></h6> -->
                                                                    
                                                                    <table id="installmentTable" class="table table-striped table-bordered display inventory-table dataTable no-footer" style="width:100%">
                                                                        <thead>
                                                                            <th class="descx" style="width: 30%;">Payment Description</th>
                                                                            <th style="width: 5%;">Inst.NO</th>
                                                                            <th style="width: 20%;">Due Date</th>
                                                                            <th title="Received AMOUNT" style="width: 20%;">Received AMT</th>
                                                                            <th title="OUTSTANDING AMOUNT" style="width: 20%;">OS AMT</th>
                                                                            <th  title="OV DUE AMOUNT" style="width: 30%;">OV Due AMT</th>
                                                                            <th>Payment Status</th>
                                                                            <th>Receiving</th>
                                                                            <th>Receipt Date</th>
                                                                            <th>Ref/Cheq No </th>
                                                                            <th>Option</th>
                                                                            
                                                                        </tr></thead>
                    
                                                                        <tbody>
                    
                                                                        <tr>
                                                                            <?php if (!empty($payments)) { 
                                                                            $total_due = 0;
                                                                              
                                                                            ?>

                                                                            <?php    foreach ($payments as $payment) { if (isset($payment['Payment_Description'])) {
                                                                                     $payment_due_date_u = $payment['due_date_u'];
                                                                                     $id=$payment['due_date_u']; 
                                                                                     
                                                                                     $due = 0;
                                                                                     $clas='';
                                                                                     $status='';
                                                                                     date_default_timezone_set('Asia/Karachi');
                                                                                    if($payment['os_amt']<='0'){
                                                                                        $class='hidden';
                                                                                        $status = '<span class="statusx booked"> <i class="text-white fontello-ok"></i>PAID </span>';
                                                                                    }elseif($payment['Receipt_Amt']=='0'){
                                                                                        $class='';
                                                                                        $status = '<span class="statusx available">UNPAID</span>';
                                                                                    }else{
                                                                                        $class='';
                                                                                        $status = '<span class="statusx partial">PARTIAL</span>';

                                                                                    }

                                                                                    //  -------------- Calculating Overdue amount----------- 
                                                                                     if (time() > (int)$payment['due_date_u'] and $payment['os_amt']>0) { 
                                                                                        $clas = 'outstanding'; 
                                                                                        $due = $payment['os_amt'];
                                                                                       
                                                                                        $total_due = $due+$total_due; 
                                                                                        // echo"<tr>$total_due<br></tr>";
                                                                                    }
                                                                                    //  ----------------------------------------------------
                                                                                     echo"<tr title='{$id}' class='{$clas}'>";?>
                                                                        <td><?php echo $payment['Payment_Description']; ?></td>                                                            
                                                                        <td><?php echo $payment['Installment_No']; ?></td>
                                                                        <td><?php echo $payment['Due_Date']; ?></td>
                                                                        <td><?php echo number_format($payment['Receipt_Amt']); ?></td>
                                                                        <td><?php echo number_format($payment['os_amt']); ?></td>
                                                                        <td><?php echo number_format($due); ?>  </td>
                                                                        <td><?php echo $status; ?></td>  
                                                                        <?php
                                                                            if (!empty($payment['receipts'])) {
                                                                                // Decode receipts as a valid JSON array
                                                                                $receipts = json_decode("[" . $payment['receipts'] . "]", true);

                                                                                // Check if there are any receipts with a valid 'amount'
                                                                                $validReceipts = array_filter($receipts, function ($receipt) {
                                                                                    return isset($receipt['amount']) && !is_null($receipt['amount']);
                                                                                });

                                                                                echo '<td colspan="3">';
                                                                                if (!empty($validReceipts)) {
                                                                                    // Display the receipts table within the cell
                                                                                    echo '<table class="subtable" border="1" style="border-collapse: collapse; width: 100%;">';
                                                                                    echo '<tbody>';
                                                                                    foreach ($validReceipts as $receipt) {
                                                                                        $formatted_date_time = $receipt['date'];
                                                                                        // if ($date_time_obj === false) {
                                                                                        //     // Handle parsing error, e.g., log error, provide fallback
                                                                                        //     $formatted_date_time = $receipt['date'];
                                                                                        // } else {
                                                                                        //     $date_time_obj = DateTime::createFromFormat("Y-m-d H:i:s.u", $receipt['date']);
                                                                                        //     $formatted_date_time = $date_time_obj->format("F d, Y at h:i A");
                                                                                        // }
                                                                                        
                                                                                        echo '<tr>';
                                                                                        
                                                                                        echo '<td style="font-size:9px"><a download href="' . ($receipt['file'] ?? '-') . '">' . number_format($receipt['amount'], 2) . '</a></td>';
                                                                                        echo '<td style="font-size: 9px;">' . ($formatted_date_time ?? '-') . '</td>';
                                                                                        echo '<td style="font-size: 9px;">' . ($receipt['receipt_id'] ?? '-') . '</td>';
                                                                                        echo '</tr>';
                                                                                    }
                                                                                    echo '</tbody>';
                                                                                    echo '</table>';
                                                                                } else {
                                                                                    // No valid receipts found
                                                                                    echo 'No receipts available';
                                                                                }
                                                                                echo '</td>';
                                                                            } else {
                                                                                // No receipts at all
                                                                                echo '<td>No receipts available</td>';
                                                                            }
                                                                            ?>

                                                                        
                                                                           
                                                                      
                                                                        <td style='text-align:center'><a class="tiny radius button bg-light-green rec-button new-payment-btn <?= $class ?>"data-amount="<?php echo $payment['os_amt']; ?>" data-id="<?php echo $payment['id']; ?>" data-reveal-id="firstModal"><i class="fontello-doc-add"></i> Receipt</a><small><?= $id; ?></small></td>
                                                                        
                                               
                                                                                    <?php echo'</tr>';
                                                                            }}}else{
                                                                                echo'<tr>No Payment Attatched</tr>';
                                                                            } ?> 
                                                                          
                                                                        </tbody>
                                                                    </table>
                                                                    <input type="hidden" id="toverdue" value="<?php echo $total_due;  ?>">
                                                            </div>
                                                        </div>
                                                    </div>    
    
                                            </div>
                                                
                                        
                                        </div>
                </div>
                <!-- End of Container Begin -->

                                                                        <?php } ?>







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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script>
function downloadTableAsExcel() {
    var mainTable = document.getElementById('installmentTable');
    var rows = mainTable.querySelectorAll('tr');
    var data = [];

    rows.forEach(row => {
        var rowData = [];
        var cols = row.querySelectorAll('th, td');

        cols.forEach(col => {
            // Check if the cell contains a subtable with the class "subtable"
            var subtable = col.querySelector('.subtable');
            if (subtable) {
                // Skip the cell containing a subtable by pushing an empty string
                rowData.push('');
            } else {
                // Otherwise, push the text content of the cell
                rowData.push(col.innerText.trim());
            }
        });

        data.push(rowData);
    });

    // Convert the data array to a worksheet
    var worksheet = XLSX.utils.aoa_to_sheet(data);

    // Create a new workbook and append the worksheet
    var workbook = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(workbook, worksheet, 'Sheet1');

    // Save the workbook to an Excel file
    XLSX.writeFile(workbook, 'table_without_subtable.xlsx');
}

</script>

    <script type='text/javascript' src="js/jquery.js"></script>
    <!-- main javascript library -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script>
    // Download as PDF
    $('#downloadButton').on('click', function (event) {
        event.preventDefault();
        const downloadContent = $('.contentToPrint').html();

        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        doc.html(downloadContent, {
            callback: function (doc) {
                doc.save('download.pdf');
            },
            x: 10,
            y: 10
        });
    });
</script> -->

   
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
 function setCreateMode() {
        // Remove the hidden ID field if it exists
        $('#inventoryForm input[name="id"]').remove();
    }
//     function formatNumber(event) {
//         const inputField = event.target;
//         const value = inputField.value.replace(/,/g, ''); // Remove existing commas
//         if (!isNaN(value) && value !== '') {
//             inputField.value = parseFloat(value).toLocaleString('en-US');
//         }
//     }


//  document.querySelectorAll('.formattedNumber').forEach(inputField => {
//         inputField.addEventListener('input', formatNumber);
//     });



    //
    $(document).on('click', '.rec-button', function (event) {
    event.preventDefault(); // Prevent any default behavior
    const paymentId = $(this).data('id'); // Get the data-id value
    const amnt = $(this).data('amount');
    $('.payment-id').val(paymentId); // Set it in the input field
    $('#amount').val(amnt);

    });


    $(document).ready(function () {
        setTimeout(function () {
                $('#toggle').click();
            }, 3000); 

        $('#photo').on('change', function () {
           
            const idCard = $('.idcard').text().trim();
            const idCardError = $('.id_card_error'); // Reference to the error container
            var preview = $('#PhotoPreview');
            var photoImg = $('#photoImg');
            var loader = $('#Photoloader');
            var text_field = $('#photoPath');
            var timestamp = new Date().getTime();
            var timestampString = timestamp.toString();
            var payment_id = $('.payment-id').val();
            var filename= timestampString + '_' + payment_id;
           
           
            
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
      


        $('#receiptForm').on('submit', function (e) {
                e.preventDefault();

                // Clear any previous response message
                $('#responseMessage').hide().removeClass('alert callout-success callout-warning');

                const formData = $(this).serialize();

                $.ajax({
                    url: 'Receipts/ReceiptsController.php', // Adjust the URL if necessary
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        try {
                            const res = JSON.parse(response);
                            if (res.success) {
                                $('#responseMessage')
                                    .addClass('callout-success')
                                    .html(res.message)
                                    .show();
                                $('#receiptForm')[0].reset(); // Reset the form
                                setTimeout(function () {
                                    location.reload();
                                }, 2000);
                            } else {
                                $('#responseMessage')
                                    .addClass('callout-warning')
                                    .html(res.message)
                                    .show();
                            }
                        } catch (e) {
                            $('#responseMessage')
                                .addClass('callout-warning')
                                .html('An error occurred while processing your request.')
                                .show();
                        }
                    },
                    error: function () {
                        $('#responseMessage')
                            .addClass('callout-warning')
                            .html('Failed to send the request. Please try again.')
                            .show();
                    }
                });
            });    
       

    $('.toverdue').text(formatNumber($('#toverdue').val()));
    $('.toverdue').addClass('counter-up-fast');

    function formatNumber(value) {
       return parseFloat(value).toLocaleString('en-US');
    }
    <?php
    // Contiains the function that render alert
    include('includes/alert-js.php');
    ?>

    // $('#downloadButton').on('click', function (event) {
    //     event.preventDefault();
    //      const downloadContent = $('.contentToPrint').html();

    // // Create a Blob object with the content
    // const blob = new Blob([downloadContent], { type: 'text/html' });

    // // Create a temporary anchor element
    // const link = document.createElement('a');
    // link.href = URL.createObjectURL(blob);
    // link.download = 'download.html';

    // // Trigger the download
    // link.click();

    // // Clean up the URL object
    // URL.revokeObjectURL(link.href);
    // });

    });
        
    // -----------------------------------Printing code-----------------
    $('#printButton').on('click', function (event) {
        event.preventDefault(); // Prevent default button behavior
        // const styles = $('style, link[rel="stylesheet"]').map(function () {
        //     return this.outerHTML; // Get all style tags and linked stylesheets
        // }).get().join('\n');
        const hideElementsCSS = `
            <style>
                .rec-button,.not-for-print,#printButton,.circle-text,hr{
                    display: none !important;
                }
                .for-print{
                    display:block !important;
                }
                .circle-text{
                    font-size: 19px !important;
                }
                h2{
                font-size:20px !important;
                }.descx{
                width:20% !important;}
                .summary-nest{
                
                border: 1px solidrgb(245, 245, 245);
                    }
    .client-logo{
    position:absolute;
    top:50%;
    left:50%;
    opacity:0.2;
    }         
    .counterdiv{
        display:none;
    }
        .background-image {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: url('img/client-logo.png'); /* Replace with your image URL */ 
  background-size: cover; 
  opacity: 0.2; 
  filter: blur(3px); /* Add a slight blur effect */
  z-index: -1; /* Place the background image behind the content */
}
  table,td{
  
    border-right: 1px solid #f0f0f0;
    border-bottom: 1px solid #f0f0f0;

  }
    .subtable table{
    dispaly:none;
    }
    .custom-heading{
        
        font-weight:500;
        text-align: center;
        background-color: #008cba !important;
        color: #ffffff !important;
        margin-top: 50px !important;
        padding: 11px !important;

    }
    table tr td {
        font-size: 12px;
        text-align: center;
        line-height:19px !important;
    }
    table thead tr th, table tfoot tr th, table tfoot tr td, table tbody tr th, table tbody tr td, table tr td{
        
        line-height:19px !important;
    }
    th{
        font-size: 10px !important;
        padding:5px;
    }
                        
.summary-nest h2 {
    margin: 0;
    text-align: center;

    font-weight: bold !important;
    color: #A8ADB8;
}
                        table thead {
                            background: whitesmoke !important;
                        }
            </style>
        `;

        const printContent = $('.contentToPrint').html(); // Get the content of the div
        const printWindow = window.open('', '', 'width=1400,height=600'); // Open a new window
        printWindow.document.write(`
            <html>
                <head>
                    <title>Payment</title>
                    
                    <link rel="stylesheet" href="https://vebvay.com/paystream/css/dashboard.css"> 
                    <link rel="stylesheet" href="https://vebvay.com/paystream/css/style.css"> 
                 
                    <link rel="stylesheet" href="https://vebvay.com/paystream/css/theme.css"> 
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
            // printWindow.close(); // Close the print window after a short delay
        }, 500); // Adjust delay if needed
    });

// -----------------------------------Printing code end-----------------


//______________________________________Document Ready Closed 
  
</script>

    <script type="text/javascript">
        $(document).ready(function () {
           
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

     
    })(jQuery);
    </script>




    <script>
   $(document).foundation();
    </script>



</body>

</html>
