<?php

class MYSQL implements DbHandler{
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

    public function user_sign_up($new_values){
        if(is_array($new_values)){
            $table = $this->_table;
            foreach($new_values as $key => $value){
                if($key == 'Username'){
                    $sql = " select * from `$table` where Username = '$value' ";
                    // Check if username already exists in db
                    $_handler_results = mysqli_query($this->_db_handler, $sql);
                    var_dump($_handler_results);

                    $rowcount=mysqli_num_rows($result);
                    // if not in db then insert into table the new one
                    if($rowcount == 0){
                        $insert_user = insert_new_user($new_values);
                        if($insert_user){
                            return true;
                        }else{
                            return false;
                        }
                    }else{
                        return false;
                    }
                }
            }
        }
    }

    public function insert_new_user($new_values){
        echo "<br> here is insert fn <br>";
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
    public function check_login($new_values){
        $table = $this->_table;
        foreach ($new_values as $key => $value){
                if($key == "Username"){
                $sql = " select * from `$table` where Username = '$value' ";

                $_handler_results = mysqli_query($this->_db_handler,$sql);
                $_arr_results = array();
       
                if ($_handler_results ) {
                    // echo "handlers is okay!";
                    while($row = mysqli_fetch_array($_handler_results ,MYSQLI_ASSOC)){
                        
                        $_arr_results[] = array_change_key_case($row);
                        // var_dump($_arr_results);
                    }
                    return $_arr_results;
                }else{
                    return false;
                }
            }
        }
    }
    // /*** starting the session ***/
    // public function get_session(){
    //     return $_SESSION["login"] = TRUE;
    // }

    // public function user_logout() {
    //     $_SESSION["login"] = FALSE;
    //     session_destroy();
    // } 
}