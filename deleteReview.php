<?php

include_once('admin/dbcon.php');



$r_id = $_GET['r_id'];
$result = mysqli_query($con, "DELETE FROM review WHERE review_id = $r_id");

?>