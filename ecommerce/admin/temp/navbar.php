<?php @session_start(); ?>

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <a class="navbar-brand" href="dashboard.php"> <i class="fa fa-home"></i> Home</a>
    </div>
     
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
       <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['username']; ?> <span class="caret"></span></a>
            <ul class="dropdown-menu navbar-right">
              <li><a href="?do=edit&id=<?php echo $_SESSION['id'] ?>">Edit Profile</a></li>
              <li><a href="#">Setting</a></li>
              <li><a href="temp/logout.php">Log Out</a></li>
            </ul>
          </li>
        </ul>
      <ul class="nav navbar-nav">
        <li class=""><a href="#"><i class="fa fa-cloud"></i> Logs <span class="sr-only">(current)</span></a></li>
        <li><a href="Categoires.php"><i class="fa fa-shopping-cart"></i> Categoires</a></li>
        <li><a href="#"><i class="fa fa-sitemap"></i> Items</a></li>
        <li><a href="home.php"><i class="fa fa-users"></i> Members</a></li>
        <li><a href="#"><i class="fa fa-plus"></i> Status</a></li>
      </ul>
      
    </div>
  </div>
</nav>