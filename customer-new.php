<?php 
include('header.php');

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

    <script>
    // Function to save input values to localStorage
    function saveFieldToStorage(event) {
        const field = event.target;
        const value = field.value;
        localStorage.setItem(field.name, value); // Save to localStorage using the field's name as the key
        
    }
    

    // Function to restore values from localStorage on page load
    function restoreFieldsFromStorage() {
        const fields = document.querySelectorAll("#customerForm input, #customerForm textarea, #customerForm select");
        fields.forEach(field => {
            const savedValue = localStorage.getItem(field.name);
            if (savedValue !== null) {
                if (field.type === "file") return; // Skip file inputs
                field.value = savedValue;
            }
        });
    }

    // Function to clear the form and localStorage
    function resetForm() {
        const fields = document.querySelectorAll("#customerForm input, #customerForm textarea, #customerForm select");
        fields.forEach(field => {
            field.value = ""; // Clear the field
        });
        localStorage.clear(); // Clear all saved values from localStorage
    }

    // Attach event listeners for blur saving
    document.addEventListener("DOMContentLoaded", function () {
        restoreFieldsFromStorage(); // Restore fields on page load

        const fields = document.querySelectorAll("#customerForm input, #customerForm textarea, #customerForm select");
        fields.forEach(field => {
            if (field.type === "hidden") {
                // For hidden fields, directly save their data on load or change
                    localStorage.setItem(field.name, field.value);
                    // console.log(field.name);
            } else {
                field.addEventListener("change", saveFieldToStorage); // Save on blur event
            }
        });
    });
</script>


    <script>
    $(document).foundation();
    $(document).ready(function(){
        
        const idCardNOKFrontPath = localStorage.getItem('idCardNOKFrontPath');
        const idCardNOKBackPath = localStorage.getItem('idCardNOKBackPath');

        const idCardBackPath = localStorage.getItem('idCardBackPath');
        const idCardFrontPath = localStorage.getItem('idCardFrontPath');
        const photoPath = localStorage.getItem('photoPath');
        if (idCardNOKFrontPath) {
            console.log(idCardNOKFrontPath);
            $('#idCardNOKFrontPath').val(idCardNOKFrontPath);
            $('#idCardNOKFrontImg').attr('src', idCardNOKFrontPath); // Set the image preview
            $('#idCardNOKFrontPreview').show(); // Ensure the preview is shown
        }
        if (idCardNOKBackPath) {
            console.log(idCardNOKBackPath);
            $('#idCardNOKBackPath').val(idCardNOKBackPath);
            $('#idCardNOKBackImg').attr('src', idCardNOKBackPath); // Set the image preview
            $('#idCardNOKBackPreview').show(); // Ensure the preview is shown
        }

        if (idCardBackPath) {
            console.log(idCardBackPath);
            $('#idCardBackPath').val(idCardBackPath);
            $('#idCardBackImg').attr('src', idCardBackPath); // Set the image preview
            $('#idCardBackPreview').show(); // Ensure the preview is shown
        }

        if (idCardFrontPath) {
            console.log(idCardFrontPath);
            $('#idCardFrontPath').val(idCardFrontPath);
            $('#idCardFrontImg').attr('src', idCardFrontPath); // Set the image preview
            $('#idCardFrontPreview').show(); // Ensure the preview is shown
        }

        if (photoPath) {
            console.log(photoPath);
            $('#photoPath').val(photoPath);
            $('#photoImg').attr('src', photoPath); // Set the image preview
            $('#PhotoPreview').show(); // Ensure the preview is shown
        }
    });
    </script>
<script type="text/javascript"src='js/form.js'></script>
</body>

</html>
