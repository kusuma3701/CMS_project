<?php require_once("functions.php")?>
<?php require_once("sessions.php")?>
<?php
$_SESSION["UserId"] = null;
   $_SESSION["UserName"] = null;
   $_SESSION["AdminName"] = null;
session_destroy();
Redirect_to("Login.php");
?>