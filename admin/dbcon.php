<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "movie_review";

$con = mysqli_connect($host, $user, $password, $dbname);
if (mysqli_connect_errno()) {
    die("Failed to connect with MySQL: " . mysqli_connect_error());
}
