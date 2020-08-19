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
           <div class="col-md-6" style="  margin-left:-55px; padding-top:25px; border: 1px solid #e3e3e3; " >
           <div class="row " >
               <div class="col-md-12" style="margin-top:-25px;background-color:white;">
                   <div class="container-fluid">
                        <div class="row">
                            <?php 
                                global $con;
                                $user_id = $_GET['user_id'];
    
                                $select = "SELECT * FROM users WHERE user_id='$user_id'";
                                $run = mysqli_query($con,$select);
                                $row = mysqli_fetch_array($run);
                                
                                
                                $image= $row['user_image'];
                                $name= ucfirst($row['user_name']);
                                
                            ?>
                            
                        <h4 class="col-md-10">Write a message to <strong class="text-primary"><?php echo $name; ?></strong></h4>
                            <a href="user_profile.php?user_id=<?php echo $user_id; ?>">
                                <img src="user/user_images/<?php echo $image; ?>" class="col-md-2 img-thumbnail" style="height:100px;">
                            </a>
                        </div><hr>
                        <form method="post" action="message.php?user_id=<?php echo $user_id; ?>" enctype="multipart/form-data">
                      <div class="form-group">
                        <input type="text" class="form-control" name="title" placeholder="Write Subject here" required="required"><br>
                          
                        <textarea class="form-control" name="content" rows="3" placeholder="Write Message here"></textarea><br>
                      </div>
                      <button type="submit" class="btn btn-success btn-block" name="message">Send Message</button>
                    </form><br><hr>
                       <?php insertMessage() ?>     
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
    
</body>
    <script>
            CKEDITOR.replace( 'content' );
    </script>
 </html>
<?php } ?>