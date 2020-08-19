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
           <div class="col-md-6" style="  margin-left:-55px; padding-top:25px; border: 1px solid #e3e3e3;" >
           <div class="row " >
               <div class="col-md-12" style="margin-top:-25px;background-color:white; height:500px;">
                   <div class="container-fluid">
                        <div class="row">
                        <h3 class="text-center text-primary">Read in details</h3><hr>
                            <?php 
                                if(isset($_GET['msg_id'])){
                                    $msg_id = $_GET['msg_id'];
                                   
                                    }
                                $sel_message = "SELECT * FROM messages where msg_id='$msg_id'";
                                $run_message = mysqli_query($con,$sel_message);
                                
                                $row_msg=mysqli_fetch_array($run_message);
                                    $msg_id = $row_msg['msg_id'];
                                    $msg_sender = $row_msg['sender'];
                                    $msg_receiver = $row_msg['receiver'];
                                    $msg_sub = ucfirst($row_msg['msg_sub']);
                                    $msg_topic = ucfirst($row_msg['msg_topic']);
                                    $msg_reply = $row_msg['reply'];
                                    $msg_status = $row_msg['status'];
                                    $msg_date = $row_msg['msg_date'];
                                    
                                    $get_sender = "SELECT * FROM users WHERE user_id='$msg_sender'";
                                    $run_sender = mysqli_query($con,$get_sender);
                                    $row = mysqli_fetch_array($run_sender);
                                    $sender_name = ucfirst($row['user_name']);
                                    $sender_image = $row['user_image'];
        
                                    $user = $_SESSION['user_email'];
                                     $get_user = "SELECT * FROM users WHERE user_email='$user'";
                                     $run_user = mysqli_query($con,$get_user);
                                     $row = mysqli_fetch_array($run_user);
                                     $user_name = ucfirst($row['user_name']);
                                     $user_id = $row['user_id'];
                                    
                                     if(isset($_GET['msg_id'])){
                                         $msg_id = $_GET['msg_id'];
                                      }  
                                    $update_status = "UPDATE messages SET status='read'   WHERE msg_id='$msg_id'";
            
                                    $runa = mysqli_query($con,$update_status);
                                
                                ?>
                        <div class="col-md-8 text-justify text-danger"><?php echo $msg_sub; ?></div>
                        <div class="col-md-4 navbar-right">
                            <a href="user_profile.php?user_id=<?php echo $msg_sender; ?>">
                                <img class="img-thumbnail" src="user/user_images/<?php echo $sender_image; ?>" title="<?php echo $sender_name; ?>" style="height:75px;"></a>
                        </div><br><hr><br>
                        <div class="col-md-12 "></div><hr>
                        <div class="col-md-12 well"><?php echo $msg_topic; ?></div>
                        <a href="my_messages.php?u_id=<?php echo $user_id; ?>">
                        <button class="btn btn-primary navbar-right">Back to messages</button>
                        </a>
                                

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
    
</body>
    <script>
            CKEDITOR.replace( 'content' );
    </script>
 </html>
<?php } ?>