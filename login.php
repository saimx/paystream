<!doctype html>
<html class="no-js" lang="en">
<?php
session_start();
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));


?>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Paystream V1.2</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/foundation.css" />

    <!-- Custom styles for this template -->

    <!-- <link rel="stylesheet" href="css/dashboard.css"> -->
    <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/dripicon.css">
    <!--  <link rel="stylesheet" href="css/typicons.css" />
    <link rel="stylesheet" href="css/font-awesome.css" /> -->
    <link rel="stylesheet" href="css/theme.css">
    <link rel="stylesheet" href="css/login.css">

    <!-- pace loader -->
    <script src="js/pace/pace.js"></script>
    <link href="js/pace/themes/orange/pace-theme-flash.css" rel="stylesheet" />
    <link rel="stylesheet" href="js/slicknav/slicknav.css" />



    <script src="js/vendor/modernizr.js"></script>
    <

</head>

<body>
    <!-- preloader -->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <!-- End of preloader -->
    <!-- right sidebar wrapper -->
    

    <div class="inner-wrap">
        <div class="wrap-fluid">
            <br>
            <br>

            <div class="row">
                <div class="column large-6 large-centered">
                   <div class="logo-container-ajmir">
                    <img class="logo-ajmir" style="width: 141px;padding-bottom: 20px;" src="img/client-logo.png">
                   </div>
                    
        
                </div>
            </div>
            <!-- Container Begin -->
            <div class="large-offset-4 large-4 columns">
                <div class="box bg-white">
                    <!-- Profile -->
                    <div class="profile">
                        <img alt="" class="" src="./img/logo.png">
                        <h3>PAYSTREAM <small>1.2</small></h3>

                    </div>
                    <!-- End of Profile -->

                    <!-- /.box-header -->
                    <div class="box-body " style="display: block;">
                        <div class="row">

                            <div class="large-12 columns">
                                <div class="row">
                                    <div class="edumix-signup-panel">
                                        <p class="welcome"> Welcome to this Paystream app!</p>
                                        <form id="loginForm">
                                            <div class="row collapse">
                                                <div class="small-2  columns">
                                                    <span class="prefix bg-grayx"><i class="text-white icon-user"></i></span>
                                                </div>
                                                <div class="small-10  columns">
                                                    <input type="text" name="username" placeholder="Username">
                                                </div>
                                            </div>
                                            <div class="row collapse">
                                                <div class="small-2 columns ">
                                                    <span class="prefix bg-grayx"><i class="text-white icon-lock"></i></span>
                                                </div>
                                                <div class="small-10 columns ">
                                                    <input type="password" name="password" placeholder="Password">
                                                </div>
                                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                                            </div>
                                            <button type="submit" class=" button login-btn bg-grayx" value=""> <div class="spinner hidden"></div>Sign in</button>
                                        </form>
                                        <p>Already have an account? <a href="#">Forgot password ?</a>
                                        </p>
                                       
                                        <br>
                                        <!-- <h2><span>Connect with</span></h2> -->
                                    </div>
                                </div>
                               

                                <div class="row">
                                    <div class="columns no-pad  ">
                                       <p class="messageBox"></p>
                                    </div>
                                </div>

                            </div>



                        </div>


                    </div>
                    <!-- end .timeline -->
                </div>
                <!-- box -->
            </div>
        </div>
        <!-- End of Container Begin -->
    </div>

    <!-- end paper bg -->



    <!-- end of inner-wrap -->



    <!-- main javascript library -->
    <script type='text/javascript' src="js/jquery.js"></script>
    <!-- <script type="text/javascript" src="js/waypoints.min.js"></script> -->
    <script type='text/javascript' src='js/preloader-script.js'></script>
    <!-- foundation javascript -->
    <script type='text/javascript' src="js/foundation.min.js"></script>
    <!-- <script type='text/javascript' src="js/foundation/foundation.dropdown.js"></script> -->
    <!-- main edumix javascript -->
    <!-- <script type='text/javascript' src='js/slimscroll/jquery.slimscroll.js'></script>
    <script type='text/javascript' src='js/slicknav/jquery.slicknav.js'></script>
    <script type='text/javascript' src='js/sliding-menu.js'></script>
    <script type='text/javascript' src='js/scriptbreaker-multiple-accordion-1.js'></script>
    <script type="text/javascript" src="js/number/jquery.counterup.min.js"></script>
    <script type="text/javascript" src="js/circle-progress/jquery.circliful.js"></script>
    <script type='text/javascript' src='js/app.js'></script> -->
    <!-- additional javascript -->



    <script>
    $(document).foundation();
    </script>

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script>
  $('.messageBox').hide();
    $(document).ready(function() {
      
        $('#loginForm').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission
            const spinner = $(this).find('.spinner');
            spinner.removeClass('hidden');
            $('.login-btn').attr('disabled','true');
            $('.login-btn').html('<div class="spinner"></div>');
            const formData = $(this).serialize(); // Serialize form data
            const messageBox = $('.messageBox'); // Message box for displaying messages
            messageBox.hide().html(''); // Clear previous messages

            // Send AJAX request to the server
            $.post('User/login-check.php', formData, function(response) {
                const result = JSON.parse(response); // Parse the JSON response

                if (result.success) {
                    // Redirect to the dashboard or another page on success
                    window.location.href = 'dashboard'; // Change this to your desired page
                } else {
                    spinner.addClass('hidden');
                    $('.login-btn').removeAttr('disabled');
                    $('.login-btn').html('<div class="spinner hidden"></div>Sign in');
                    // Display error message
                    messageBox.html(result.message).show();
                }
            }).fail(function() {
                messageBox.html('An error occurred. Please try again.').show();
                spinner.addClass('hidden');
                $('.login-btn').removeAttr('disabled');
                $('.login-btn').html('<div class="spinner hidden"></div>Sign in')
            });
        });
    });

</script>



</body>

</html>
