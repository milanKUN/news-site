<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php
                include "config.php";
                if(isset($_GET["search"])){
                $search=$_GET["search"];
                
                }
                else{
                    $search="";
                }
                // echo $search;
                //     if(isset($_GET["spage"])){
                //         $spage=$_GET["spage"];
                //   }else{
                //     $spage=1;
                //   }
                
                //   $limit=2;
                //   $ofset=($spage-1)*$limit;
                    $sql="SELECT `post`.`post_id`, `post`.`post_img`,`post`.`author`,`post`.`post_date`,`post`.`category`,`post`.`description`,`post`.`title`,`category`.`category_name`,`user`.`first_name`,`user`.`user_id` FROM `post` LEFT JOIN `category` ON `post`.`category` = `category`.`category_id` LEFT JOIN `user` ON `post`.`author` =`user`.`username`
                    WHERE `post`.`title` LIKE '%$search%' OR `post`.`description` LIKE '%$search%'
                    ORDER BY `post`.`post_id` DESC "; 
                    $result=mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result)>0){
                        while($row=mysqli_fetch_assoc($result)){
                        
                ?>
                <!-- post-container -->
                <div class="post-container">
                  <h2 class="page-heading">Search :<?php echo $search;?></h2>
                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?id=<?php echo $row['post_id'];?>"><img src="admin/upload/<?php echo $row["post_img"]; ?>" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                <h3><a href="single.php?id=<?php echo $row['post_id'];?>"><?php echo $row["title"]; ?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?cid=<?php echo $row['category'];?>'><?php echo $row['category_name'];?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php?au_id=<?php echo $row["user_id"]; ?>'><?php echo $row["author"]; ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $row["post_date"]; ?>
                                        </span>
                                    </div>
                                    <p class="description">
                                    <?php echo substr($row["description"],0,130)."...."; ?>
                                    </p>
                                    <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id'];?>'>read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- /post-container -->
                <?php
                        }
                    }else{
                        echo "<h2><b> '$search' NO RESULT FOUND </b></h2>";
                    }
                
                // if(isset($_GET["search"])){
                // //     $search=$_GET["search"];
                // $sql1="SELECT * FROM `post`WHERE `post`.`title` LIKE '%$search%' OR `POST`.`description` LIKE '%$search%'";
                // $result1=mysqli_query($conn,$sql1);
                // if(mysqli_num_rows($result1)>0){
                // $total_record= mysqli_num_rows($result1);
                // }else{
                //     $total_record="0"; 
                // }
                // // $limit=2;
                // $total_page=ceil($total_record/$limit);
                //     echo "<ul class='pagination admin-pagination'>";
                //     if($spage>1){
                //       echo '<li class=""><a href="search.php?page='.($spage-1).'">Prev</a></li>';
                //     }
                // for($i=1;$i<=$total_page;$i++){
                //         if($i==$spage){
                //           $active="active";
                //         }else{
                //           $active="";
                //         }
                //         echo '<li class="'.$active.'"><a href="search.php?spage='.$i.'">'.$i.'</a></li>';
                // }
                // if($spage<$total_page){
                //   echo '<li class=""><a href="search.php?spage='.($spage+1).'">Next</a></li>';
                // }
                //     echo "</ul>";
            
        // }
                ?>
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
