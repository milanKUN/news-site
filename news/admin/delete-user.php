<?php
include 'config.php';
$us_id=$_GET["id"];
$sql="DELETE FROM `user` WHERE  `user`.`user_id`='$us_id'";
if(mysqli_query($conn,$sql)){
    // echo '<script>alert("Delit Succesfully");</script>';
    header("location:users.php");
}
?>