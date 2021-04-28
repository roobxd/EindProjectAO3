<?php
    require("../assets/template/dashboard_template.html");
    require("../assets/php/reservering.php");

    
?>

<html>
    <style>
        body {
            background-color: #f5f5f5;
        }

        #reserveringen-container{
            background-color: #ffffff;
            height: 70%;
            width: 55%;
            margin: 0 auto;
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
                    <?php
                        foreach(returnReserveringen() as $reservering){
                            echo "<tr>";
                            foreach($reservering->return_small_result() as $result){
                                echo "<td>".$result."</td>";
                            }
                            echo "</tr>";
                        }

                    ?>
                </table>
            </div>
        </div>
    </body>
</htm>
