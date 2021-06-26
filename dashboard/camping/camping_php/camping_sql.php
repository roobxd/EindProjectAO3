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


        function return_small_result(){
            $result = array(
                $this->gebruiker_id,
                $this->gebruikersnaam,
                $this->email,
                $this->rechten
            );
            return $result;
        } 

    }

    function returnAccounts(){
        $connection = OpenConnection();
        $result = $connection->query("SELECT *, CASE WHEN NOW() BETWEEN (SELECT `begin_datum` FROM `reserveringen` WHERE `plaatsnummer` = `plaatsen`.`plaatsnummer`) AND (SELECT `eind_datum` FROM `reserveringen` WHERE `plaatsnummer` = `plaatsen`.`plaatsnummer`) THEN 'Bezet' ELSE 'Vrij' END AS 'bezet' FROM `plaatsen`");
        $account_array = array();
        while ( $arr = $result->fetch_assoc() ){
            array_push($account_array, new Account($arr)); 
        }
        CloseConnection($connection);
        return $account_array;
    }

?>