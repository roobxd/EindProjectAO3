<?php
    require("db/database_connectie.php");
    if(isset($_POST["submit"])){
        if(RegisterAccount($_POST["user"], $_POST["email"], $_POST["password"])){
            header("Location: ../../login.html");
        }
        else {
           echo OpenConnection() -> error();
        }
    }


    function RegisterAccount($user, $email, $password){
        $connection = OpenConnection();

        $statement = $connection -> prepare("INSERT INTO `accountgegevens` (`gebruikersnaam`, `email`, `wachtwoord`) VALUES(?,?,?)");
        $statement -> bind_param("sss", $user, $email, password_hash($password, PASSWORD_BCRYPT));


        $result = $statement -> execute();
        CloseConnection($connection);
        return $result;
        
    }


?>