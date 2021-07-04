<?php

    require_once(__DIR__."/../../../assets/php/db/database_connectie.php");

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

        function return_factuur(){
            $factuur_info = array(
                "volwassene" => "q", 
                "kinderen4_12" => "q",
                "huisdier" => "b",
                "elektriciteit" => "b",
                "douche" => "q",
                "wasmachine" => "b",
                "wasdroger" => "b",
                "verblijf" => "o",
                "auto" => "b",
            ); 

            $factuur = array();
      
            foreach($this as $key => $value){
                if(array_key_exists($key, $factuur_info)){
                    if($factuur_info[$key] === "q" && $value > 0){
                        array_push($factuur, $key);
                    }
                    elseif($factuur_info[$key] === "b" && $value == 1){
                        array_push($factuur, $key);
                    }
                    elseif($factuur_info[$key] === "o"){
                        array_push($factuur, $key);
                    }
                }
            }
            return $factuur;
        }

        function calculate_price($item){
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
            if($item == NULL){
                foreach($this as $key => $value){
                    if(array_key_exists($key, $prijzen)){
                        if($key == "verblijf"){
                           $price += $prijzen["verblijf"][$this->verblijf][$this->grootte] * $days;
                        }
                        elseif($prijzen[$key][0] == "q" && $value > 0){
                            $price += ($prijzen[$key][1] * $value) * $days;
                        }
                        elseif($prijzen[$key][0] == "b" && $value == 1){
                            $price += $prijzen[$key][1] * $days;
                        }
                    }
                }
            } else {
                if($item == "verblijf"){
                    return $prijzen["verblijf"][$this->verblijf][$this->grootte] * $days;              
                }
                elseif($prijzen[$item][0] == "q" && $this->$item > 0){
                    return ($prijzen[$item][1] * $this->$item) * $days;
                }
                elseif($prijzen[$item][0] == "b" && $this->$item == 1){
                    return $prijzen[$item][1] * $days;
                }
            }
            return $price;
        }
    }

    function updateWinst($maand, $prijs){
        $connection = OpenConnection();

        $prep_query = $connection->prepare("UPDATE ");

        CloseConnection($connection);
    }
    
    function return_fancy_name($key){
        $reservering_naam = array(
            "volwassene" => "Volwassene",
            "kinderen4_12" => "Kinderen",
            "huisdier" => "Huisdier",
            "elektriciteit" => "Elektriciteit",
            "douche" => "Douche Munten",
            "wasmachine" => "Wasmachine",
            "wasdroger" => "Wasdroger",
            "verblijf" => "Verblijf",
            "auto" => "Auto"
        );
        return $reservering_naam[$key];
    }

    function checkBeschikbaar($plaatsnummer, $begin_datum, $eind_datum){
        $connection = OpenConnection();
        $prep_query = $connection->prepare("SELECT * FROM `reserveringen` WHERE (? <= `reserveringen`.`eind_datum`) AND (? >= `reserveringen`.`begin_datum`) AND `reserveringen`.`plaatsnummer` = ?");

        $prep_query->bind_param("ssi", $begin_datum, $eind_datum, $plaatsnummer );
        $prep_query->execute();

        
        if($plaatsnummer >= 0 && $plaatsnummer <= 50){
            if($result = $prep_query->get_result()->num_rows == 0){
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
        CloseConnection($connection);
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
        $result = $connection->query("SELECT `reserveringen`.`reservering_id`, `reserveringen`.`plaatsnummer`, `plaatsen`.`grootte`, `klanten`.`voornaam`, `klanten`.`tussenvoegsel`, `klanten`.`achternaam`, `reserveringen`.`begin_datum`, `reserveringen`.`eind_datum`, `reserveringen`.`volwassene`, `reserveringen`.`kinderen4_12`, `reserveringen`.`huisdier`, `plaatsen`.`elektriciteit`, `reserveringen`.`douche`, `reserveringen`.`wasmachine`, `reserveringen`.`wasdroger`, `reserveringen`.`verblijf`, `reserveringen`.`auto` FROM `reserveringen`, `klanten`, `plaatsen` WHERE `reserveringen`.`plaatsnummer` = `plaatsen`.`plaatsnummer` AND `klanten`.`klant_id` = `reserveringen`.`klant_id` AND `reserveringen`.`eind_datum` >= NOW()");
        $reservering_array = array();
        while ( $arr = $result->fetch_assoc() ){
            array_push($reservering_array, new Reservering($arr)); 
        }
        CloseConnection($connection);
        return $reservering_array;
    }

?>