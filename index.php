<?php
session_start();
// session_destroy();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("autoload.php");
define("_ALLOW_ACCESS", 1);
$user = new MySQL("member");
// var_dump($_SESSION);
//********************************************//
//Routing
if (isset($_SESSION["user_id"]) && isset($_SESSION["is_admin"]) && $_SESSION["is_admin"]== true) {
    // 
    //admin views should be required here
    // echo " if condition one";
    // var_dump($_SESSION);
    // require_once("Views/member/view_my_profile.php");
} elseif (isset($_SESSION["user_id"]) && isset($_SESSION["is_admin"])) {
    //members views should be required here
    // echo "if condition two";
    require_once("Views/member/view_my_profile.php");
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


