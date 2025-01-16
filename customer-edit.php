<?php
if(isset($_GET['id'])){


$id= $_GET['id'];
$_GET['action'] = 'view_customer';


include('header.php');
require_once 'Customer/CustomerController.php';
$controller = new CustomerController();
$customers = $controller->viewCustomer($id);

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
            <div class="row no-pad">

                <div class="large-12 columns">
               
                    <div class="box bg-white">
                        <div class="box-body pad-forty" style="display: block;">
                            <div class="row">
                            <h2 class="text-centered"><img src="img/customer.png" width="100px"> Customer Information</h2>      
                               <hr>
                                <?php include('customer-form.php'); ?>
                                
                            </div>
                        </div>   
                       
                        </div>
                        <!-- box -->
                    </div>
                </div>


                           
                              

                      
                <footer>
                    <div id="footer">Copyright &copy; 2015 <a href="http://themeforest.net/user/matirasa">Matirasa</a> Made with <i class="fontello-heart-1 text-green"></i></div>

                </footer>
            </div>










            <!-- Right Menu -->
            <aside class="right-off-canvas-menu">
                <!-- whatever you want goes here -->
                <ul class="off-canvas-list">
                    <li>
                        <label class="bg-transparent" style="padding:25px 20px"><span class="label round bg-green">online</span><i class=" icon-gear right"></i>
                        </label>
                    </li>
                    <li>
                        <a href="#"><img alt="" class="chat-pic" src="http://api.randomuser.me/portraits/thumb/men/25.jpg"><b>Walter M. Reed</b>
                            <br>Hi, there...</a>
                    </li>
                    <li>
                        <a href="#"><img alt="" class="chat-pic" src="http://api.randomuser.me/portraits/thumb/women/26.jpg"><b>Evelyn G. Thrailkill</b>
                            <br>Ok, good luck!</a>
                    </li>
                    <li>
                        <a href="#"><img alt="" class="chat-pic" src="http://api.randomuser.me/portraits/thumb/men/27.jpg"><b>Michael L. Merchant</b>
                            <br>Do you receive my email?</a>
                    </li>

                    <li>
                        <a href="#"><img alt="" class="chat-pic" src="http://api.randomuser.me/portraits/thumb/men/29.jpg"><b>James S. Houchin</b>
                            <br>Thak you, you're wellcome</a>
                    </li>

                    <li>
                        <label class="bg-transparent" style="padding:25px 20px"><span class="label round bg-opacity-white">offline</span><i class="icon-gear right"></i>
                        </label>
                    </li>

                    <li>
                        <a href="#"><img alt="" class="chat-pic chat-pic-gray" src="http://api.randomuser.me/portraits/thumb/men/30.jpg"><b>Allen M. Plant</b>
                            <br>Hi, there...</a>
                    </li>
                    <li>
                        <a href="#"><img alt="" class="chat-pic chat-pic-gray" src="http://api.randomuser.me/portraits/thumb/men/31.jpg"><b>Arthur S. Galindo</b>
                            <br>Hi, there...</a>
                    </li>
                    <li>
                        <a href="#"><img alt="" class="chat-pic chat-pic-gray" src="http://api.randomuser.me/portraits/thumb/women/32.jpg"><b>Joyce T. True</b>
                            <br>Hi, there...</a>
                    </li>
                    <li>
                        <a href="#"><img alt="" class="chat-pic chat-pic-gray" src="http://api.randomuser.me/portraits/thumb/men/33.jpg"><b>Christopher A. Charpentier</b>
                            <br>Hi, there...</a>
                    </li>
                    <li>
                        <a href="#"><img alt="" class="chat-pic chat-pic-gray" src="http://api.randomuser.me/portraits/thumb/women/34.jpg"><b>Teresa M. Boothe</b>
                            <br>Hi, there...</a>
                    </li>


                </ul>
            </aside>
            <!-- close the off-canvas menu -->
            <a class="exit-off-canvas"></a>
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



    <script>
    $(document).foundation();
    </script>
<script type="text/javascript"src='js/form.js'></script>


<script>

    $(document).ready(function() {
    $('#customerEditForm').on('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Serialize the form data
        var formData = $(this).serialize();

        // Send the form data using jQuery AJAX
        $.ajax({
            url: "Customer/CustomerController.php?action=edit_customer&id=<?php echo htmlspecialchars($_GET['id']); ?>",
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(data) {
                // Handle the response data
                if (data.success) {
                    alert(data.message); // Show success message
                    // Optionally, redirect or update the UI
                } else {
                    alert('Error: ' + data.message); // Show error message
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error:', textStatus, errorThrown); // Log any errors
                alert('An error occurred while processing your request. Please try again.');
            }
        });
    });
});
</script>

</script>
</body>

</html>
<?php

}

?>
