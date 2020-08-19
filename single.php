<?php session_start();
include("includes/connection.php");
include("functions/functions.php");
if(!isset($_SESSION['user_email'])){
    header("location:index.php");
}
else{
?>
<!doctype html>
<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width,initial-state=1"/>
        <title>Welcome User</title>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="css/font-awesome.css" rel="stylesheet" type="text/css" />
        <link href="css/default.css" rel="stylesheet" type="text/css" />
        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="ckeditor/ckeditor.js"></script>
        <script src="js/bootstrap.js"></script>
</head>
<body style="background-color: #EEEDED;">
 <?php include("template/navigation.php"); ?>
   <!----ENd nAVBAR hERE-->
   <div class="container-fluid">
       <div class="row" style="margin-top:-20px;">
           <div class="col-md-2" style="background-color:white; border: 1px solid #e3e3e3;" >
               <?php leftSide () ?>
           </div>
           <div class="col-md-1"></div>
           <div class="col-md-6" style="  margin-left:-55px; padding-top:-10px; border: 1px solid #e3e3e3;" >
           <div class="row " >
               <div class="col-md-12" style="margin-top:-25px; background-color:white;">
                   <?php
                   $user = $_SESSION['user_email'];
                    $get_user = "SELECT * FROM users WHERE user_email='$user'";
                    $run_user = mysqli_query($con,$get_user);
                    $row = mysqli_fetch_array($run_user);
                    $user_id = $row['user_id'];
                    ?>
               </div>
               <div class="col-md-12" style="margin-top:10px;background-color:white; "></div>
               <div class="col-md-12" style="margin-top:-10px;background-color:white; ">
                   <h5 class="text-success"></h5>
                   <div class="container-fluid" style="margin-left:-15px;">
                        <div class="row" >
                            <?php
                            if(isset($_GET['post_id'])){
                                $get_id = $_GET['post_id'];
                                $get_posts = "SELECT * FROM posts WHERE post_id ='$get_id'";
                                $run_posts = mysqli_query($con,$get_posts);
                                $row_posts=mysqli_fetch_array($run_posts);
                                
                                $post_id = $row_posts['post_id'];
                                $user_id = $row_posts['user_id'];
                                $topic_id = $row_posts['topic_id'];
                                $post_title = ucfirst($row_posts['post_title']);
                                $post_content = ucfirst($row_posts['post_content']);
                                $post_date = $row_posts['post_date'];
                                
                                //getting user information
                                
                                $user = "SELECT * FROM users WHERE user_id='$user_id' AND posts = 'yes'";
                                $run_user = mysqli_query($con,$user);
                                $row_user = mysqli_fetch_array($run_user);
                                $user_name = ucfirst($row_user['user_name']);
                                $user_image = $row_user['user_image'];
                                
                                
                            echo "<div class='col-md-2'>
                            <img src='user/user_images/$user_image' class='img-responsive' style='height:50px; width:50px;'><br>
                            </div> 
                            <div class='col-md-10' style='margin-left:-25px;'>
                                <p class='text-primary'><strong><a href='user_profile.php?user_id=$user_id'>$user_name</a></strong><small class='navbar-right'> $post_date</small></p><br>
                                <p class='text-danger text-justify' style='margin-top:-30px;'><strong>$post_title</strong></p><br>
                             </div> 
                            <div class='col-md-12 text-justify' style='margin-top:-20px; margin-bottom:10px;'>$post_content<br>
                            </div>";
                            }
                            ?>
                       </div>
                                           
                   </div>
               </div>
<!-------------------------------------------------------------------------------------->
               <div class="col-md-12" style="margin-top:20px;background-color:white; ">
                   <h5 class="text-success"></h5>
                   <div class="container-fluid" style="margin-left:-15px;">
                        <div class="row" >
                            <?php
                                $record_per_page = 2;
                                $page = '';
                                if (isset($_GET["page"]))
                                {
                                $page = $_GET["page"];
                                }
                                else 
                                {
                                $page = 1;	
                                }
                                $start_from = ($page-1)*$record_per_page;
     
                                $get_id = $_GET['post_id'];
                                $get_com = "SELECT * FROM comments WHERE post_id ='$get_id' ORDER BY 1 DESC LIMIT $start_from, $record_per_page";
                                $run_com = mysqli_query($con,$get_com);
                                while($row=mysqli_fetch_array($run_com)){
                                $com = $row['comment'];
                                $com_name = $row['comment_author'];
                                $date = $row['date'];
                                $user_image = $row['user_photo'];
                                $user_id = $row['user_id'];
                                
                            echo "<div class='col-md-2'>
                            <a href='user_profile.php?user_id=$user_id'>
                            <img src='user/user_images/$user_image' class='img-responsive' style='height:50px; width:50px;'></a><br>
                            </div> 
                            <div class='col-md-10' style='margin-left:-25px;'>
                                <p class='text-primary'><strong><a href='user_profile.php?user_id=$user_id'>$com_name</a></strong><small class='navbar-right'><i class = 'text-danger'>Replied On</i> $date</small></p><br>
                                
                             </div> 
                            <div class='col-md-12 text-justify' style='margin-top:-20px; margin-bottom:10px;'><p>$com</p><br><hr>
                            </div>";
                                }
                            ?>
                       </div>
                                           
                   </div>
               </div>
               
               
               <div class="col-md-12 text-center">
                    <nav aria-label="Page navigation">
                      <ul class="pagination">
                          <?php 
                            global $get_id;   
                            global $post_id; 
							$get_id = $_GET['post_id'];
                            $page_query = "select * from comments WHERE post_id ='$get_id' ";
                            $page_result = mysqli_query($con,$page_query);
                            $total_records = mysqli_num_rows($page_result);
                            $total_pages = ceil($total_records/$record_per_page);
                            for ($i=1;$i<=$total_pages; $i++)
                            {
                                echo "<li><a href='single.php?post_id=".$get_id."&page=".$i."'>".$i."</a></li>";
                            }
                            ?>
                      </ul>
                    </nav>
               </div><br>
<!--------------------------------------------------------------------------------------->               
               <div class="col-md-12" style="margin-top:-5px; background-color:white;">
                       <form method="post" action="">
                           <h4>Replay Your Comment</h4>
                          <div class="form-group">
                            <br><br>
                            <textarea class="form-control" name="comment" rows="3"></textarea><br>
                          </div>
                          <button type="submit" class="btn btn-primary btn-block" name="reply">Reply to Post</button>
                        </form><br><hr>
                   <?php getreply() ?>
                 </div>
           </div>
           </div>
           <div class="col-md-1"></div>
           <div class="col-md-3" style="background-color:white;  margin-left:-55px; padding-top:25px; border: 1px solid #e3e3e3;">
               <h4 class="text-info text-center" style="margin-top:-10px;">Recent registered Users</h4><hr>
               <div class="row">
                    <div class="col-md-12">
                        <?php regUser() ?><hr>
                     </div>   
                </div>
           </div>
       </div>
   </div>
</body>
    <script>
            CKEDITOR.replace( 'comment' );
    </script>
 </html>
<?php } ?>