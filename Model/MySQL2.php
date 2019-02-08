<?php

class MYSQL implements DbHandler{
    public $_table;
    public $_db_handler;
    
    public function __construct($table){
        $this->_table = $table;
        $this->connect();
    }

    public function connect(){
        $handler = mysqli_connect(__HOST__, __USER__, __PASS__,__DB__);
        if($handler){
            $this->_db_handler = $handler;
        }
        else if(mysqli_connect_errno()){
            echo "Error: Could not connect to Database.";
            exit();
        }
    }

    //REGISTRATION PROCCESS
    public function reg_user($name,$user_name,$password,$email,$img_input,$cv_input){
        $sql = "SELECT * FROM $db where Username='$user_name' OR Email='$email'";

        //Check if username or email already exists in db
        $check =  ($this->_db_handler)->query($sql) ;
        $count_row = $check->num_rows;

        //if not in db then insert into table the new one
        if($count_row == 0){
            $sql1 = " INSERT INTO $db Set ('Username','Password','Name','Email','Image','CV') VALUES ('$user_name','$password','$name','$email','$img_input','$cv_input') ";
            // $result = mysqli_query($this->db,$sql1) or die(mysqli_connect_errno()."Data cannot be inserted");
            // return $result;

            $result = mysqli_query($this->_db,$sql1);
            if($result){
                return $result;
            }
            else{
                // echo "Data cannot be inserted";
                die(mysqli_connect_errno()."Data cannot be inserted");
            }
        }
        else {
            return false;
        }
    }


    //LOGIN PROCESS
    public function check_login($user_name,$password,$email){
        $sql2 = " SELECT ID FROM $db WHERE Username = '$user_name' OR Email = '$email' ";
        
        //Check if username already exists in db
        $result = mysqli_query($this->_db,$sql2);
        $user_data = mysqli_fetch_array($result);
        $count_row = $result->num_rows;

        if($count_row == 1){
            // this login var will use for the session thing
            $_SESSION["login"] = true;
            $_SESSION["ID"] = $user_data["ID"];
            return true;
        }

        else{
            return false;
        }
    }

    /*** starting the session ***/
    public function get_session(){
        return $_SESSION["login"];
    }

    public function user_logout() {
        $_SESSION["login"] = FALSE;
        session_destroy();
    }
    
    public function disconnect() {
        if($this->_db_handler){
            mysqli_close($this->_db_handler);
        }
    }
}