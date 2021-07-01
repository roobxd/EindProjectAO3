<?php
    require_once(__DIR__."/../../../assets/php/db/database_connectie.php");
    require(__DIR__."/../../reservering/reservering_php/reservering_sql.php");

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

    function returnGeldVerdientWeek(){
        $connection = OpenConnection();

        $result = $connection->query("SELECT `reserveringen`.`reservering_id`, `reserveringen`.`plaatsnummer`, `plaatsen`.`grootte`, `klanten`.`voornaam`, `klanten`.`tussenvoegsel`, `klanten`.`achternaam`, `reserveringen`.`begin_datum`, `reserveringen`.`eind_datum`, `reserveringen`.`volwassene`, `reserveringen`.`kinderen4_12`, `reserveringen`.`huisdier`, `plaatsen`.`elektriciteit`, `reserveringen`.`douche`, `reserveringen`.`wasmachine`, `reserveringen`.`wasdroger`, `reserveringen`.`verblijf`, `reserveringen`.`auto` FROM `reserveringen`, `klanten`, `plaatsen` WHERE `reserveringen`.`plaatsnummer` = `plaatsen`.`plaatsnummer` AND `klanten`.`klant_id` = `reserveringen`.`klant_id` AND NOW() >= DATE_SUB(NOW(), INTERVAL WEEKDAY(NOW()) DAY) AND NOW() < DATE_ADD(NOW(), INTERVAL WEEKDAY(NOW()) DAY)");
        
        $price = 0;
        while ( $arr = $result->fetch_assoc() ){
            $price += (new Reservering($arr))->calculate_price(NULL);
        }
        return $price;
    }

    function returnGeldVerdientMaand(){

    }


?>