<?php

// defaut: dev

// $env = 'test';
//$env = 'prod';
if(isset($env)){
    if($env == 'test'){
        $db = new PDO('mysql:host=exmachinefmci.mysql.db;dbname=exmachinefmci;charset=utf8', 'exmachinefmci', 'carp310M');
        $url = 'https://exmachina.ovh/bca/';
        // PHP 8.1
    }
    elseif($env == 'prod'){
        // LOL
    }
} // dev
else{
    $db = new PDO('mysql:host=localhost;dbname=bca;charset=utf8', 'root', 'root');
    $url = 'http://localhost:8888/bca/v5.1/BCA/';
    // PHP 7.3.8

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

?>