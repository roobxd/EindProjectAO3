<?php
    require("../assets/template/dashboard_template.html");
    require("../assets/php/reservering.php");

    
?>

<html>
    <style>
        body {

        }

        #main{
            width: auto;
            height: 100%;
            background-color: #f5f5f5;
        }

        #reserveringen-container{
            background-color: #ffffff;
            height: 70%;
            width: 60%;
            padding: 15px;
            margin-left: 15%;
            box-shadow: 3px 3px 4px rgba(0,0,0,0.4);

        }

        #reserveringen-container__reserveringen-table table{
            border-collapse: collapse;
            width: 100%;
        }

        #reserveringen-container__reserveringen-table th{
            padding: 10px;
            text-align: left;
            background-color: rgb(99, 168, 128);
            color: #ffffff;
        }

        #reserveringen-container__reserveringen-table td{
            padding: 10px;
            text-align: left;
        }


    </style>
    <head>

    </head>
    <body>
        <div id="main">
            <div id="reserveringen-container">
                <div id="reserveringen-container__options">
                    <div id="reserveringen-container__options__content">

                        <input type="text">
                    </div>
                </div>
                <div id="reserveringen-container__reserveringen-table">
                    <table>
                        <tr><th></th><th>#</th><th>Voornaam</th><th>Tussenvoegsel</th><th>Achternaam</th><th>Begin Datum</th><th>Eind Datum</th><th>Eindbedrag</th><th>Acties</th></tr>
                        <?php
                            foreach(returnReserveringen() as $reservering){
                                echo "<tr>";
                                echo "<td> <input type='checkbox'> </td>";
                                foreach($reservering->return_small_result() as $result){
                                    echo "<td>".$result."</td>";
                                }
                                echo "<td> <input type='button'><input type='button'> </td>";
                                echo "</tr>";
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </body>
</htm>
