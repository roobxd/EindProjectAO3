<?php

    require("db/database_connectie.php");

    class Reservering {
        public $plaatsnummer;
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
        public $caravan_klein;
        public $caravan_groot;
        public $tent_klein;
        public $tent_groot;
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
                "caravan_klein" => array("b", 2) ,
                "caravan_groot" => array("b", 4),
                "tent_klein" => array("b", 3),
                "tent_groot" => array("b", 5),
                "auto" => array("b", 3)
            ); 
            $price = 0;
            $begin = new DateTime($this->begin_datum);
            $end = new DateTime($this->eind_datum);
            $days = intval($begin->diff($end)->format("%R%a"));
            foreach($this as $key => $value){
                if(array_key_exists($key, $prijzen)){
                    if($prijzen[$key][0] == "q"){
                        $price += ($prijzen[$key][1] * $value) * $days;
                    }
                    else{
                        $price += $prijzen[$key][1] * $days;
                    }
                }
            }
            return $price;
        }


    }


    function returnReserveringen(){
        $connection = OpenConnection();
        $result = $connection->query("SELECT `plaatsnummer`, `klanten`.`voornaam`, `klanten`.`tussenvoegsel`, `klanten`.`achternaam`, `begin_datum`, `eind_datum`, `kinderen4_12`, `huisdier`, `elektriciteit`, `douche`, `wasmachine`, `wasdroger`, `caravan_klein`, `caravan_groot`, `tent_klein`, `tent_groot`, `auto` FROM `reserveringen`, `klanten`  WHERE `klanten`.`klant_id` = `reserveringen`.`klant_id`");
        $reservering_array = array();
        while ( $arr = $result->fetch_assoc() ){
            array_push($reservering_array, new Reservering($arr)); 
        }
        CloseConnection($connection);
        return $reservering_array;
    }

?>