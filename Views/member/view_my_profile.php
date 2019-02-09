<?php

$id = (int)$_SESSION["user_id"];
$current_user = $user->get_record($id);
$user_name =$current_user[0]["username"];
$name = $current_user[0]['name'];
$email = $current_user[0]['email'];
$img = $current_user[0]['image'];
$cv = $current_user[0]['cv'];

?>


<html>

<body>
    <div>
        Welcome to your Profile
    </div>

    <!-- User Name -->
    <div>
        <?php  echo"$user_name"   ;?>
    </div>

    <!-- Name -->
    <div>
        <?php  echo"$name"   ;?>
    </div>

    <!-- Email -->
    <div>
        <?php  echo"$email"   ;?>
    </div>

    <!-- Image -->
    <div>
        <img src="<?php echo "./profile_pictures/1.png"; ?>">
        <?php  echo"$img"   ;?>
    </div>

    <!-- CV -->
    <div>
        <?php  echo"$cv"   ;?>
    </div>

    <?php 
        echo "<a href= '" . $_SERVER["PHP_SELF"] . "?edit '> 
        Edit your profile </a>";
    ?>
</body>

</html>