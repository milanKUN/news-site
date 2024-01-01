<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="search.php" method ="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger" >Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Recent Posts</h4>
        
        <?php

                    include "config.php";
                //     if(isset($_GET["page"])){
                //         $page=$_GET["page"];
                //   }else{
                //     $page=1;
                //   }
                //   $limit=2;
                //   $ofset=($page-1)*$limit;
                    $sql="SELECT `post`.`post_id`, `post`.`post_img`,`post`.`author`,`post`.`post_date`,`post`.`category`,`post`.`description`,`post`.`title`,`category`.`category_name`,`user`.`first_name`,`user`.`user_id` FROM `post` LEFT JOIN `category` ON `post`.`category` = `category`.`category_id` LEFT JOIN `user` ON `post`.`author` =`user`.`username` ORDER BY `post`.`post_id` DESC
                    LIMIT 2 ";
                    $result=mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result)>0){
                        while($row=mysqli_fetch_assoc($result)){
                    
                    ?>
                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?id=<?php echo $row['post_id'];?>"><img src="admin/upload/<?php echo $row["post_img"]; ?>" alt="" /></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href="single.php?id=<?php echo $row['post_id'];?>"><?php echo $row["title"]; ?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?cid=<?php echo $row['category'];?>'><?php echo $row["category_name"]; ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php?au_id=<?php echo $row["user_id"]; ?>'><?php echo $row["author"]; ?>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $row["post_date"]; ?>
                                        </span>
                                    </div>
                                    <p class="description">
                                    <?php echo substr($row["description"],0,130,)."......"; ?>
                                    </p>
                            <a class='read-more pull-right' href="single.php?id=<?php echo $row['post_id'];?>">read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                        <?php
                        }
                    }
                    ?>
        
        
       
        </div>
    </div>
    <!-- /recent posts box -->
</div>
