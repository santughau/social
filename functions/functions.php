<?php
$con = mysqli_connect("localhost","root","","social") or die ("connection was not established"); 

function getTopics(){
         global $con;
         $get_topics = "SELECT * FROM topics ORDER BY topic_title asc";
         $run_topics = mysqli_query($con,$get_topics);
         while($row=mysqli_fetch_array($run_topics)){
             $topic_id = $row['topic_id'];
             $topic_title = $row['topic_title'];
             echo "<option value='$topic_id'>$topic_title</option>";
         }
    
}


function getNavTopics(){
        global $con;
        $get_topics = "SELECT * FROM topics ORDER BY topic_title asc";
        $run_topics = mysqli_query($con,$get_topics);
        while($row=mysqli_fetch_array($run_topics)){
             $topic_id = $row['topic_id'];
             $topic_title = $row['topic_title'];
             echo "<li><a href='topic.php?topic=$topic_id'>$topic_title</a></li>";
        }
}

function getUserName(){
        global $con;
        $user = $_SESSION['user_email'];
             $get_user = "SELECT * FROM users WHERE user_email='$user'";
             $run_user = mysqli_query($con,$get_user);
             $row = mysqli_fetch_array($run_user);
             $user_name = ucfirst($row['user_name']);
             echo "$user_name ";
}

function leftSide (){
                    global $con;
                    global $count_msg;
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
    
                    $user_posts = "SELECT * FROM posts where user_id='$user_id'";
                    $run_posts = mysqli_query($con,$user_posts);
                    $posts = mysqli_num_rows($run_posts);
    
                    $sel_message = "SELECT * FROM messages where receiver='$user_id' AND status='unread'";
                    $run_message = mysqli_query($con,$sel_message);
                    $count_msg= mysqli_num_rows($run_message);
               echo "
               <a href='home.php'>
               <img src='user/user_images/$user_image' class='img-responsive img-rounded' style='padding-top:25px;'></a><br>
               <p class='text-left'><strong class='text-primary'>Name</strong><br>$user_name</p>
               <p class='text-left'><strong class='text-primary'>Country</strong><br>$user_country</p>
               <p class='text-left'><strong class='text-primary'>Last Login</strong><br>$last_login</p>
               <p class='text-left'><strong class='text-primary'>Member Since</strong><br>$register_date</p>
               <p class='text-left'><a href='my_messages.php?u_id=$user_id'>Messages</a> <span class='badge'>$count_msg</span></p>
               <p class='text-left'><a href='my_posts.php?u_id=$user_id'>My Posts</a> <span class='badge'>$posts</span></p>
               <p class='text-left'><a href='edit_profile.php?u_id=$user_id'>Edit My Account</a> </p>
               <p class='text-left'><a href='logout.php' class='text-danger'>Log Out</a> </p>";
}


function insertPost(){
        if(isset($_POST['sub'])){
            global $con;
            global $user_id;
            $title = addslashes($_POST['title']);
            $content = addslashes($_POST['content']);
            $tpoic = $_POST['topic'];
            
            if($content==''){
                echo "<script>alert('Enter Content')</script>";
                echo "<script>window.open('home.php','_self')</script>";
                exit();
            }
            
            $insert = "INSERT INTO posts (user_id,topic_id,post_title,post_content,post_date)
                VALUES ('$user_id','$tpoic','$title','$content',NOW())";
            $run = mysqli_query($con,$insert);
                if($run){
                   echo "<h3>Post SUbmitted</h3>"; 
                   echo "<script>window.open('home.php','_self')</script>";
                    
                    $update = "UPDATE users set posts='yes' WHERE user_id='user_id'";
                    $run_update = mysqli_query($con,$update);
                }
        }
}


function getreply(){
    global $con;
    global $post_id;
    global $user_id;
    global $user_name;
                 
    if(isset($_POST['reply'])){
        $comment = $_POST['comment'];
        
        $user = $_SESSION['user_email'];
                    $get_user = "SELECT * FROM users WHERE user_email='$user'";
                    $run_user = mysqli_query($con,$get_user);
                    $row = mysqli_fetch_array($run_user);
                    $user_id = $row['user_id'];
                    $user_name = $row['user_name'];
                    $user_image = $row['user_image'];
        
        $insert = "INSERT INTO comments (post_id,user_id,comment,comment_author,user_photo,date)
        VALUES ('$post_id','$user_id','$comment','$user_name','$user_image',NOW())";
        $run = mysqli_query($con,$insert);
        echo "<script>alert('Saved')</script>";
        echo "<script>window.open('single.php?post_id=$post_id','_self')</script>";
    }
     
}


