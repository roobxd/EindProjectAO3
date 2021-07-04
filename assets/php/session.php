<?php

    function startSession($permission){
        session_start();
        $_SESSION["permission"] = $permission; 
    }

    function stopSession(){
        session_destroy();
        header("Location: ".__DIR__."/../../login.html");
    }

    function checkPermission($level){
        session_start();
        if(isset($_SESSION["permission"]) && $_SESSION["permission"] >= $level){
            return true;
        }
        else{
            return false;
        }
    }

?>