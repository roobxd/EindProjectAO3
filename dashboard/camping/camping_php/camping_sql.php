<?php
    require_once(__DIR__."../../../../assets/php/db/database_connectie.php");

    class CampingPlek {

        public $plaatsnummer;
        public $grootte;
        public $elektriciteit;
        public $beschikbaar; 

        function __construct(Array $prop=array()){
            foreach($prop as $key => $value){
                $this->{$key} = $value;
            }

        }


        function return_result(){
            $result = array(
                $this->plaatsnummer,
                ($this->grootte == 1) ? "Groot" : "Klein",
                ($this->elektriciteit == 1) ? "Ja" : "Nee",
                $this->beschikbaar
             );
            return $result;
        } 

    }

    function returnPlekken(){
        $connection = OpenConnection();
        $result = $connection->query("SELECT `plaatsen`.*, CASE WHEN NOW() BETWEEN `reserveringen`.`begin_datum` AND `reserveringen`.`eind_datum` THEN 'Bezet' ELSE 'Vrij' END AS 'beschikbaar' FROM `plaatsen` LEFT JOIN `reserveringen` ON `reserveringen`.`plaatsnummer` = `plaatsen`.`plaatsnummer` GROUP BY `plaatsen`.`plaatsnummer`");
        $camping_array = array();
        while ( $arr = $result->fetch_assoc() ){
            array_push($camping_array, new CampingPlek($arr)); 
        }
        CloseConnection($connection);
        return $camping_array;
    }

?>