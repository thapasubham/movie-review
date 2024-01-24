<?php
include_once("admin/dbcon.php");
session_start();
if (!isset($_SESSION['user_id'])) {
    exit();
}


$user  = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $review = $_POST['review'];
    $m_id = $_POST['movie_id'];
    $star = $_POST['star'];
}

$date = date("Y-m-d"); 

//echo $m_id;
echo "before inserting";
$query = "UPDATE review SET reviewed_by='$user', review_date='$date', review_msg='$review', star='$star'
             WHERE review_id='$_id'";
$result = mysqli_query($con, $query);
echo "after inserting";
if(!$result){ echo "inside if else";
    $error = mysqli_error($con);
    echo "Error adding review: " . $error;
    $con->close();
    exit;
} else{
    echo "Your review had been added";

}
header("Location: movie.php?id=".$m_id);
$con->close();
?>