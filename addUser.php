
<?php
include_once('admin/dbcon.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $username = $_POST['username'];
    $city = $_POST['city'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = $_POST['password'];

    $usernameQuery = mysqli_query($con, "SELECT username FROM members WHERE username = '$username'");
    $count = mysqli_num_rows($usernameQuery);

    if ($count > 0) {
        echo "<p class=\"text\" style=\" text-align: center; \">Failed to register.
         <br>The username already exists.
         <a href=\"register.html\">Try Again</a> </p>
         ";
    } else {
        $sql = "INSERT INTO members (firstname,lastname, username, city, phone, email, password)
                VALUES ('$firstName', '$lastName', '$username', '$city', '$phone', '$email', '$password')";
        $result = mysqli_query($con, $sql);

        if (!$result) {
            die("Failed to register: " . mysqli_error($con));
        } else {
            sleep(1);
            echo "Registration Successful. Please login.";
            header('Location: login.php');
            exit;
        }
    }
}

?>
<html>
<head>
<link rel="stylesheet" href="body.css">
<style>
    .text{
        padding: 30px;
        font-size: 110%;
    }
    a {
    text-align: right;
    text-decoration: none;
    color: #fff;
    font-weight: bold;
  }
  
  a:hover {
    color: #0577fa;
   
  }
</style>
</head>
</html>