<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                    <div class="post-container">
                        <?php
                        include "config.php";
                        $id=$_GET["id"];
                        $sql="SELECT `post`.`post_id`, `post`.`post_img`,`post`.`author`,`post`.`post_date`,`post`.`category`,`post`.`description`,`post`.`title`,`category`.`category_name`,`user`.`first_name`,`user`.`user_id` FROM `post` LEFT JOIN `category` ON `post`.`category` = `category`.`category_id` LEFT JOIN `user` ON `post`.`author` =`user`.`username`
                        where `post`.`post_id`='$id'";
                        $result=mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result)>0){
                            while($row=mysqli_fetch_assoc($result)){
                        ?>
                        <div class="post-content single-post">
                            <h3><?php echo $row["title"];?></h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    <?php echo $row["category_name"];?>
                                </span>
                                <span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a href='author.php?au_id=<?php echo $row["user_id"]; ?>'><?php echo $row["author"]; ?></a>
                                </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?php echo $row["post_date"];?>
                                </span>
                            </div>
                            <img class="single-feature-image" src="admin/upload/<?php echo $row["post_img"];?>" alt=""/>
                            <p class="description">
                            <?php echo $row["description"];?>
                            </p>
                        </div>
                        <?php
                                }
                            }
                        ?>
                    </div>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
