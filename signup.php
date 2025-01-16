<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.6.3/css/foundation.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        .form-container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
    <title>Login & Signup</title>
</head>
<body>

<div class="form-container">
    <h2>Login</h2>
    <!-- <form id="loginForm">
        <div class="grid-x grid-margin-x">
            <div class="cell small-12">
                <label>Username
                    <input type="text" name="username" required>
                </label>
            </div>
            <div class="cell small-12">
                <label>Password
                    <input type="password" name="password" required>
                </label>
            </div>
            <div class="cell small-12">
                <button type="submit" class="button">Login</button>
            </div>
        </div>
    </form> -->

    <h2>Signup</h2>
    <form id="signupForm">
        <div class="grid-x grid-margin-x">
            <div class="cell small-12">
                <label>Username
                    <input type="text" value="saimimtiaz" name="username" required>
                </label>
            </div>
            <div class="cell small-12">
                <label>Email
                    <input type="email" value="saim@gmail.com" name="email" required>
                </label>
            </div>
            <div class="cell small-12">
                <label>Password
                    <input type="password" value="7781300" name="password" required>
                </label>
            </div>
            <div class="cell small-12">
                <button type="submit" class="button">Signup</button>
            </div>
            <div class="small-12">
                <p class="messageBox"></p>
            </div>
        </div>
        <input type="hidden" name="action" value="register"> <!-- Hidden input for action -->
    </form>

    <script type='text/javascript' src="js/jquery.js"></script>
    <script>
        $(document).ready(function() {
           
            $('#signupForm').on('submit', function(e) {
                alert('');
                e.preventDefault(); // Prevent the default form submission
                $.post('signup-.php', $(this).serialize(), function(response) {
                    $('.messageBox').html(response); // Display the response in the message box
                });
            });
        });
    </script>

</body>
</html>