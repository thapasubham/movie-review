<?php
include_once("admin/dbcon.php");
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: info.html");
    exit();
}


$user  = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $review = $_POST['review'];
    $m_id = $_POST['movie_id'];
    $star = $_POST['star'];


}
$date = date("Y-m-d");
echo $date . "<br>";
echo $user . "<br>";
echo $m_id. "<br>";
echo $star. "<br>";

?>