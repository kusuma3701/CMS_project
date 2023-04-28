<?php require_once("db.php")?>
<?php require_once("functions.php")?>
<?php require_once("sessions.php")?>
<?php Confirm_Login(); ?>
<?php
$SearchQueryParameter = $_GET["id"];
global $connectingdb;
   
    $sql = "SELECT * FROM posts WHERE  id='$SearchQueryParameter'";
    $stmt = $connectingdb->query($sql);
    while($DateRows=$stmt->fetch()){
        $TitleTobeUpdated = $DateRows["title"];
        $PostTobeUpdated = $DateRows["post"];
        $CategoryTobeUpdated = $DateRows["category"];
        $ImageTobeUpdated = $DateRows["image"];
    }
if(isset($_POST["Submit"]))
{
 
 
    global $connectingdb;
  $sql = "DELETE FROM posts WHERE id='$SearchQueryParameter'";
  $Execute = $connectingdb->query($sql);
      if($Execute)
    {
    $Target_Path_To_Be_Delete_Image = "uploads/$ImageTobeUpdated";
    unlink($Target_Path_To_Be_Delete_Image);
      $_SESSION["SuccessMessage"]="Post Deleted successfully";
      Redirect_to("Posts.php");
    }
    else{
      $_SESSION["ErrorMessage"]="Error found";
      Redirect_to("Posts.php");
    }
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete post</title>

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

<header class="bg- text-white py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1><i class="fas fa-edit"></i><b>&nbsp;&nbsp;DELETE POSTS</b></h1>
      </div>
    </div>
  </div>
</header><br>

<div class="container ">
  <div class="jumbotron ">
    <?php
    echo ErrorMessage();
    echo SuccessMessage();
    
    ?>
    <form action="DeletePost.php?id=<?php echo $SearchQueryParameter ?>" method="post" enctype="multipart/form-data">
      <div class="card ">
  
    <div class="card-body">
      <div class="form-group">
        <label for="Title"><h3 class="Fieldinfo">Post Title:</h3></label>
        <input disabled class="form-control"type="text" name="PostTitle" id="Title" placeholder="Type title here..." value="<?php echo $TitleTobeUpdated;?>">
      </div>
      <div class="form-group">
      <span class="Fieldinfo">Existing Category:</span>
      <?php echo $CategoryTobeUpdated; ?><br>
       
      </div><br>
      <div class="form-group">
      <span class="Fieldinfo">Existing Image:</span>
        <img src="uploads/<?php echo $ImageTobeUpdated;?>" width="250px"; height="150px"; ><br>
        
      </div>
      <div class="form-group">
        <label for="Post"><h3 class="Fieldinfo">Post:</h3></label>
        <textarea disabled class="form-control" name="PostDescription" id="Post" cols="8" rows="10"><?php echo $PostTobeUpdated; ?></textarea>
      </div>
    </div>
    <div class="row">
            <div class="col-lg-6">
               <a href="dashboard.php" class="btn btn-lg btn-warning btn-block"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Back to Dashboard</a>
                 
            </div>
            <div class="col-lg-6">
                <button type="submit" class="btn btn-lg btn-danger btn-block" name="Submit"><i class="fas fa-trash"></i>&nbsp;&nbsp;Delete</button>
                
            </div>
            
          </div>
      </div>
    </form>
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