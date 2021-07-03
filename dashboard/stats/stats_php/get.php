<?php
    require_once(__DIR__."/statistieken_sql.php");
    echo json_encode(returnWinst());
?>