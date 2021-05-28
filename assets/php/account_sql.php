<?php

    require("db/database_connectie.php");

    class Account {

        public $gebruikers_id;
        public $gebruikersnaam;
        public $email;
        public $rechten; 

        function __construct(Array $prop=array()){
            foreach($prop as $key => $value){
                $this->{$key} = $value;
            }

        }


        function return_small_result(){
            $result = array(
                $this->gebruikers_id,
                $this->gebruikersnaam,
                $this->email,
            );
            return $result;
        } 

    }


    function returnAccounts(){
        $connection = OpenConnection();
        $result = $connection->query("SELECT `gebruikers_id`, `gebruikersnaam`, `email`, `rechten` FROM `accountgegevens`");
        $account_array = array();
        while ( $arr = $result->fetch_assoc() ){
            array_push($account_array, new Account($arr)); 
        }
        CloseConnection($connection);
        return $account_array;
    }

?>