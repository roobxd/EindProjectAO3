<?php
    require("../../assets/template/dashboard_template.html");
    require("../../assets/php/reservering_sql.php");

?>


<html>
    <style>
        #main{
            width: auto;
            margin-left: 15%;
            height: 100%;
            background-color: var(--main-background);
        }

        #reservering-form{
            background-color: var(--main-light);
            box-shadow: 3px 3px 4px rgba(0,0,0,0.4);
            border-radius: 15px;
            margin: auto;
            width: 60%;
            height: 80%;
        }

        #reservering-form form{
            
        }
    </style>
<head></head>
<body>
    <div id="main">
        <div id="reservering-form">
            <form action="reservering_toevoegen.php" method="POST">
                Voornaam
                <p><input required name="voornaam" type="text"></p>
                Tussenvoegsel
                <p><input name="tussenvoegsel" type="text"></p>
                Achternaam
                <p><input required name="achternaam" type="text"></p>

                Plaatsnummer
                <p><input required name="plaatsnummer" type="number"></p>
                Begin Datum
                <p><input required name="begin_datum" type="datetime-local">
                Eind Datum
                <input required name="eind_datum" type="datetime-local"></p>

                Volwassene
                <p><input required name="volwassene" type="number"></p>
                Kinderen van 4 tot 12 jaar
                <p><input required name="kinderen4_12" type="number"></p>

                Huisdier?
                <p><input name="huisdier" value=1 type="checkbox"> <input type="hidden" name="huisdier" value=0></p>

                Douche munten
                <p><input name="douche" type="number"></p>

                Wasmachine?
                <p><input name="wasmachine" value=1 type="checkbox"><input type="hidden" name="wasmachine" value=0></p>
                Wasdroger?
                <p><input name="wasdroger" value=1 type="checkbox"><input type="hidden" name="wasdroger" value=0></p>

                Verblijf
                <p>
                <select name="verblijf" >
                    <option selected value=1>Caravan</option>
                    <option value=0>Tent</option>
                </select>
                </p>


                Auto?
                <p><input name="auto" value=1 type="checkbox"><input type="hidden" name="auto" value=0></p>
                <p><input name="toevoegen" type="submit"></p>
            </form>
        </div>
    </div>
</body>
</html>