
<?php
    require_once(__DIR__."/../../assets/template/dashboard_template.html");
    require_once(__DIR__."/reservering_php/reservering_sql.php");
?> 
<html>
    <style>
        #main{
            width: auto;
            height: 100%;
            margin-left: 15%;
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

        #reserveringen-container__reserveringen-table table{
            border-collapse: collapse;
            min-width: inherit;
            max-height: inherit;
            box-sizing: border-box;
            background-color: var(--main-light);
            box-shadow: 3px 3px 4px rgba(0,0,0,0.4);
            border-radius: 15px;

        }

        #reserveringen-container__reserveringen-table th{
            padding: 10px;
            text-align: left;
            background-color: var(--accent-green);
            color: #ffffff;
        }

        #reserveringen-container__reserveringen-table td{
            padding: 10px;
            text-align: left;
            word-wrap: break-word;
        }

        #reserveringen-container__reserveringen-table tr:nth-child(even){
            background-color: #f5f5f5;
        }


    </style>
    <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="text/javascript">
            $(document).ready(function() {
                $("#reservering-filter").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#reservering-table tr").not("thead tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });

                $("#bulk_verwijderen").on("click", function () {
                    var checkedReserveringen = $(".reservering_box:checked").map(function(){
                        return this.value;
                    }).get();
                    var checkedReserveringenJSON = JSON.stringify(checkedReserveringen);
                    $.ajax({
                        method: "POST",
                        url: "reservering_php/verwijderen.php",
                        data: {bulk_delete: checkedReserveringenJSON},
                    }).done(function() {
                        location.reload();
                    })
                });

                $("#aanmaken").on("click", function () {
                    location.replace("reservering_aanmaken.php");
                });

                $(".verwijderen").on("click", function () {
                    var reservering_id = JSON.stringify([$(this).val()]);
                    $.ajax({
                        method: "POST",
                        url: "reservering_php/verwijderen.php",
                        data: {single_delete: reservering_id},
                    }).done(function() {
                        location.reload();
                    })

                });

                $(".meer_info").on("click", function () {
                    var reservering_id = $(this).val();
                    console.log(reservering_id);
                    location.replace("reservering_meerinfo.php?reservering_id="+reservering_id);
                });
                $(".factuur").on("click", function () {
                    var reservering_id = $(this).val();
                    location.replace("factuur.php?reservering_id="+reservering_id)
                });
            });
    </script> 
    </head>
    <body>
        <div id="main">
            <div id="reserveringen-container">
                <div id="reserveringen-container__options">
                    <div id="reserveringen-container__options__content">
                        <input id="reservering-filter" type="text">
                        <button id="aanmaken">Aanmaken</button>
                        <button id="bulk_verwijderen">Verwijderen</button>
                    </div>
                </div>
                <div id="reserveringen-container__reserveringen-table">
                    <table id="reservering-table">
                        <thead><tr><th></th><th>#</th><th>Voornaam</th><th>Tussenvoegsel</th><th>Achternaam</th><th>Begin Datum</th><th>Eind Datum</th><th>Eindbedrag</th><th>Acties</th></tr></thead>
                        <?php
                            foreach(returnReserveringen() as $reservering){
                                echo "<tr>";
                                echo "<td> <input type='checkbox' value=".$reservering->reservering_id." class='reservering_box'>  </td>";
                                foreach($reservering->return_small_result() as $result){

                                    echo "<td>".$result."</td>";
                           
                                }
                                echo "<td>€". $reservering->calculate_price(NULL) ."</td>";
                                echo "<td><button value=".$reservering->reservering_id." class='meer_info'>Meer Info / Aanpassen</button><button value=".$reservering->reservering_id." class='verwijderen'>Verwijderen</button><button class='factuur' value=".$reservering->reservering_id.">Factuur</button></td>";
                                echo "</tr>";
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </body>
</htm>
 