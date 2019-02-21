<?php
    $error = array();

    if(isset($_POST["submit"]))
    {
        //User name check
        if(strlen($_POST["user_name"])> __MAX__USER__NAME__ || strlen($_POST["user_name"])==0)
        {
            $error[] = "Invalid User Name. <br/>";           
        }

        // password check
        if(strlen($_POST["password"]) > __MAX__PASSWORD__ ||
           strlen($_POST["password"]) < __MIN__PASSWORD__ ||
           strlen($_POST["password"]) == 0)
        {
            $error[] = "Invalid password. It should be between 8 and 16 characters. <br/>";            
        }

        //name check
        if(strlen($_POST["name"]) > __MAX__NAME__ || strlen($_POST["name"]) == 0 )
        {
            $error[] = "Invalid name. <br/>";           
        }

        //email
        if(!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL) || strlen($_POST["email"])==0)
        {
            $error[] = "Invalid email. <br/>";
        }

        //Job check
        if(strlen($_POST["job"])==0)
        {
            $error[] = "Please Enter a Job. <br/>";
        }
        //Img check
        if (! file_exists($_FILES["img"]["tmp_name"])) 
        {
            $error[] = "Please Enter an Image. <br/>";
        }
        else{
            // Get image file extension
            $file_extension = pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
            if(!($file_extension === __IMG___EXTENSION__ ))
            {
                $error[] = "Invalid extension, only jpg allowed. <br/>";
            }
            if(($_FILES["img"]["size"]) > 1000000)
            {
                $error[] = "Image size exceeded 1M. <br/>";
                
            }
            if($_FILES["img"]["name"] != ($_POST["user_name"].".".$file_extension))
            {
                $error[] = "Invalid image name. <br/>";
                
            }
        }

        //CV check
        if (! file_exists($_FILES["cv"]["tmp_name"])) 
        {
            $error[] = "Please Enter your CV/Resume. <br/>";
        }
        else{
            // Get CV file extension
            $file_extension = pathinfo($_FILES["cv"]["name"], PATHINFO_EXTENSION);
            if(!($file_extension === __FILE__EXTENSION__ ))
            {
                $error[] = "Invalid extension, only PDF allowed. <br/>";
            }
            if(($_FILES["cv"]["size"]) > 1000000)
            {
                $error[] = "File size exceeded 1M. <br/>";
                
            }
            if($_FILES["cv"]["name"] != ($_POST["user_name"].".".$file_extension))
            {
                $error[] = "Invalid CV name. <br/>";
                
            }
        }


        if(sizeof($error)==0)
        {
            var_dump($_FILES["img"]["tmp_name"]);
            $img_check = move_uploaded_file($_FILES["img"]["tmp_name"],"profile_pictures/".$_FILES["img"]["name"]);
            
            var_dump($_FILES["cv"]["tmp_name"]);
            $cv_check = move_uploaded_file($_FILES["cv"]["tmp_name"],"cvs/".$_FILES["cv"]["name"]);

            $new_values = array(
                "Username" => $_POST["user_name"],
                "Password" => password_hash(trim($_POST["password"]), PASSWORD_DEFAULT),
                "Name" => $_POST["name"],
                "Email" => $_POST["email"],
                "Job" => $_POST["job"],
                "Image" => $_FILES["img"]["name"],
                "CV" => $_FILES["cv"]["name"]
            );
            // var_dump($_FILES["cv"]);
            $register = $user->user_sign_up($new_values);
            if ($register) {
                // Registration Success
                echo "Registration has been done successfully
                <a href= '" . $_SERVER["PHP_SELF"] . "?login '> Click Here </a> to Log in <br/>";

                }else {
                    // Registration Failed
                    echo "Registration Failed. Please Try again";
                }
            header("Location: http://localhost:8080/PHP-Project/");
            
        }
    }
?>

<html>

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
                    Fill the form below accurately indicating your potentials and suitability to job applying for.
                </div>
            </div>
        </div>
        <div class="errors">
            <?php

                if(sizeof($error) != 0)
                {
                    foreach($error as $val)
                    {
                        echo "<p color='red' align='center'>".$val."</p>";
                    }
                }

            ?>
        </div>
        <div class="formdiv">
            <form id="signup_form" method="POST" enctype="multipart/form-data">

                <!-- USERNAME -->
                <div class="row">
                    <label class="username">User Name:</label><br />
                    <input id="user_name" class="input" name="user_name" type="text" value="<?php echo (isset($_POST["
                        user_name"]))? $_POST["user_name"]:"" ?>"
                    size="30" /><br />

                </div>

                <!-- PASSWORD -->
                <div class="row">
                    <label class="password">Password:</label><br />

                    <input id="password" class="input" name="password" type="password" value="<?php echo (isset($_POST["
                        password"]))? $_POST["password"]:"" ?>"
                    size="30" /><br />
                    <label class="sub-label">
                        Password must be between 8 and 16 characters
                    </label>

                </div>

                <!-- NAME -->
                <div class="row">
                    <label class="name">Your Full Name:</label><br />
                    <input type="text" id="name" class="input" name="name" value="<?php echo (isset($_POST[" name"]))?
                        $_POST["name"]:"" ?>" >
                </div>

                <!-- EMAIL -->

                <div class="row">
                    <label class="email">Your Email:</label><br />
                    <input id="email" class="input" name="email" type="text" value="<?php echo (isset($_POST["
                        email"]))? $_POST["email"]:"" ?>"
                    size="30" /><br />
                </div>

                <!-- JOB -->
                <div class="row">
                    <label class="job">Your Job:</label><br />
                    <input type="text" id="job" class="input" name="job" 
                    value="<?php echo (isset($_POST["job"]))? $_POST["job"]:"" ?>" />
                </div>

                <!-- IMAGE -->
                <div class="row">
                    <label class="img">Upload your Image:</label><br />
                    <input type="file" class="img" name="img"><br />
                    <label class="sub-label">
                        Attached file name must be the same as your USERNAME and extension JPG file. Max File size is
                        1MB.
                    </label>
                </div>

                <!-- CV -->
                <div class="row">
                    <label class="cv">Upload your CV:</label><br />
                    <input type="file" class="cv" name="cv"><br />
                    <label class="sub-label">
                        Attached file name must be the same as your USERNAME and PDF file. Max File size is 1MB.
                    </label>
                    <br /><br />
                </div>

                <div class="btn">
                    <input class="submitbtn" name="submit" type="submit" value="Submit" />
                </div>

            </form>
        </div>
    </div>

</body>

</html>