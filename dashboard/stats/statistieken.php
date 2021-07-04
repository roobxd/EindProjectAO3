<?php

    require_once(__DIR__."/stats_php/statistieken_sql.php");
    if(checkPermission(2) == 0){
        exit("Geen toegang");
    };
    require_once(__DIR__."/../../assets/template/dashboard_template.html");
?> 


<html>
    <style>
        #main{
            width: auto;
            height: 100%;
            margin-left: 15%;
            background-color: var(--main-background);
        }

        #stats-container{
            box-sizing: border-box; 
            padding: 10px;
            grid-template-columns: 1fr 1fr 1fr ;
            grid-gap: 5px;
            display: grid;
        }

        .stats-container__item{
            padding: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            background-color: var(--main-light);
            text-align: center;
        }

        .stats-container__item p{
            font-size: 24px;
        }

        .stats-container__item__graph{
            grid-column-start: 1;
            grid-column-end: 4;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            background-color: var(--main-light);
            text-align: center;
        }





    </style>
    <head>

    </head>
    <body>
        <div id="main">
            <div id="stats-container">
                <div class="stats-container__item"><span>Totaal aantal verdient deze maand </span><p>€<?=returnGeldVerdientMaand()?></p></div>
                <div class="stats-container__item"><span>Totaal reserveringen die weg gaan vandaag</span><p><?= returnVerlatendeReserveringen() ?></p></div> 
                <div class="stats-container__item"><span>Totaal actieve reserveringen:</span> <p><?= returnActieveReserveringen() ?></p></div>
                <div class="stats-container__item__graph"><canvas id="opbrengst"></canvas></div>

            </div>
        </div>
    </body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $.ajax({
            method: "GET",
            url: "stats_php/get.php",
        }).done(function(data) {
             createGraph($.parseJSON(data));
        });
    });
    function createGraph(winst){
        const grafiekLabels = ["Januari", "Februari", "Maart", "April", "Mei", "Juni", "Juli", "Augustus", "September", "Oktober", "November", "December"];
        const data = {
            labels: grafiekLabels,
            datasets: [{
                label: 'Winst',
                backgroundColor: 'rgb(255,255,255)',
                borderColor: 'rgb(114, 201, 117)',
                data: winst,
            }]
        };
        const grafiekOpties = {
            type: 'line',
            data,
            options: {}
        };
        var winstGrafiek = new Chart(
            document.getElementById('opbrengst'),
            grafiekOpties
        );
    }






</script>
</html>




