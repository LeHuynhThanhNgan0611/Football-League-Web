<?php
    define('HOST','127.0.0.1');
    define('USER','root');
    define('PASS','');
    define('DB_NAME','userlogin');

    function create_connection(){
        $conn =  new mysqli(HOST,USER,PASS,DB_NAME);
        if($conn->connect_error){
            die('Cannot connect to server: '.$conn->connect_error);
        }
        return $conn;
    }
?>