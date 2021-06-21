<?php
    require("../../assets/template/dashboard_template.html");
    require("../../assets/php/reservering_sql.php");
    
    $reservering = selectReservering($_GET["reservering_id"]);

?> 
<html>
    <style>
        #main{
            width: auto;
            height: 100%;
            background-color: var(--main-background);
        }

        #reserveringen-container{
            background-color: var(--main-background);
            height: 70%;
            max-width: 70%;
            padding: 15px;
            margin-left: 15%;

        }

        #reserveringen-container__options__content{
            background: var(--main-light);
            box-shadow: 3px 3px 4px rgba(0,0,0,0.4);
            border-radius: 15px;
            margin-bottom: 20px;
            padding: 15px;
            display: inline-block;
        }



    </style>
    <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    </head>
    <body>
        <div id="main">
            <div id="reserveringen-container">
            <form action="reservering_aanpassen.php" method="POST">
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
                <p><input type="datetime-local" name="begin_datum" value= <?= date('Y-m-d\TH:i:s', strtotime($reservering->begin_datum)); ?>>
                Eind Datum
                <input type="datetime-local" name="eind_datum" value= <?= date('Y-m-d\TH:i:s', strtotime($reservering->eind_datum)); ?>></p>

                Volwassene  
                <p><input type="number" name="volwassene" value= <?= $reservering->volwassene ?>></p>
                Kinderen van 4 tot 12 jaar
                <p><input type="number" name="kinderen4_12" value= <?= $reservering->kinderen4_12 ?>></p>

                Huisdier?
                <p><input type="checkbox" name="huisdier" value=<?=$reservering->huisdier ?> <?php if($reservering->huisdier == 1){echo "checked='checked'";}?>><input type="hidden" name="huisdier" value=<?php echo ($reservering->huisdier == 1) ? 0 : 1?>></p>

                Douche munten
                <p><input type="number" name="douche" value=<?= $reservering->douche?>></p>

                Wasmachine?
                <p><input type="checkbox" name="wasmachine" value=<?=$reservering->wasmachine ?> <?php if($reservering->wasmachine == 1){echo "checked='checked'";}?>><input type="hidden" name="wasmachine" value=<?php echo ($reservering->wasmachine == 1) ? 0 : 1?>></p>
                Wasdroger?
                <p><input type="checkbox" name="wasdroger" value=<?=$reservering->wasdroger ?> <?php if($reservering->wasdroger == 1){echo "checked='checked'";}?>><input type="hidden" name="wasdroger" value=<?php echo ($reservering->wasdroger == 1) ? 0 : 1?>></p>

                Verblijf
                <p>
                <select name="verblijf">
                    <option value=1>Caravan</option>
                    <option value=0>Tent</option>
                </select>
                </p>

                Auto?
                <p><input type="checkbox" name="auto" value=<?=$reservering->auto ?> <?php if($reservering->auto = 1){echo "checked";}?>><input type="hidden" name="auto" value=<?php echo ($reservering->auto == 1) ? 0 : 1?>></p>
                <p><input type="submit" name="aanpassen" value="Aanpassen"></p>
            </form>
            </div>
        </div>
    </body>
</htm>
