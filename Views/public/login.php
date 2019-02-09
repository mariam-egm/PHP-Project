<?php
$error = array();
if(isset($_POST['submit'])){
    // extract($_REQUEST);
    //User name check
    echo "submit if";
    if(strlen($_POST["user_name"])> __MAX__NAME__ || strlen($_POST["user_name"])==0)
    {
        $error[] = "<script type='text/javascript'> alert('Invalid User Name'); </script>";           
    }

    // password check
    if(strlen($_POST["password"]) > $max_password ||
       strlen($_POST["password"]) < $min_password ||
       strlen($_POST["password"]) == 0)
    {
        $error[] = "<script type='text/javascript'> alert(\"Invalid password. It should be between 8 and 16 characters\"); </script>";            
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
            $_SESSION["user_id"] = $user->get_user_id($_POST["user_name"]);
            $_SESSION["is_admin"]= $user->is_admin($user->get_user_id($_POST["user_name"]));
            echo "hello login";
            echo "<script 'text/javascript'> 
            alert(\"Successfully logged in\"); 
            </script>";
        } else {
            // Login Failed
            echo "<script type='text/javascript'> alert(\"Wrong username or password <br/> If you're not a member, Please Sign Up\"); </script>";
        }
    }
}
?>

<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div id="after_submit">
    </div>

    <div class="bigdiv">

        <img src="./images/headerimg.png" class="headerimg" />

        <div class="form-header-group ">
            <div class="header-text httal htvam">
                <h2 id="header_293" class="form-header" data-component="header">
                    Employment Application
                </h2>
                <div id="subHeader_293" class="form-subHeader">
                    If you're not a member Please Register.
                </div>
            </div>
        </div>

        <div class="formdiv">
            <form id="login_form" method="POST" enctype="multipart/form-data">

                <div class="row">
                    <label class="username">Username</label><br />
                    <input id="user_name" class="input" name="user_name" type="text" value="" size="30" /><br />

                </div>

                <div class="row">
                    <label class="password">Password</label><br />
                    <input id="password" class="input" name="password" type="password" value="" size="30" /><br />

                </div>

                <div class="btn">
                    <input class="loginbtn" name="submit" type="image" src="../images/login.jpg" /><br/>
                </div>
                <br/>
            </form>
            <div class="btn">
            <?php 
            echo "<a href= '" . $_SERVER["PHP_SELF"] . "?signup '> 
            <img  class ='signupbtn' src='../images/registerbtn.png' </a>";
            ?>
            </div>
        </div>
    </div>
</body>

</html>