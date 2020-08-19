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
           <div class="col-md-6" style="  margin-left:-55px; padding-top:-40px; margin-top:-11px; border: 1px solid #e3e3e3;" >
           <div class="row " >
               <div class="col-md-12" style="margin-top:10px;background-color:white; ">
                   <div class="container-fluid" style="margin-left:-15px;">
                        <div class="row" >
                            <h3 class="text-center text-primary">All registered menbers</h3><hr>
                            <?php
                            $get_user = "SELECT * FROM users ORDER BY user_id DESC ";
                             $run_user = mysqli_query($con,$get_user);
                             while($row = mysqli_fetch_array($run_user)){
                                 $user_name = ucfirst($row['user_name']);
                                 $user_image = ucfirst($row['user_image']);
                                 $user_id = $row['user_id'];
                             echo "
                                <a href='user_profile.php?user_id=$user_id'>
                                <img src='user/user_images/$user_image' title='$user_name' style='width:50px; height:50px;'></a>";

                                 } 
                            ?>
                            
                       </div>
                   </div><hr>
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
            CKEDITOR.replace( 'content' );
    </script>
</body>
 </html>
<?php } ?>