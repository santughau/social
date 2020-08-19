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
                        <div class="row" >
                        <h3 class="text-center text-primary">My unread Messages</h3>
                        <table class="table table-striped table-bordered table-condensed table-responsive">
                            <tr class="warning">
                                <td>Sender</td>
                                <td>Subject</td>
                                <td>Date</td>
                                <td>Reply</td>
                            </tr>
                            
                                <?php 
                                if(isset($_GET['u_id'])){
                                    $user_id = $_GET['u_id'];
                                   
                                    }
                                $sel_message = "SELECT * FROM messages where receiver='$user_id' AND status='unread'";
                                $run_message = mysqli_query($con,$sel_message);
                                $count_msg= mysqli_num_rows($run_message);
                                while($row_msg=mysqli_fetch_array($run_message)){
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
                                ?>
                                <tr>
                                <td><?php echo $sender_name; ?></td>
                                <td><a href="message_detail.php?msg_id=<?php echo $msg_id; ?>"><?php echo $msg_sub; ?></a></td>
                                <td><?php echo $msg_date; ?></td>
                                <td><a href="message.php?user_id=<?php echo $msg_sender; ?>">Reply</a></td>
                            </tr>
                            <?php } ?>
                        </table>
                       
                   </div>
                       <a href="view_messages.php?u_id=<?php echo $user_id; ?>">
                       <button class="btn btn-primary navbar-right">View All Messages</button></a>
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