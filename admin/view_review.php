<?php
include_once("dbcon.php");
include_once("header.html");
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
$id = $_GET["id"];


$result = mysqli_query($con, "select * from movie where movie_id = $id");

$average = mysqli_query($con, "SELECT AVG(star) AS average_star FROM review WHERE movie_id=$id");
$average_result = mysqli_fetch_array($average);

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
       
            width: 40%;
            margin: 0 auto;
            text-align: center;
            padding: 20px;
            background-color:#040f25;
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
            width:80%; 
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
            width: 40%;
            margin: 0 auto;
           
            padding: 20px;
            border-radius: 5px;
          

           
        }
.each-comment{
width: auto; 


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
.delete:hover{
color:red;
}

 
    </style>
</head>
<body>
    
    <div class="details">
<h2>Movie</h2>
        <img src="../image/<?php echo $row['img_name']; ?>" alt="Movie Image">
        <p>Name: <?php echo $row['movie_name']; ?></p>
</p>
     <?php   $formatted_rating = number_format($average_result['average_star'],1);
            echo "Average rating: " . $formatted_rating;
            ?>
            </p>
        <p>Genre: <?php echo $row['genre']; ?></p>
        <p>Released Year: <?php echo $row['released']; ?></p>

    </div>    
<div class="comments"> 


       

</div>
</div><?php
?>


<div class="comments-box">
<?php
$other_user_review = mysqli_query($con, "SELECT * FROM review WHERE movie_id = $id");


 if(mysqli_num_rows($other_user_review)>0){ 
  
   
      while($row =mysqli_fetch_array($other_user_review)){
        ?>
 <div class="each-comment" ><?php
        $reviewed_by = mysqli_query($con, "SELECT firstname, lastname from members where m_id =". $row['reviewed_by']);
        $member = mysqli_fetch_assoc($reviewed_by) ;
echo '<p style="font-weight: bold;">'.$member['firstname'].'</p>'. $row["review_msg"];
    echo "<br>";
    echo "User Rating: ". $row["star"] ;
 
   
?></div><?php
      }
?></div> <?php
}

else{?>
 <div class="msg" style="font-weight: bold;">
 No Other reviews yet
 </div> 
 <?php
}
?>  

</div>
</div>

<body>
</html>
<?php


