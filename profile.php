<?php
include_once('admin/dbcon.php');
include_once('header.php');
if (isset($_SESSION["error_deleting"])) {
    echo "<script>alert('" . $_SESSION["error_deleting"] . "');</script>";
    unset($_SESSION["error_deleting"]);
}

if (!isset($_SESSION['user_id'])) {
    header("Location: info.html");
    exit();
}$result = mysqli_query($con, "SELECT * FROM members WHERE m_id=" . $_SESSION['user_id']);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="body.css">

    <style>
        .container a {
            color: #007bff;
            text-decoration: none;
            margin-right: 20px;
        }

        .container {
            display: flex;
            justify-content: center;
            margin-left: auto;
            margin-right: auto;
            align-items: center;
            height: 100vh;
            background-color: #042425;
        }



        label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
        }

        input[type="text"],
        [type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        #logging:hover {

            color: #fa7b00;
        }

        #delete {
            color: #ff0000;

        }

        #delete:hover {
            color: #aa0000;

        }

        .btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }


        .btn:hover {
            background-color: #0056b3;
        }

        .error {
            color: #ff0000;
            font-weight: bold;
            margin-top: 10px;
            font-size: 14px;
        }
    </style>
</head>

<body>

   


    <div class="container">



        <form>
            <label>
                <?php
                echo $row["firstname"]
                ?>
                <?php
                echo $row["lastname"]
                ?>
            </label>

            <label>
                <?php
                echo "Phone no: " . $row["phone"]
                ?>
            </label>

            <label>Username</label>

            <input type="text" id="username" name="username" value="<?php
                                                                    echo $row["username"] ?>">

            <p id="usernameCheck" class="error"></p>
            <input class='btn' type="button" id="submitform" value="Update" />
            <label>Change Password</label>
            <input type="password" id="password1" name="password">

            <label>Confirm Password</label>
            <input type="password" id="password2" name="confirmp">
            <input class='btn' type="button" id="passwordupdate" value="Confirm" />
            <p id="passwordcheck" class="error"></p>
            <a href="logout.php" id="logging">Log Out</a>
            <a href="delete.php" id="delete" onClick="return confirm('Are you sure you want to delete?')">Delete User</a>

        </form>


    </div>
    <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script type="text/javascript">
        //for username
        $(function() {
            $("#submitform").on('click', function() {
                var username = $("#username").val();
                var failmsg = "";
                if (username === "") failmsg += "No Username was entered.\n";
                else if (username.length < 5) failmsg += "Username must be at least 5 characters.\n";
                if (/[^a-zA-Z0-9_-]/.test(username)) failmsg += "Only a-z, A-Z, 0-9, - and _ allowed in Username.\n";
                
                if (failmsg == "") {
                    $.ajax({
                        method: "POST",
                        url: "update.php",
                        data: {
                            "username": username
                        },
                        success: function(response) {
                            if (response == "exists") {
                                $("#usernameCheck").text("Username already exists");
                            }
                            if (response == "available") {
                                $("#usernameCheck").text("Username updated successfully");
                            }
                        }
                    });
                } else {

                    $("#usernameCheck").text(failmsg);
                }

            })
        })
    </script>

<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $("#passwordupdate").on('click', function() {
                var password = $("#password1").val();
                var password2 = $("#password2").val();
                var failPassword ="";

              if(password != password2) failPassword += " Two password doesnt match"
                  else  if (password == "") failPassword += "No Password was entered.\n";
                    else if (password.length < 6) failPassword += "Password must be at least 6 characters.\n";
                    else if (!/[a-z]/.test(password) || !/[A-Z]/.test(password) || !/[0-9]/.test(password)) failPassword += "Password requires at least one lowercase letter, one uppercase letter, and one digit.\n";
                  
                    

                if (failPassword == "") {
                    $.ajax({
                        method: "POST",
                        url: "updatepassword.php",
                        data: {
                            "password": password
                        },
                        success: function(response) {
                            console.log(response);
                            if (response == "error") {
                                $("#passwordcheck").text("New password cannot be the same as the old password").css("color", "red");
                            }
                            if (response == "success") {
        $("#passwordcheck").text("Password change successful").css("color", "green");
    }
                        }
                    });
                } else {
                    $("#passwordcheck").text(failPassword);
                }
            })
        })
    </script>

</body>

</html>