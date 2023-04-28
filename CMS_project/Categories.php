<?php require_once("db.php")?>
<?php require_once("functions.php")?>
<?php require_once("sessions.php")?>
<?php
$_SESSION["TrackingURL"] = $_SERVER["PHP_SELF"];
 Confirm_Login(); ?>
<?php
if(isset($_POST["Submit"]))
{
  $Category=$_POST["CategoryTitle"];
  $Admin = $_SESSION["UserName"];
  date_default_timezone_set("Asia/Karachi");
  $currenttime=time();
  $Datetime=strftime("%B-%d-%Y %H:%M:%S",$currenttime);
  if(empty($Category))
  {
   $_SESSION["ErrorMessage"]="All fields must be filled";
    Redirect_to("Categories.php");
  }
  else if(strlen($Category)<3)
  {
    $_SESSION["ErrorMessage"]="Title should have atleast 2 characters";
    Redirect_to("Categories.php");
  }
  else if(strlen($Category)>49)
  {
    $_SESSION["ErrorMessage"]="Title should not exceed 50 characters";
    Redirect_to("Categories.php");
  }
  else{
    $sql="INSERT INTO category(title,author,datetime)";
    $sql .="VALUES(:Title,:admin,:datetime)";
    $stmt=$connectingdb->prepare($sql);
    $stmt->bindValue(':Title',$Category);
    $stmt->bindValue(':admin',$Admin);
    $stmt->bindValue(':datetime',$Datetime);
    $Execute=$stmt->execute();
    if($Execute)
    {
      $_SESSION["SuccessMessage"]="Category added successfully";
      Redirect_to("Categories.php");
    }
    else{
      $_SESSION["ErrorMessage"]="Error found";
      Redirect_to("Categories.php");
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

<header class="bg-info text-white py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1><i class="fas fa-text-height" style="color:#27aael"></i>Manage Categories</h1>
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
    <form action="Categories.php" method="post">
      <div class="card ">
  <div class="card-header ">
      <h2><b>Add New Category</b></h2>
    </div><br>
    <div class="card-body">
      <div class="form-group">
        <label for="Title"><h3 class="Fieldinfo">Category Title:</h3></label>
        <input class="form-control"type="text" name="CategoryTitle" id="Title" placeholder="Type title here...">
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
    </form><br><br>
    <h2><b>Existing Categories</b></h2><br><br>
            <table class="table table-striped table-hover">
                <thead class="thead-dark" >
                  <tr>
                    <th>No.</th>
                    <th>Date&Time</th>
                    <th>Category Name</th>
                    
                    <th>Creater Name</th>
                    
                    <th>Action</th>
                    
                    
                  </tr>
                </thead>

           

            
             <?php
             global $connectingdb;
             $sql = "SELECT * FROM category ORDER BY id desc";
             $Execute = $connectingdb->query($sql);
             $Srno = 0;
             while ($DateRows = $Execute->fetch()) {
                 $CategoryId = $DateRows["id"];
                 $CategoryDate = $DateRows["datetime"];
                 $CategoryName = $DateRows["title"];
                 $CreatorName = $DateRows["author"];
             
                 $Srno++;
                
                 ?>
             <tbody>
                 <tr>
                    <td><?php echo htmlentities($Srno); ?></td>
                    <td><?php echo htmlentities($CategoryDate); ?></td>
                    <td><?php echo htmlentities($CategoryName); ?></td>
                    
                    <td><?php echo htmlentities($CreatorName); ?></td>
                    
                    <td><a href="DeleteCategory.php?id=<?php echo $CategoryId; ?>" class="btn btn-danger">Delete</a></td>
                    
                 </tr>
             </tbody>
             <?php } ?>
            </table>
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