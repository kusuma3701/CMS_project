<?php require_once("db.php")?>
<?php require_once("functions.php")?>
<?php require_once("sessions.php")?>
<?php $_SESSION["TrackingURL"] = $_SERVER["PHP_SELF"];
Confirm_Login(); ?>
<?php
if(isset($_POST["Submit"]))
{
  $UserName=$_POST["Username"];
  $Name=$_POST["Name"];
  $Password=$_POST["Password"];
  $ConfirmPassword=$_POST["ConfirmPassword"];
  $Admin=$_SESSION["UserName"];
  date_default_timezone_set("Asia/Karachi");
  $currenttime=time();
  $Datetime=strftime("%B-%d-%Y %H:%M:%S",$currenttime);
  if(empty($UserName)||empty($Password)||empty($ConfirmPassword))
  {
   $_SESSION["ErrorMessage"]="All fields must be filled";
    Redirect_to("Admins.php");
  }
  else if(strlen($Password)<4)
  {
    $_SESSION["ErrorMessage"]="Password should have atleast 3 characters";
    Redirect_to("Admins.php");
  }
  else if($Password !== $ConfirmPassword)
  {
    $_SESSION["ErrorMessage"]="Password and Confirm password should match";
    Redirect_to("Admins.php");
  }
  else if(CheckFunctionIfUsernameExists($UserName))
  {
    $_SESSION["ErrorMessage"]="Username Exists !! Try another";
    Redirect_to("Admins.php");
  }
  else{
    $sql="INSERT INTO admins(datetime,username,password,aname,addedby)";
    $sql .="VALUES(:datetime,:userName,:password,:aName,:adminName)";
    $stmt=$connectingdb->prepare($sql);
    $stmt->bindValue(':datetime',$Datetime);
    $stmt->bindValue(':userName',$UserName);
    $stmt->bindValue(':password',$Password);
    $stmt->bindValue(':aName',$Name);
    $stmt->bindValue(':adminName', $Admin);
    $_SESSION["AdminName"];
    
    $Execute=$stmt->execute();
    if($Execute)
    {
      $_SESSION["SuccessMessage"]=" NewAdmin with name ".$Name." added successfully";
      Redirect_to("Admins.php");
    }
    else{
      $_SESSION["ErrorMessage"]="Error found";
      Redirect_to("Admins.php");
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
    <title>Admin page</title>

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
      <li class="nav-item"><a href="profile.php" class="nav-link"><i class="fas fa-user text-success"></i>&nbsp;My profile</a></li>
        <li class="nav-item"><a href="dashboard.php" class="nav-link">Dashboard</a></li>
        <li class="nav-item"><a href="posts.php" class="nav-link">Posts</a></li>
        <li class="nav-item"><a href="category.php" class="nav-link">Categories</a></li>
        <li class="nav-item"><a href="manage_admins.php" class="nav-link">Manage Admins</a></li>
        <li class="nav-item"><a href="comments.php" class="nav-link">Comments</a></li>
        <li class="nav-item"><a href="Blog.php" class="nav-link">Live Blog</a></li>
        <li class="nav-item"><a href="logout.php" class="nav-link" style="color:red">Logout</a></li>
        
      </ul>
    </div>
  </div>
  
</nav>

<header class="bg-info text-white py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1><i class="fas fa-user" style="color:#27aael"></i>&nbsp;&nbsp;Manage Admins</h1>
      </div>
    </div>
  </div>
</header><br>

<div class="container ">
<div class="jumbotron">
    <?php
    echo ErrorMessage();
    echo SuccessMessage();
    ?>
    <form action="Admins.php" method="post">
      <div class="card ">
  <div class="card-header ">
      <h2>Add New Admin</h2>
    </div><br>
    <div class="card-body">
      <div class="form-group">
        <label for="username"><h3 class="Fieldinfo">Username :</h3></label>
        <input class="form-control"type="text" name="Username" id="username">
      </div>
      <div class="form-group">
        <label for="Name"><h3 class="Fieldinfo">Name :</h3></label>
        <input class="form-control"type="text" name="Name" id="Name">
        <small class="text-danger text-muted" style="font-size: 15px;">*Optional</small>
      </div>
      <div class="form-group">
        <label for="Password"><h3 class="Fieldinfo">Password :</h3></label>
        <input class="form-control"type="password" name="Password" id="Password" >
      </div>
      <div class="form-group">
        <label for="ConfirmPassword"><h3 class="Fieldinfo">Confirm Password :</h3></label>
        <input class="form-control"type="password" name="ConfirmPassword" id="ConfirmPassword">
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
    </form><br><br><br>
    <h2><b>Existing Admins</b></h2><br><br>
            <table class="table table-striped table-hover">
                <thead class="thead-dark" >
                  <tr>
                    <th>No.</th>
                    <th>Date&Time</th>
                    <th>Username</th>
                    
                    <th>Admin Name</th>
                    <th>AddedBy</th>
                    <th>Action</th>
                    
                    
                  </tr>
                </thead>

           

            
             <?php
             global $connectingdb;
             $sql = "SELECT * FROM admins ORDER BY id desc";
             $Execute = $connectingdb->query($sql);
             $Srno = 0;
             while ($DateRows = $Execute->fetch()) {
                 $AdminId = $DateRows["id"];
                 $DateTime = $DateRows["datetime"];
                 $AdminUsername = $DateRows["username"];
                 $AdminName = $DateRows["aname"];
                 $AddedBy = $DateRows["addedby"];
                 $Srno++;
                
                 ?>
             <tbody>
                 <tr>
                    <td><?php echo htmlentities($Srno); ?></td>
                    <td><?php echo htmlentities($DateTime); ?></td>
                    <td><?php echo htmlentities($AdminUsername); ?></td>
                    
                    <td><?php echo htmlentities($AdminName); ?></td>
                    <td><?php echo htmlentities($AddedBy); ?></td>
                    <td><a href="DeleteAdmin.php?id=<?php echo $AdminId; ?>" class="btn btn-danger">Delete</a></td>
                    
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