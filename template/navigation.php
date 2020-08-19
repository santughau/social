<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="home.php">
           <img alt="Brand" src="images/logo1.png" class="img-responsive" style="height:25px; border-radius:5px;">
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li ><a href="home.php"><i class="fa fa-home" aria-hidden="true"></i>
 Home</a></li>
        <li><a href="member.php"><i class="fa fa-heart" aria-hidden="true"></i>
 Member</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-circle" aria-hidden="true"></i>
 Topic <span class="caret"></span></a>
              <ul class="dropdown-menu">
           <?php getNavTopics() ?>
            </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left" method="get" action="result.php" >
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search a topic" name="user_query" >
        </div>
        <button type="submit" class="btn btn-default" name="search">Submit</button>
      </form>
        
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i>
                <?php getUserName() ?>               
              <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="view_profile.php?u_id=<?php getUserId() ?>"><i class="fa fa-user-circle" aria-hidden="true"></i>
 My Profile</a></li>
            <li><a href="edit_profile.php?u_id=<?php getUserId() ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
 Edit Profile</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>
 LogOut</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>