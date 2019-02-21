<?php

$id = (int)$_SESSION["user_id"];
$current_user = $user->get_record($id);
$user_name =$current_user[0]["username"];
$name = $current_user[0]["name"];
$email = $current_user[0]["email"];
$img = $current_user[0]["image"];
$cv = $current_user[0]["cv"];
$password = $current_user[0]["password"];
$job= $current_user[0]["job"];
$error = array();

if(isset($_POST["submit"]))
{
    //User name check
    if(strlen($_POST["user_name"]) > __MAX__USER__NAME__)
    {
        $error[] = "Invalid User Name";           
    }

    // password check
    // if(strlen($_POST["password"])>$max_password ||
    //    strlen($_POST["password"])<$min_password)
    // {
    //     $error[] = "Invalid password. It should be between 8 and 16 characters";            
    // }

    //name check
    if(strlen($_POST["name"]) > __MAX__NAME__)
    {
        $error[] = "Invalid name";           
    }

    //email
    // if(!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL))
    // {
    //     $error[] = "Invalid email";
    // }

    //Img check
    if ( file_exists($_FILES["img"]["tmp_name"])) 
    {
        // Get image file extension
        $file_extension = pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
        if(!($file_extension === __IMG___EXTENSION__ ))
        {
            $error[] = "Invalid extension, only jpg allowed";
        }
        if(($_FILES["img"]["size"]) > 1000000)
        {
            $error[] = "Image size exceeded 1M";
            
        }
    }


    //CV check
    if ( file_exists($_FILES["cv"]["tmp_name"])) 
    {
        // Get CV file extension
        $file_extension = pathinfo($_FILES["cv"]["name"], PATHINFO_EXTENSION);
        if(!($file_extension === __FILE__EXTENSION__ ))
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
        if(isset($_POST["user_name"]) && !empty($_POST["user_name"]))
        {
            $p_user_name = $_POST["user_name"];
        }else
        {
            $p_user_name=$user_name;
        }
        if(isset( $_POST["password"]) && !empty($_POST["password"]))
        {
            $p_password = $_POST["password"];
        }else
        {
            $p_password = $password;
        }
        if(isset( $_POST["name"]) && !empty($_POST["name"]))
        {
            $p_name = $_POST["name"];
        }else
        {
            $p_name = $name;
        }
        if(isset( $_POST["email"]) && !empty($_POST["email"]))
        {
            $p_email = $_POST["email"];
        }else
        {
            $p_email = $email;
        }
        // if(isset( $_POST["job"]) && !empty($_POST["job"]))
        // {
        //     $p_job = $_POST["job"];
        // }else
        // {
        //     $p_job = $job;
        // }
        if(isset( $_FILES["img"]["name"]) && !empty($_FILES["img"]["name"]) )
        {
            $p_img = $_FILES["img"]["name"];
        }else
        {
            $p_img = $img;
        }
        if(isset( $_FILES["cv"]["name"]) && !empty($_FILES["cv"]["name"]))
        {
            $p_cv= $_FILES["cv"]["name"];
        }else
        {
            $p_cv = $cv;                
        }
        
        $new_values = array(

            "Username" => $p_user_name,
            "Password" => $p_password,
            "Name" => $p_name,
            "Email" => $p_email,
            "Job" => $p_job,
            "Image" => $p_img,
            "CV" => $p_cv
        );
        $is_edited = $user->edit_profile($new_values,$id);
        if ($is_edited) {
            // Registration Success
            echo "<script type='text/javascript'> alert('Your Profile is edited successfully');</script> <a href= '" . $_SERVER["PHP_SELF"] . "?login '> Click Here </a> to Log in ";

            } else {
                // Registration Failed
                echo "<script type='text/javascript'> alert(\"Editing Failed. Please Try again\"); </script>";
            }
        header("Location: http://localhost:8080/PHP-Project/");
        
    }
    // else
    // {
    //     foreach($error as $val)
    //     {
    //         echo "<script type='text/javascript'> alert ('$val'); </script> <br/>";
    //     }
    // }

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
                    Here you can edit your info.
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
                    <input id="user_name" class="input" placeholder="<?php echo" $user_name"?>" name="user_name"
                    type="text" value="
                    <?php echo (isset($_POST["
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
                    <input type="text" id="name" class="input" placeholder="<?php echo" $name"?>" name="name" value="
                    <?php echo (isset($_POST["
                        name"]))? $_POST["name"]:"" ?>" >
                </div>

                <!-- EMAIL -->

                <div class="row">
                    <label class="email">Your Email:</label><br />
                    <input id="email" class="input" placeholder="<?php echo" $email"?>" name="email" type="text"
                    value="
                    <?php echo (isset($_POST["
                        email"]))? $_POST["email"]:"" ?>"
                    size="30" /><br />
                </div>

                <!-- JOB -->
                <div class="row">
                    <label class="job">Your Job:</label><br />
                    <input type="text" id="job" class="input" placeholder="<?php echo" $job"?>" name="job" value="
                    <?php echo (isset($_POST["
                        job"]))? $_POST["job"]:"" ?>" >
                </div>


                <!-- IMAGE -->
                <div class="row">
                    <label class="img">Upload your Image:</label><br />
                    <input type="file" class="img" name="img"><br />
                    <label class="sub-label">
                        Attached image file must be PNG file. Max File size is 1MB.
                    </label>
                </div>

                <!-- CV -->
                <div class="row">
                    <label class="cv">Upload your CV:</label><br />
                    <input type="file" class="cv" name="cv"><br />
                    <label class="sub-label">
                        Attached file must be PDF file. Max File size is 1MB.
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