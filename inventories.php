<?php 
include('header.php');

?>
<style>
    th{
        cursor: pointer;
    }
</style>
<?php




require_once 'Inventory/InventoryController.php';
$controller = new InventoryController();
$inventories = $controller->viewAllInventory( True); // with_customer=True Brings Customer along with Inventory
$inventories = json_decode($inventories, true);
// echo'<pre>';
// print_r($inventories);
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
                         
                                
                                

      
          

        <table class="table table-striped table-bordered display inventory-table" style="width:100%">
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
                    <th>Assigned Customer</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($inventories)) {
                    // Output data of each row
                    foreach ($inventories as $item) {
                        $id =$item['inventory_id'];
                        if($item['customer_name'] == ''){
                            $customer ='<span class="statusx ">-</span>';
                        }else{
                            $customer = $item['customer_name'];
                        }
                        echo "<tr>
                            <td><a href='inventory-payment?id={$id}'>{$item['inventory_id']}</a></td>
                            <td><a href='inventory-payment?id={$id}'>{$item['inventory_name']}</a></td>
                            <td>{$item['size']}</td>
                            <td>{$item['type']}</td>
                            <td>{$item['project']}</td>
                            <td>{$item['code']}</td>
                            <td>{$item['booking_date']}</td>
                            <td><span class='statusx {$item['status']}'>" . strtoupper($item['status']) . "</span></td>
                            <td>{$item['floor']}</td>
                            <td>{$customer}<br>
                                <small>{$item['customer_email']}</small><br>
                                <small>{$item['customer_phone']}</small>
                            </td>
                            <td>
                                <button class='tiny radius button bg-blue ' data-reveal-id='firstModal' onclick=\"editInventory({$item['inventory_id']})\"><i class='editicon icon-document-edit tooltipstered'></i> Edit</button>
                                <button class='tiny radius button bg-red' onclick=\"deleteInventory({$item['inventory_id']})\">Delete</button>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>No inventory found</td></tr>";
                }
                ?>
            </tbody>
        </table>
                     
                        
                        <div id="firstModal" class="reveal-modal open" data-reveal="" >
                            <?php include 'includes/inventory-form.php'; ?>

                        </div>
                        
            
       
            
        


                            </div>
                            <!-- end .timeline -->
                        </div>
                        <!-- box -->
                    </div>


                    

<div id="editForm" class="reveal-modal" data-reveal>

</div>


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
                                <h3 class="box-title"><i class="fontello-th-outline"></i>
                                    <span>FOOTABLE</span>
                                </h3>
                            </div>
                            <!-- /.box-header -->
                            
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
        setTimeout(function () {
                $('#toggle').click();
            }, 3000); 
        // Handle form submission
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

        // Load inventory data
        function loadInventory() {
            $.ajax({
                url: 'Inventory/InventoryController.php?action=view_all',
                method: 'GET',
                success: function (response) {
                    console.log(response);
                    const inventory = JSON.parse(response);
                    let tableHtml = `<table  id="footable-res2" data-filter="#filter" data-filter-text-only="true" class="table table-striped table-bordered display " style="width:100%">
                     <thead>
                     <tr>   
                        <th  data-toggle="true">ID</th>
                        <th  data-toggle="true">Name</th>
                        <th  data-toggle="true">Size</th>
                        <th  data-toggle="true">Type</th>
                        <th  data-toggle="true">Project</th>
                        <th  data-toggle="true">Code</th>
                        <th  data-toggle="true">Booking Date</th>
                        <th  data-toggle="true">Status</th>
                        <th data-toggle="true" >Floor</th>
                        <th  data-toggle="true">Actions</th>
                    </tr> </thead><tbody>`;

                    inventory.forEach(item => {
                        tableHtml += `<tr>
                            <td>${item.id}</td>
                            <td>${item.name}</td>
                            <td>${item.size}</td>
                            <td>${item.type}</td>
                            <td>${item.project}</td>
                            <td>${item.code}</td>
                            <td>${item.booking_date}</td>
                            <td>${item.status}</td>
                            <td>${item.floor}</td>
                            <td>
                                <button class='btn tiny'  onclick="editInventory(${item.id})">Edit</button>
                                <button class='btn tiny' onclick="deleteInventory(${item.id})">Delete</button>
                            </td>
                        </tr>`;
                    });

                    tableHtml += `</tbody></table>`;
                    $("#inventoryTable").html(tableHtml);
                },
                error: function () {
                    alert("Failed to fetch inventory.");
                }
            });
        }

        function setEditMode(id) {
            // Check if the hidden ID field exists
           
        }

// Function to clear the ID field for creating new inventory
   

        // Edit inventory
        window.editInventory = function (id) {
          
            if ($('#inventoryForm input[name="id"]').length === 0) {
                // Add hidden ID field
                $('#inventoryForm').append('<input type="hidden" name="id" value="' + id + '">');
            } else {
                // Update the ID value
                $('#inventoryForm input[name="id"]').val(id);
            }


            $.ajax({
                url: `Inventory/InventoryController.php?action=view_inventory&id=${id}`,
                method: 'GET',
                success: function (response) {
                    const inventory = JSON.parse(response);
                    $("#inventoryId").val(inventory.id);
                    $("#name").val(inventory.name);
                    $("#size").val(inventory.size);
                    $("#type").val(inventory.type);
                    $("#project").val(inventory.project);
                    $("#code").val(inventory.code);
                    // $("#booking_date").val(inventory.booking_date);
                    $("#status").val(inventory.status);
                    $("#floor").val(inventory.floor);
                },
                error: function () {
                    alert("Failed to load inventory details.");
                }
            });
        };

        // Delete inventory
        window.deleteInventory = function (id) {
            if (confirm("Are you sure you want to delete this inventory item?")) {
                $.ajax({
                    url: `Inventory/InventoryController.php?action=delete_inventory&id=${id}`,
                    method: 'GET',
                    success: function (response) {
                        const result = JSON.parse(response);
                        alert(result.message);
                        setTimeout(function () {
                       window.location.reload();
                    }, 1000);
                        // loadInventory(); // Refresh the table
                    },
                    error: function () {
                        alert("Failed to delete inventory.");
                    }
                });
            }
        };

        // Reset form after submission or edit
        function resetForm() {
            $("#inventoryForm")[0].reset();
            $("#inventoryId").val('');
        }
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




    <script>
    $(document).foundation();
    </script>



</body>

</html>
