<?php
session_start();
include_once("admin/dbcon.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: info.html");
    exit();
}


$userId =$_SESSION['user_id'];


    // Allow deletion
    $deleteReviewQuery = mysqli_query($con, "DELETE FROM review WHERE reviewed_by = $userId");
    $deleteMembersQuery = mysqli_query($con, "DELETE FROM members WHERE m_id = $userId");

    if (!$deleteReviewQuery || !$deleteMembersQuery) {
        // Deletion failed
        die("Failed to delete: " . mysqli_error($con));
    } else {
       
        echo "<script>alert('Data deleted successfully');</script>";
        echo "<script>window.location.href = 'logout.php';</script>";

    }

?>
