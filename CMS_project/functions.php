<?php require_once("db.php")?>
<?php
function Redirect_to($New_Location)
{
    header("Location:".$New_Location);
    exit;
}
function CheckFunctionIfUsernameExists($UserName){
    global $connectingdb;
    $sql = "SELECT username FROM admins WHERE username=:userName";
    $stmt = $connectingdb->prepare($sql);
    $stmt->bindValue(':userName', $UserName);
    $stmt->execute();
    $Result = $stmt->rowcount();
    if($Result==1){
        return true;
    }
    else{
        return false;
    }
}
function Login_Attempt($UserName,$Password)
{
    global $connectingdb;
        $sql = "SELECT * FROM admins WHERE username=:userName AND password=:passWord LIMIT 1";
        $stmt = $connectingdb->prepare($sql);
        $stmt->bindValue(':userName', $UserName);
        $stmt->bindValue(':passWord', $Password);
        $stmt->execute();
        $Result = $stmt->rowcount();
        if($Result==1)
        {
        return $Found_Account = $stmt->fetch();
        }
        else{
        return null;
        }
}
function Confirm_Login(){
    if (isset($_SESSION["User_ID"])) {
        
        return true;
    }
    else{
        $_SESSION["ErrorMessage"] = "Login Required !!";
        Redirect_to("Login.php");
    }
}
?>