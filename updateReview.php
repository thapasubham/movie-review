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
    $r_id = $_POST['r_id'];
    $star = $_POST['star'];
}

$date = date("Y-m-d"); 

//echo $m_id;
echo "before inserting";
$query = "UPDATE review SET reviewed_by='$user', review_msg='$review', star='$star'
             WHERE review_id='$r_id'";
$result = mysqli_query($con, $query);
echo "after inserting";
if(!$result){ echo "inside if else";
    $error = mysqli_error($con);
    echo "Error adding review: " . $error;
    $con->close();
    exit;
} else{
  

}
echo $r_id;
echo $review;
header("Location: movie.php?id=".$m_id);
$con->close();
?>