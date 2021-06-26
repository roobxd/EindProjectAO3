<?php
    require_once(__DIR__."/account_sql.php");
    if(isset($_POST["single_delete"])){
        removeAccounts(json_decode($_POST["single_delete"]));
    }
    elseif(isset($_POST["bulk_delete"])){
        removeAccounts(json_decode($_POST["bulk_delete"]));
    }

?>