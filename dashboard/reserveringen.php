<?php
    require("../assets/template/dashboard_template.html");
?>

<html>
    <style>

        #reserveringen-container{
            background-color: rgba(0,0,0,0.04);
            height: 70%;
            width: 55%;
            margin-left: 25%; 
        }

    </style>
    <head>

    </head>
    <body>
        <div id="reserveringen-container">
            <div id="reserveringen-container__options">
                <div id="reserveringen-container__options__content">
                    <input type="text">
                </div>
            </div>
            <div id="reserveringen-container__reserveringen-table">
                <table>
                    <tr><th>Plaatsnummer</th><th>Voornaam</th><th>Tussenvoegsel</th><th>Achternaam</th><th>Begin Datum</th><th>Eind Datum</th><th>Eindbedrag</th><th>Acties</th></tr>
                </table>
            </div>
        </div>
    </body>
</htm>
