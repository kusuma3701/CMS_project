<?php require_once("db.php")?>
<?php require_once("functions.php")?>
<?php require_once("sessions.php")?>
<?php

if(isset($_GET["id"])){
    $SearchQueryParameter = $_GET["id"];
    global $connectingdb;
    
    $sql = "DELETE FROM category WHERE id='$SearchQueryParameter'";
    $Execute = $connectingdb->query($sql);  
    if($Execute){
        $_SESSION["SuccessMessage"] = "Category Deleted Successfully!!";
        Redirect_to("Categories.php");
    }
    else{
        $_SESSION["ErrorMessage"] = "Something went wrong! Try Again!!";
        Redirect_to("Categories.php");
    }
}
?>