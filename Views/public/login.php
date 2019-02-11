<?php
$error = array();
if(isset($_POST['submit'])){

    if(strlen($_POST["user_name"])> __MAX__USER__NAME__ || strlen($_POST["user_name"])==0)
    {
        $error[] = "Invalid User Name";           
    }

    // password check
    if(strlen($_POST["password"]) > __MAX__PASSWORD__ ||
       strlen($_POST["password"]) < __MIN__PASSWORD__ ||
       strlen($_POST["password"]) == 0)
    {
        $error[] = "Invalid password. It should be between 8 and 16 characters.";            
    }
    if(sizeof($error) == 0)
    {
        
        $new_values = array(
            "Username" => $_POST["user_name"],
            "Password" => $_POST["password"]
        );

        $login = $user->check_login($new_values);

        if ($login) {
            //echo "Successfully logged in";
            $_SESSION["user_id"] = $user->get_user_id($_POST["user_name"]);
            $_SESSION["is_admin"]= $user->is_admin($user->get_user_id($_POST["user_name"]));

            echo "<script type='text/javascript'> alert('Successfully logged in'); </script>";
            header("Location: http://localhost/PHP-Project/"); 

        } else {
            echo "<script type='text/javascript'> alert('Wrong username or password <br/> If you're not a member, Please Sign Up'); </script>";
        }
    }
    // else
    // {
    //     foreach($error as $val)
    //     {
    //         echo "<script type='text/javascript'> alert('hiii'); </script> ";
    //     }
    // }
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
        <div class="errors">
            <?php

                if(sizeof($error) != 0)
                {
                    foreach($error as $ay7aga)
                    {
                        echo $ay7aga;
                    }
                }

            ?>
        </div>
        <div class="formdiv">

            <form id="login_form" method="POST" enctype="multipart/form-data" ">

                <div class=" row">
                <label class="username">Username</label><br />
                <input id="user_name" class="input" name="user_name" type="text" value="" size="30" /><br />

        </div>

        <div class="row">
            <label class="password">Password</label><br />
            <input id="password" class="input" name="password" type="password" value="" size="30" /><br />

        </div>

        <div class="btn">
            <input class="loginbtn" name="submit" type="submit" value="Log In" />
            <br />
        </div>
        <br />
        </form>
        <div class="btn">
            <?php 
            echo "<button> <a class='signupbtn' href= '" . $_SERVER["PHP_SELF"] . "?signup '> Register </a> </button>";
            ?>
        </div>
    </div>
    </div>
</body>

</html>