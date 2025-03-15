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
       font-size: 20px;
        line-height: 40px;
        text-align: justify;
    
    }
    .bg-grayx{
        background: none !important;
    }
    .down{
        top: 50px !important;
    }
    .footer-down{
        position: relative;
        bottom: -210px;
    }
    .contentToPrint{

        background-color: #f5f5f5;
    }
    .issue{
        background-color: #2f323a;
    color: #c6c6c6;
    padding: 5px;
    float: right;
    font-size: 12px;
    font-style: normal;
}
#inventoryTable{
    border-radius: 5px !important;

    box-shadow:0 2px 2px 0 rgba(0, 0, 0, 0.16), 0 2px 0px 0 rgba(0, 0, 0, 0.12) !important;
    background-color: transparent;
    text-align: center;
    margin-top: 40px;
}
table thead, th, td{
    background: transparent !important;
    text-align: center;
}
tbody{
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
}
th,td{
    border: 0px !important;
    text-align: center !important;
    border-right: 1px solid gray !important;
}
td{padding: 20px !important;
font-size: 20px !important;}

    
    .pagingx {
    height: 50px; /* Adjust this to set the desired space */
    /* Optionally, add margin if needed */
    margin-top: 20px; /* Adds space above */
    margin-bottom: 20px; /* Adds space below */
}
@media screen and (max-width: 1020px) {

        .pagingx{
            height: 0px !important;
        }
        .size{
            width: 120px !important;
        }
        .contex{
            line-height: 30px !important;
        }
        .qr-img{
            bottom: -135px !important;
        }
        .footer-down {
    
    bottom: -136px;
}

    }
</style>
<?php

// Define the URL for the action




require_once 'Payment/PaymentController.php';
$controller = new PaymentController();
$payments = $controller->get_payment_with_receipt($_GET['id']);

