<?php
session_start();
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post_id = mysqli_real_escape_string($conn, $_POST["post_id"]);
    $post_title = mysqli_real_escape_string($conn, $_POST["post_title"]);
    $post_title = str_replace("<", "&lt;", $post_title);
    $post_title = str_replace(">", "&gt;", $post_title);
    $postdesc = mysqli_real_escape_string($conn, $_POST["postdesc"]);
    $postdesc = str_replace("<", "&lt", "$postdesc");
    $postdesc = str_replace(">", "&gt", "$postdesc");
    $category = mysqli_real_escape_string($conn, $_POST["category"]);
    $date = date("d.M/y");
    $author = $_SESSION["usersname"];

    if (!empty($_FILES["new_image"]["name"])) {
        $img_name = $_FILES['new_image']['name'];
        $img_size = $_FILES['new_image']['size'];
        $img_tmp = $_FILES['new_image']['tmp_name'];
        $img_type = $_FILES['new_image']['type'];
        $img_ext = $_FILES["new_image"]["name"];
        if ($img_size > 2097152) {
            echo "pliese uplode less 2mb";
        } else {
            $searc = mysqli_query($conn,"SELECT * FROM `POST` WHERE `post_id` = '$post_id'");
            if(mysqli_num_rows($searc) > 0){
                while($rows = mysqli_fetch_assoc($searc)){
                    $old_image_path = $rows['post_img'];
                }
            }
            unlink("upload/".$old_image_path);
            move_uploaded_file($img_tmp, "upload/" . $img_name);
            $sql = "UPDATE `POST` SET `title`='$post_title',`description`='$postdesc',`category`='$category',`post_date`='$date',`author`='$author',`post_img`='$img_name' WHERE `post_id`= '$post_id'";
            if (mysqli_query($conn, $sql)) {
                header("location:post.php");
            }
        }
    } else {
        $sql = "UPDATE `POST` SET `title`='$post_title',`description`='$postdesc',`category`='$category',`post_date`='$date',`author`='$author' WHERE `post_id`= '$post_id'";
        if (mysqli_query($conn, $sql)) {
            header("location:post.php");
        }
    }

}
