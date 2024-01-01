<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">Add New Post</h1>
                </div>
                <div class="col-md-offset-3 col-md-6">
                    <?php
                    // session_start();
                    if(isset($_FILES["fileToUpload"])){
                        $file_name=$_FILES["fileToUpload"]["name"];
                        $file_size=$_FILES["fileToUpload"]["size"];
                        $file_tmp=$_FILES["fileToUpload"]["tmp_name"];
                        $file_type=$_FILES["fileToUpload"]["type"];
                        $file_ext=$_FILES["fileToUpload"]["name"];
                        if($file_size>2097152){
                            echo "<script>alert('less then 2 mb'); </script>";
                        }else{
                            move_uploaded_file($file_tmp,"upload/".$file_name);
                        }

                    }
                    if($_SERVER["REQUEST_METHOD"]=="POST"){
                        if(isset($_POST["submit"])){
                            include"config.php";
                             $post_title=mysqli_real_escape_string($conn,$_POST["post_title"]);
                             $post_title=str_replace("<","&lt;",$post_title);
                             $post_title=str_replace(">","&gt;",$post_title);
                             $postdesc=mysqli_real_escape_string($conn,$_POST["postdesc"]);
                             $postdesc=str_replace("<","&lt","$postdesc");
                             $postdesc=str_replace(">","&gt","$postdesc");
                             $category=mysqli_real_escape_string($conn,$_POST["category"]);
                            $date = date("d.M . y");
                             $author=$_SESSION["usersname"];
                             $sql="INSERT INTO `post`(`title`, `description`, `category`, `post_date`, `author`, `post_img`) VALUES ('$post_title','$postdesc','$category','$date','$author','$file_name')";
                                

                             if(mysqli_query($conn,$sql)){
                                header("location:post.php");
                             }

                        }
                    }
                    
                    ?>
                  <!-- Form -->
                  <form  action="<?php $_SERVER['REQUEST_URI'];?>" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="post_title">Title</label>
                          <input type="text" name="post_title" class="form-control" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1"> Description</label>
                          <textarea name="postdesc" class="form-control" rows="5"  required></textarea>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Category</label>

                          <select name="category" class="form-control">
                          <?php
                            include"config.php";
                          $sql1="SELECT * FROM `category`";
                          $result=mysqli_query($conn,$sql1);
                          if(mysqli_num_rows($result)>0){
                              while($row=mysqli_fetch_assoc($result)){
                           
                           ?>

                              <option value="<?php echo $row["category_id"]; ?>"><?php echo $row["category_name"]; ?></option>
                              
                              <?php
                             }
                           }
                           ?>

                           </select>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Post image</label>
                          <input type="file" name="fileToUpload" required>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                  </form>
                  <!--/Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
