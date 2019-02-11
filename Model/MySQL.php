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
            echo "<script type='text/javascript'> alert('Error: Could not connect to Database.'); </script>";
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
                    $sql = "select * from `$table` where Username = '$value'; ";

                    $_arr_results = array();
                    $_arr_results = $this->get_results($sql);
                    if(sizeof($_arr_results) == 0){
                        $new_user = $this->insert_new_user($new_values);
                        if($new_user){
                            $this->disconnect();
                            return true;
                        }else{
                            $this->disconnect();
                            return false;
                        }
                    }
                    
                    // $_handler_results = mysqli_query($this->_db_handler, $sql);

                    // if($_handler_results){
                    //     $arr_results = array();
                    //     while($row = mysqli_fetch_array($_handler_results,MYSQLI_ASSOC)){
                    //         $arr_results[] = array_change_key_case($row);
                    //     }

                    //     if(sizeof($arr_results) == 0){
                    //         $new_user = $this->insert_new_user($new_values);
                    //         if($new_user){
                    //             $this->disconnect();
                    //             return true;
                    //         }else{
                    //             $this->disconnect();
                    //             return false;
                    //         }
                    //     }
                    // }else{
                    //     return false;
                    // }
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
            $sql = $sql1." ".$sql2;

            $_handler_results = mysqli_query($this->_db_handler, $sql);
            
            if($_handler_results){
                $this->disconnect();
                return true;    
            }else{
                $this->disconnect();
                return false;
            }
        }
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////
    public function edit_profile($new_values,$id){
        // echo "here is edit sql";
        if(is_array($new_values)){
            $table = $this->_table;
            $sql1 = "Update $table SET";
            foreach($new_values as $key => $value){
                $sql1 .= " $key =";
                $sql1 .= " '$value',";
            }

            $sql1 .= "Where ID = $id;";
            $sql1 = str_replace( ",Where" , " where" , $sql1);

            $_handler_results = mysqli_query($this->_db_handler, $sql1);
            if($_handler_results){
                $this->disconnect();
                return true;    
            }else{
                $this->disconnect();
                return false;
            }
        }
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////
    
    public function get_user_id($user_name)
    {
        $table = $this->_table;
        $sql = " select ID from `$table` where Username = '$user_name' ";

        $_arr_results = array();
        $_arr_results = $this->get_results($sql);
        if($_arr_results){
            return $_arr_results[0]["id"];
        }else{
            return false;
        }

        // $_handler_results = mysqli_query($this->_db_handler,$sql);
        // $_arr_results = array();


        // if ($_handler_results ) {
        //     while($row = mysqli_fetch_array($_handler_results ,MYSQLI_ASSOC))
        //     {    
        //         $_arr_results[] = array_change_key_case($row);
        //     }
        //     return $_arr_results[0]["id"];
        // }else{
        //     return false;
        // }
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////
    //LOGIN PROCESS
    public function check_login($new_values){
        $table = $this->_table;

        $value = $new_values["Username"];

        $sql = "select Password from `$table` where Username ='$value'";

        $_handler_results = mysqli_query($this->_db_handler,$sql);
        $_arr_results = array();

        if ($_handler_results) {
            while($row = mysqli_fetch_array($_handler_results ,MYSQLI_ASSOC))
            {    
                $_arr_results[] = array_change_key_case($row);

                if(password_verify($new_values["Password"],$_arr_results[0]["password"]))
                {
                    return true;
                }
                else{
                    return false;
                }
            }
        }else{
            return false;
        }

    }
////////////////////////////////////////////////////////////////////////////////////////////////////////
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
            if($_arr_results[0]["is_admin"]==NULL || $_arr_results[0]["is_admin"]== 0)
            {
                return False;
            }else{
                return True;
            }

        }
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function get_record($id) {
        $table = $this->_table;
        $sql = "select * from `$table` where ID = $id";
        return $this->get_results($sql);
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function get_data($fields = array(), $start = 0) {
        $table = $this->_table;
        if (empty($fields)) {
            $sql = "select * from `$table`";
        } else {
            $sql = "select ";
            foreach ($fields as $f) {
                $sql .= " `$f`, ";
            }
            $sql .= "from  `$table` ";
            $sql = str_replace(", from", "from", $sql);
        }
        $sql .= "limit $start," . __RECORDS_PER_PAGE__;
        return $this->get_results($sql);
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////
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