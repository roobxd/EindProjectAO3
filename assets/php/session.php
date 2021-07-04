<?php

    function startSession($permission){
        session_start();
        $_SESSION["permission"] = $permission; 
    }

    function stopSession(){
        session_start();
        unset($_SESSION["permission"]);
        session_destroy();
        header("Location: ../../login.html");
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