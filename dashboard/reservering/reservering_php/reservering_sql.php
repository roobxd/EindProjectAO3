<?php

    require_once("../../assets/php/db/database_connectie.php");

    class Reservering {
        public $reservering_id;
        public $plaatsnummer;
        public $grootte;
        public $voornaam;
        public $tussenvoegsel;
        public $achternaam;
        public $begin_datum;
        public $eind_datum;
        public $volwassene;
        public $kinderen4_12;
        public $huisdier;
        public $elektriciteit;
        public $douche;
        public $wasmachine;
        public $wasdroger;
        public $verblijf;
        public $auto;

        function __construct(Array $prop=array()){
            foreach($prop as $key => $value){
                $this->{$key} = $value;
            }

        }


        function return_small_result(){
            $result = array(
                $this->plaatsnummer,
                $this->voornaam,
                $this->tussenvoegsel,
                $this->achternaam,
                $this->begin_datum,
                $this->eind_datum,
            );
            return $result;
        } 


        function calculate_price(){
            $prijzen = array(
                "volwassene" => array("q", 5), 
                "kinderen4_12" => array("q", 4),
                "huisdier" => array("b", 2),
                "elektriciteit" => array("b", 2),
                "douche" => array("q", 0.50),
                "wasmachine" => array("b", 6),
                "wasdroger" => array("b", 4),
                "verblijf" => array(
                    0 => array(3, 5),
                    1 => array(2, 4)
                ),
                "auto" => array("b", 3),
            ); 
            
            $price = 0;
            $begin = new DateTime($this->begin_datum);
            $end = new DateTime($this->eind_datum);
            $days = intval($begin->diff($end)->format("%R%a"));
            foreach($this as $key => $value){
                if(array_key_exists($key, $prijzen)){
                    if($key == "verblijf"){
                       $price += $prijzen["verblijf"][$this->verblijf][$this->grootte] * $days;
                    }
                    elseif($prijzen[$key][0] == "q"){
                        $price += ($prijzen[$key][1] * $value) * $days;
                    }
                    else {
                        $price += $prijzen[$key][1] * $days;
                    }
                }
            }
            return $price;
        }
    }

    function selectReservering($reservering_id){
        $connection = OpenConnection();
        $prep_query = $connection->prepare("SELECT `reserveringen`.`reservering_id`, `reserveringen`.`plaatsnummer`, `plaatsen`.`grootte`, `klanten`.`voornaam`, `klanten`.`tussenvoegsel`, `klanten`.`achternaam`, `reserveringen`.`begin_datum`, `reserveringen`.`eind_datum`, `reserveringen`.`volwassene`, `reserveringen`.`kinderen4_12`, `reserveringen`.`huisdier`, `plaatsen`.`elektriciteit`, `reserveringen`.`douche`, `reserveringen`.`wasmachine`, `reserveringen`.`wasdroger`, `reserveringen`.`verblijf`, `reserveringen`.`auto` FROM `reserveringen`, `klanten`, `plaatsen` WHERE `reserveringen`.`reservering_id` = ?  AND `klanten`.`klant_id` = `reserveringen`.`klant_id` AND `plaatsen`.`plaatsnummer` = (SELECT `plaatsnummer` FROM `reserveringen` WHERE `reservering_id` = ?)");

        $prep_query->bind_param("ii", $reservering_id, $reservering_id);
        $prep_query->execute();

        $result = $prep_query->get_result();
        
        CloseConnection($connection);
        return new Reservering($result->fetch_assoc());
    }
    function removeReservering($reservering_ids){
        
        $connection = OpenConnection();
        $prep_query = $connection->prepare("DELETE FROM `reserveringen` WHERE `reservering_id` = ?");
        foreach($reservering_ids as $reservering_id){
            $prep_query->bind_param("i", $reservering_id);
            $prep_query->execute();
        }

        CloseConnection($connection);
    }

    function addReservering($reservering){

        $connection = OpenConnection();
        
        $prep_query1 = $connection->prepare("INSERT INTO `klanten` (`voornaam`, `tussenvoegsel`, `achternaam`) VALUES(?,?,?)");
        $prep_query2 = $connection->prepare("INSERT INTO `reserveringen` (`klant_id`, `plaatsnummer`, `begin_datum`, `eind_datum`, `volwassene`, `kinderen4_12`, `huisdier`, `douche`, `wasmachine`, `wasdroger`, `verblijf`, `auto`) VALUES(LAST_INSERT_ID(),?,?,?,?,?,?,?,?,?,?,?)");

        $prep_query1->bind_param("sss", $reservering["voornaam"], $reservering["tussenvoegsel"], $reservering["achternaam"]);
        $prep_query1->execute();

        $prep_query2->bind_param("issiiiiiiii", $reservering["plaatsnummer"], $reservering["begin_datum"], $reservering["eind_datum"], $reservering["volwassene"], $reservering["kinderen4_12"], $reservering["huisdier"], $reservering["douche"], $reservering["wasmachine"], $reservering["wasdroger"], $reservering["verblijf"], $reservering["auto"]);
        $prep_query2->execute();

        CloseConnection($connection);
    }

    function editReservering($updated_reservering){
        // Dit is nog steeds onveilig.
        function create_sql_string(&$val, $key){
            if(is_numeric($val)){
                $val = "`".$key."` = ".$val;
            }
            else{
                $val = "`".$key."` = '".$val."'";
            }
        }

        $klanten_array = array_slice($updated_reservering, 1,3);
        $reservering_array = array_diff_assoc($updated_reservering, $klanten_array);

        array_walk($klanten_array, "create_sql_string");
        array_walk($reservering_array, "create_sql_string");

        $connection = OpenConnection();

        $connection->query("UPDATE `reserveringen` SET ". implode(",", $reservering_array) ." WHERE ".$reservering_array["reservering_id"]);
        $connection->query("UPDATE `klanten` SET ". implode(",", $klanten_array) ." WHERE `klant_id` = (SELECT `klant_id` FROM `reserveringen` WHERE ".$reservering_array["reservering_id"].")");

        CloseConnection($connection);


    }


    
    function returnReserveringen(){
        $connection = OpenConnection();
        $result = $connection->query("SELECT `reserveringen`.`reservering_id`, `reserveringen`.`plaatsnummer`, `plaatsen`.`grootte`, `klanten`.`voornaam`, `klanten`.`tussenvoegsel`, `klanten`.`achternaam`, `reserveringen`.`begin_datum`, `reserveringen`.`eind_datum`, `reserveringen`.`volwassene`, `reserveringen`.`kinderen4_12`, `reserveringen`.`huisdier`, `plaatsen`.`elektriciteit`, `reserveringen`.`douche`, `reserveringen`.`wasmachine`, `reserveringen`.`wasdroger`, `reserveringen`.`verblijf`, `reserveringen`.`auto` FROM `reserveringen`, `klanten`, `plaatsen` WHERE `reserveringen`.`plaatsnummer` = `plaatsen`.`plaatsnummer` AND `klanten`.`klant_id` = `reserveringen`.`klant_id`");
        $reservering_array = array();
        while ( $arr = $result->fetch_assoc() ){
            array_push($reservering_array, new Reservering($arr)); 
        }
        CloseConnection($connection);
        return $reservering_array;
    }

?>