<?php 
include('header.php');

?>


<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
<style>

    .nunito{
        font-family: "Nunito", serif !important;
        
    }
    .bolder{
        font-weight: bolder;
    }
    .highlight{
        font-family: "Nunito", serif !important;
        font-weight: bolder;
        color: #000000;
    }
    .weigh-normal{
        font-weight: normal !important;
    }
    .underline{
        text-decoration: underline;
    }
    .center-text{
        text-align: center;
    }
    .line-h{
        line-height:60px
    }
    .contex{
        text-transform: none !important;
        line-height: 50px;

        text-align: justify;
    
    }
    .bg-grayx{
        background: none !important;
    }
    
</style>
<?php

// Define the URL for the action




require_once 'Payment/PaymentController.php';
$controller = new PaymentController();
$payments = $controller->get_payment_with_receipt($_GET['id']);
// echo"<pre>";
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

                <div class="box " style="padding:46px">
  <div class="pull-right box-tools">

                                    <span class="box-btn" data-widget="collapse"><i class="icon-minus"></i>
                                    </span>
                                    <span class="box-btn" data-widget="remove"><i class="icon-cross"></i>
                                    </span>
                                </div>
                                <a style="font-size:12px" id="printButton" href="#" class="button tiny radius"><i class="fontello-print"></i> Print</a>
                                <a href="" class="tiny radius button bg-green "><i class="fontello-print"></i> Share</a>
                </div>

                
            <div class="row contentToPrint">
                <div class="columns large-9 small-9 medium-9 large-centered medium-centered small-centered bg-grayx">
                <div class="box background " style="padding:46px">
                            <div class="box-header bg-transparent">
                                <!-- tools box -->
                                <!-- <div class="pull-right box-tools">

                                    <span class="box-btn" data-widget="collapse"><i class="icon-minus"></i>
                                    </span>
                                    <span class="box-btn" data-widget="remove"><i class="icon-cross"></i>
                                    </span>
                                </div> -->
                                <!-- <h3 class="box-title"><i class="fontello-th-large-outline"></i>
                                    <span>All Inventories</span>
                                </h3> -->
                                
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body " style="display: block;">
                                <div class="row">
                                    <div class="columns large-4 medium-4 small-4">
                                        <img  src="img/client-logo-2.png" class="small-4 size" >
                                    </div>
                                    <div class="columns large-4 medium-4 small-4 right">
                                        <img src="img/bahria-town-logo.png" class="small-4 size" >
                                    </div>
                                   
                                </div>

                                <div class="row">
                                <div class="columns large-3 medium-3 small-3 right" style="margin-top: 52px;">
                                        <div>
                                            <span class="payment-id"><?=$payments[0]['Due_Date']?></span>
                                        </div>
                                        <img src="includes/barcode.php?data=<?=trim($_GET['id']);?>"/>
                                        <div id="payment-id-div">
                                            <span class="payment-id"><?=trim($_GET['id']);?></span>
                                        </div>

                                         
                                        
                                    </div>
                                </div>
                            </div>  
                            <div class="paging"><br><br><br><br><br></div> 
                            <h1 class="nunito bolder center-text">Payment Receipt</h1>
                            <div class="row line-h">
                                <div class="columns large-11 medium-11 small-11 large-centered  medium-centered small-centered" style="margin-top: 10px;">
                                    <!-- if Os_amount is not empty then it will be a partial payment -->
                                    <?php if (!empty($payments[0]['os_amt']) && $payments[0]['os_amt'] != 0) { ?> 
                                        <h3 class="weigh-normal contex">
                                            This is to acknowledge receipt of a partial payment of  <span class="highlight">
                                            <?= $payments[0]['receive_mount_in_words'] ?></span><span class="highlight"> (PKR <?= number_format($payments[0]['Receipt_Amt'])?>) </span>
                                            from <span class="highlight"><?=strtoupper($payments[0]['customer_name'])?></span> with ID Card No:<span class="highlight"> <?=($payments[0]['customer_id_card'])?></span> as part of the total payment of <span class="highlight"> <?=($payments[0]['amount_in_words'])?></span> <span class="highlight">(Rs <?=($payments[0]['Due_Amt'])?>)</span>
                                            as payment for the purchase of <span class="highlight underline"><?=($payments[0]['inventory_name'])?></span> located in <span class="highlight underline"><?=($payments[0]['inventory_floor'])?></span> through <span class="highlight"><?=strtoupper(($payments[0]['method']))?> </span>with reference  
                                            <span class="highlight"><?=($payments[0]['ref_cheq_no'])?></span> on <span class="highlight"> <?=$payments[0]['Due_Date']?></span>.The remaining balance of <?= $payments[0]['remaining_mount_in_words'] ?></span><span class="highlight"> (PKR <?= number_format($payments[0]['os_amt'])?>) </span> is yet to be paid.
                                        </h3>
                                    <?php }else{ ?>
                                    <h3 class="weigh-normal contex">
                                        This is to acknowledge receipt of an amount of <span class="highlight">
                                        <?= $payments[0]['receive_mount_in_words'] ?></span><span class="highlight"> (PKR <?= number_format($payments[0]['Receipt_Amt'])?>) </span>
                                        from <span class="highlight"><?=strtoupper($payments[0]['customer_name'])?></span> with ID Card No:<span class="highlight"> <?=($payments[0]['customer_id_card'])?></span> 
                                        as payment for the purchase of <span class="highlight underline"><?=($payments[0]['inventory_name'])?></span> located in <span class="highlight underline"><?=($payments[0]['inventory_floor'])?></span> through <span class="highlight"><?=strtoupper(($payments[0]['method']))?> </span>with reference  
                                        <span class="highlight"><?=($payments[0]['ref_cheq_no'])?></span> on <span class="highlight"> <?=$payments[0]['Due_Date']?></span>.
                                    </h3>

                                    <img class="stamp right" src="img/receipt/fullpaid.png">
                                    <?php } ?>
                                     
                                </div>


                            </div>



                            <div class="row"></div>
                            <div class="paging">
                            <br><br><br><br><br>
                            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                            </div>
                            <div style="position: relative; display: flex; justify-content: center; align-items: center; height: 200px;">
                                <!-- QR Code -->
                                <img class="qr-img" src="includes/qr-code-receipt.php?id=<?=trim($_GET['id']);?>">
                            </div>

                            <!-- Footer Note -->
                            <blockquote class="footer-note">
                                NOTE: <?= htmlspecialchars($payments[0]['note'], ENT_QUOTES, 'UTF-8') ?>
                            </blockquote>
                


                                
                </div>
                <div class="paging">
                            <br><br><br><br><br>
                            <br><br><br><br><br>
                            <br><br><br><br><br></div>  
                             
                            
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


 
        
    // -----------------------------------Printing code-----------------
    $('#printButton').on('click', function (event) {
        event.preventDefault(); // Prevent default button behavior
        // const styles = $('style, link[rel="stylesheet"]').map(function () {
        //     return this.outerHTML; // Get all style tags and linked stylesheets
        // }).get().join('\n');
        const hideElementsCSS = `
            <style>
        .background{
        height:1000px !important;
        }
        h3{
        font-size:14px !important;
        }
           
        body{
          background: none !important;
        }
          .contentToPrint {
            background: #f5f5f5 !important; /* Make background transparent for content */
        }
    .box-body {
        position: relative; /* Ensures relative positioning for child elements */
    }

    .box-body .row {
        display: flex;
        justify-content: space-between; /* Ensures left and right alignment */
        align-items: center; /* Vertically centers the images */
    }

    .box-body img.size {
        max-width: 150px; /* Sets a consistent maximum width */
        height: auto; /* Maintains aspect ratio */
        object-fit: contain; /* Ensures the image fits within the box */
    }

    @media print {
        .box-body img.size {
            max-width: 100px; /* Reduce size for printing */
            height: auto; /* Maintain aspect ratio */
        }
    }
    .nunito{
        font-family: "Nunito", serif !important;
        
    }
        .paging{
        display:none;}
    .bolder{
        font-weight: bolder;
    }
    .highlight{
        font-family: "Nunito", serif !important;
        font-weight: bolder;
        color: #000000;
    }
    .weigh-normal{
        font-weight: normal !important;
    }
    .underline{
        text-decoration: underline;
    }
    .center-text{
        text-align: center;
    }
    .line-h{
        line-height:12px
    }
    .contex{
        text-transform: none !important;
        text-align: justify;
    }
        .size{
        width: 90px !important;
        }
        
        


    @media print {
        /* Prevent page breaks inside content */
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
        }
        .bg-grayx{
            background:#f5f5f5 !important;
        }

        .contentToPrint {
            page-break-before: always;
            page-break-after: always;
            page-break-inside: avoid;
            /* Define a fixed height to make sure everything fits */
            max-height: 100vh; /* Adjust based on your content */
        
        }

 
        .footer-note {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: white; /* Ensures footer visibility in print */
        text-align: center;
        font-size: 12px;
        padding: 10px;
        color: #333;
        border-top: 1px solid #ece9e9;
    }

        /* To ensure everything fits on one page */
        @page {
            size: A4; /* Set to A4 or another size that fits your content */
            margin: 0;
        }

        /* Optionally, you can scale content to fit one page */
        .contentToPrint {
            transform: scale(0.9); /* Adjust scale to fit */
            transform-origin: top;
        }

         .qr-section {
        position: fixed; /* Fix the position of the QR section */
        bottom: 0; /* Stick it to the bottom */
        left: 0;
        width: 100%; /* Make it span the width of the page */
        height: 200px; /* Keep the same height */
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: white; /* Optional: Ensure the background color is visible */
        }

        .qr-section div {
            top: 50%;
            transform: translateY(-50%);
        }

    .stamp {
    width: 180px;
    position: absolute;
    top: 550px;
    right: 0%;
    opacity: 0.9;
    z-index:1;
}


        
    }
            </style>
        `;

        const printContent = $('.contentToPrint').html(); // Get the content of the div
        const printWindow = window.open('', '', 'width=1600,height=2000'); // Open a new window
        const baseUrl = window.location.origin;
        printWindow.document.write(`
            <html>
                <head>
                    <title>Payment</title>
                    <link rel="stylesheet" href="${baseUrl}/paystream/css/dashboard.css"> 
                    <link rel="stylesheet" href="${baseUrl}/paystream/css/dashboard.css"> 
                    <link rel="stylesheet" href="${baseUrl}/paystream/css/style.css"> 
                    <link rel="stylesheet" href="${baseUrl}/paystream/css/theme.css"> 
                      <link rel="stylesheet" href="${baseUrl}/paystream/css/foundation.css">

                  
                    <link rel="preconnect" href="https://fonts.googleapis.com">
                    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
                
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



    <script>
   $(document).foundation();
    </script>



</body>

</html>
