<?php

include_once("admin/dbcon.php");
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: info.html");
    exit();
}


$user  = $_SESSION['user_id'];
$id = $_GET["id"];
$result = mysqli_query($con, "select * from movie where movie_id = $id");


if (!$result) {
    die("Error: " . mysqli_error($con));
}

$row = mysqli_fetch_assoc($result);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Details</title>
    <link rel="stylesheet" type="text/css" href="body.css">

    <style>
        .details {
            width: 50%;
            margin: 0 auto;
            text-align: center;
            padding: 20px;
            background-color: #012324;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgb(0, 3, 3);
        }


        img {
            max-width: 100%;
            max-height: 500px;
            width: auto;
            height: auto;
            margin: 0 auto;
            display: block;
        }


        p {
            font-size: 18px;
            margin: 10px 0;
        }

        .link-red {
            color: blue;
            text-decoration: none;
        }

        .link-red:hover {
            color: red;
        }
        a.return-link {
            color: #ff5f50;
            font-weight: bold;
            text-decoration: none;
        }

        a.return-link:hover {
            color: green;
        }
        .user{
            width: 50%;
            margin: 0 auto;
            text-align: center;
            padding: 20px;
           
        }
        .comments{
            width: 50%;
            margin: 0 auto;
            text-align: center;
            padding: 20px;
           
        }
    </style>
</head>

<body>
    <div class="details">

        <img src="image/<?php echo $row['img_name']; ?>" alt="Movie Image">
        <p>Movie Name: <?php echo $row['movie_name']; ?></p>
        <p>Total Copies: <?php echo $row['total_disk']; ?></p>
        <p>Genre: <?php echo $row['genre']; ?></p>
        <p>Released Year: <?php echo $row['released']; ?></p>

    </div>    

<div class="user">

<?php
$review_user_result = mysqli_query($con, "SELECT * FROM review WHERE movie_id = '$id' AND reviewed_by = '$user'");

if ($review_user_row = mysqli_fetch_array($review_user_result)) {
    echo $review_user_row["review_msg"];
    echo $review_user_row["star"] . "<br>";
    echo $review_user_row["edit_status"];
} else {
    echo '
    <form method="post" action="reviewAdd.php">
        <label>Add your review</label>
        <input type="text" name="review">
        <input type="hidden" name="movie_id" value="' . $id . '">
        <input type="hidden" name="star" value="yup">
        <input type="Submit" value="Submit">
    </form>';
}



?>
</div>

<div class="comments"
<?php
$other_user_review=mysqli_query($con, "SELECT * FROM review WHERE movie_id = '$id' AND NOT reviewed_by = '$user'");
if($other = mysqli_fetch_array($other_user_review)){
    echo $other["review_msg"];
    echo $other["star"] . "<br>";
    echo $other["edit_status"];

}else{
    echo "<label>be the first one to review this movie</label>";
}
?>  
</div>

<body>
</html>