<?php 
include('header.php');

?>
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
                                    <span>All Inventories</span>
                                </h3>
                                
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body " style="display: block;">
                                <div class="row">
                                    <div class="columns large-5">
                                    <h3 class="mb-4"><i class=" fontello-commerical-building " style="font-size:43px"></i>Inventory's List</h3>
                                    </div>

                                    <div class="columns large-5 right">
                                    <h3 styl="float:right">
                                    <a href="#" data-reveal-id="firstModal" class="button tiny success" onclick="setCreateMode()"><i class=" fontello-doc-add" style="font-size:20px"> </i>Create New Inventory</a> 
                                </h3>
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


    $(document).ready(function () {

    <?php
    // Contiains the function that render alert
    include('includes/alert-js.php');
    ?>


    });
    
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




    <script>
    $(document).foundation();
    </script>



</body>

</html>
