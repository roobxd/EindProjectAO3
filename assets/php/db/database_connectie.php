
<?php

function OpenConnection(){
    $connection = new mysqli("localhost", "root", "root", "reserveringsysteem_ao3") or die("Failed");
    return $connection;
}

function CloseConnection($connection){
    return $connection -> close();
}




?>