<?php
$error = array();
if(isset($_POST['submit'])){
    // extract($_REQUEST);
    //User name check
    // echo "submit if";
    if(strlen($_POST["user_name"])> __MAX__NAME__ || strlen($_POST["user_name"])==0)
    {
        $error[] = "Invalid User Name";           
    }

    // password check
    if(strlen($_POST["password"]) > $max_password ||
       strlen($_POST["password"]) < $min_password ||
       strlen($_POST["password"]) == 0)
    {
        $error[] = "Invalid password. It should be between 8 and 16 characters";            
        // echo "mogefrvr";
    }
    var_dump($error);
    if(sizeof($error) == 0)
    {
        
        $new_values = array(
            "Username" => $_POST["user_name"],
            "Password" => $_POST["password"]
        );
        $login = $user->check_login($new_values);
        if ($login) {
            echo "Successfully logged in";
            // session_start();
            // echo "from login page this is the return from get user id <br>";
            // var_dump($user->get_user_id($_POST["user_name"]));
            $_SESSION["user_id"] = $user->get_user_id($_POST["user_name"]);
            $_SESSION["is_admin"]= $user->is_admin($user->get_user_id($_POST["user_name"]));
            // var_dump($_SESSION);
            echo "hello login";
            // echo $_SESSION["is_admin"];
        } else {
            // Login Failed
            echo "Wrong username or password <br/> If you're not a member, Please Sign Up";
        }
    }
}
?>

<!DOCTYPE html>
<head>
    <title> LOG IN PAGE </title>
</head>

<body>
    <h3> Log in </h3>
        <div id="after_submit">
            
        </div>
        <form id="login_form" method="POST" enctype="multipart/form-data">

            <div class="row">
                <label class="required" for="user_name">Username</label><br/>
                <input id="user_name" class="input" name="user_name" type="text" value="" size="30" /><br />

            </div>

            <div class="row">
                <label class="required" for="password">Password</label><br/>
                <input id="password" class="input" name="password" type="password" value="" size="30" /><br />

            </div>

            <input id="submit" name="submit" type="submit" value="Log In"/>
            
        </form>
        <?php 
        echo "<a href= '" . $_SERVER["PHP_SELF"] . "?signup '> Sign up </a>";
        ?>
        </div>
        </div>
    </body>
</html>