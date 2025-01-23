<?php 
include('header.php');

?>
<?php
require_once 'Payment/PaymentController.php';
require_once 'Receipts/ReceiptsController.php';
$controller = new PaymentController();
$controller2 = new ReceiptsController();
// Fetch payments from the controller

$receipts = $controller2->display_receipts_for_Graph();


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
                               </div> 
                               </div>
                               </div>  


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
                                    <span>All Inventories</span>
                                    
                                </h3>
                                
                                
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body " style="display: block;">
                                <div class="row">
                                    <div class="columns large-12">
                                    <h3 class="mb-4"><i class=" fontello-commerical-building " style="font-size:43px"></i>All Payments</h3>
                                    </div>

                                    <div class="columns large-12 ">.
                                    <a href="#" id="downloadButton" class="button tiny radius">
                                                                        <i class="fontello-download"></i> Download
                                                                    </a>
<!-- ----------------------------------------------------------------Section to display stats -->

<?php 
$payments = $controller->displayAllPaymentsWithReceipts();

$totalDueAmt = 0;
$totalReceiptAmt = 0;
$totalOsAmt = 0;
foreach ($payments as $item) {
    $totalDueAmt += isset($item['Due_Amt']) ? floatval($item['Due_Amt']) : 0;
    $totalReceiptAmt += isset($item['Receipt_Amt']) ? floatval($item['Receipt_Amt']) : 0;
    $totalOsAmt += isset($item['os_amt']) ? floatval($item['os_amt']) : 0;
}


?>
                                                                <div class="row not-for-print ">
                                                                        <div class="columns large-4 small-4">
                                                                            <div class="summary-nest">
                                                                                <h2 class="text-black total_value"><span class="counter-up-fast"><?php echo number_format($totalDueAmt, 0) ?></span><small>PKR</small></h2>
                                                                                <p>Total Amount</p>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <!--  -->
                                                                        <div class="columns large-4 small-4 summary-border-left">
                                                                            <div class="summary-nest">
                                                                                <h2 class="text-black total_value"><span class="counter-up"><?php echo number_format($totalOsAmt, 0) ?></span><small>PKR</small></h2>
                                                                                <p>Total Outstanding</p>
                                                                            </div>
                                                                        </div>
                                                                        <!--  -->
                                                                        <div class="columns large-4  small-4 summary-border-left">
                                                                            <div class="summary-nest">
                                                                                <h2 class="text-black total_value"><span class="counter-up mint"><?php echo number_format($totalReceiptAmt, 0) ?></span><small>PKR</small></h2>
                                                                                <p class="mint">Total Received</p>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    
                                                                        
                                                                    </div>
                                                                 

<!-- ----------------------------------------------------------------Section to display stats -->


                                    <table class="table table-striped table-bordered display payment-table dataTable no-footer ">
        <thead>
            <tr>
                <th>Payment ID</th>
                <th>Customer Name</th>
                <th>Payment Description</th>
                <!-- <th>Installment No</th> -->
                <th> Date</th>
                <th>Due Amount</th>
                <th>Remaining Amount</th>
                <th>Receipt Amount</th>
                <th>Receipts</th>
                <th>Issue By</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch payments with receipts
            
            //             echo"<pre>";
            // print_r($payments);
            // die;//total_receipt_amount
            // $paymentsWithTotalReceipts = [];
            foreach ($payments as $payment) {

                // Payment details
                echo "<tr>";
                echo "<td><a href='receipt-view?id=" . $payment['payment_id'] . "'>" . $payment['payment_id'] . "</a></td>";
                echo "<td><a href='receipt-view?id=" . $payment['payment_id'] . "'>" . $payment['customer_name'] . "</a></td>";
                echo "<td><a href='receipt-view?id=" . $payment['payment_id'] . "'>" . $payment['Payment_Description'] . "</a></td>";
                // echo "<td>" . $payment['Installment_No'] . "</td>";
                echo "<td>" . $payment['Due_Date'] . "</td>";
                echo "<td>" . number_format($payment['Due_Amt']) . "</td>";
                echo "<td>" . number_format($payment['os_amt']) . "</td>";
                echo "<td style='color: #00b265;font-weight: 800;'>" . number_format($payment['Receipt_Amt']) . "</td>";

                // List associated receipts
                echo "<td>";
                if (isset($payment['receipt_id'])) {
                    echo "<ul>";
                    echo "<li>Receipt ID: " . $payment['receipt_id'] . "</li>";
                    echo "<li>Date: " . $payment['receipt_date'] . "</li>";
                    if ($payment['receipt_file']) {
                        echo "<li><a download href='" . $payment['receipt_file'] . "' target='_blank'>View File</a></li>";
                    }
                    echo "</ul>";
                } else {
                    echo "No receipts available";
                }
                echo "</td>";
                echo"<td>".$payment['issue_by']."</td>";

                echo "</tr>";

                
            }
            ?>
        </tbody>
    </table>

 





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

    <script src="js/flot/jquery.flot.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.icon-menu').click();
        });
        //
    (function($) {
        "use strict";
        $('.payment-table').dataTable({
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
