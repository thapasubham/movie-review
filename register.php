

<?php include_once("header.php");
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="body.css">
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript">

        function validate() {
            var failMsg = validateFirstname(document.getElementById('firstname').value);
            failMsg += validateLastname(document.getElementById('lastname').value);
            failMsg += validateNumber(document.getElementById('phone').value);
            failMsg += validateUsername(document.getElementById('username').value);
            failMsg += validateCity(document.getElementById('city').value);
            failMsg += validateEmail(document.getElementById('email').value);
            var password = document.getElementById('password').value;
            var password2 = document.getElementById('password1').value;

            if (password != password2) {
              document.getElementById('password_error').innerHTML =  "The password doesn't match";
            } else {
                failMsg += validatePassword(password);
            }

            if (failMsg === "") {
              
                return true;
            } else {
               
                return false;
            }
        }

        function validateFirstname(field) {
            if (field === "") {
                document.getElementById('firstname_error').innerHTML = "No Firstname was entered.\n";
                return "error";
            } else if (!/^[A-Z][a-z]*$/.test(field)) {
                document.getElementById('firstname_error').innerHTML = "Enter Valid first Name.\n";
                return "error";
            }
            return "";
        }

        function validateLastname(field) {
            if (field === "") {
                document.getElementById('lastname_error').innerHTML = "No Lastname was entered.\n";
                return "error";
            } else if (!/^[A-Z][a-z]*$/.test(field)) {
                document.getElementById('lastname_error').innerHTML = "Enter Valid last Name.\n";
                return "error";
            }
            return "";
        }

        function validateUsername(field) {
            if (field === "") {
                document.getElementById('username_error').innerHTML = "No Username was entered.\n";
                return "error";
            } else if (field.length < 5) {
                document.getElementById('username_error').innerHTML = "Username must be at least 5 characters.\n";
                return "error";
            } else if (/[^a-z0-9_-]/.test(field)) {
                document.getElementById('username_error').innerHTML = "Only a-z, A-Z, 0-9, - and _ allowed in Username.\n";
                return "error";
            }
            return "";
        }

        function validateCity(field) {
            if (field === "") {
                document.getElementById('city_error').innerHTML = "No City was entered.\n";
                return "error";
            } else if (!/^[A-z][a-z]*$/.test(field)) {
                document.getElementById('city_error').innerHTML = "Enter Valid city Name.\n";
                return "error";
            }
            return "";
        }

        function validatePassword(field) {
            if (field === "") {
                document.getElementById('password_error').innerHTML = "No Password was entered.\n";
                return "error";
            } else if (field.length < 6) {
                document.getElementById('password_error').innerHTML = "Password must be at least 6 characters.\n";
                return "error";
            } else if (!/[a-z]/.test(field) || !/[A-Z]/.test(field) || !/[0-9]/.test(field)) {
                document.getElementById('password_error').innerHTML = "Password requires at least one lowercase letter, one uppercase letter, and one digit.\n";
                return "error";
            }
            return "";
        }

        function validateNumber(field) {
            if (isNaN(field)) {
                document.getElementById('phone_error').innerHTML = "No phone number was entered.\n";
                return "error";
            } else if (field.length < 10) {
                document.getElementById('phone_error').innerHTML = "Please enter a valid 10-digit phone number.\n";
                return "error";
            }
            return "";
        }

        function validateEmail(field) {
            if (field === "") {
                document.getElementById('email_error').innerHTML = "No Email was entered.\n";
                return "error";
            } else if (!(/\S+@\S+\.\S+/.test(field))) {
                document.getElementById('email_error').innerHTML = "The Email is not valid.\n";
                return "error";
            }
            return "";
        }
    </script>
    <style>
        header {

        }
    </style>
</head>

<body>
   
    <div class="first-container">

        <h1>Sign Up</h1>
        <div class="container">
            <form name="Register" action="addUser.php" method="post" onsubmit="return validate()">
                <label for="firstname">First Name:</label>
                <input type="text" id="firstname" name="firstname" required>
                <p id="firstname_error"></p>

                <label for="lastname">Last Name:</label>
                <input type="text" id="lastname" name="lastname" required>
                <p id="lastname_error"></p>

                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <p id="username_error"></p>

                <label for="city">City:</label>
                <input type="text" id="city" name="city" required>
                <p id="city_error"></p>

                <label for="phone">Phone Number:</label>
                <input type="number" id="phone" name="phone" required>
                <p id="phone_error"></p>

                <label for="email">Email:</label>
                <input type="text" id="email" name="email" required>
                <p id="email_error"></p>

                <label for="password1">Password:</label>
                <input type="password" id="password1" name="password1" required>

                <label for="password">Confirm Password:</label>
                <input type="password" id="password" name="password" required>
                <p id="password_error"></p>
                <input type="submit" value="Submit">
                <p id="success"></p> <a href="login.php">Login</a>

            </form>
        </div>
    </div>
</body>

</html>
