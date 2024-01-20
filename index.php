<?php
session_start();
include_once('admin/dbcon.php');
//include_once('header.html');
if (isset($_SESSION['message'])) {
    echo "<script>alert('" . $_SESSION['message'] . "');</script>";
    unset($_SESSION['message']);
}

if (isset($_SESSION['error'])) {
    echo "<script>alert('" . $_SESSION['error'] . "');</script>";
    unset($_SESSION['error']);
}

if (!isset($_SESSION['user_id'])) {
    header("Location: info.html");
    exit();
}

$result = mysqli_query($con, "select * from movie");
if (!$result) die("Database fetch failed: " . mysqli_error($con));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie List</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="body.css">
    <style>
    
    header {
        background-color: #333;
        color: #fff;
        padding: 1em 0;
        text-align: center;
    }

    .outer_box {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        padding: 20px;
    }

    .movie_box {
        width: 20%;
        margin: 20px 0;
        padding: 15px;
        background-color:#040f25;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(255, 0255  , 255, 0.2);
        transition: transform 0.3s ease-in-out;
        text-align: center;
    }

    .movie_box:hover {
        transform: scale(1.05);
    }

    .movie_name {
        font-weight: bold;
       
        
    }

    .year {
        color: #afafaf;
        
    }

    .image {
        max-width: 100%; 
        max-height: 200px;
        margin-top: 5px; 
    }
    .link{
      margin-top: 5px; 
    }
</style>

</head>
<body>

<header>
    <h1>Movie List</h1>
</header>
<div class="outer_box">
    <?php
    while ($row = mysqli_fetch_array($result)) {
        
        echo '<div class="movie_box">';
       
        echo '<img class="image" src="image/' . $row["img_name"] . '"><br>';

        echo '<p class="movie_name">' . $row["movie_name"] . '</p>';
        echo '<p class="year">Releases: ' . $row["released"] . '</p>';


        
        $average = mysqli_query($con, "SELECT AVG(star) AS average_star FROM review WHERE movie_id={$row['movie_id']}");
        $average_result = mysqli_fetch_array($average);
        
        // Check if a result is obtained
        echo $average_result['average_star'];
        if ($average_result['average_star'] == null) {
            echo "No reviews yet";
            echo "<br><a href=\"movie.php?id=" . $row['movie_id'] . "\">Add one</a>";
        } else {
            echo "Average rating: " . $average_result['average_star'];
            echo "<br><a href=\"movie.php?id=" . $row['movie_id'] . "\">Check Reviews</a>";
        }
        
        echo '</div> ';
   
  

  }
    ?>
</div>
</body>
</html>
