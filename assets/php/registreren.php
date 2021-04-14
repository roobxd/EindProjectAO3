<?php
    require("db/database_connectie.php");
    if(isset($_POST["submit"])){
        if(RegisterAccount($_POST["user"], $_POST["email"], $_POST["password"])){
            header("Location: ../../login.html");
        }
    }


    function RegisterAccount($user, $email, $password){
        $connection = OpenConnection();
        $hash_pw = password_hash($password, PASSWORD_DEFAULT);
        $rechten = json_encode(array("rollen" => ""));
        $statement = $connection -> prepare("INSERT INTO `accountgegevens` (`gebruikersnaam`, `email`, `wachtwoord`, `rechten`) VALUES(?,?,?,?)");
        $statement -> bind_param("ssss", $user, $email, $hash_pw, $rechten);


        $result = $statement -> execute();
        exit($connection->error);
        CloseConnection($connection);
        return $result;
        
    }


?>