<?php

// defaut: dev

//$env = 'test';
//$env = 'prod';
if(isset($env)){
    if($env == 'test'){
        $db = new PDO('mysql:host=exmachinefmci.mysql.db;dbname=exmachinefmci;charset=utf8', 'exmachinefmci', 'carp310M');
    }
    elseif($env == 'prod'){
        $db = new PDO('mysql:host=exmachinefmci.mysql.db;dbname=exmachinefmci;charset=utf8', 'exmachinefmci', 'carp310M');
    }
} // dev
else{
    $db = new PDO('mysql:host=localhost;dbname=bca;charset=utf8', 'root', 'root');

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

?>