<?php  
    require_once(__DIR__."/account_sql.php");
    if(isset($_POST["toevoegen"])){
        $add_account_array = array(
            "gebruikersnaam" => $_POST["gebruikersnaam"] ,
            "email" => $_POST["email"],
            "wachtwoord" => $_POST["wachtwoord"], 
            "rechten" => intval($_POST["rechten"])
        );
        addAccount($add_account_array);
        header("Location: ../accounts.php");
    }



?>