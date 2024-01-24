<?php
include_once('header.php');
$_SESSION['url'] = $_SERVER['REQUEST_URI'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="body.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
       /* style.css */


.movie-list {
    text-align: center;
    margin-top: 50px;
}

.movie-list img {
    max-width: 100%;
    max-height: 400px;
    width: auto;
    height: auto;
    display: block;
    margin: 0 auto;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

.movie-list p {
    font-size: 18px;
    margin-top: 15px;
}


.additional-content p {
    font-size: 16px;
    line-height: 1.5;
    color: #666;
}
p{
    text-align:center;
    font-size:20px;
}

    </style>
</head>

<body>

    <div class="movie-list">
        
        <img src="image/Drive.jpeg">
        <p><a href="movielist.php">View Movie</a></p>
    </div>

    <p>Review and Rate movies</p></div>

</body>

</html>
