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
<body style="background:#EEEDED;">
 <?php include("template/navigation.php"); ?>
   <!----ENd nAVBAR hERE-->
   <div class="container-fluid">
       <div class="row" style="margin-top:-20px;">
           <div class="col-md-2" style="background-color:white; border: 1px solid #e3e3e3;" >
               <?php leftSide () ?>
           </div>
           <div class="col-md-1"></div>
           <div class="col-md-6" style="  margin-left:-55px; padding-top:25px; border: 1px solid #e3e3e3;" >
           <div class="row " >
               <div class="col-md-12" style="margin-top:-25px; background-color:white;">
                   <?php
                   $user = $_SESSION['user_email'];
                    $get_user = "SELECT * FROM users WHERE user_email='$user'";
                    $run_user = mysqli_query($con,$get_user);
                    $row = mysqli_fetch_array($run_user);
                    $user_id = $row['user_id'];
                    ?>
                   <form method="post" action="home.php?id=<?php echo $user_id; ?>" enctype="multipart/form-data">
                      <div class="form-group">
                        <h5>Write your post here !</h5>
                        <input type="text" class="form-control" name="title" placeholder="Write topic title here" required="required"><br>
                        <textarea class="form-control" name="content" rows="3"></textarea><br>
                        <select class="form-control" name="topic">
                          <option>Select Topic</option>
                         <?php getTopics() ?>
                        </select>
                      </div>
                      <button type="submit" class="btn btn-primary btn-block" name="sub">Post</button>
                    </form>
                   <?php insertPost() ?>
               </div>
               <div class="col-md-12" style="margin-top:10px;background-color:white; "><h5 class="text-success"><strong>Recent Discussions  !</strong></h5></div>
               <div class="col-md-12" style="margin-top:10px;background-color:white; ">
                   <h5 class="text-success"></h5>
                   <div class="container-fluid" style="margin-left:-15px;">
                        <div class="row" >
                            <?php
                            $record_per_page = 5;
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
                            $get_posts = "SELECT * FROM posts ORDER BY post_id DESC LIMIT $start_from, $record_per_page";
                            $run_posts = mysqli_query($con,$get_posts);
                            while($row_posts=mysqli_fetch_array($run_posts)){
                                
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
                            <a href='user_profile.php?user_id=$user_id'>
                            <img src='user/user_images/$user_image' class='img-responsive' style='height:50px; width:50px;'></a><br>
                            </div> 
                            <div class='col-md-10' style='margin-left:-25px;'>
                                <p class='text-primary'><strong><a href='user_profile.php?user_id=$user_id'>$user_name</a></strong><small class='navbar-right'> $post_date</small></p><br>
                                <p class='text-danger text-justify' style='margin-top:-30px;'><strong>$post_title</strong></p><br>
                             </div> 
                            <div class='col-md-12 text-justify' style='margin-top:-20px; margin-bottom:10px;'>$post_content<br>
                            <a href='single.php?post_id=$post_id'>
                            <button type='submit' class='btn btn-success btn-xs navbar-right' name='search'>Reply</button></a>
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
                            $page_query = "select * from posts ORDER BY post_id DESC ";
                            $page_result = mysqli_query($con,$page_query);
                            $total_records = mysqli_num_rows($page_result);
                            $total_pages = ceil($total_records/$record_per_page);
                            for ($i=1;$i<=$total_pages; $i++)
                            {
                                echo "<li><a href='home.php?page=".$i."'>".$i."</a></li>";
                            }
                            ?>
                      </ul>
                    </nav>
               </div>
           </div>
           </div>
           <div class="col-md-1"></div>
           <div class="col-md-3" style="background-color:white; margin-left:-55px; padding-top:25px; border: 1px solid #e3e3e3;">
               <h4 class="text-info text-center" style="margin-top:-10px;">Recent registered Users</h4><hr>
               <div class="row">
                    <div class="col-md-12">
                        <?php regUser() ?><hr>
                     </div>   
                </div>
           </div>
       </div>
   </div>
    <script>
            CKEDITOR.replace( 'content' );
    </script>
</body>
 </html>
<?php } ?>