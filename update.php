<?php
session_start();
include_once("admin/dbcon.php");

$_SESSION['available'] = true;

if (isset($_POST["username"])) {
    $username = $_POST["username"];

    $stmt = "SELECT username FROM members WHERE username = '$username'";
    $result = mysqli_query($con, $stmt);

    if ($result) {
        if (!mysqli_num_rows($result) > 0) {
            $updateStmt = "UPDATE members SET username = '$username' WHERE m_id =   " . $_SESSION['user_id'];
            $updateResult = mysqli_query($con, $updateStmt);

            if (!$updateResult) {
                $_SESSION['available'] = false;
            }
        } else {
            $_SESSION['available'] = false;
        }
    }
}

if (!$_SESSION['available']) {
    echo "exists";
} else {
    echo "available";
}
