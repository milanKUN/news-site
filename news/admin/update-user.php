<?php include "header.php"; 
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST['submit'])){

    
        include"config.php";
        $user_id=mysqli_real_escape_string($conn,$_POST["user_id"]);
        $fname=mysqli_real_escape_string($conn,$_POST["f_name"]);
        $fname=str_replace("<","&lt;",$fname);
        $fname=str_replace(">","&gt;",$fname);
        $lname=mysqli_real_escape_string($conn,$_POST["l_name"]);
        $lname=str_replace("<","&lt","$lname");
        $lname=str_replace(">","&gt","$lname");
        $user=mysqli_real_escape_string($conn,$_POST["username"]);
        $user=str_replace("<","&lt","$user");
        $user=str_replace(">","&gt","$user");
        
        $role= mysqli_real_escape_string($conn,$_POST["role"]);


        // $sql_new = mysqli_query($conn,'SELECT * FROM `user` WHERE `username` = "'.$user.'" ');
        // if(mysqli_num_rows($sql_new) > 0){

            // echo '<script>alert("username alrady exisit");</script>';
        // }else{
            $sql="UPDATE `user` SET `first_name`='$fname',`last_name`='$lname',`username`='$user',`role`='$role' WHERE `user`.`user_id`= '$user_id'";
            
                if(mysqli_query($conn,$sql)){
            echo '<script>alert("Your account is update succesfully");</script>';

                    header("Refresh:1; url=users.php", true, 303);
                }
        }
        
    }


    // }
    // echo rand(10000000000000,99999999999999);
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                <?php
                include 'config.php';
                // if($_SERVER["REQUEST_METHOD"]=="POST"){
                    
                        $us_id=$_GET['id'];
                        // echo $us_id;
                        $sql= "SELECT * FROM `user` where `user_id`= '$us_id'";
                        $result= mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result)>0){
                            while($row=mysqli_fetch_assoc($result)){
                                
                           
                ?>
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['REQUEST_URI'];?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="<?php echo($row['user_id']); ?>" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo($row['first_name']); ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo($row['last_name']); ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo($row['username']); ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="<?php echo $row['role']; ?>">
                          <?php
                          if($row['role']==1){
                            echo "<option value='1' selected>Admin</option>";
                            echo "<option value='0'>normal User</option>";

                          }else{
                            echo "<option value='0' selected>normal User</option>";
                            echo "<option value='1' >Admin</option>";

                          }
                          ?>
                              <!-- <option value="0">normal User</option> -->
                              <!-- <option value="1">Admin</option> -->
                          </select>
                      </div>
                      <?php } ?>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                  <!-- /Form -->
                  <?php
                   
                }
            // }
        
                  ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>