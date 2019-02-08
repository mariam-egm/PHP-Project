<?php

class MYSQL implements DBHandler{
    private $_db_handler;
    private $_table;
    
    public function __construct($table){
        $this->_table = $table;
        $this->connect();
    }

    public function connect(){
        $handler = mysqli_connect(__HOST__, __USER__, __PASS__,__DB__);
        if($handler){
            $this->_db_handler = $handler;
            return true;
        }
        else{
            echo "Error: Could not connect to Database.";
            return false;
        }
    }

    public function disconnect() {
        if($this->_db_handler){
            mysqli_close($this->_db_handler);
        }
    }

    //REGISTRATION PROCCESS
    // public function reg_user($name,$user_name,$password,$email,$img_input,$cv_input){
        // $table = $this->_table;
        // $sql = " SELECT * FROM $table where Username = $user_name ";

        //Check if username already exists in db
        // $check = mysqli_query($this->_db_handler, $sql);
        // var_dump($check);
        //if not in db then insert into table the new one
        // if($check){
        //     $sql1 = " INSERT INTO $table VALUES ('1','$user_name','$password','$name','$email','$img_input','$cv_input','True') ";
        //     // $result = mysqli_query($this->db,$sql1) or die(mysqli_connect_errno()."Data cannot be inserted");
        //     // return $result;

        //     $_handler_result = mysqli_query($this->_db_handler,$sql1);
        //     if($_handler_result){
        //         return true;
        //     }
        //     else{
        //         echo "Data cannot be inserted <br/>";
        //         // die(mysqli_connect_errno()."Data cannot be inserted");
        //         return false;
        //     }
        // }
        // else {
        //     echo "User already exists. Please Log in. <br>";
        //     return false;
        // }
    // }

    public function insert_user($new_values){
        if(is_array($new_values)){
            $table = $this->_table;
            $sql1 = "Insert into $table (";
            $sql2 = "values (";
            foreach($new_values as $key => $value){
                $sql1 .= " $key,";
                $sql2 .= " '$value',";
            }
            $sql1 = $sql1.")";
            $sql2 = $sql2.")";
            $sql1 = str_replace( ",)" , ") " , $sql1);
            $sql2 = str_replace( ",)" , ")" , $sql2);
            $sql = $sql1.$sql2;
            // var_dump($new_values);

            // if (__Debug__Mode__ === 1)
            // {
            //     echo "hii";
            //     echo "<h5>Sent Query: </h5>" . $sql . "<br/> <br/>";
            // }

            $_handler_results = mysqli_query($this->_db_handler, $sql);

            if($this->_db_handler->query($sql) == True){
                echo "the query was right <br>";
                return true;    
                // $this->disconnect();
            }else{
                // $this->disconnect();
                echo "la2 :) <br>" ;
                return false;
            }
        }
    }


    //LOGIN PROCESS
    public function check_login($user_name,$password){
        $sql2 = " SELECT ID FROM member WHERE Username = '$user_name' ";
        
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
        return $_SESSION["login"] = TRUE;
    }

    public function user_logout() {
        $_SESSION["login"] = FALSE;
        session_destroy();
    }
    
}