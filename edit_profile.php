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
           <div class="col-md-6" style="  margin-left:-55px; padding-top:24px;border: 1px solid #e3e3e3;" >
               <div class="row " >
                   <div class="col-md-12" style="margin-top:-25px;background-color:white; ">
                       <h3 class="text-success text-center">Edit Your Profie here !</h3>
                       <div class="container-fluid" style="margin-left:40px;">
                            <div class="row" >
                                <?php
                                    $user = $_SESSION['user_email'];
                                    $get_user = "SELECT * FROM users WHERE user_email='$user'";
                                    $run_user = mysqli_query($con,$get_user);
                                    $row = mysqli_fetch_array($run_user);
                                    $user_id = $row['user_id'];
                                    $user_name = ucfirst($row['user_name']);
                                    $user_country = ucfirst($row['user_country']);
                                    $last_login = $row['last_login'];
                                    $register_date = $row['register_date'];
                                    $user_image = $row['user_image'];
                                    $user_pass = $row['user_pass'];
                                    $user_email = $row['user_email'];
                                    $user_gender = $row['user_gender'];
                                ?>
                <form class="form-horizontal" style="margin-top:20px;" method="post" action="" enctype="multipart/form-data">
                      <div class="form-group">
                        <label  class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-8">
                          <input type="text" name="u_name" class="form-control" 
                                 value="<?php echo $user_name; ?>" required="required">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label  class="col-sm-2 control-label ">Password</label>
                        <div class="col-sm-8">
                          <input type="password" name="u_pass" class="form-control "   value="<?php echo $user_pass; ?>" required="required">
                        </div>
                      </div>
                      
                      <div class="form-group ">
                        <label  class="col-sm-2 control-label ">Email</label>
                        <div class="col-sm-8 ">
                          <input type="email"  name="u_email" class="form-control"  value="<?php echo $user_email; ?>" required="required">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label  class="col-sm-2 control-label">Country</label>
                        <div class="col-sm-8">
                          <select class="form-control" name="u_country" disabled="disabled" >
                              <option><?php echo $user_country; ?></option>
                              <option>India</option>
                              <option>Nepal</option>
                              <option>United States</option>
                              <option>Japan</option>
                            
                           </select>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label  class="col-sm-2 control-label">Gender</label>
                        <div class="col-sm-8">
                          <select class="form-control" name="u_gender" disabled="disabled">
                              <option><?php echo $user_gender; ?></option>
                              <option>Male</option>
                              <option>Female</option>
                          </select>
                        </div>
                      </div>
                                    
                     <div class="form-group">
                        <label  class="col-sm-2 control-label">Photo</label>
                        <div class="col-sm-8">
                          <input type="file" class="form-control btn-warning" name="u_image" required="required" >
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label  class="col-sm-2 control-label">Birthday</label>
                        <div class="col-sm-8">
                          <input type="date" class="form-control" name="u_birthday"  >
                        </div>
                      </div>
                      <div class="col-md-5"></div>
                      <button type="submit" name="update" class="btn btn-primary col-md-10 ">Update your Profile</button>
                    </form>
                    <?php updateUser() ?>
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
 </html>
<?php } ?>