<?php require_once("db.php")?>
<?php require_once("functions.php")?>
<?php require_once("sessions.php")?>
<?php

if(isset($_GET["id"])){
    $SearchQueryParameter = $_GET["id"];
    global $connectingdb;
    $Admin = $_SESSION["AdminName"];
    $sql = "UPDATE comments SET status='ON',approvedby='$Admin' WHERE id='$SearchQueryParameter'";
    $Execute = $connectingdb->query($sql);  
    if($Execute){
        $_SESSION["SuccessMessage"] = "Comment Approved Successfully!!";
        Redirect_to("comments.php");
    }
    else{
        $_SESSION["ErrorMessage"] = "Something went wrong! Try Again!!";
        Redirect_to("comments.php");
    }
}
?>