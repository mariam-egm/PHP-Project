<?php

$id = $_SESSION["user_id"];
$current_user = $user->get_record(4);

?>



<html>
<body>
    hiiiiiiiiiiiiiiiii
    <?php
        var_dump($current_user);
    ?>
</body>
</html>