//  die;
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
            <ul class="breadcrumbs ">
                                <?php

                                 if (isset($payments[1])) {

                                    foreach ($payments as $index => $payment) {
                                      
                                        $number = $index+1;
                                        echo "<li><a class='' href='?id={$_GET['id']}&index={$index}'><span class='fontello-popup'></span>Receipt {$number}</a></li>";
                                        
                                    }
                                }
                                if(!isset($_GET['index']))
                                {
                                    $index = 0;
                                }else{
                                    $index = $_GET['index'];
                                    $formatter = new NumberFormatter('en', NumberFormatter::SPELLOUT);
                                    $numberInWords = $formatter->format($payments[$index]['amount']);
                                    $payments[$index]['receive_mount_in_words']=strtoupper($numberInWords);

                                }
                                
                                ?>
            </ul>
            <!-- end of breadcrumbs -->

        <!-- ---------------------------------------------- -->
       
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
                                <a  class="button tiny radius" id="downloadPdf"><i class="fontello-download"></i>Download as PDF</a>
                                <a target="_blank" href="https://wa.me/<?= $payments[0]['customer_phone'] ?>?text=Aoa," class="button tiny radius bg-green "><i class="fontello-forward"></i> Share</a>
                            <!-- debug block only when the dev parameter is set in the URL -->
                                <?php
                                    if (isset($_GET['dev'])) {
                                        echo "<pre><code>";
                                        print_r($payments);
                                        echo "</code></pre>";
                                    }
                                ?>
                                <!-- ---------------------------- -->
                                    
                                
                </div>

                
            <div class="row contentToPrint">
                <div class="columns large-9 small-12 medium-12 large-centered medium-centered small-centered bg-grayx">
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
                                    <div class="columns large-2 medium-4 small-6">
                                        <img  src="img/client-logo-2.png" class="size" >
                                    </div>
                                    <div class="columns large-2 medium-4 small-6 right">
                                        <img src="img/bahria-town-logo.png" class="size" >
                                    </div>
                                   
                                </div>

                                <div class="row">
                                <div class="columns large-3 medium-6 small-6 right" style="margin-top: 52px;">
                                        <div>
                                  
                                        </div>
                                        
                                        <img src="https://paystream.pk/ajmair/includes/barcode3/example/html/image.php?filetype=PNG&dpi=72&scale=2.2&rotation=0&font_family=Nunito-Medium.ttf&font_size=12&thickness=20&checksum=&code=BCGcode39&text=<?=trim($_GET['id'])?>"/>
                                        <div id="payment-id-div">
                                            
                                        </div>

                                         
                                        
                                    </div>
                                </div>
                            </div>  
                            <div class="paging"><br><br></div>
                            <!-- ----------------------First Check the Type of Payment Biyana full payment or conditional payment  -->
                             <?php
                             $payments[$index]['Due_Date'] = date("Y-m-d", strtotime(($payments[$index]['Due_Date'])));
                             if(!empty($payments[$index]['ref_cheq_no'])){
                                $refrence =' with reference <span class="highlight"> ('.$payments[$index]['ref_cheq_no'].')</span>';
                             }else{
                                $refrence = '';
                             }
                              
                             $biyanah = False; 
                             if($payments[$index]['token_type']=='conditional-token'){
                                $biyanah = False; 
                                // [token_type] => conditional-token
                                
                                    echo'<h1 class="nunito bolder center-text">Conditional Token Payment Receipt</h1>';
                                    $pType = 'Conditional Token';
                             }elseif($payments[$index]['token_type']=='confirm-token'){
                                    echo'<h1 class="nunito bolder center-text">Confirmed Token Payment Receipt</h1>';
                                    $pType = 'Confirmed Token';
                            }elseif($payments[$index]['token_type']=='full-payment'){
                                    echo'<h1 class="nunito bolder center-text">Full Payment Receipt</h1>';
                                    $pType = 'Full Payment';
                                
                            }else{
                                    echo'<h1 class="nunito bolder center-text"> Payment Confirmation Receipt</h1>';
                                    $pType = '';
                            }
                           
                             
                             ?>
                            

                            <!-- ----------------------------------------- -->
                            <div class="row line-h">
                                <div class="columns large-11 medium-11 small-11 large-centered  medium-centered small-centered" style="margin-top: 10px;">
                                    <!-- if Os_amount is not empty then it will be a partial payment -->
                                    <?php if (!empty($payments[$index]['os_amt']) && $payments[$index]['os_amt'] != 0) { ?> 
                                        <h3 class="weigh-normal contex">
                                            This is to acknowledge receipt of a <?= $pType ?> payment of  <span class="highlight">
                                            <?= $payments[$index]['receive_mount_in_words'] ?></span><span class="highlight">  (PKR <?= number_format($payments[$index]['amount'])?>) </span>
                                            from <span class="highlight"><?=strtoupper($payments[$index]['customer_name'])?></span> on <span class="highlight"><?= date("l, jS F Y", strtotime(($payments[$index]['created_at']))) ?></span>  with ID Card No:<span class="highlight"> <?=($payments[$index]['customer_id_card'])?></span> as part of the total payment of <span class="highlight"> <?=($payments[$index]['amount_in_words'])?></span> <span class="highlight">(Rs <?=($payments[0]['Due_Amt'])?>)</span>
                                            as payment for the purchase of <?= $payments[$index]['inventory_type']; ?> Number <span class="highlight underline"><?=   ($payments[0]['inventory_name'])?></span> Size <span class="highlight underline"><?=   ($payments[0]['inventory_size'])?></span> with Registration Number <span class="highlight underline"><?=   ($payments[0]['inventory_registration'])?></span>  located in <span class="highlight underline"><?=($payments[0]['inventory_floor'])?></span> through <span class="highlight"><?=strtoupper(($payments[$index]['method']))?> </span> <?= $refrence ?> on <span class="highlight"> <?=$payments[$index]['Due_Date']?></span>.
                                            <?php if (!empty($payments[$index]['biyanah']) && $payments[$index]['biyanah'] != 0) { ?>
                                            <hr>
                                            <div class="context">As per our mutual agreement Biyanah will be made on the <span class="highlight "> <?= date("l, jS F Y", strtotime($payments[0]['biyanah_date']));   ?></span> with an amount of <span class="highlight "><?=($payments[0]['biyanah_in_words'])?> (PKR <?= number_format($payments[$index]['biyanah'])?>)</span> </span> 
                                            and the remaining balance of <span class="highlight "><?= $payments[0]['remaining_mount_in_words'] ?></span><span class="highlight"> (PKR <?= number_format($payments[$index]['os_amt'])?>) </span> is yet to be paid on <span class="highlight"><?= date("l, jS F Y", strtotime($payments[0]['remaining_date'])) ?></span>.</div>
                                            <?php } ?>
                                        </h3>
                                    <?php }else{ ?>
                                    <h3 class="weigh-normal contex">
                                        This is to acknowledge receipt of an amount of <span class="highlight">
                                        <?= $payments[$index]['receive_mount_in_words'] ?></span><span class="highlight"> (PKR <?= number_format($payments[$index]['amount'])?>) </span>
                                        from <span class="highlight"><?=strtoupper($payments[$index]['customer_name'])?></span> on <span class="highlight"><?= date("l, jS F Y", strtotime(($payments[$index]['created_at']))) ?></span>  with ID Card No:<span class="highlight"> <?=($payments[$index]['customer_id_card'])?></span> 
                                        as payment for the purchase of <?= $payments[$index]['inventory_type']; ?> Number <span class="highlight underline"><?=($payments[0]['inventory_name'])?></span> Size <span class="highlight underline"><?=   ($payments[0]['inventory_size'])?></span> with Registration Number <span class="highlight underline"><?=   ($payments[0]['inventory_registration'])?></span>   located in <span class="highlight underline"><?=($payments[$index]['inventory_floor'])?></span> through <span class="highlight"><?=strtoupper(($payments[$index]['method']))?> </span> <?= $refrence ?> on <span class="highlight"> <?=$payments[$index]['Due_Date']?></span>.
                                    </h3>

                                    <img class="stamp right" src="img/receipt/fullpaid.png">
                                    <?php } ?>

                                    <table  id="inventoryTable" data-filter="#filter" class=" no-paging footable-loaded footable default demo inventory-table" style="width:100%">
                                        <thead>
                                            <th>Possession Payment</th>
                                            <th>Utilities Payment</th>
                                            <th>Corner Payment</th>
                                            <th>Extra Area Payment</th>
                                        </thead>
                                            <td>Paid</td>
                                            <td>Not Paid</td>
                                            <td>Not Paid</td>
                                            <td>Not Paid</td>
                                    </table>
                                     
                                </div>


                            </div>



                            <div class="row"></div>
                            <div class="pagingx">
                           
                            </div>
                            <div class="down" style="position: relative; display: flex; justify-content: center; align-items: center; height: 200px;">
                                <!-- QR Code -->
                                <img class="qr-img" src="includes/qr-code-receipt.php?id=<?=trim($_GET['id']);?>">
                            </div>

                            <!-- Footer Note -->
                             <?php 
                             if(!empty($payments[$index]['note'])){
                             ?>
                            <blockquote class="footer-note footer-down" style="position: relative;">
                                NOTE: <?= htmlspecialchars($payments[$index]['note'], ENT_QUOTES, 'UTF-8') ?>
                                <hr>
                                <span class="issue">Issued By <?=($payments[$index]['issue_by'])?> | <?=($payments[$index]['reqested_by'])?> </span> 
                              
                            </blockquote>

                            <?php

                             }else{
                                ?>

                            <span class="issue">Issued By <?=($payments[$index]['issue_by'])?> | <?=($payments[$index]['reqested_by'])?> </span> 
                              
                            <?php 
                            }
                            ?>
                         
                


                                
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        document.getElementById('downloadPdf').addEventListener('click', () => {
    // Select the content to convert to PDF
    const element = document.querySelector('.contentToPrint');

    // Use html2canvas to render the element to a canvas
    html2canvas(element, {
        scale: 2, // Reduce scale to decrease image resolution (adjust as needed)
        useCORS: true,
    }).then((canvas) => {
        // Convert the canvas to a compressed JPEG image
        const imgData = canvas.toDataURL('image/jpeg', 0.7); // Use 'jpeg' format and adjust quality (0.1 to 1)

        // Initialize jsPDF
        const pdf = new jspdf.jsPDF('p', 'mm', 'a4');
        const imgWidth = 210; // A4 width in mm
        const pageHeight = 297; // A4 height in mm
        const imgHeight = (canvas.height * imgWidth) / canvas.width;

        // Add the compressed image to the PDF
        let position = 0;
        pdf.addImage(imgData, 'JPEG', 0, position, imgWidth, imgHeight);

        // Save the PDF
        pdf.save('receipt-'+<?=trim($_GET['id']);?>+'.pdf');
    });
});
    </script>



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
          font-family: "Nunito", serif !important;
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
        font-family:font-family: "Nunito", serif !important;
    }
        .size{
        width: 90px !important;
        }
        
         .footer-note {
        position: fixed;
        bottom:0;
        left: 0;
        width: 100%;
        background-color: white; /* Ensures footer visibility in print */
        text-align: center;
        font-size: 12px;
        padding: 10px;
        color: #333;
        border-top: 1px solid #ece9e9;
        
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
        position: fixed !important;
        bottom:0;
        left: 0;
        width: 100%;
        background-color: white !important; /* Ensures footer visibility in print */
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
    .down{
        top: 0px !important;
    }
    .footer-down{
     
        
    }
    .background {
    margin-top: 20px !important;
    background: none !important;
    background-image: url(img/receipt/reciptbg2.png) !important;
    background-repeat: no-repeat !important;
    background-size: cover !important;
    background-position: center !important;
    height: 2013px;
}


        
    }
            </style>
        `;

        const printContent = $('.contentToPrint').html(); // Get the content of the div
        const printWindow = window.open('', '', 'width=1600,height=2000'); // Open a new window
        const currentUrl = window.location.href;
        const url = new URL(currentUrl);
        const pathSegments = url.pathname.split('/').filter(segment => segment !== '');
        const baseUrl = `${url.protocol}//${url.host}/${pathSegments[0]}`;
        
        printWindow.document.write(`
            <html>
                <head>
                    <title>Payment</title>
                    <link rel="stylesheet" href="${baseUrl}/css/dashboard.css"> 
                    <link rel="stylesheet" href="${baseUrl}/css/dashboard.css"> 
                    <link rel="stylesheet" href="${baseUrl}/css/style.css"> 
                    <link rel="stylesheet" href="${baseUrl}/css/theme.css"> 
                      <link rel="stylesheet" href="${baseUrl}/css/foundation.css">

                  
                    <link rel="preconnect" href="https://fonts.googleapis.com">
                    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
                
                    ${hideElementsCSS}
                </head>
                <body>${printContent}</body>
            </html>
        `);
        console.log(baseUrl);
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
