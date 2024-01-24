
<?php
include_once('admin/dbcon.php');
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
       .box {
        background-color: #333;
   
   
}

        .top-bar{
            width: 50%; margin-left: auto;
    margin-right: auto;
            color: #fff;
            padding: 1em 0;
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
    }
        
    .left-name{
        text-align: left;
        width: 10%;
        font-size:20px;
        display: flex;
    }
    ul {
 
 list-style-type: none;
 display: flex;
 padding: 0;
}

li {
 display: inline;
 margin-right: 10px;
}
a {
    text-align: right;
    text-decoration: none;
    color: #fff;
    font-weight: bold;
  }
  
  a:hover {
    color: #0577fa;
   
  }
        </style>
</head>
<body>
    <div class="box">
<div class="top-bar">
        <div class="left-name">Review IT
        </div>
        <ul>
        <li><a href="index.php"> &nbsp &nbsp Home</a></li>|&nbsp&nbsp
       
<?php 
if (!isset($_SESSION['user_id'])) {
?>
<a href="login.php">Login</a> &nbsp&nbsp
|&nbsp&nbsp
<a href="register.php">Sign up</a>
<?php
} else
{
    $user = $_SESSION['user_id'];
$result = mysqli_query($con, "SELECT firstname from members where m_id =$user");
$name = mysqli_fetch_array($result) ;

echo "<a href=\"profile.php\">My Profile&nbsp &nbsp</a>";
echo "|&nbsp&nbsp<a href=\"logout.php\">Logout</a>";
}

?>

</li>

</ul>
    
    
</div>
</div>
</body>
</html>