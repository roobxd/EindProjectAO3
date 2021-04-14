<?php
    require("db/database_connectie.php");
    if(isset($_POST["f_submit"])){
        if (CheckLogin($_POST["f_username"], $_POST["f_password"])){
            session_start();
            $_SESSION["Ingelogd"] = true;
            header("Location: ../../dashboard/home.php");
        }
    }


    function CheckLogin($user, $password){
        $connection = OpenConnection();

        $statement = $connection -> prepare("SELECT `wachtwoord`, `rechten` FROM accountgegevens WHERE `gebruikersnaam` = ? OR `email` = ?");
        $statement -> bind_param("ss", $user, $user);

        $statement -> execute();
        $pass_hash = $statement->get_result()->fetch_assoc()["wachtwoord"];


        $test = password_verify($password, $pass_hash);

        CloseConnection($connection);
        return $test;
    }


?>