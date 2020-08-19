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
                   <div class="col-md-12" style="margin-top:-25px; background-color:white;"></div>

                   <div class="col-md-12" style="margin-top:-25px;background-color:white;">
                       <h5 class="text-success"></h5>
                       <div class="container-fluid">
                            <div class="row" >
                                <?php
                                    global $con;
                                    $user_id = $_GET['user_id'];
                                    $select = "SELECT * FROM users WHERE user_id='$user_id'";
                                    $run = mysqli_query($con,$select);
                                    $row = mysqli_fetch_array($run);

                                    $id= $row['user_id'];
                                    $image= $row['user_image'];
                                    $name= ucfirst($row['user_name']);
                                    $country= $row['user_country'];
                                    $gender= $row['user_gender'];
                                    $last_login= $row['last_login'];
                                    $register_date= $row['register_date'];
                                    $birthday_date= $row['user_b_day'];
                                    $email= $row['user_email'];

                                if($gender=='male'){
                                    $msg= "Send him a message";
                                }
                                else{
                                $msg= "Send her a message";
                                }

                               echo "<div class='col-md-12' style='background-color:white;'>
                                <h3 class='text-center text-info'>Info About this User</h3><hr>
                                <div class='col-md-8'>
                                <p class='text-left'><strong class='text-primary'>Name :</strong>  $name</p>
                                <p class='text-left'><strong class='text-primary'>Gender :</strong>  $gender</p>
                                <p class='text-left'><strong class='text-primary'>Country :</strong>  $country</p>
                                <p class='text-left'><strong class='text-primary'>Birthday :</strong>  $birthday_date</p>
                                <p class='text-left'><strong class='text-primary'>Last Login :</strong>  $last_login</p>
                                <p class='text-left'><strong class='text-primary'>Member Since :</strong>  $register_date</p>
                                <p class='text-left'><strong class='text-primary'>E-mail :</strong>  $email</p>
                                </div>
                                <div class='col-md-4'>
                                    <img src='user/user_images/$image' class='img-responsive img-thumbnail' style='height:200px;'>
                                </div>
                              </div>
                           </div><hr>
                           <a href='message.php?user_id=$id'>
                           <button type='submit' class='btn btn-success' name='search'>Send her a Message</button><br></a><hr>";?>

                           <div class='row'>
                           <div class='col-md-12' style='margin-bottom:10px;'>
                               <h4 class='text-center text-info'>Recently Joined Members</h4><hr>
                               <?php
                               $select = "SELECT * FROM users LIMIT 50";
                                    $run = mysqli_query($con,$select);
                                    while ($row = mysqli_fetch_array($run)){

                                    $id= $row['user_id'];
                                    $image= $row['user_image'];
                                    $name= $row['user_name'];

                                echo "<a href='user_profile.php?user_id=$id'>
                                    <img src='user/user_images/$image' title='$name' style='width:50px; height:50px;'></a> ";
                                }?>
                           </div>
                           </div><hr>
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
</div>
    
</body>
 </html>
<?php } ?>