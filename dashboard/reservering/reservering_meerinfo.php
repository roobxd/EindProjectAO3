<?php

    require_once(__DIR__."/reservering_php/reservering_sql.php");
    if(checkPermission(1) == 0){
        exit("Geen toegang");
    };
    require_once(__DIR__."/../../assets/template/dashboard_template.html");
    $reservering = selectReservering($_GET["reservering_id"]);

?> 
<html>
    <style>
        #main{
            width: auto;
            margin-left: 15%;
            height: 100%;
            background-color: var(--main-background);
            text-align: center;
        }

        #reservering-form{
            display: inline-block;
            background-color: var(--main-light);
            box-shadow: 3px 3px 4px rgba(0,0,0,0.4);
            border-radius: 15px;
            width: 65%;
            margin: 2%;
            padding: 15px;
        }

    </style>
    <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    </head>
    <body>
        <div id="main">
            <form id="reservering-form" action="reservering_php/aanpassen.php" method="POST">
                <h1>Reservering Info</h1>
                <input type="hidden" name="reservering_id" value=<?=$_GET["reservering_id"];?>>
                Voornaam
                <p><input type="text" name="voornaam" value= <?= $reservering->voornaam ?>></p>
                Tussenvoegsel
                <p><input type="text" name="tussenvoegsel" value= <?= $reservering->tussenvoegsel ?>></p>
                Achternaam
                <p><input type="text" name="achternaam" value= <?= $reservering->achternaam ?>></p>

                Plaatsnummer
                <p><input type="number" name="plaatsnummer" value= <?= $reservering->plaatsnummer ?>></p>
                Begin Datum
                <p><input type="date" name="begin_datum" value= <?= date('Y-m-d', strtotime($reservering->begin_datum)); ?>></p>
                Eind Datum
                <p><input type="date" name="eind_datum" value= <?= date('Y-m-d', strtotime($reservering->eind_datum)); ?>></p>

                Volwassene  
                <p><input type="number" name="volwassene" value= <?= $reservering->volwassene ?>></p>
                Kinderen
                <p><input type="number" name="kinderen4_12" value= <?= $reservering->kinderen4_12 ?>></p>

                Huisdier?
                <p><input type="checkbox" name="huisdier" value=<?=$reservering->huisdier ?> <?php if($reservering->huisdier == 1){echo "checked='checked'";}?>></p>

                Douche munten
                <p><input type="number" name="douche" value=<?= $reservering->douche?>></p>

                Wasmachine?
                <p><input type="checkbox" name="wasmachine" value=<?=$reservering->wasmachine ?> <?php if($reservering->wasmachine == 1){echo "checked='checked'";}?>></p>
                Wasdroger?
                <p><input type="checkbox" name="wasdroger" value=<?=$reservering->wasdroger ?> <?php if($reservering->wasdroger == 1){echo "checked='checked'";}?>></p>

                Verblijf
                <p>
                <select name="verblijf">
                    <option value=1>Caravan</option>
                    <option value=0>Tent</option>
                </select>
                </p>

                Auto?
                <p><input type="checkbox" name="auto" value=<?=$reservering->auto ?> <?php if($reservering->auto == 1){echo "checked='checked'";}?>></p>
                <p><input type="submit" name="aanpassen" value="Aanpassen"></p>
            </form>
        </div>
    </body>
</htm>
