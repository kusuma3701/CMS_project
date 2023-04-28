<?php require_once("db.php")?>
<?php require_once("functions.php")?>
<?php require_once("sessions.php")?>
<?php

if(isset($_GET["id"])){
    $SearchQueryParameter = $_GET["id"];
    global $connectingdb;
    
    $sql = "DELETE FROM admins WHERE id='$SearchQueryParameter'";
    $Execute = $connectingdb->query($sql);  
    if($Execute){
        $_SESSION["SuccessMessage"] = "Admin Deleted Successfully!!";
        Redirect_to("Admins.php");
    }
    else{
        $_SESSION["ErrorMessage"] = "Something went wrong! Try Again!!";
        Redirect_to("Admins.php");
    }
}
?>