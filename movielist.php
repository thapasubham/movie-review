<?php

include_once('admin/dbcon.php');
include_once('header.php');

$_SESSION['url'] = $_SERVER['REQUEST_URI'];

if (isset($_SESSION['message'])) {
    echo "<script>alert('" . $_SESSION['message'] . "');</script>";
    unset($_SESSION['message']);
}

if (isset($_SESSION['error'])) {
    echo "<script>alert('" . $_SESSION['error'] . "');</script>";
    unset($_SESSION['error']);
}

$result = mysqli_query($con, "select * from movie");
if (!$result) die("Database fetch failed: " . mysqli_error($con));
?>

<!DOCTYPE html>
<html lang="en">
<head> 
    <title>Moive List</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie List</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="body.css">

    <style>
      

    .outer_box {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        padding: 20px;
    }
h3{
    text-align: center;
}
    .movie_box {
        width: 20%;
        height: 50%;
        margin: 20px 0;
        padding: 15px;
        background-color:#040f25;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(255, 0255  , 255, 0.2);
        transition: transform 0.3s ;
        text-align: center;
    }

    .movie_box:hover {
        transform: scale(1.02);
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
       <h3> Movies List</h2>
</header>

<div class="outer_box">
    <?php
    while ($row = mysqli_fetch_array($result)) {
        // 
        // <div class="row"><?php
        echo '<div class="movie_box">';
       
        echo '<img class="image" src="image/' . $row["img_name"] . '" alt =" ' . $row["movie_name"] . '"><br>';

        echo '<p class="movie_name">' . $row["movie_name"] . '</p>';
        echo '<p class="year">Releases: ' . $row["released"] . '</p>';



        
        $average = mysqli_query($con, "SELECT AVG(star) AS average_star FROM review WHERE movie_id={$row['movie_id']}");
        $average_result = mysqli_fetch_array($average);
        
        // averating
        if ($average_result['average_star'] == null) {
            echo "No reviews yet";
            echo "<br><a href=\"movie.php?id=" . $row['movie_id'] . "\">Add one</a>";
        } else {
            $formatted_rating = number_format($average_result['average_star'],1);
            echo "Average rating: " . $formatted_rating;
            echo "<br><a href=\"movie.php?id=" . $row['movie_id'] . "\">Check Reviews</a>";
        }
        
        echo '
    
    </div> ';
   
  

  }
    ?>
</div>
</body>
</html>
