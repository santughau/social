
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
<body style="background:#EEEDED">
 <?php include("template/navigation.php"); ?>
   <!----ENd nAVBAR hERE-->
   <div class="container-fluid">
       <div class="row" style="margin-top:-20px;">
           <div class="col-md-2" style="background-color:white; border: 1px solid #e3e3e3;" >
               <?php leftSide () ?>
           </div>
           <div class="col-md-1"></div>
           <div class="col-md-6" style="  margin-left:-55px; padding-top:25px;border: 1px solid #e3e3e3;" >
           <div class="row " >
               <div class="col-md-12" style="margin-top:-25px; background-color:white;">
                   <?php
                   $user = $_SESSION['user_email'];
                    $get_user = "SELECT * FROM users WHERE user_email='$user'";
                    $run_user = mysqli_query($con,$get_user);
                    $row = mysqli_fetch_array($run_user);
                    $user_id = $row['user_id'];
    
                    if(isset($_GET['post_id'])){
                        
                        $get_id = $_GET['post_id'];
                        
                        $get_post = "SELECT * FROM posts where post_id='$get_id'";
                        $run_post = mysqli_query($con,$get_post);
                        $row = mysqli_fetch_array($run_post);
                        
                        $post_title = $row['post_title'];
                        $post_con = $row['post_content'];
                        
                    }
                    ?>
                   <form method="post" action="" enctype="multipart/form-data">
                      <div class="form-group">
                        <h5>Edit your post here !</h5>
                        <input type="text" class="form-control" name="title" value="<?php echo  $post_title; ?>" required="required"><br>
                        <textarea class="form-control" name="content" rows="3"><?php echo $post_con; ?></textarea><br>
                        <select class="form-control" name="topic">
                          <option>Select Topic</option>
                         <?php getTopics() ?>
                        </select>
                      </div>
                      <button type="submit" class="btn btn-primary btn-block" name="update_post">update Post</button>
                    </form>
                   <?php   update_post()  ?>
               </div>
               <div class="col-md-12" style="margin-top:10px;background-color:white; "></div>
               <div class="col-md-12" style="margin-top:10px;background-color:white; "></div>
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
            CKEDITOR.replace( 'content' );
        </script>
</body>
 </html>
<?php } ?>