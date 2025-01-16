<?php 
include('header.php');

?>
<?php

require_once 'Payment/PaymentController.php';
require_once 'Receipts/ReceiptsController.php';
$controller = new PaymentController();
$controller2 = new ReceiptsController();
$payments = $controller->display_for_dashboard();
$receipts = $controller2->display_receipts_for_Graph();

// echo'<pre>';
// print_r($receipts);
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

                <!-- Container Begin -->

                <div class="row" style="margin-top:-20px">
                  
                <div class="box">
                            <div class="box-header bg-transparent">
                                <!-- tools box -->
                                <div class="pull-right box-tools">

                                    <span class="box-btn" data-widget="collapse"><i class="icon-minus"></i>
                                    </span>
                                    <span class="box-btn" data-widget="remove"><i class="icon-cross"></i>
                                    </span>
                                </div>
                                <h3 style="margin-bottom:20px;" class="box-title">
                                    <span>Payment Forcast</span>
                                </h3>
                                
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body " style="display: block;">
                                <div class="row">
                                    <div class="columns large-10">
                                    <div id="line-chart" style="height: 235px;"></div>
                                    </div>
                                </div>
                               


                
                <div class="row dashboardtablePrint">
                  




                    <div class="columns large-12">
                    <h6 class="printedx">
                                                                    <a style="font-size:12px" id="printButton" href="#" class="button radius tiny">
                                                                        <i class="fontello-print"></i> Print
                                                                    </a>
                                                                    <a href="#" id="downloadButton" class="button tiny radius">
                                                                        <i class="fontello-download"></i> Download
                                                                    </a>
                    </h6>

                      <!-- Dashboard dataset -->
                      <?php 
                    include('includes/dashboard-top.php');
                    
                    ?>
                    <!-- Dataset end here -->

                    <?php
                    echo '<table id="dashboardtable" class="table table-striped table-bordered display inventory-table dataTable no-footer" style="width:100%">';
                    echo '<thead>
                            <tr>
                                <th style="width:20%">Inv Details</th>
                                <th>Customer Detail</th>
                                <th>Total Amount</th>
                                <th>Total Receipt Amount</th>
                                <th>Total OV Amount</th>
                                <th>Overdue Count</th>
                                <th>Percentage Received</th>
                            </tr>
                        </thead>';
                    echo '<tbody>';

                    foreach ($payments as $payment) {
                        $photo_path = $payment['customer_photo'];
                        if ($payment['total_due_amt'] != 0) {
                            $percentage_paid = round(($payment['total_receipt_amt']/ $payment['total_due_amt'])*100);}else{$percentage = 0;
                            }
                        if ($payment['overdue_count'] != 0 or $payment['total_due_amt'] != 0) {
                            $overdue_count = $payment['overdue_count']-2;
                            }else{
                                $overdue_count = 0;  
                            }    
                             
                        
                        echo '<tr>';
                        
                        // Combine Inv ID, Inv Details, Size, InvCode, Type, and Status into one <td>
                        echo '<td >'
                            . '<a href="inventory-payment?id=' . htmlspecialchars($payment['inventory_id']) . '">'
                            . 'Inv ID: ' . htmlspecialchars($payment['inventory_id']) . '</a><br>'
                            . 'Details: ' . htmlspecialchars($payment['inventory_name']) . '<br>'
                            . 'Size: ' . htmlspecialchars($payment['size']) . '<br>'
                            . 'Code: <a href="inventory-payment?id=' . htmlspecialchars($payment['inventory_id']) . '">' 
                            . htmlspecialchars($payment['code']) . '</a><br>'
                            . 'Type: ' . strtoupper(htmlspecialchars($payment['type'])) . '<br>'
                            . 'Project: ' . strtoupper(htmlspecialchars($payment['project'])) . '<br>'
                            . 'Floor: ' . strtoupper(htmlspecialchars($payment['floor'])) . '<br>'
                            . 'Booking Date: ' . strtoupper(htmlspecialchars($payment['booking_date'])) . '<br>'
                            . '<span class="statusx ' . htmlspecialchars($payment['status']) . '">'
                            . 'Status: ' . strtoupper(htmlspecialchars($payment['status'])) . '</span>'
                            . '</td>';
                        

                        
                        
                        // Customer Detail
                        echo '<td title="Customer ID: ' . htmlspecialchars($payment['customer_id']) . '">'
                            . '<img src="' . htmlspecialchars($photo_path) . '" class="chat-pic round-pic-small" alt="Customer Image" /><br>'
                            . '<a href="customer-edit?id=' . htmlspecialchars($payment['customer_id']) . '">' 
                            . htmlspecialchars($payment['customer_name']) . '</a><br>'
                            . '<small><a href="mailto:' . htmlspecialchars($payment['customer_email']) . '">' 
                            . htmlspecialchars($payment['customer_email']) . '</a></small><br>'
                            . '<small><a href="https://wa.me/' . htmlspecialchars($payment['customer_phone']) . '" target="_blank">' 
                            . htmlspecialchars($payment['customer_phone']) . '</a></small>'
                            . '</td>';
                        
                        // Total Amount
                        echo '<td>' . htmlspecialchars(number_format($payment['total_due_amt'])) . '</td>';
                        
                        // Total Receipt Amount
                        echo '<td>' . htmlspecialchars(number_format($payment['total_receipt_amt'])) . '</td>';
                        
                        // Total Overdue Amount
                        echo '<td>' . htmlspecialchars(number_format($payment['total_overdue_amt'])) . '</td>';
                        
                        // Overdue Count
                        echo '<td>' . htmlspecialchars($overdue_count ) . '</td>';
                        echo'<td>';
                        ?>
                            <div class="circlestat" 
                                                                data-dimension="80" 
                                                                data-text="<?php echo $percentage_paid; ?>%" 
                                                                data-width="8" 
                                                                data-fontsize="12" 
                                                                data-percent="<?php echo $percentage_paid; ?>" 
                                                                data-fgcolor="#008cba" 
                                                                data-border="3" 
                                                                data-bgcolor="#f0f0f0" 
                                                                data-fill="#FFF">
                                                            </div>
                        <?php
                        echo '</td>';
                        echo '</tr>';
                    }
                    

                    echo '</tbody>';
                    echo '</table>';
                    ?>



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
 function setCreateMode() {
        // Remove the hidden ID field if it exists
        $('#inventoryForm input[name="id"]').remove();
    }




    $(document).ready(function () {
        // setTimeout(function () {
        //         $('#toggle').click();
        //     }, 3000); 
    <?php
    // Contiains the function that render alert
    // include('includes/alert-js.php');
    ?>

$('#printButton').on('click', function (event) {
        event.preventDefault(); // Prevent default button behavior
        // const styles = $('style, link[rel="stylesheet"]').map(function () {
        //     return this.outerHTML; // Get all style tags and linked stylesheets
        // }).get().join('\n');
        const hideElementsCSS = `
            <style>
            body{
           background: #ffffff;
            }
           a{
           text-decoration:none;
           }
                .rec-button,.not-for-print,#printButton,.circle-text,.dataTables_length,lable,input{
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
                
    .client-logo{
    position:absolute;
    top:50%;
    left:50%;
    opacity:0.2;
    }         
    .counterdiv{
        display:none;
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
        border-right: 1px solid #f7f7f7;
        border-bottom: 1px solid #f7f7f7;
        
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

        const printContent = $('.dashboardtablePrint').html(); // Get the content of the div
        const printWindow = window.open('', '', 'width=1400,height=600'); // Open a new window
        printWindow.document.write(`
            <html>
                <head>
                    <title>All Payments Report</title>
                      
                    <link rel="stylesheet" href="https://vebvay.com/paystream/css/dashboard.css"> 
                    <link rel="stylesheet" href="https://vebvay.com/paystream/css/style.css"> 
                 
                    <link rel="stylesheet" href="https://vebvay.com/paystream/css/theme.css"> 
                    <link rel="preconnect" href="https://fonts.googleapis.com">
                    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                    <link rel="stylesheet" href="https://vebvay.com/paystream/css/foundation.css"> 
                
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

<script src="js/flot/jquery.flot.js" type="text/javascript"></script>

<script type="text/javascript">
    $(function() {
        "use strict";


        /*
         * LINE CHART
         * ----------
         */
        //LINE randomly generated data
        var phpArray = <?= json_encode($receipts); ?>;
        var flotData = phpArray.map(function (item) {
        var date = new Date(item.date);
        var count = item.count;

        var day = date.getDate(); // Numeric day of the month
        var month = date.toLocaleString('default', { month: 'short' }); // "Jan", "Feb", etc.
        var year = date.getFullYear(); // Full year
        var formattedDate = `${month} ${day}, ${year}`; // Format the date for labels

        return { day: day, count: count, formattedDate: formattedDate, amount: parseFloat(item.amount) };
    });

        // Separate datasets for amount and count
        var amountData = flotData.map((item, index) => [index + 1, item.amount]); // X-axis: index, Y-axis: amount
        var countData = flotData.map((item, index) => [index + 1, item.count]);  // X-axis: index, Y-axis: count
        var xAxisLabels = flotData.map(item => item.formattedDate); // For the X-axis labels

        //[{ label: "Amount", data: flotData }]

        $.plot("#line-chart",  [
    { label: "", data: amountData, color: "#333333" }// Second Y-axis
], 
    {   
            grid: {
                hoverable: true,
                clickable: true,
                borderColor: "#E2E6EE",
                borderWidth: 1,
                tickColor: "#E2E6EE"
            },
            series: {
                shadowSize: 0,
                lines: {
                    show: true
                },
                points: {
                    show: true
                }
            },
            colors: ["#333333", "#cccccc"],
            lines: {
                fill: true,
            },
            yaxes: [
        {   // First Y-axis (for amount)
            tickDecimals: 2,
            tickFormatter: function (val) {
                return val.toLocaleString() + ' RS'; // Format as currency
            }
        }
    ],
    xaxis: {
        show: true,
        tickDecimals: 0,
        ticks: xAxisLabels.map((label, index) => [index + 1, label]), // Show formattedDate as labels
        tickLength: 0 // Hide tick lines
    }
        });
        //Initialize tooltip on hover
        $("<div class='tooltip-inner' id='line-chart-tooltip'></div>").css({
            position: "absolute",
            background: "#333333",
            padding: "3px 10px",
            color: "#ffffff",
            display: "none",
            opacity: 0.9
        }).appendTo("body");
        $("#line-chart").bind("plothover", function(event, pos, item) {

            if (item) {
                var x = item.datapoint[0].toFixed(2),
                    y = item.datapoint[1].toFixed(2);

                $("#line-chart-tooltip").html(item.series.label + " of " + x + " = " + y)
                    .css({
                        top: item.pageY + 5,
                        left: item.pageX + 5
                    })
                    .fadeIn(200);
            } else {
                $("#line-chart-tooltip").hide();
            }

        });
        /* END LINE CHART */

       
        /* END AREA CHART */

    });

    /*
     * Custom Label formatter
     * ----------------------
     */
    function labelFormatter(label, series) {
        return "<div style='font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
    }
    </script>



    <script>
    $(document).foundation();
    </script>



</body>

</html>
