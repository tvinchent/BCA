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
}
else{
    $db = new PDO('mysql:host=localhost;dbname=bca;charset=utf8', 'root', 'root');
}

?>