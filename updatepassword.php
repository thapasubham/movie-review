<?php
session_start();
include_once("admin/dbcon.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: info.html");
    exit();
}

if (isset($_POST["password"])) {
    $newPassword = $_POST["password"];

    $userId = $_SESSION['user_id'];
    $query = "SELECT password FROM members WHERE m_id = $userId";
    $result = mysqli_query($con, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $oldPassword = $row['password'];


        if ($newPassword !== $oldPassword) {

            $updateStmt = "UPDATE members SET password = '$newPassword' WHERE m_id = $userId";
            $stmt = mysqli_query($con, $updateStmt);

            if ($stmt) {
                echo "success";
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
    }
}
