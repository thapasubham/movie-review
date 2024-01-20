<?php
include_once('dbcon.php');


session_start();


if (isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}


if (isset($_POST['submit'])) {
    $result = mysqli_query($con, "SELECT * FROM admin WHERE username='" . $_POST['username'] . "'");
    $value =    mysqli_fetch_array($result);
    $enteredUserId = $_POST['username'];
    $enteredPassword = $_POST['password'];
    if ($value != null) {
        if ($enteredUserId == $value['username']) {
            if ($enteredPassword == $value['password']) {
                $_SESSION['admin_id'] = $value['admin_id'];

                header("Location: index.php");
                exit();
            } else {
                $error = "Invalid Password";
            }
        } else {
            $error += "Invalid username";
        }
    } else {
        $error = "The user doesn't exist";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../body.css">
    <style>
        .algner {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        a {
            color: blue;
        }

        a:hover {
            color: #00ff99;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="first-container">
        <h1>Admin Login</h1>
        <div class="container">
            <?php if (isset($error)) { ?>
                <p><?php echo $error; ?></p>
            <?php } ?>

            <form method="post" action="login.php">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <div class="algner">
                    <input type="submit" name="submit" value="Login">
                   
                </div>
            </form>
        </div>
    </div>
</body>

</html>