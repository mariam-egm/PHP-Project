<?php
    $error = array();

    if(isset($_POST["submit"]))
    {
        //User name check
        if(strlen($_POST["user_name"])> $max_user_name || strlen($_POST["user_name"])==0)
        {
            $error[] = "Invalid User Name";           
        }

        // password check
        if(strlen($_POST["password"])>$max_password ||
           strlen($_POST["password"])<$min_password ||
           strlen($_POST["password"])==0)
        {
            $error[] = "Invalid password. It should be between 8 and 16 characters";            
        }

        //name check
        if(strlen($_POST["name"]) > $max_name ||strlen($_POST["name"])==0 )
        {
            $error[] = "Invalid name";           
        }

        //email
        if(!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL) || strlen($_POST["email"])==0)
        {
            $error[] = "Invalid email";
        }

        //Job check
        if(strlen($_POST["job"])==0)
        {
            $error[] = "Please Enter a Job";
        }
        //Img check
        if (! file_exists($_FILES["img"]["tmp_name"])) 
        {
            $error[] = "Please Enter an Image";
        }
        else{
            // Get image file extension
            $file_extension = pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
            if(!($file_extension === $allowed_image_extension))
            {
                $error[] = "Invalid extension, only jpg allowed";
            }
            if(($_FILES["img"]["size"]) > 1000000)
            {
                $error[] = "Image size exceeded 1M";
                
            }
        }

        //CV check
        if (! file_exists($_FILES["cv"]["tmp_name"])) 
        {
            $error[] = "Please Enter your CV/Resume";
        }
        else{
            // Get CV file extension
            $file_extension = pathinfo($_FILES["cv"]["name"], PATHINFO_EXTENSION);
            if(!($file_extension === $allowed_file_extension))
            {
                $error[] = "Invalid extension, only PDF allowed";
            }
            if(($_FILES["cv"]["size"]) > 1000000)
            {
                $error[] = "File size exceeded 1M";
                
            }
        }


        if(sizeof($error)==0)
        {
            $new_values = array(
                "Username" => $_POST["user_name"],
                "Password" => $_POST["password"],
                "Name" => $_POST["name"],
                "Email" => $_POST["email"],
                "Image" => $_FILES["img"]["name"],
                "CV" => $_FILES["cv"]["name"]
            );
            // var_dump($_FILES["cv"]);
            $register = $user->user_sign_up($new_values);
            if ($register) {
                // Registration Success
                echo "<br> Registration successfully <br/> <a href= '" . $_SERVER["PHP_SELF"] . "?login '> Click Here </a> to Log in <br/>";

                } else {
                    // Registration Failed
                    echo "<script type='text/javascript'> alert(\"Registration Failed. Please Try again\"); </script>";
                }

            // echo "Thank you for contacting us <br/>";
            exit();
        }
        else
        {
            foreach($error as $val)
            {
                // echo "<script type='text/javascript'> alert ('$val'); </script> <br/>";
                // echo "<script type='text/javascript'> alert(\"$val\"); </script> <br/>";
                alert("$val");
            }
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

        <div class="formdiv">
            <form id="signup_form" action="#" method="POST" enctype="multipart/form-data">

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
                    <input id="name" class="input" name="name" type="text" value=" <?php echo (isset($_POST[" name"]))?
                        $_POST["name"]:"" ?> "
                    size="30" /><br />

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
                    <input id="job" class="input" name="job" type="text" value=" <?php echo (isset($_POST[" job"]))?
                        $_POST["job"]:"" ?> "
                    size="30" /><br />

                </div>

                <!-- IMAGE -->
                <div class="row">
                    <label class="img">Upload your Image:</label><br />
                    <input type="file" class="img" name="img"><br />
                    <label class="sub-label">
                        Attached image file must be PNG file.
                    </label>
                </div>

                <!-- CV -->
                <div class="row">
                    <label class="cv">Upload your CV:</label><br />
                    <input type="file" class="cv" name="cv"><br />
                    <label class="sub-label">
                        Attached file must be PDF file.
                    </label>
                    <br /><br />
                </div>

                <div class="btn">
                    <input class="submitbtn" name="submit" type="image" src="./images/submitbtn.png" />
                </div>

            </form>
        </div>
    </div>

</body>

</html>