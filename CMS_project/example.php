<?php require_once("db.php")?>
<?php require_once("functions.php")?>
<?php require_once("sessions.php")?>
<?php
if(isset($_POST["Submit"]))
{
  $PostTitle=$_POST["PostTitle"];
  $Category = $_POST["Category"];
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
    Redirect_to("Addnewpost.php");
  }
  else if(strlen($PostTitle)<5)
  {
    $_SESSION["ErrorMessage"]="Post Title should have atleast 5 characters";
    Redirect_to("Addnewpost.php");
  }
  else if(strlen($PostText)>999)
  {
    $_SESSION["ErrorMessage"]="Post Text should not exceed 1000 characters";
    Redirect_to("Addnewpost.php");
  }
  else{
    global $connectingdb;
    $sql="INSERT INTO posts(datetime,title,category,author,image,post)";
    $sql .="VALUES(:dateTime,:postTitle,:categoryName,:adminName,:imageName,:postDescription)";
    $stmt=$connectingdb->prepare($sql);
    $stmt->bindValue(':dateTime',$Datetime);
    $stmt->bindValue(':postTitle',$PostTitle);
    $stmt->bindValue(':categoryName',$Category);
    $stmt->bindValue(':adminName',$Admin);
    $stmt->bindValue(':imageName',$Image);
    $stmt->bindValue(':postDescription',$PostText);
    $Execute=$stmt->execute();
    move_uploaded_file($_FILES["Image"]["tmp_name"], $Target);
    if($Execute)
    {
      $_SESSION["SuccessMessage"]="Category with id: ".$connectingdb->lastInsertId()." added successfully";
      Redirect_to("Addnewpost.php");
    }
    else{
      $_SESSION["ErrorMessage"]="Error found";
      Redirect_to("Addnewpost.php");
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
    <title>Project</title>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
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
      <li class="nav-item"><a href="profile.php" class="nav-link"><i class="fas fa-user text-success"></i>My profile</a></li>
        <li class="nav-item"><a href="dashboard.php" class="nav-link">Dashboard</a></li>
        <li class="nav-item"><a href="posts.php" class="nav-link">Posts</a></li>
        <li class="nav-item"><a href="Categories.php" class="nav-link">Categories</a></li>
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
        <h1><i class="fas fa-text-height" style="color:#27aael"></i>Add New Post</h1>
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
    <form action="Addnewpost.php" method="post" enctype="multipart/form-data">
      <div class="card ">
    <div class="card-body">
      <div class="form-group">
        <label for="title"><h3 class="Fieldinfo">Post Title:</h3></label>
        <input class="form-control"type="text" name="PostTitle" id="title" placeholder="Type title here...">
      </div>
    </div>
    <div class="card-body">
      <div class="form-group">
        <label for="CategoryTitle"><h3 class="Fieldinfo">Choose Category</h3></label>
        <select class="form-control" name="Category" id="CategoryTitle">
            <?php
            global $connectingdb;
            $sql = "SELECT id,title FROM category";
            $stmt = $connectingdb->query($sql);
            while ($DateRows = $stmt->fetch()) {
                $Id = $DateRows["id"];
                $CategoryName = $DateRows["title"];

            
            ?>
            
            <option value=""><?php echo $CategoryName; ?></option>
            <?php } ?>
        </select>
      </div>
    </div>
    <div class="card-body">
        <div class="form-group">
        <label for="CategoryTitle"><h3 class="Fieldinfo">Select Image</h3></label> 
        <input type="File" name="Image" id="SelectImage">
        </div>
    </div>
    <div class="form-group">
    <label for="Post"><h3 class="Fieldinfo">Post:</h3></label>
    <textarea class="form-control" name="PostDescription" id="Post" cols="8" rows="10"></textarea>
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