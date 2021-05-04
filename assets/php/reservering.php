<?php

    require("db/database_connectie.php");

    class Reservering {
        public $plaatsnummer;
        public $voornaam;
        public $tussenvoegsel;
        public $achternaam;
        public $begin_datum;
        public $eind_datum;
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


        const PRIJZEN = array(
            "kinderen4_12" => 4,
            "" => ""

        ); 


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