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
        $statement = $connection -> prepare("INSERT INTO `accountgegevens` (`gebruikersnaam`, `email`, `wachtwoord`) VALUES(?,?,?)");
        $statement -> bind_param("sss", $user, $email, $hash_pw);


        $result = $statement -> execute();
        CloseConnection($connection);
        return $result;
        
    }


?>