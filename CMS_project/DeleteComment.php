<?php require_once("db.php")?>
<?php require_once("functions.php")?>
<?php require_once("sessions.php")?>
<?php

if(isset($_GET["id"])){
    $SearchQueryParameter = $_GET["id"];
    global $connectingdb;
    
    $sql = "DELETE FROM comments WHERE id='$SearchQueryParameter'";
    $Execute = $connectingdb->query($sql);  
    if($Execute){
        $_SESSION["SuccessMessage"] = "Comment Deleted Successfully!!";
        Redirect_to("comments.php");
    }
    else{
        $_SESSION["ErrorMessage"] = "Something went wrong! Try Again!!";
        Redirect_to("comments.php");
    }
}
?>