<?php
session_start();
session_regenerate_id();
// session_destroy();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("autoload.php");
define("_ALLOW_ACCESS", 1);
$user = new MySQL("member");
//********************************************//
//Routing
if(isset($_GET["logout"]))
{
    session_destroy();
    require_once("Views/logout.php"); 
}

if (isset($_SESSION["user_id"]) && isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] === true) {
     
    //admin views should be required here
    if(isset($_GET["id"]))
    {
        require_once("Views/admin/user.php");     
    }else
    {
        require_once("Views/admin/users.php");
    }
    if(isset($_GET["users"]))
    {
        require_once("Views/admin/users.php");    
    }

} elseif (isset($_SESSION["user_id"]) && isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] === false) {
    //members views should be required here
    if(isset($_GET["edit"]))
    {
        require_once("Views/member/edit_my_profile.php");     
    }else
    {
        require_once("Views/member/view_my_profile.php");
    }
} else {
    //public views should be required here
    if(isset($_GET["signup"])){
        
        require_once("Views/public/signup.php");
    }
    else{
        require_once("Views/public/login.php");
    }
}
//********************************************//
?>      