function regUser(){
            global $con;
             $get_user = "SELECT * FROM users ORDER BY user_id DESC LIMIT 16";
             $run_user = mysqli_query($con,$get_user);
             while($row = mysqli_fetch_array($run_user)){
                 $user_name = ucfirst($row['user_name']);
                 $user_image = ucfirst($row['user_image']);
                 $user_id = $row['user_id'];
             echo "
                <a href='user_profile.php?user_id=$user_id'>
                <img src='user/user_images/$user_image' title='$user_name' style='width:50px; height:50px;'></a>";
               
                 }
}


function result(){
   
        global $con;
        if(isset($_GET['user_query'])){
            $search_term = $_GET['user_query'];
                                   
        }
    
         $get_posts = "SELECT * FROM posts WHERE post_title like '%$search_term%' OR post_content like '%$search_term%' ORDER BY 1 DESC LIMIT 50  ";
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
}

function getUserId(){
        global $con;
            $user = $_SESSION['user_email'];
             $get_user = "SELECT * FROM users WHERE user_email='$user'";
             $run_user = mysqli_query($con,$get_user);
             $row = mysqli_fetch_array($run_user);
             $user_name = ucfirst($row['user_name']);
             $user_id = $row['user_id'];
             echo "$user_id ";
}

function get_option_list($table,$col_id,$col_value){
  global $con;
    $get_option = "select * FROM $table ORDER BY $col_value ASC";
    $run_option = mysqli_query($con,$get_option);
     while ($row_option = mysqli_fetch_array($run_option)){
		$option_id = $row_option[$col_id];
		$option_title = $row_option[$col_value];
		echo "<option value='$option_id'>$option_title</option>";
		
		}
}

function updateUser(){
        global $con;
			$user = $_SESSION['user_email'];
             $get_user = "SELECT * FROM users WHERE user_email='$user'";
             $run_user = mysqli_query($con,$get_user);
             $row = mysqli_fetch_array($run_user);
             $user_name = ucfirst($row['user_name']);
             $user_id = $row['user_id'];
            
        if(isset($_POST['update'])){
            $u_name = $_POST['u_name'];
            $u_pass = $_POST['u_pass'];
            $u_email = $_POST['u_email'];
            $u_image = $_FILES['u_image']['name'];
            $image_tmp = $_FILES['u_image']['tmp_name'];
            
            move_uploaded_file($image_tmp,"user/user_images/$u_image");
            
            $update = "UPDATE users SET user_name='$u_name', user_pass='$u_pass', user_email='$u_email', user_image='$u_image' WHERE user_id='$user_id'";
            
            $run = mysqli_query($con,$update);
            
            if($run){
                echo "<script>alert('Your Profile is updated.')</script>";
                echo "<script>window.open('home.php','_self')</script>";
            }

        }
}


function update_post(){
   
        global $con;
        global $get_id;
        if(isset($_POST['update_post'])){
            $title = $_POST['title'];
            $content = $_POST['content'];
            $topic = $_POST['topic'];
            
            $update_post = "UPDATE posts SET post_title='$title', post_content='$content', topic_id='$topic'  WHERE post_id='$get_id'";
            
            $runa = mysqli_query($con,$update_post);
            
            if($runa){
                echo "<script>alert('Your post is updated.')</script>";
                echo "<script>window.open('home.php','_self')</script>";
            }
        }
}

function insertMessage(){
        if(isset($_POST['message'])){
            global $con;
            global $user_id;
            global $name;
             $title = addslashes($_POST['title']);
            $content = addslashes($_POST['content']);
            
              $user = $_SESSION['user_email'];
             $get_user = "SELECT * FROM users WHERE user_email='$user'";
             $run_user = mysqli_query($con,$get_user);
             $row = mysqli_fetch_array($run_user);
             $user_name = ucfirst($row['user_name']);
             $uid = $row['user_id'];
             
            
            if($content==''){
                echo "<script>alert('Enter Content')</script>";
                echo "<script>window.open('home.php','_self')</script>";
                exit();
            }
            
            $insert = "INSERT INTO messages (sender,receiver,msg_sub,msg_topic,reply,status,msg_date)
                VALUES ('$uid','$user_id','$title','$content','no_reply','unread',NOW())";
            $run = mysqli_query($con,$insert);
                if($run){
                   echo "<script>alert('Your Message is submitted to $name.')</script>"; 
 
                }
        }
}


?>