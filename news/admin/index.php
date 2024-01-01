<?php
session_start();
if(isset($_SESSION["usersname"])){
    header("location:post.php");
}

?>

<!doctype html>
<html>
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ADMIN | Login</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <div id="wrapper-admin" class="body-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                        <img class="logo" src="images/news.jpg">
                        <h3 class="heading">Admin</h3>
                        <!-- Form Start -->
                        <form  action="<?php $_SERVER['REQUEST_URI'];?>" method ="POST">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="" required>
                            </div>
                            <input type="submit" name="login" class="btn btn-primary" value="login" />
                        </form>
                        <!-- /Form  End -->


                        <?php
                        include "config.php";
                        if($_SERVER["REQUEST_METHOD"]=="POST"){
                            if(isset($_POST["login"])){
                                $username=mysqli_real_escape_string($conn,$_POST["username"]);
                                $username=str_replace("<","&lt;",$username);
                                $username=str_replace(">","&gt;",$username);
                                $password=mysqli_real_escape_string($conn,md5($_POST["password"]));
                                $password=str_replace("<","&lt;",$password);
                                $password=str_replace(">","&gt;",$password);
                                $sql="SELECT * FROM `user` where `user`.`username`='$username'";
                                $result=mysqli_query($conn,$sql);
                                if(mysqli_num_rows($result)>0){
                                    while($row=mysqli_fetch_assoc($result)){
                                        if($row["password"]==="$password"){
                                        session_start();
                                        $_SESSION["usersname"]=$row["username"];
                                        $_SESSION["usersid"]=$row["user_id"];
                                        $_SESSION["usersrole"]=$row["role"];
                                        header("location:post.php");
                                        }else{
                                            echo "your password is wrong";
                    
                                     }
                                 }
                             }else{
                                 echo "your usersname is wrong";
                                }
                         }
                        }
                        ?>


                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
