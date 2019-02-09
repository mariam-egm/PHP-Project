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

    ////////////////////////////////////////////////////REGISTRATION PROCCESS/////////////////////////////////////////////////////////////
    public function user_sign_up($new_values){
        if(is_array($new_values)){
            $table = $this->_table;
            foreach($new_values as $key => $value){
                if($key == "Username"){
                    $sql = " select * from `$table` where Username = '$value' ";
                    $_handler_results = mysqli_query($this->_db_handler, $sql);
                    if($_handler_results){
                        var_dump($_handler_results);

                        $arr_results = array();

                        if($_handler_results){
                            while($row = mysqli_fetch_array($_handler_results,MYSQLI_ASSOC)){
                                $arr_results[] = array_change_key_case($row);
                            }
                            var_dump($arr_results);

                            if(sizeof($arr_results) == 0){
                                $new_user = $this->insert_new_user($new_values);
                                if($new_user){
                                    $this->disconnect();
                                    return true;
                                }else{
                                    echo "<br> User already Exists <br>";
                                    $this->disconnect();
                                    return false;
                                }
                            }
                        }
                    }
                }
            }
        }
    }
//////////////////////////////////////////////////INSERTION FUNCTION//////////////////////////////////////////////////////
    public function insert_new_user($new_values){
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
                $this->disconnect();
            }else{
                $this->disconnect();
                echo "la2 :) <br>" ;
                return false;
            }
        }
    }

    public function get_user_id($user_name)
    {
        $table = $this->_table;
        $sql = " select ID from `$table` where Username = 'mariam' ";
        $_handler_results = mysqli_query($this->_db_handler,$sql);
        $_arr_results = array();


        if ($_handler_results ) {
            while($row = mysqli_fetch_array($_handler_results ,MYSQLI_ASSOC))
            {    
                $_arr_results[] = array_change_key_case($row);
            }
            return $_arr_results[0]["id"];
        }else{
            return false;
        }
    }

    //LOGIN PROCESS
    public function check_login($new_values){
        $table = $this->_table;
        foreach ($new_values as $key => $value)
        {
            if($key == "Username")
            {
                $sql = " select * from `$table` where Username = '$value' ";

                $_handler_results = mysqli_query($this->_db_handler,$sql);
                $_arr_results = array();
    
                if ($_handler_results ) {
                    while($row = mysqli_fetch_array($_handler_results ,MYSQLI_ASSOC))
                    {    
                        $_arr_results[] = array_change_key_case($row);
                    }
                    return $_arr_results;
                }else{
                    return false;
                }
            }
        }
    }


    public function is_admin($user_id)
    {
        $table = $this->_table;
        $sql = " select is_Admin from `$table` where ID = '$user_id' ";
        $_handler_results = mysqli_query($this->_db_handler,$sql);
        $_arr_results = array();

        if ($_handler_results) {
            while($row = mysqli_fetch_array($_handler_results ,MYSQLI_ASSOC))
            {    
                $_arr_results[] = array_change_key_case($row);
            }
            // var_dump("from the function",$_arr_results[0]["is_admin"]);
            if($_arr_results[0]["is_admin"]==NULL)
            {
                return False;
            }else{
                return True;
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

    public function get_record($id) {
        $table = $this->_table;
        $sql = "select * from `$table` limit ID = $id";
        return $this->get_results($sql);
    }
    private function get_results($sql) {
        if (__Debug__Mode__ === 1)
            echo "<h5>Sent Query: </h5>" . $sql . "<br/> <br/>";
        $_handler_results = mysqli_query($this->_db_handler, $sql);
        $_arr_results = array();
       
        if ($_handler_results ) {
             while($row = mysqli_fetch_array($_handler_results ,MYSQLI_ASSOC)){
                $_arr_results[] = array_change_key_case($row);
            }
            return $_arr_results;
            
        } else {
            return false;
        }
    }


}







