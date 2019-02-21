<?php

class Validations{

    protected $dbObj;
    protected $mysql;

    public function __construct($db){
        $this->dbObj = $db;
    }

    public function is_valid_username($username){
        if($this->dbObj->get_record_by_username($username)){
            return NULL;
        } else {
            return "Invalid Username";
        }
    }

    public function is_valid_password($password){
        $value = $this->dbObj->get_record_by_username($username);
        if ($value["password"] === $password){
            return Null;
        }else{
            return "Invalid Password";
        }
    }

    public function is_unique_username($username){

    }

    public function is_valid_password_length($password){

    }

    public function is_valid_name($name){

    }

    public function is_valid_email($email){

    }

    public function is_valid_job($job){

    }

    public function is_valid_image_size($image){

    }

    public function is_valid_image_extension($image){

    }

    public function is_valid_cv_size($cv){

    }

    public function is_valid_cv_extension($cv){

    }
}


?>