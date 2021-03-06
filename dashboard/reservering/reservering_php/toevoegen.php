<?php
    require_once(__DIR__."/reservering_sql.php");
    if(isset($_POST["toevoegen"])){
        $add_reservering_array = array(
            "voornaam" => $_POST["voornaam"] ,
            "tussenvoegsel" => $_POST["tussenvoegsel"],
            "achternaam" => $_POST["achternaam"], 
            "plaatsnummer" => intval($_POST["plaatsnummer"]),
            "begin_datum" => $_POST["begin_datum"],
            "eind_datum" => $_POST["eind_datum"],
            "volwassene" => $_POST["volwassene"],
            "kinderen4_12" => $_POST["kinderen4_12"],
            "huisdier" => (isset($_POST["huisdier"])) ? intval($_POST["huisdier"]) : 0,
            "douche" => intval($_POST["douche"]),
            "wasmachine" => (isset($_POST["wasmachine"])) ? intval($_POST["wasmachine"]) : 0,
            "wasdroger" => (isset($_POST["wasdroger"])) ? intval($_POST["wasdroger"]) : 0,
            "verblijf" => $_POST["verblijf"],
            "auto" => (isset($_POST["auto"])) ? intval($_POST["auto"]) : 0
        );
        if(checkBeschikbaar($add_reservering_array["plaatsnummer"], $add_reservering_array["begin_datum"], $add_reservering_array["eind_datum"], NULL)){
            addReservering($add_reservering_array);
            header("Location: ../reserveringen.php");
        } else {
            echo "Plek niet beschikbaar..";
            echo "<meta http-equiv='refresh' content='3;url=../reservering_aanmaken.php'>";
        }

        
    }



?>