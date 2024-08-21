<?php
include_once("admin/dbcon.php");
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
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
$query = "INSERT INTO review (reviewed_by, movie_id, review_date, review_msg, star) 
VALUES ( '$user', '$m_id', '$date', '$review', '$star')";
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

