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
               </div>
               <div class="col-md-12" style="margin-top:-25px;background-color:white; ">
                   <h5 class="text-success"></h5>
                   <div class="container-fluid" style="margin-left:-15px;">
                        <div class="row" >
                            <?php
                            
                            if(isset($_GET['u_id'])){
                                $u_id = $_GET['u_id'];
                            }
    
                            $get_posts = "SELECT * FROM posts WHERE user_id='$u_id' LIMIT 20";
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
                            <div class='col-md-7'></div>
                            <div class='col-md-5 navbar-right'>
                            <a href='delete_post.php?post_id=$post_id'>
                            <button type='submit' class='btn btn-danger btn-xs' name='search'>Delete</button></a>
                            <a href='edit_post.php?post_id=$post_id'>
                            <button type='submit' class='btn btn-warning btn-xs' name='search'>Edit</button></a>
                            <a href='single.php?post_id=$post_id'>
                            <button type='submit' class='btn btn-success btn-xs' name='search'>View</button></a></div>
                            </div><hr>";
                                include('delete_post.php');
                            }
                        ?>
                       </div>
                   </div>
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
    <script>
            CKEDITOR.replace( 'editor1' );
        </script>
</body>
 </html>
<?php } ?>