<?php

    require("db/database_connectie.php");

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
        $prep_query = $connection->prepare("SELECT `reserveringen`.`reservering_id`, `reserveringen`.`plaatsnummer`, `plaatsen`.`grootte`, `klanten`.`voornaam`, `klanten`.`tussenvoegsel`, `klanten`.`achternaam`, `reserveringen`.`begin_datum`, `reserveringen`.`eind_datum`, `reserveringen`.`volwassene`, `reserveringen`.`kinderen4_12`, `reserveringen`.`huisdier`, `plaatsen`.`elektriciteit`, `reserveringen`.`douche`, `reserveringen`.`wasmachine`, `reserveringen`.`wasdroger`, `reserveringen`.`verblijf`, `reserveringen`.`auto` FROM `reserveringen`, `klanten`, `plaatsen` WHERE ? IN (`plaatsen`.`plaatsnummer`, `reserveringen`.`plaatsnummer`) AND `klanten`.`klant_id` = `reserveringen`.`klant_id`");

        $prep_query->bind_param("i", $reservering_id);
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
        $connection->begin_transaction();
        
        $prep_query1 = $connection->prepare("INSERT INTO `klanten` (`voornaam`, `tussenvoegsel`, `achternaam`) VALUES(?,?,?)");
        $prep_query2 = $connection->prepare("INSERT INTO `reserveringen` (`klant_id`, `plaatsnummer`, `begin_datum`, `eind_datum`, `volwassene`, `kinderen4_12`, `huisdier`, `douche`, `wasmachine`, `wasdroger`, `verblijf`, `auto`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");

        var_dump($_POST);

        $prep_query1->bind_param("sss", $reservering["voornaam"], $reservering["tussenvoegsel"], $reservering["achternaam"]);
        $prep_query1->execute();

        $prep_query2->bind_param("iissiiiiiiii", $connection->insert_id, $reservering["plaatsnummer"], $reservering["begin_datum"], $reservering["eind_datum"], $reservering["volwassene"], $reservering["kinderen4_12"], $reservering["huisdier"], $reservering["douche"], $reservering["wasmachine"], $reservering["wasdroger"], $reservering["verblijf"], $reservering["auto"]);
        $prep_query2->execute();

        $connection->commit();
        CloseConnection($connection);
    }

    function editReservering($updated_reservering){

        $connection = OpenConnection();

        $update_array = array();
        foreach($updated_reservering as $key=>$val) {
            $update_array[$key] = $key." = ".$val;
        }
        exit(implode(", ", $update_array));
        // $prep_query = $connection->prepare("UPDATE `reserveringen` SET ". implode(",", $update_array) ." WHERE `reservering_id` = ".$updated_reservering["reservering_id"]);

        // $prep_query->bind_param();
        // $prep_query->execute();

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