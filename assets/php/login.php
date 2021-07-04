<?php
    require_once(__DIR__."/db/database_connectie.php");
    require_once(__DIR__."/session.php");
    if(isset($_POST["submit"])){
        $login_check = CheckLogin($_POST["username"], $_POST["password"]);
        if ($login_check[0]){
            startSession($login_check[1]);
            header("Location: ../../dashboard/home/home.php");
        }
    }


    function CheckLogin($user, $password){
        $connection = OpenConnection();

        $statement = $connection -> prepare("SELECT `wachtwoord`, `rechten` FROM accountgegevens WHERE `gebruikersnaam` = ? OR `email` = ?");
        $statement -> bind_param("ss", $user, $user);

        $statement -> execute();

        $result = $statement->get_result()->fetch_assoc();
        $pass_hash = $result["wachtwoord"];
        $permission = $result["rechten"];


        $pass_verified = password_verify($password, $pass_hash);

        CloseConnection($connection);
        return array($pass_verified, $permission);
    }


?>