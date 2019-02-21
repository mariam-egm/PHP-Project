<?php

class User{
    protected $dbObj;
    protected $user_data;
    protected $errors;
    protected $validationObj;

    public function __construct($db){
        $this->dbObj = $db;
        $this->errors = array();
        $this->validationObj = new Validations($db);
    }

    public function login($username, $password){
        $this->errors[] = $this->validationObj->is_valid_username($username);
        if(empty($this->errors)){
            $password = password_hash(trim($password, PASSWORD_DEFAULT));
            $this->errors[] = $this->validationObj->is_valid_password($password);
            if(empty($this->errors)){
                return true;
            }else{
                return "Invalid Password";
            }
        }else{
            return "Invalid Username";
        }
    }
}
?>