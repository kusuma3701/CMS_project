<?php require_once("db.php")?>
<?php require_once("functions.php")?>
<?php require_once("sessions.php")?>
<?php
if(isset($_POST["Submit"]))
{
    $UserName = $_POST["Username"];
    $Password = $_POST["Password"];
    if(empty($UserName)||empty($Password))
    {
        $_SESSION["ErrorMessage"] = "All fields must be fill!!";
        Redirect_to("Login.php");
    }
    else{
        $Found_Account = Login_Attempt($UserName, $Password);
        if($Found_Account)
        {
            $_SESSION["User_ID"] = $Found_Account["id"];
            $_SESSION["UserName"] = $Found_Account["username"];
            $_SESSION["AdminName"] = $Found_Account["aname"];
            $_SESSION["SuccessMessage"] = "Welcome ".$_SESSION["AdminName"];
            Redirect_to("Dashboard.php");
        }
        else{
            $_SESSION["ErrorMessage"] = "Invalid Username/Password";
            Redirect_to("Login.php");
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
    <title>Login</title>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
    <div style="height:100px ; background:#27aael ;">
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
  
            <img src="1.jpg" alt="" height="80px" width="180px">
       
    
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      
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
<div class="container">
    <div class="jumbotron">
    <section class="container py-2 mb-4">
    <div class="row">
        <div class="offset-sm-3 col-sm-6" style="min-height:500px;">
        <br><br><br><br><br>
        <?php
    echo ErrorMessage();
    echo SuccessMessage();
    ?>
            <div class="card bg-secondary text-light">
                <div class="card-header">
                    <h4 style="font-size: 25px;">Welcome back!!</h4>
                </div>
                    <div class="card-body bg-dark">

                    
                    <form action="Login.php" method="post">
                        <div class="form-group">
                            <label for="username"><span class="Fieldinfo">Username:</span></label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-white bg-info"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" name="Username" id="username">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password"><span class="Fieldinfo">Password:</span></label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-white bg-info"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" class="form-control" name="Password" id="password">
                            </div>
                        </div><br>
                        <input type="submit" name="Submit" class="btn btn-info btn-block btn-lg" value="Login">
                    </form>
                </div>
            </div>
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