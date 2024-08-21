<?php
include_once("dbcon.php");
include_once("header.html");
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
if (isset($_SESSION["error"])) {
    echo "<script>alert('" . $_SESSION["error"] . "');</script>";
    unset($_SESSION["error"]);
}  
if (isset($_POST["submit"])) {
    $file = $_FILES["image"]["tmp_name"];
    $name = $_POST['name'];
    $released =  $_POST['year'];
    $bio = $_POST['bio'];
    $genre = $_POST['genre'];

    $file_ext = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
 if($file_ext != "png"  && $file_ext != "jpg" && $file_ext != "jpeg"){

    $_SESSION["error"] = "$file_ext  isnt a supported format";
    header('Location: add.php');
 }else {
    $filename = $name . '.' . $file_ext;
    $img_dir = "image/";
    $destination = "../image/" . $filename;
    move_uploaded_file($file, $destination);

    $sql = "INSERT INTO movie (movie_name, img_name,  released, about_movie, genre) values ('$name', '$filename',  '$released', '$bio', '$genre')";

    $result = mysqli_query($con, $sql);
    if (!$result) {
        $_SESSION['message'] = "Movie failed To: " . mysqli_error($con);
    }
    $_SESSION['message'] = "Movie Successfully added";
    header('Location: index.php');
    exit;
}
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-color: #042425;
            color: #fff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
.form-box{
            padding: 20px;
            border-radius: 5px;
            background-color: #040f25;
            box-shadow: 0 0 5px rgba(200, 255, 100, 0.21);
            width: 25%;
            margin: 10px auto;
}
        h1 {
            text-align: center;
            margin-top: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 5px;
           
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: 98%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <h1>Add Movie</h1>
<div class="form-box">
    <form action="add.php" method="post" enctype="multipart/form-data">
        <label>Movie Name</label>
        <input type="text" name="name" value="" required> <br>
        <label>Upload Image</label> <p>Only Png and Jpg are supported</p>
       <input type="file" name="image" value="" required><br> 
        <label>Released Year</label>
        <input type="text" id="year" name="year" value="" required><br>
        <p id="year_error"></p>
        <label>About Movie</label>
        <input type="text" id="available" name="bio" value="" required>
        <p id="disk_error"></p>

        <label>Genre</label>
        <select name="genre">
            <option value="Comedy">Comedy</option>
            <option value="Action">Action</option>
            <option value="Crime">Action</option>
            <option value="Thriller">Thriller</option>
            <option value="History">Si-Fi</option>
        </select>

        <input type="submit" value="Submit" name="submit">
    </form>
    </div>
    <script>
        function validate() {
            var year = document.getElementById("year").value;
           
            var b_year = yearVal(year);
            

            if (!(b_year)) {
                return false;
            } else {
                return true;
            }
        }

        function yearVal(year) {
            if (isNaN(year)) {
                document.getElementById("year_error").innerHTML = "Year must be a number";
                return false;

            } else if (year.toString().length != 4) {
                document.getElementById("year_error").innerHTML = "Year must of 4 digit";
                return false;
            } else {
                document.getElementById("year_error").innerHTML = "";
                return true;
            }
        }

        
        
    </script>

</body>

</html>