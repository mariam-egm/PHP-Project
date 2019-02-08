<?php
require_once("Model/MySQL.php");
$log = new MySQL("member");

if(isset($_REQUEST['submit'])){
    extract($_REQUEST);
    $login = $log->check_login($user_name, $password);
    if ($login) {
        // Registration Success
        // header("location:home.php");
    } else {
        // Registration Failed
        echo "Wrong username or password <br/> If you're not a member, Please Sign Up";
    }
}
?>

<html>
    <body>
    <h3> Log in </h3>
        <div id="after_submit">
            
        </div>
        <form id="login_form" action="#" method="POST" enctype="multipart/form-data">

            <div class="row">
                <label class="required" for="user_name">Username/Email:</label><br />
                <input id="user_name" class="input" name="user_name" type="text" value="" size="30" /><br />

            </div>

            <div class="row">
                <label class="required" for="password">Password:</label><br />
                <input id="password" class="input" name="password" type="password" value="" size="30" /><br />

            </div>


            <input id="submit" name="submit" type="submit" value="Log In" />
            
        </form>
        <?php 
        echo "<a href= '" . $_SERVER["PHP_SELF"] . "?signup '> Sign up </a>";

        ?>

    </body>
</html>

