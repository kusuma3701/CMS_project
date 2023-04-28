<?php require_once("db.php");?>
<?php require_once("functions.php");?>
<?php require_once("sessions.php");?>
<?php
$_SESSION["TrackingURL"] = $_SERVER["PHP_SELF"];
//echo $_SESSION["TrackingURL"];
Confirm_Login(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="style.css">
<style>
    .kusu
      {
        padding-left: 50px;
      }
      
      .navbar-nav{
          padding-top: 10px;
          font-size: 20px;
          
      }
      
      .navbar ul{
          padding-left: 500px;
      }
</style>
</head>
<body>
    <div style="height:100px ; background:#27aael ;"></div>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
  
            <img src="1.jpg" alt="" height="80px" width="180px">
       
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      <li class="nav-item"><a href="profile.php" class="nav-link"><i class="fas fa-user text-success"></i>&nbspMy profile</a></li>
        <li class="nav-item"><a href="dashboard.php" class="nav-link">Dashboard</a></li>
        <li class="nav-item"><a href="Posts.php" class="nav-link">Posts</a></li>
        <li class="nav-item"><a href="Categories.php" class="nav-link">Categories</a></li>
        <li class="nav-item"><a href="Admins.php" class="nav-link">Manage Admins</a></li>
        <li class="nav-item"><a href="comments.php" class="nav-link">Comments</a></li>
        <li class="nav-item"><a href="live_blog.php" class="nav-link">Live Blog</a></li>
        <li class="nav-item"><a href="Logout.php" class="nav-link" style="color:red">Logout</a></li>
        
      </ul>
    </div>
  </div>
  
</nav>

<header class="bg-dark text-white py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1><i class="fas fa-blog" style="color:#27aael"></i>&nbsp;Blog Posts</h1>
      </div>
    </div><br>
  
  <div class="row">
    <div class="col-md-3 mb-2">
      <a href="Addnewpost.php" class="btn btn-primary btn-block"><h4><i class='fas fa-edit' style='font-size:24px;'></i>&nbsp&nbspAdd New Post</h4></a>
    </div>
  
  <div class="col-md-3 mb-2">
    <a href="Categories.php" class="btn btn-info btn-block"><h4><i class='fas fa-folder-plus' style='font-size:24px;'></i>&nbsp&nbspAdd New Category</h4></a>
  </div>

<div class="col-md-3 mb-2">
    <a href="Admins.php" class="btn btn-danger btn-block"><h4><i class='fas fa-user-plus' style='font-size:24px;'></i>&nbsp&nbspAdd New Admin</h4></a>
  </div>
  <div class="col-md-3 mb-2">
    <a href="Comments.php" class="btn btn-success btn-block"><h4><i class='fas fa-check' style='font-size:24px;'></i>&nbsp&nbspApprove Comments</h4></a>
  </div>
</div>

</div>
</div>
</header><br>

<div class="jumbotron">
<section>
  <div class="row">
    <div class="col lg-12">
    <?php
    echo ErrorMessage();
    echo SuccessMessage();
    ?>
      <table class="table table-striped table-hover">
        <thead class="thead-dark">
        <tr>
          <th>#</th>
          <th>Title</th>
          <th>Category</th>
          <th>Date&Time</th>
          <th>Author</th>
          <th>Banner</th>
          <th>Comments</th>
          <th>Action</th>
          <th>Live preview</th>
        </tr>
        </thead>
        <?php
        global $connectingdb;
        $sql = "SELECT * FROM posts";
        $stmt = $connectingdb->query($sql);
        $sr = 0;
        while($DateRows=$stmt->fetch())
        {
          $Id=$DateRows["id"];
          $DateTime=$DateRows["datetime"];
          $PostTitle=$DateRows["title"];
          $Category=$DateRows["category"];
          $Admin=$DateRows["author"];
          $Image=$DateRows["image"];
          $PostText = $DateRows["post"];
          $sr++;
        ?>
        <tbody>
        <tr>
          <td><?php echo $sr; ?></td>
          <td>
            <?php
          if (strlen($PostTitle) > 20) {
            $PostTitle = substr($PostTitle, 0, 18).'..';}
          echo $PostTitle;
            ?>
           </td>
          <td>
            <?php
            if (strlen($Category) > 8) {
              $Category = substr($Category, 0, 8 ).'..';}
             echo $Category; 
            ?>
          </td>
          <td>
            <?php
            if (strlen($DateTime) > 11) {
              $DateTime = substr($DateTime, 0, 11).'..';}
             echo $DateTime;
            ?>
          </td>
          <td>
            <?php
            if (strlen($Admin) > 6) {
              $Admin = substr($Admin, 0, 6).'..';}
             echo $Admin;
            ?>
          </td>
          <td><img src="uploads/<?php echo $Image; ?>" width="170px;"></td>
          <td>Comments</td>
          <td>
            <a href="EditPost.php?id=<?php echo $Id; ?>"><span class="btn btn-warning btn-lg">Edit</span></a>
            <a href="DeletePost.php?id=<?php echo $Id; ?>"><span class="btn btn-danger btn-lg">Delete</span></a>
          </td>
          
          <td><a href="FullPost.php?id=<?php echo $Id; ?>"target="_blank"><span class="btn btn-primary btn-lg">Live preview</span></td>
        </tr>
        </tbody>
        <?php } ?>
      </table>
    </div>
  </div>
</section>
</div>

</body>
</html>