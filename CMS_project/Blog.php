<?php require_once("db.php")?>
<?php require_once("functions.php")?>
<?php require_once("sessions.php")?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>

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
    <div class="col-sm" style="" >
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
        $sql = "SELECT * FROM posts ORDER BY id desc";
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
        <img src="uploads/<?php echo htmlentities($Image); ?>" width="800px" />
        <div class="card-body">
          <h2 class="card-title"><?php echo htmlentities($PostTitle); ?></h2>
          <h4 class="text-muted">Writen by <?php echo htmlentities($Admin); ?> on <?php echo htmlentities($DateTime); ?></h4>
          <span style="float:right" class="badge badge-dark text-light">Comments 20</span>
          <hr my-2>
          <h5 class="card-text" ><?php if (strlen($PostDescription) > 150) {
            $PostDescription = substr($PostDescription, 0, 150) . "...";}echo htmlentities($PostDescription); ?></h5>
          
          <a href="FullPost.php?id=<?php echo $PostId; ?>" style="float:right">
          <span class="btn btn-lg btn-info">Read more >></span>
        </a>
        </div>
      </div>
     <?php } ?>

      
    </div>
    <div class="col-sm" style="background-color: green;" >
      One of three columns
    </div>
    
  </div>
</div>
</body>
</html>