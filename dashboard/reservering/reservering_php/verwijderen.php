<?php
    require_once(__DIR__."/reservering_sql.php");
    if(isset($_POST["bulk_delete"])){
        removeReservering(json_decode($_POST["bulk_delete"]));
    } elseif(isset($_POST["single_delete"])){
        removeReservering(json_decode($_POST["single_delete"]));
    }

?>