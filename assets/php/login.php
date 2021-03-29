<?php
    require("db/database_connectie.php");
    if(isset($_POST["submit"])){
        CheckLogin($_POST["user"], $_POST["password"]);
        // if (CheckLogin($_POST["user"], $_POST["password"])){
        //     header("Location: ../../dashboard/home.php");
        // }
        // else{
        //     echo "x2";
        // }
    }
    else {
        echo "x";
    }


    function CheckLogin($user, $password){
        $connection = OpenConnection();

        $statement = $connection -> prepare("SELECT `wachtwoord` FROM accountgegevens WHERE `gebruikersnaam` = ? OR `email` = ?");
        $statement -> bind_param("ss", $user, $user);

        $statement -> execute();
        $pass_hash = $statement->get_result()->fetch_assoc()["wachtwoord"];

        echo $pass_hash;
        echo $password;
        $test = password_verify($password, $pass_hash);
        if($test){
            echo "y";
        }
        else{
            echo "x";
        }

        CloseConnection($connection);
        return password_verify($password, $pass_hash);;
    }


?>