<?php require_once("db.php")?>
<?php require_once("functions.php")?>
<?php require_once("sessions.php")?>
<?php $SearchQueryParameter = $_GET["id"]; ?>
<?php
if(isset($_POST["Submit"]))
{
  $Name=$_POST["CommenterName"];
  $Email = $_POST["CommenterEmail"];
  $Comment = $_POST["CommenterThoughts"];
  date_default_timezone_set("Asia/Karachi");
  $currenttime=time();
  $Datetime=strftime("%B-%d-%Y %H:%M:%S",$currenttime);
  if (empty($Name) || empty($Email) || empty($Comment)) {
    $_SESSION["ErrorMessage"] = "All fields must be filled";
    Redirect_to("FullPost.php?id={$SearchQueryParameter}");
  }
  else if(strlen($Comment)>500)
  {
    $_SESSION["ErrorMessage"]="Title should have less than 500 characters";
    Redirect_to("FullPost.php?id={$SearchQueryParameter}");
  }
  else{
    $sql="INSERT INTO comments(datetime,name,email,comment,approvedby,status,post_id)";
    $sql .="VALUES(:datetime,:name,:email,:comment,'Pending','OFF',:postIdFromURL)";
    $stmt=$connectingdb->prepare($sql);
    
    $stmt->bindValue(':datetime',$Datetime);
    $stmt->bindValue(':name',$Name);
    $stmt->bindValue(':email',$Email);
    $stmt->bindValue(':comment',$Comment);
    
    $stmt->bindValue(':postIdFromURL',$SearchQueryParameter);
    $Execute=$stmt->execute();
    if($Execute)
    {
      $_SESSION["SuccessMessage"]="Comment Submitted Successfully";
      Redirect_to("FullPost.php?id={$SearchQueryParameter}");
    }
    else{
      $_SESSION["ErrorMessage"]="Something went Wrong!! Try again";
      Redirect_to("FullPost.php?id={$SearchQueryParameter}");
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="style.css">
<style>
    .kusu
      {
        padding-left: 70px;
      }
      
      .navbar-nav{
          padding-top: 10px;
          font-size: 20px;
          
      }
      
      .navbar ul{
          padding-left: 600px;
      }
      nav ul li { 
          margin-left: 15px;
          margin-right: 15px; 
      } 
</style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <img src="1.jpg" alt="" height="80px" width="180px">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="nav navbar-nav navbar-right mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="Blog.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
      <a class="nav-link" href="#">About Us <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
      <a class="nav-link" href="Blog.php">Blog <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
      <a class="nav-link" href="#">Contact Us <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
      <a class="nav-link" href="#">Features<span class="sr-only">(current)</span></a>
      </li>
    </ul>
    <form class="form-inline my-3 my-lg-6" action="Blog.php">
      <div class="form-group"></div>
      <input class="form-control mr-lg-3" type="text" name="Search" placeholder="Search Here" id="search" aria-label="Search">
      <button class="btn btn-primary my-2 my-sm-0"  name="SearchButton" ><h4>Go</h4></button>
      </div>
    </form>
  </div>
</nav>
<div class="container">
    
        <div class="row">
          <div class="col-lg-8" >
          <h1>Posts</h1>
      <?php
    echo ErrorMessage();
    echo SuccessMessage();
    ?>
      <?php
      global $connectingdb;
      if(isset($_GET["SearchButton"])){
        $Search = $_GET["Search"];
        $sql = "SELECT * FROM posts WHERE datetime LIKE :search
        OR title LIKE :search
        OR category LIKE :search
        OR post LIKE :search";
        $stmt = $connectingdb->prepare($sql);
        $stmt->bindValue(':search','%'.$Search.'%');
        $stmt->execute();
      } else {
          $PostIdFromURL = $_GET["id"];
          if(!isset($PostIdFromURL)){
              $_SESSION["ErrorMessage"] = "Bad Request!!";
              Redirect_to("Blog.php");
          }
        $sql = "SELECT * FROM posts WHERE id='$PostIdFromURL'";
        $stmt = $connectingdb->query($sql);
      }
      
      while($DateRows=$stmt->fetch()){
        $PostId = $DateRows["id"];
        $DateTime = $DateRows["datetime"];
        $PostTitle = $DateRows["title"];
        $Category = $DateRows["category"];
        $Admin = $DateRows["author"];
        $Image = $DateRows["image"];
        $PostDescription = $DateRows["post"];
      
      ?>
      
      <div class="card">
        <img src="uploads/<?php echo htmlentities($Image); ?>" width="700px" />
        <div class="card-body">
          <h2 class="card-title"><?php echo htmlentities($PostTitle); ?></h2>
          <h4 class="text-muted">Writen by <?php echo htmlentities($Admin); ?> on <?php echo htmlentities($DateTime); ?></h4>
          <span style="float:right" class="badge badge-dark text-light">Comments 20</span>
          <hr my-2>
          <h5 class="card-text" ><?php echo htmlentities($PostDescription); ?></h5>
          
          
        </div>
      </div>
     <?php } ?><br>
     <span class="Fieldinfo">Comments</span>
     <hr class="my-4">
     <?php
     global $connectingdb;
     $sql = "SELECT * FROM comments WHERE post_id='$SearchQueryParameter' AND status='ON'";
     $stmt = $connectingdb->query($sql);
     while ($DateRows = $stmt->fetch()) {
       $CommentDate = $DateRows['datetime'];
       $CommenterName = $DateRows['name'];
       $CommentContent = $DateRows['comment'];

       ?>
     <div >
     
      <div class="media">
        <img class="d-block img-fluid align-self-start" src="2.img" alt="" width="130px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <div class="media-body ml-2">
          <h6 class="lead" style="font-size: 25px;"><b><?php echo $CommenterName; ?></b></h6>
          <p class="small" style="font-size: 13px;"><?php echo $CommentDate ?></p>
          <p style="font-size: 15px;"><?php echo $CommentContent ?></p>
        </div>
      </div>
     </div>
     <hr class="my-4">
     <?php } ?>
     <div class="">
      <form class="" action="FullPost.php?id=<?php echo $SearchQueryParameter; ?>" method="post" >
      <div class="card mb-3">
        <div class="card-header">
          <h5 class="Fieldinfo">Share your thoughts about this post</h5>
        </div>
        <div class="card-body">
          <div class="form-group">
          <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
          </div>
          <input class="form-control" type="text" name="CommenterName" placeholder="Name"value="">
          </div>
          </div>

          <div class="form-group">
          <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
          </div>
          <input class="form-control" type="email" name="CommenterEmail" placeholder="Email"value="">
          </div>
          </div>

          <div class="form-group">
            <textarea class="form-control" name="CommenterThoughts" id="" cols="80" rows="8"></textarea>
          </div>
          <div class="">
            <button type="submit" name="Submit" class="btn btn-primary btn-lg">Submit</button>
          </div>
        </div>
      </div>
    </form>
     </div>
          </div>
          <div class="col-lg-4" style="background-color: green;" >
                hgjkhdsfkj
          </div>
        
    </div>
</div>
</body>
</html>