<?php
    require("../../assets/php/reservering_sql.php");
    if(isset($_POST["aanpassen"])){
        $edit_array = array(
            "reservering_id" => $_POST["reservering_id"],
            "voornaam" => $_POST["voornaam"] ,
            "tussenvoegsel" => $_POST["tussenvoegsel"],
            "achternaam" => $_POST["achternaam"], 
            "plaatsnummer" =>$_POST["plaatsnummer"],
            "begin_datum" => $_POST["begin_datum"],
            "eind_datum" => $_POST["eind_datum"],
            "volwassene" => $_POST["volwassene"],
            "kinderen4_12" => $_POST["kinderen4_12"],
            "huisdier" => $_POST["huisdier"],
            "douche" => $_POST["douche"],
            "wasmachine" => $_POST["wasmachine"],
            "wasdroger" => $_POST["wasdroger"],
            "verblijf" => $_POST["verblijf"],
            "auto" => $_POST["auto"]
        );
        editReservering($edit_array);
        header("Location: reserveringen.php");
    }

?>