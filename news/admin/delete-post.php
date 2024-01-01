<?php
$id=$_GET["id"];
include "config.php";
$img=mysqli_query($conn,"SELECT * FROM `POST` WHERE `POST`.`post_id`='$id'");
if(mysqli_num_rows($img)>0){
    while($row=mysqli_fetch_assoc($img)){
        $old_img=$row["post_img"];
        unlink("upload/".$old_img);
    }
}
$sql="DELETE FROM `POST` WHERE `POST`.`post_id`='$id'";
if(mysqli_query($conn,$sql)){
    header("location:post.php");
}


?>