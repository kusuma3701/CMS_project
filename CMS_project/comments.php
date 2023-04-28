<?php require_once("db.php")?>
<?php require_once("functions.php")?>
<?php require_once("sessions.php")?>
<?php $_SESSION["TrackingURL"] = $_SERVER["PHP_SELF"];
Confirm_Login(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
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
      <li class="nav-item"><a href="profile.php" class="nav-link"><i class="fas fa-user text-success"></i>&nbsp;&nbsp;My profile</a></li>
        <li class="nav-item"><a href="dashboard.php" class="nav-link">Dashboard</a></li>
        <li class="nav-item"><a href="posts.php" class="nav-link">Posts</a></li>
        <li class="nav-item"><a href="category.php" class="nav-link">Categories</a></li>
        <li class="nav-item"><a href="manage_admins.php" class="nav-link">Manage Admins</a></li>
        <li class="nav-item"><a href="comments.php" class="nav-link">Comments</a></li>
        <li class="nav-item"><a href="live_blog.php" class="nav-link">Live Blog</a></li>
        <li class="nav-item"><a href="logout.php" class="nav-link" style="color:red">Logout</a></li>
        
      </ul>
    </div>
  </div>
  
</nav>
<header class="bg-info text-white py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1><i class="fas fa-comments" style="color:#27aael"></i>&nbsp;&nbsp;Manage Comments</h1>
      </div>
    </div>
  </div>
</header><br>

<div class="container" >
  <div class="jumbotron" >
  <section class="container py-2 mb-4">
    <div class="row" style="min-height:30px;">
        <div class="col-lg-12" style="min-height:400px;">
        <?php
    echo ErrorMessage();
    echo SuccessMessage();
    ?>
        <h2><b>Un-approved Comments</b></h2><br><br>
            <table class="table table-striped table-hover">
                <thead class="thead-dark" >
                  <tr>
                    <th>No.</th>
                    <th>Date&Time</th>
                    <th>Name</th>
                    
                    <th>Comment</th>
                    <th>Approve</th>
                    <th>Action</th>
                    <th>Details</th>
                    
                  </tr>
                </thead>

           

            
             <?php
             global $connectingdb;
             $sql = "SELECT * FROM comments WHERE status='OFF' ORDER BY id desc";
             $Execute = $connectingdb->query($sql);
             $Srno = 0;
             while ($DateRows = $Execute->fetch()) {
                 $Commentid = $DateRows["id"];
                 $dateTimeofComment = $DateRows["datetime"];
                 $Commentername = $DateRows["name"];
                 $Commentcontent = $DateRows["comment"];
                 $Commentpostid = $DateRows["post_id"];
                 $Srno++;
                
                 ?>
             <tbody>
                 <tr>
                    <td><?php echo htmlentities($Srno); ?></td>
                    <td><?php echo htmlentities($dateTimeofComment); ?></td>
                    <td><?php echo htmlentities($Commentername); ?></td>
                    
                    <td><?php echo htmlentities($Commentcontent); ?></td>
                    <td><a href="ApproveComment.php?id=<?php echo $Commentid; ?>" class="btn btn-success">Approve</a></td>
                    <td><a href="DeleteComment.php?id=<?php echo $Commentid; ?>" class="btn btn-danger">Delete</a></td>
                    <td><a class="btn btn-primary" href="FullPost.php?id=<?php echo $Commentpostid; ?>" target="_blank">Live Preview</a></td>
                 </tr>
             </tbody>
             <?php } ?>
            </table><br><br>
            <h2><b>Approved Comments</b></h2><br><br>
            <table class="table table-striped table-hover">
                <thead class="thead-dark" >
                  <tr>
                    <th>No.</th>
                    <th>Date&Time</th>
                    <th>Name</th>
                    
                    <th>Comment</th>
                    <th>Revert</th>
                    <th>Action</th>
                    <th>Details</th>
                    
                  </tr>
                </thead>

           

            
             <?php
             global $connectingdb;
             $sql = "SELECT * FROM comments WHERE status='ON' ORDER BY id desc";
             $Execute = $connectingdb->query($sql);
             $Srno = 0;
             while ($DateRows = $Execute->fetch()) {
                 $Commentid = $DateRows["id"];
                 $dateTimeofComment = $DateRows["datetime"];
                 $Commentername = $DateRows["name"];
                 $Commentcontent = $DateRows["comment"];
                 $Commentpostid = $DateRows["post_id"];
                 $Srno++;
                
                 ?>
             <tbody>
                 <tr>
                    <td><?php echo htmlentities($Srno); ?></td>
                    <td><?php echo htmlentities($dateTimeofComment); ?></td>
                    <td><?php echo htmlentities($Commentername); ?></td>
                    
                    <td><?php echo htmlentities($Commentcontent); ?></td>
                    <td><a href="DisApproveComment.php?id=<?php echo $Commentid; ?>" class="btn btn-warning">Dis-Approve</a></td>
                    <td><a href="DeleteComment.php?id=<?php echo $Commentid; ?>" class="btn btn-danger">Delete</a></td>
                    <td><a class="btn btn-primary" href="FullPost.php?id=<?php echo $Commentpostid; ?>" target="_blank">Live Preview</a></td>
                 </tr>
             </tbody>
             <?php } ?>
            </table>
        </div>
    </div>

</section>
  </div>
</div>




<footer class="bg-success text-white">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="lead text-center">By Choppa Kusuma </p>
            </div>
        </div>
    </div>
</footer>

</body>
</html>