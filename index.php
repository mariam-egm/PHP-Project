<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("autoload.php");
define("_ALLOW_ACCESS", 1);

$user = new MySQL("member");

//********************************************//
//Routing
if (isset($_SESSION["user_id"]) && $_SESSION["is_admin"] === True) {
    //admin views should be required here
} elseif (isset($_SESSION["user_id"]) && $_SESSION["is_admin"] === False) {
    //members views should be required here
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