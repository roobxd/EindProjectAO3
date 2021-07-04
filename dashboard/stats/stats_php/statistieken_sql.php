<?php
    require_once(__DIR__."/../../../assets/php/db/database_connectie.php");
    require_once(__DIR__."/../../reservering/reservering_php/reservering_sql.php");

    function returnActieveReserveringen(){
        $connection = OpenConnection();
        $result = $connection->query("SELECT COUNT(`reserveringen`.`reservering_id`) as 'aantal_actieve_reserveringen' FROM `reserveringen` WHERE NOW() BETWEEN `reserveringen`.`begin_datum` AND `reserveringen`.`eind_datum`");
       

        CloseConnection($connection);
        return $result->fetch_assoc()["aantal_actieve_reserveringen"];
    }

    function returnVerlatendeReserveringen(){
        $connection = OpenConnection();

        $result = $connection->query("SELECT COUNT(`reserveringen`.`reservering_id`) as 'aantal_verlatende_reserveringen' FROM `reserveringen` WHERE `reserveringen`.`eind_datum`= NOW()");

        CloseConnection($connection);

        return $result->fetch_assoc()["aantal_verlatende_reserveringen"];
    }

    function returnGeldVerdientMaand(){
        $connection = OpenConnection();

        $result = $connection->query("SELECT `reserveringen`.`reservering_id`, `reserveringen`.`plaatsnummer`, `plaatsen`.`grootte`, `klanten`.`voornaam`, `klanten`.`tussenvoegsel`, `klanten`.`achternaam`, `reserveringen`.`begin_datum`, `reserveringen`.`eind_datum`, `reserveringen`.`volwassene`, `reserveringen`.`kinderen4_12`, `reserveringen`.`huisdier`, `plaatsen`.`elektriciteit`, `reserveringen`.`douche`, `reserveringen`.`wasmachine`, `reserveringen`.`wasdroger`, `reserveringen`.`verblijf`, `reserveringen`.`auto` FROM `reserveringen`, `klanten`, `plaatsen` WHERE `reserveringen`.`plaatsnummer` = `plaatsen`.`plaatsnummer` AND `klanten`.`klant_id` = `reserveringen`.`klant_id` AND `reserveringen`.`begin_datum`< LAST_DAY(NOW()) AND `reserveringen`.`begin_datum` >= date_add(date_add(LAST_DAY(NOW()),interval 1 DAY),interval -1 MONTH)");
        
        $price = 0;
        while ( $arr = $result->fetch_assoc() ){
            $price += (new Reservering($arr))->calculate_price(NULL);
        }
        $prep_query = $connection->prepare("UPDATE `winst_archief` SET `winst` = ? WHERE `maand` = ?");

        $maand = intval(date("m"));
        $prep_query->bind_param("ii", $price, $maand);
        $prep_query->execute();
        
        CloseConnection($connection);
        return $price;
    }



    function returnWinst(){
        $connection = OpenConnection();
        $result = $connection->query("SELECT `winst` FROM `winst_archief`");

        $winstArray = array();
        
        while($row = $result->fetch_array(MYSQLI_NUM)){
            array_push($winstArray, $row[0]);
        }
        CloseConnection($connection);
        return $winstArray;
    }


?>