<?php
    require_once(__DIR__."../../../../assets/php/db/database_connectie.php");

    class Account {

        public $gebruiker_id;
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
                $this->gebruiker_id,
                $this->gebruikersnaam,
                $this->email,
                $this->rechten
            );
            return $result;
        } 

    }

    function selectAccount($account_id){
        $connection = OpenConnection();
        $prep_query = $connection->prepare("SELECT * FROM `accountgegevens` WHERE `gebruiker_id` = ?");

        $prep_query->bind_param("i", $account_id);
        $prep_query->execute();

        $result = $prep_query->get_result();
        
        CloseConnection($connection);
        return new Account($result->fetch_assoc());
    }

    function returnAccounts(){
        $connection = OpenConnection();
        $result = $connection->query("SELECT `gebruiker_id`, `gebruikersnaam`, `email`, `rechten` FROM `accountgegevens`");
        $account_array = array();
        while ( $arr = $result->fetch_assoc() ){
            array_push($account_array, new Account($arr)); 
        }
        CloseConnection($connection);
        return $account_array;
    }

    function removeAccounts($account_ids){
        
        $connection = OpenConnection();
        $prep_query = $connection->prepare("DELETE FROM `accountgegevens` WHERE `gebruiker_id` = ?");
        foreach($account_ids as $id){
            $prep_query->bind_param("i", $id);
            $prep_query->execute();
        }

        CloseConnection($connection);
    }

    function addAccount($account_array){

        $connection = OpenConnection();
        
        $prep_query = $connection->prepare("INSERT INTO `accountgegevens` (`gebruikersnaam`, `email`, `wachtwoord`, `rechten`) VALUES(?,?,?,?)");

        $prep_query->bind_param("sssi", $account_array["gebruikersnaam"], $account_array["email"], $account_array["wachtwoord"], $account_array["rechten"] );
        $prep_query->execute();

        CloseConnection($connection);
    }

    function editAccount($account_array){

        $connection = OpenConnection();

        $prep_query = $connection->prepare("UPDATE `accountgegevens` SET `gebruikersnaam` = ?,  `email` = ?, `rechten` = ? WHERE `gebruiker_id` = ?");

        $prep_query->bind_param("ssii", $account_array["gebruikersnaam"], $account_array["email"], $account_array["rechten"], $account_array["gebruiker_id"]);
        $prep_query->execute();

        CloseConnection($connection);


    }
?>