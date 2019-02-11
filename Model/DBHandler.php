<?php
interface DBHandler {
    public function connect();
    // public function __construct();
    // public function reg_user($name,$user_name,$password,$email,$img_input,$cv_input);
    // public function check_login($user_name,$password);
    // public function get_session();
    // public function user_logout();
    public function disconnect();   
}
?>
