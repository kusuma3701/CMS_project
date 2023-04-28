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
    <title>Dashboard</title>

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
        <h1><i class="fas fa-cog" style="color:#27aael"></i>&nbsp;Dashboard</h1>
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
    <a href="Admins.php" class="btn btn-danger btn-block"><h4><i class='fas fa-user-plus' style='font-size:24px;'></i>&nbsp;&nbsp;Add New Admin</h4></a>
  </div>
  <div class="col-md-3 mb-2">
    <a href="Comments.php" class="btn btn-success btn-block"><h4><i class='fas fa-check' style='font-size:24px;'></i>&nbsp;&nbsp;Approve Comments</h4></a>
  </div>
</div>

</div>
</div>
</header><br>

<br>
<hr>
<section class="container py-2 mb-4" >
  <div class="row">
    
    <?php
    echo ErrorMessage();
    echo SuccessMessage();
    ?>
      
    
    
    <div class="col-lg-2 d-none d-md-block" >
        <div class="card text-center bg-info text-white mb-3" >
            <div class="card-body" >
                <h1 class="lead" style="font-size:35px;" >Posts</h1>
                <h4 class="display-5" ></h4>
                <p style="font-size:26px;" ><i class="fab fa-readme">&nbsp;<b>
                <?php 
                global $connectingdb;
                $sql="SELECT COUNT(*) FROM posts";
                $stmt=$connectingdb->query($sql);
                $TotalRows=$stmt->fetch();
                $TotalPosts=array_shift($TotalRows);
                echo $TotalPosts;
                 ?>
                </b></i></p>
            </div>
        </div>
         
        <div class="card text-center bg-info text-white mb-5" >
            <div class="card-body" >
                <h1 class="lead" style="font-size:35px;" >Categories</h1>
                <h4 class="display-7" ></h4>
                <p style="font-size:26px;" ><i class="fas fa-folder">&nbsp;<b>
                <?php 
                global $connectingdb;
                $sql="SELECT COUNT(*) FROM category";
                $stmt=$connectingdb->query($sql);
                $TotalRows=$stmt->fetch();
                $TotalCategories=array_shift($TotalRows);
                echo $TotalCategories;
                 ?>
                </b>
                </i></p>
                
            </div>
        </div>

        <div class="card text-center bg-info text-white mb-3" >
            <div class="card-body" >
                <h1 class="lead" style="font-size:35px;" >Admins</h1>
                <h4 class="display-5" ></h4>
                <p style="font-size:26px;" ><i class="fas fa-users">&nbsp;<b>
                <?php 
                global $connectingdb;
                $sql="SELECT COUNT(*) FROM admins";
                $stmt=$connectingdb->query($sql);
                $TotalRows=$stmt->fetch();
                $TotalAdmins=array_shift($TotalRows);
                echo $TotalAdmins;
                 ?>
                </b>  
                </i></p>
                
            </div>
        </div>

        <div class="card text-center bg-info text-white mb-3" >
            <div class="card-body" >
                <h1 class="lead" style="font-size:35px;" >Comments</h1>
                <h4 class="display-5" ></h4>
                <p style="font-size:26px;" ><i class="fas fa-comments">&nbsp;
                <?php 
                global $connectingdb;
                $sql="SELECT COUNT(*) FROM comments";
                $stmt=$connectingdb->query($sql);
                $TotalRows=$stmt->fetch();
                $TotalComments=array_shift($TotalRows);
                echo $TotalComments;
                 ?>
                </b>
                </i></p>
                
            </div>
        </div>
    </div>
    
    <div class="col-lg-10" >
        <h1>Total Posts</h1>
        <table class="table table-striped table-hover" >
            <thead class="thead-dark" style="background-color:orange;">
                 <tr>
                    <th>No.</th>
                    <th>Title</th>
                    <th>Date&Time</th>
                    <th>Author</th>
                    <th>Comments</th>
                    <th>Details</th>
                 </tr>
            </thead><br>
            <?php 
            $Srno=0;
            global $connectingdb;
            $sql="SELECT * FROM posts ORDER BY id DESC LIMIT 0,5";
            $stmt=$connectingdb->query($sql);
            while($DateRows=$stmt->fetch()){
                $PostId=$DateRows["id"];
                $DateTime=$DateRows["datetime"];
                $Author=$DateRows["author"];
                $Title=$DateRows["title"];
                $Srno++;
            
            ?>
            <tbody>
               <tr>
                <td><?php echo $Srno; ?></td>
                <td><?php echo $Title; ?></td>
                <td><?php echo $DateTime; ?></td>
                <td><?php echo $Author; ?></td>
                <td>
                    <?php
                     
                    ?>
                      
                        
                   
                </td>
                <td><a target="_blank" href="FullPost.php?id=<?php echo $PostId; ?>">
                <span class="btn btn-info" >Preview</span></a>
                </td>
               </tr>
            </tbody>
            <?php } ?>
        </table>
    </div>
    
    </div> 
</section>


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