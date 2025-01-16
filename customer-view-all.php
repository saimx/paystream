<?php 
include('header.php');

?>
<?php
// Define the URL for the action





require_once 'Customer/CustomerController.php';
$controller = new CustomerController();
$customers = $controller->viewAllCustomers();



?>


<?php

// Define the URL for the action



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
                                <h3 class="box-title"><i class="fontello-th-large-outline"></i>
                                    <span>All Customers</span>
                                </h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body " style="display: block;">

                         
                                <h4 class="mb-4">Customer's List</h4>

        <?php if (!empty($customers) && isset($customers[0]['id'])): ?>
            <table  id="customer-table" class="table table-striped table-bordered display" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                   
                        <th>Email</th>
                        <th>Phone</th>
                        <th>City</th>
                        <!-- <th>Address</th> -->
                        <th>Created At</th>
                        <th>Actions</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($customers as $customer): ?>
                        <tr>
                            <td><?= htmlspecialchars($customer['id']) ?></td>
                            <td><img src='<?= htmlspecialchars($customer['photo_path']) ?>' class="chat-pic round-pic-small" /><?= htmlspecialchars($customer['name']) ?><br><small><?= htmlspecialchars($customer['fname']) ?></small></td>
                          
                            <td>
                                <a class="" href="mailto:<?= htmlspecialchars($customer['email']) ?>"><i class=" icon-mail"></i> <?= htmlspecialchars($customer['email']) ?></a>
                            </td>
                            <td><a href="https://wa.me/<?= urlencode($customer['phone']) ?>" target="_blank"><span class="fontello-phone "></span><?= htmlspecialchars($customer['phone']) ?></a></td>
                            <td><?= htmlspecialchars($customer['city']) ?></td>
                            <!-- <td><?php //htmlspecialchars($customer['address']) ?></td> -->
                            <td><?= htmlspecialchars($customer['created_at']) ?></td>
                            
                            <td>
                                <!-- Action Buttons -->
                                <a   class="radius tiny btn bg-green customer-view" data-id="<?= htmlspecialchars($customer['id']) ?>" ><i class="fontello-search"></i> View</a>
                                <a   class="radius tiny btn bg-black"  href="customer-edit.php?id=<?= htmlspecialchars($customer['id']) ?>"><i class="fontello-edit"></i>Edit</a>
                                <a  class="radius tiny btn bg-red " href="CustomerController.php?action=delete_customer&id=<?= htmlspecialchars($customer['id']) ?>"  onclick="return confirm('Are you sure you want to delete this customer?');"><i class="fontello-trash"></i>Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-warning">No customers found.</div>
        <?php endif; ?>


                            </div>
                            <!-- end .timeline -->
                        </div>
                        <!-- box -->
                    </div>


                    




                    <div class="large-12 columns hidden inventory-of-customer">
                        <div class="box">
                            <div class="box-header bg-transparent">
                                <!-- tools box -->
                                <div class="pull-right box-tools">

                                    <span class="box-btn" data-widget="collapse"><i class="icon-minus"></i>
                                    </span>
                                    <span class="box-btn" data-widget="remove"><i class="icon-cross"></i>
                                    </span>
                                </div>
                                <h3 class="box-title"><i class="fontello-th-outline"></i>
                                    <span>Inventory of Customer </span>
                                </h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body " style="display: block;">
                                <div class="row" style="margin-bottom:10px;">
                                    <div class="large-4 columns">
                                        <input class="form-control" id="filter" placeholder="Search..." type="text" />
                                    </div>
                                    <div class="large-2 columns">
                                        <select class="filter-status form-control">
                                            <option value="active">Active</option>
                                            <option value="disabled">Disabled</option>
                                            <option value="suspended">Suspended</option>
                                        </select>
                                    </div>
                                    <div class="large-6 columns">

                                        <a href="#clear" style="margin-left:10px;" class="pull-right btn bg-red clear-filter" title="clear filter">clear</a>
                                        



                                    </div>

                                </div>

                                
                                <table id="inventoryTable" data-filter="#filter" class=" no-paging footable-loaded footable default demo inventory-table" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Size</th>
                    <th>Type</th>
                    <th>Project</th>
                    <th>Code</th>
                    <th>Booking Date</th>
                    <th>Status</th>
                    <th>Floor</th>
                  
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
            <tr><td colspan="10">No inventory found</td></tr>
            </tbody>
        </table>

                            </div></div>
                            <!-- end .timeline -->
                        </div>
                        <!-- box -->
                    </div>




                </div>
                <!-- End of Container Begin -->









                <?php 
                    require('includes/footer.php');
                ?>
            </div>










            <?php include('includes/right-menu.php'); ?>
            <!-- End of Right Menu -->
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
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('click', '.customer-view', function() {  
                id=$(this).data('id');
                // alert(id);
                $('.inventory-of-customer').show('fast');
                $('html, body').animate({
                    scrollTop: $(document).height()
                }, 800); // Adjust the duration (milliseconds) as needed
                //

                $.ajax({
                url: `Inventory/InventoryController.php?action=getInventorireisCustomer&customer_id=${id}`,
                method: 'GET',
                success: function (response) {
                    console.log(JSON.parse(response));
                    const inventory = JSON.parse(response);
                    debugger;
                    let tableHtml = `<table  class="table table-striped table-bordered display" style="width:100%">
                    <thead>
                    <tr>   
                        <th>ID</th>
                        <th>Name</th>
                        <th>Size</th>
                        <th>Type</th>
                        <th>Project</th>
                        <th>Code</th>
                        <th>Booking Date</th>
                        <th>Status</th>
                        <th>Floor</th>
                        <th>Actions</th>
                    </tr> </thead><tbody>`;
                    if (inventory.length === 0) {
                    tableHtml += `<tr><td colspan="10">No inventory found</td></tr>`;
                    } else {
                        inventory.forEach(item => {
                            tableHtml += `<tr>
                                <td><a href="inventory-payment?id=${item.inventory_id}">${item.inventory_id}</a></td>
                                <td><a href="inventory-payment?id=${item.inventory_id}">${item.inventory_name}</a></td>
                                <td>${item.size}</td>
                                <td>${item.type}</td>
                                <td>${item.project}</td>
                                <td>${item.code}</td>
                                <td>${item.booking_date}</td>
                                <td><span class="status-metro status-active">${item.status}</span></td>
                                <td>${item.floor}</td>
                                <td>
                                 
                                   <a href="inventory-payment?id=${item.inventory_id}">View</a>
                                    
                                </td>
                            </tr>`;
                            
                        });
                    }

                    tableHtml += `</tbody></table>`;
                    $("#inventoryTable").html(tableHtml);
                },
                error: function () {
                    alert("Failed to fetch inventory.");
                }
            });


            });

            $('.icon-menu').click();
        });
        //
    (function($) {
        "use strict";
        $('#customer-table').dataTable({
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
