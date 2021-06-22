<?php
    require("../../assets/php/reservering_sql.php");
    if(isset($_POST["aanpassen"])){
        $edit_array = array(
            "reservering_id" => $_POST["reservering_id"],
            "voornaam" => $_POST["voornaam"] ,
            "tussenvoegsel" => $_POST["tussenvoegsel"],
            "achternaam" => $_POST["achternaam"], 
            "plaatsnummer" => intval($_POST["plaatsnummer"]),
            "begin_datum" => $_POST["begin_datum"],
            "eind_datum" => $_POST["eind_datum"],
            "volwassene" => $_POST["volwassene"],
            "kinderen4_12" => $_POST["kinderen4_12"],
            "huisdier" => (isset($_POST["huisdier"])) ? intval($_POST["huisdier"]) : (intval($_POST["huisdier"]) == 1) ? 0 : 1 ,
            "douche" => intval($_POST["douche"]),
            "wasmachine" => (isset($_POST["wasmachine"])) ? intval($_POST["wasmachine"]) : (intval($_POST["wasmachine"]) == 1) ? 0 : 1 ,
            "wasdroger" => (isset($_POST["wasdroger"])) ? intval($_POST["wasdroger"]) : (intval($_POST["wasdroger"]) == 1) ? 0 : 1 ,
            "verblijf" => $_POST["verblijf"],
            "auto" => (isset($_POST["auto"])) ? intval($_POST["auto"]) : (intval($_POST["auto"]) == 1) ? 0 : 1 
        );
        editReservering($edit_array);
        header("Location: reserveringen.php");
    }

?>