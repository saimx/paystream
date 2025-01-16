<?php 
include('header.php');

?>
<?php

// Define the URL for the action

// define('SECURE_ACCESS', true);
// define('ROOT_PATH', __DIR__);
// require_once ROOT_PATH . '/config.php';

//Inventory/InventoryController.php?action=view_all

// require_once 'Payment/PaymentController.php';
// $controller = new PaymentController();
// $payments = $controller->get_payment_with_customer($_GET['id']);
 
?>
    <!-- End of preloader -->
 
    <script type='text/javascript' src='js/invoice/script.js'></script>
    <link rel='stylesheet' type='text/css' href='js/invoice/style-invoice.css' />

    <div class="off-canvas-wrap" data-offcanvas>
        <!-- right sidebar wrapper -->
        <div class="inner-wrap">
            <?php include('right-side.php') ?>

            <div class="wrap-fluid" id="paper-bg">
                <!-- top nav -->
                <?php include('top-nav.php') ?>
                <!-- end of top nav -->

                <!-- breadcrumbs -->
                <?php include('breadcrum.php') ?>
                <!-- end of breadcrumbs -->

                <!-- ---------------------------------------------- -->
                <?php include('includes/alert.php');?>
                <!-- ---------------------------------------------- -->

               

                <!-- Container Begin -->
                <div class="row" style="margin-top:-20px">



                    <div class="large-12 columns">
                        <div class="box">
                            <div class="box-header bg-transparent">
                                <!-- tools box -->
                                <div class="pull-right box-tools">

                                    <span class="box-btn" data-widget="collapse"><i class="icon-minus"></i>
                                    </span>
                                    <span class="box-btn" data-widget="remove"><i class="icon-cross"></i>
                                    </span>
                                </div>

                            </div>
                            <!-- /.box-header -->
                            <div class="box-body " style="display: block;">
                                <div class="large-12 columns">

                                    <article>


                                        <div class="row">

                                            <div class="medium-7 columns">


                                                <address contenteditable>

                                                    <strong>John Doe</strong>
                                                    <br>795 Folsom Ave, Suite 600
                                                    <br>San Francisco, CA 94107
                                                    <br>Phone: (555) 539-1037
                                                    <br>Email: <i>john.doe@example.com</i>

                                                </address>
                                            </div>


                                            <div class="medium-5 columns">
                                                <table class="meta">
                                                    <tr>
                                                        <th><span contenteditable>Invoice #</span>
                                                        </th>
                                                        <td><span contenteditable>101138</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th><span contenteditable>Date</span>
                                                        </th>
                                                        <td><span contenteditable>January 1, 2012</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th><span contenteditable>Amount Due</span>
                                                        </th>
                                                        <td><span id="prefix" contenteditable>$</span><span>600.00</span>
                                                        </td>
                                                    </tr>
                                                </table>

                                            </div>
                                        </div>
                                        <table class="inventory">
                                            <thead>
                                                <tr>
                                                    <th><span contenteditable>Item</span>
                                                    </th>
                                                    <th><span contenteditable>Description</span>
                                                    </th>
                                                    <th><span contenteditable>Rate</span>
                                                    </th>
                                                    <th><span contenteditable>Quantity</span>
                                                    </th>
                                                    <th><span contenteditable>Price</span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><a class="cut">x</a><span contenteditable>Front End Consultation</span>
                                                    </td>
                                                    <td><span contenteditable>Experience Review</span>
                                                    </td>
                                                    <td><span data-prefix>$</span><span contenteditable>150.00</span>
                                                    </td>
                                                    <td><span contenteditable>4</span>
                                                    </td>
                                                    <td><span data-prefix>$</span><span>600.00</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <a class="add">Add</a>
                                        <br>
                                        <div class="row">
                                            <!-- accepted payments column -->
                                            <div class="medium-7 columns">
                                                <p class="lead">Payment Methods:</p>
                                                <img src="./img/credit/visa.png" alt="Visa" />
                                                <img src="./img/credit/mastercard.png" alt="Mastercard" />
                                                <img src="./img/credit/american-express.png" alt="American Express" />
                                                <img src="./img/credit/paypal2.png" alt="Paypal" />
                                                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                                                </p>
                                            </div>
                                            <!-- /.col -->
                                            <div class="medium-5 columns">
                                                <table class="balance">
                                                    <tr>
                                                        <th><span contenteditable>Total</span>
                                                        </th>
                                                        <td><span data-prefix>$</span><span>600.00</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th><span contenteditable>Amount Paid</span>
                                                        </th>
                                                        <td><span data-prefix>$</span><span contenteditable>0.00</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th><span contenteditable>Balance Due</span>
                                                        </th>
                                                        <td><span data-prefix>$</span><span>600.00</span>
                                                        </td>
                                                    </tr>
                                                </table>

                                            </div>
                                            <!-- /.col -->
                                        </div>
                                    </article>
                                    <hr>
                                    <aside>
                                        <div contenteditable>
                                            <p>A finance charge of 1.5% will be made on unpaid balances after 30 days.</p>
                                        </div>
                                    </aside>

                                </div>
                                <div style="clear:both;"></div>




                            </div>
                            <!-- end .timeline -->


                        </div>
                        <!-- box -->
                    </div>
                </div>
                <!-- End of Container Begin -->










                <?php 
                    require('footer.php');
                ?>
            </div>










           <?php include('right-menu.php'); ?>


           
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








    <script>
    $(document).foundation();
    </script>



</body>

</html>
