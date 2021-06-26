<?php
    require_once(__DIR__."/account_sql.php");
    if(isset($_POST["aanpassen"])){
        $edit_account_array = array(
            "gebruiker_id" => $_POST["gebruiker_id"],
            "gebruikersnaam" => $_POST["gebruikersnaam"] ,
            "email" => $_POST["email"],
            "rechten" => intval($_POST["rechten"])
        );
        editAccount($edit_account_array);
        header("Location: ../accounts.php");
    } else {
        echo "Tt";
    }
?>