<?php
session_start();
if(!isset($_SESSION["usersname"])){
    header("location:index.php");
}

include "config.php";
$id= $_GET["id"];
$sql="DELETE FROM `category` WHERE `category`.`category_id`='$id'";
if(mysqli_query($conn,$sql)){
    header("location:category.php");
}else{
    echo "delit not sussfull";
}
?>