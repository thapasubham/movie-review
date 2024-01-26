<?php

include_once("admin/dbcon.php");
include_once('header.php');

$_SESSION['url'] = $_SERVER['REQUEST_URI'];
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
if (!isset($_SESSION['user_id'])) {
    $user =0;
}else{
    $user =$_SESSION['user_id'];
}

$id = $_GET["r_id"];


$result = mysqli_query($con, "SELECT review.*, movie.* FROM review JOIN movie ON review.movie_id = movie.movie_id
                                WHERE review.review_id = $id");


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
    <title>Movie Review</title>
    <link rel="stylesheet" type="text/css" href="body.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        .details {
          
            height:auto;
            width: 40%;
            margin: 0 auto;
            text-align: center;
            padding: 20px;
            background-color: #012324;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgb(255, 255, 200,0.2);
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
           
        }
        .comments{
            width:70%; 
    align-content: center;
    margin-left: auto;
    margin-right: auto;
           
        }

    .msg{
    width: 80%;
            color: white;
            margin: 0 auto;
            text-align:center;
            padding: 20px;
        }

        .comments-box{

            height:auto;
            width: 50%;
            margin: 0 auto;
           
            padding: 20px;
            border-radius: 5px;
          

           
        }
.each-comment{
width: auto; 
text-align: center;

text-align:left;
    padding:15px;
    box-shadow: 0 0 10px rgb(0,0,0);
}
    select{
    width: 10%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

 
    </style>
</head>

<body>
    
    <div class="details">
<h2>Movie</h2>
        <img src="image/<?php echo $row['img_name']; ?>" alt="Movie Image">
        <p>Movie Name: <?php echo $row['movie_name']; ?></p>
        <p>Genre: <?php echo $row['genre']; ?></p>
        <p>Released Year: <?php echo $row['released']; ?></p>

    </div>    
<div class="comments"> 
    
<?php 


    ?>
    <div class="comments-box">
        <div class="each-comment" >
        <form method="post" action="updateReview.php">
        <label>Add your review</label>
        <input type="text" name="review" value="<?php echo $row['review_msg'];?>"required>
        <input type="hidden" name="movie_id" value=" <?php echo $row['movie_id'];?>">
        <input type="hidden" name="r_id" value=" <?php echo $id?>">

        <select name="star"  required>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select>
        <input type="Submit" value="Submit">
    </form>
</div>
</div>
</body>
</html>