<?php include "header.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){
        include"config.php";
        $fname=mysqli_real_escape_string($conn,$_POST["fname"]);
        $fname=str_replace("<","&lt;",$fname);
        $fname=str_replace(">","&gt;",$fname);
        $lname=mysqli_real_escape_string($conn,$_POST["lname"]);
        $lname=str_replace("<","&lt","$lname");
        $lname=str_replace(">","&gt","$lname");
        $user=mysqli_real_escape_string($conn,$_POST["user"]);
        $user=str_replace("<","&lt","$user");
        $user=str_replace(">","&gt","$user");
        $password= mysqli_real_escape_string($conn,md5($_POST["password"]));
        $password=str_replace("<","&lt","$password");
        $password=str_replace(">","&gt","$password");
        $role= mysqli_real_escape_string($conn,$_POST["role"]);


        $sql_new = mysqli_query($conn,'SELECT * FROM `user` WHERE `username` = "'.$user.'" ');
        if(mysqli_num_rows($sql_new) > 0){

            echo '<script>alert("username alrady exisit");</script>';
        }else{
            $sql="INSERT INTO `user` (`first_name`, `last_name`, `username`, `password`, `role`) VALUES ('$fname', '$lname', '$user', '$password', '$role')";
                if(mysqli_query($conn,$sql)){
            echo '<script>alert("Your account is created succesfully");</script>';

                    header("Refresh:1; url=users.php", true, 303);
                }
        }
        



    }
    // echo rand(10000000000000,99999999999999);
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add User</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['REQUEST_URI'];?>" method ="POST" autocomplete="off">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                      </div>
                          <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="user" class="form-control" placeholder="Username" required>
                      </div>

                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" >
                              <option value="0">Normal User</option>
                              <option value="1">Admin</option>
                          </select>
                      </div>
                      <input type="submit"  name="save" class="btn btn-primary" value="Save" required />
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>
<?php include "footer.php"; ?>
