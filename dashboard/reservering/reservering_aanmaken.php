<?php

    require_once(__DIR__."/reservering_php/reservering_sql.php");
    if(checkPermission(1) == 0){
        exit("Geen toegang");
    };
    require_once(__DIR__."/../../assets/template/dashboard_template.html");
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
<head></head>
<body>
    <div id="main">
        <form id="reservering-form" action="reservering_php/toevoegen.php" method="POST">
            <h1>Reservering Aanmaken</h1>
            Voornaam
            <p><input required name="voornaam" type="text"></p>
            Tussenvoegsel
            <p><input name="tussenvoegsel" type="text"></p>
            Achternaam
            <p><input required name="achternaam" type="text"></p>

            Plaatsnummer
            <p><input required name="plaatsnummer" type="number"></p>
            
            Begin Datum
            <p><input required name="begin_datum" type="date"></p>
            Eind Datum
            <p><input required name="eind_datum" type="date"></p>

            Volwassene
            <p><input required name="volwassene" type="number"></p>
            Kinderen
            <p><input required name="kinderen4_12" type="number"></p>

            Huisdier?
            <p><input name="huisdier" value=1 type="checkbox"></p>

            Douche munten
            <p><input name="douche" type="number"></p>

            Wasmachine?
            <p><input name="wasmachine" value=1 type="checkbox"></p>
            Wasdroger?
            <p><input name="wasdroger" value=1 type="checkbox"></p>

            Verblijf
            <p>
            <select name="verblijf" >
                <option selected value=1>Caravan</option>
                <option value=0>Tent</option>
            </select>
            </p>


            Auto?
            <p><input name="auto" value=1 type="checkbox"></p>
            <p><input name="toevoegen" type="submit"></p>
        </form>
    </div>
</body>
</html>