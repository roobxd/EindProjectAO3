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
            <form>
                Voornaam
                <p><input type="text"></p>
                Tussenvoegsel
                <p><input type="text"></p>
                Achternaam
                <p><input type="text"></p>

                Plaatsnummer
                <p><input type="number"></p>
                Begin Datum
                <p><input type="datetime-local">
                Eind Datum
                <input type="datetime-local"></p>

                Volwassene
                <p><input type="number"></p>
                Kinderen van 4 tot 12 jaar
                <p><input type="number"></p>

                Huisdier?
                <p><input type="checkbox"></p>
                Elektriciteit?
                <p><input type="checkbox"></p>

                Douche munten
                <p><input type="number"></p>

                Wasmachine?
                <p><input type="checkbox"></p>
                Wasdroger?
                <p><input type="checkbox"></p>

                <p>
                Caravan (klein)
                <input type="checkbox">
                Caravan (groot)
                <input type="checkbox">
                Tent (klein)
                <input type="checkbox">
                Tent (groot)
                <input type="checkbox">
                </p>

                Auto?
                <p><input type="checkbox"></p>
                <p><input type="submit"></p>
            </form>
        </div>
    </div>
</body>
</html>