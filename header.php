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
        header{
        background-color: #333;
        color: #fff;
        padding: 1em 0;
        text-align: center;
    }
        
    ul {
 
 list-style-type: none;
 
 padding: 0;
}

li {
 display: inline;
 margin-right: 10px;
}

        </style>
</head>
<body>
    <header>
        <ul 
        ><li>
<?php 
if (!isset($_SESSION['user_id'])) {
?>
<a href="login.php">login</a>
<?php
} else
{
    $user = $_SESSION['user_id'];
$result = mysqli_query($con, "SELECT firstname from members where m_id =$user");
$name = mysqli_fetch_array($result) ;

echo "welcome " . $name['firstname'];
}

?>
</li>
<li> hello</li>
</ul>
    </header>
</body>
</html>