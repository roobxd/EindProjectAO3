<?php
    require_once(__DIR__."/reservering_sql.php");
    if(isset($_POST["aanpassen"])){
        $huisdier_value = isset($_POST["huisdier"]) ? 1 : 0;
        $wasmachine_value = isset($_POST["wasmachine"]) ? 1 : 0;
        $wasdroger_value = isset($_POST["wasdroger"]) ? 1 : 0;
        $auto_value = isset($_POST["auto"]) ? 1 : 0;
        
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
            "huisdier" => $huisdier_value,
            "douche" => $_POST["douche"],
            "wasmachine" => $wasmachine_value,
            "wasdroger" => $wasdroger_value,
            "verblijf" => $_POST["verblijf"],
            "auto" => $auto_value
        );
        if(checkBeschikbaar($edit_array["plaatsnummer"], $edit_array["begin_datum"], $edit_array["eind_datum"], $edit_array["reservering_id"])){
            editReservering($edit_array);
            header("Location: ../reserveringen.php");
        } else {
            echo "Plek niet beschikbaar..";
            echo "<meta http-equiv='refresh' content='3;url=../reservering_meerinfo.php?reservering_id=".$edit_array["reservering_id"].">";
        }
    }
?>