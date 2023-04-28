<?php require_once("db.php")?>
<?php require_once("functions.php")?>
<?php require_once("sessions.php")?>
<?php Confirm_Login(); ?>
<?php
$SearchQueryParameter = $_GET["id"];
if(isset($_POST["Submit"]))
{
  $PostTitle=$_POST["PostTitle"];
  $CategoryName = $_POST["Category"];
  $Image = $_FILES["Image"]["name"];
  $Target = "uploads/".basename($_FILES["Image"]["name"]);
  $PostText = $_POST["PostDescription"];
  $Admin="Kusuma";
  date_default_timezone_set("Asia/Karachi");
  $currenttime=time();
  $Datetime=strftime("%B-%d-%Y %H:%M:%S",$currenttime);
  if(empty($PostTitle))
  {
   $_SESSION["ErrorMessage"]="Title should not be empty";
    Redirect_to("Posts.php");
  }
  else if(strlen($PostTitle)<5)
  {
    $_SESSION["ErrorMessage"]="Title should have atleast 5 characters";
    Redirect_to("Posts.php");
  }
  else if(strlen($PostText)>9999)
  {
    $_SESSION["ErrorMessage"]="Text should not exceed 1000 characters";
    Redirect_to("Posts.php");
  }
  else{
    global $connectingdb;
    if (!empty($_FILES["Image"]["name"])) {
      $sql = "UPDATE posts SET title='$PostTitle',category='$CategoryName',image='$Image',post='$PostText' 
    WHERE id='$SearchQueryParameter'";
    }else{
      $sql = "UPDATE posts SET title='$PostTitle',category='$CategoryName',post='$PostText' 
    WHERE id='$SearchQueryParameter'";
    }
    $Execute = $connectingdb->query($sql);
    move_uploaded_file($_FILES["Image"]["tmp_name"], $Target);
    if($Execute)
    {
      $_SESSION["SuccessMessage"]="Post updated successfully";
      Redirect_to("Posts.php");
    }
    else{
      $_SESSION["ErrorMessage"]="Error found";
      Redirect_to("Posts.php");
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new post</title>

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
      <li class="nav-item"><a href="profile.php" class="nav-link"><i class="fas fa-user text-success"></i>My profile</a></li>
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
        <h1><i class="fas fa-edit"></i><b>&nbsp;&nbsp;EDIT POSTS</b></h1>
      </div>
    </div>
  </div>
</header><br>

<div class="container ">
  <div class="jumbotron ">
    <?php
    echo ErrorMessage();
    echo SuccessMessage();
    global $connectingdb;
   
    $sql = "SELECT * FROM posts WHERE  id='$SearchQueryParameter'";
    $stmt = $connectingdb->query($sql);
    while($DateRows=$stmt->fetch()){
        $TitleTobeUpdated = $DateRows["title"];
        $PostTobeUpdated = $DateRows["post"];
      $CategoryTobeUpdated = $DateRows["category"];
      $ImageTobeUpdated = $DateRows["image"];
    }
    ?>
    <form action="EditPost.php?id=<?php echo $SearchQueryParameter ?>" method="post" enctype="multipart/form-data">
      <div class="card ">
  
    <div class="card-body">
      <div class="form-group">
        <label for="Title"><h3 class="Fieldinfo">Post Title:</h3></label>
        <input class="form-control"type="text" name="PostTitle" id="Title" placeholder="Type title here..." value="<?php echo $TitleTobeUpdated;?>">
      </div>
      <div class="form-group">
      <span class="Fieldinfo">Existing Category:</span>
      <?php echo $CategoryTobeUpdated; ?><br>
        <label for="CategoryTitle"><h3 class="Fieldinfo">Choose Category:</h3></label>
        <select class="form-control" name="Category" id="CategoryTitle">
         <?php
         global $connectingdb;
         $sql = "SELECT id,title FROM category";
         $stmt = $connectingdb->query($sql);
         while ($DateRows = $stmt->fetch()) {
           $Id = $DateRows["id"];
           $CategoryName = $DateRows["title"];

         ?>
         <option><?php echo $CategoryName; ?></option>
         <?php } ?>
        </select>
      </div>
      <div class="form-group">
      <span class="Fieldinfo">Existing Image:</span>
        <img src="uploads/<?php echo $ImageTobeUpdated;?>" width="250px"; height="150px"; ><br>
        <label for="imageSelect"><h3 class="Fieldinfo">Select image:</h3></label>
        <input type="File" name="Image" id="imageSelect">
      </div>
      <div class="form-group">
        <label for="Post"><h3 class="Fieldinfo">Post:</h3></label>
        <textarea class="form-control" name="PostDescription" id="Post" cols="8" rows="10"><?php echo $PostTobeUpdated; ?></textarea>
      </div>
    </div>
    <div class="row">
            <div class="col-lg-6">
               <a href="dashboard.php" class="btn btn-lg btn-warning btn-block">Back to Dashboard</a>
                 
            </div>
            <div class="col-lg-6">
                <button type="submit" class="btn btn-lg btn-success btn-block" name="Submit">Publish</button>
                
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