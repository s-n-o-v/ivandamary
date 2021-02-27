<?php

    function connect_to_db(){
        global $dbh;
    
        if (defined('CONNECT_TO_DB')) { 
            return 1; 
        }

        $db_config = array(
            'server' => "localhost",
            'username' => "root",
            'password' => "",
            'name' => "idm_staff"
        );
    
        define('CONNECT_TO_DB', 1); // once

        $dbh = mysqli_connect($db_config['server'], $db_config['username'], $db_config['password'], $db_config['name']);
        if (!$dbh ){ 
            echo "Error: Unable to connect to MySQL." . PHP_EOL;
            echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
            exit; 
        }

        return 1;
    }

    function mysql_query($q){
        global $dbh;
        $res = mysqli_query($dbh, $q); 
        return $res;
    }
        
    function mysql_affected_rows(){
        global $dbh;
        $cnt = mysqli_affected_rows($dbh);
        return $cnt;
    }

    function mysql_error(){
        global $dbh;
        $err_msg = mysqli_error($dbh);
        return $err_msg;
    }

    function mysql_fetch_array($res){
        $r = mysqli_fetch_array($res, MYSQLI_BOTH);
        return $r;
    }

    function mysql_fetch_assoc($res){
        $r = mysqli_fetch_assoc($res); 
        return $r;
    }

    function mysql_fetch_row($res){
        $r = mysqli_fetch_row($res);
        return $r;
    }

    function mysql_num_rows($res){
        $r = mysqli_num_rows($res);
        return $r;
    }

    function mysql_real_escape_string($str){
        global $dbh;
        $str_esc = mysqli_real_escape_string($dbh, $str);
        return $str_esc;
    }
    
?>