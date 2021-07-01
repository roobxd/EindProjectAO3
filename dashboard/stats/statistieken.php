<?php
    require_once(__DIR__."/../../assets/template/dashboard_template.html");
    require_once(__DIR__."/stats_php/statistieken_sql.php");
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
            padding: 15px;
            grid-template-columns: auto auto auto;
            grid-gap: 5px;
            display: grid;
        }

        .stats-container__item{
            padding: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            background-color: var(--main-light);
            text-align: center;
        }
        .stats-container__item span{
            

        }

        .stats-container__item p{
            font-size: 24px;
        }





    </style>
    <head>

    </head>
    <body>
        <div id="main">
            <div id="stats-container">
                <div class="stats-container__item"><span>Totaal actieve reserveringen:</span> <p><?= returnActieveReserveringen() ?></p></div>
                <div class="stats-container__item"><span>Totaal reserveringen die weg gaan vandaag</span><p><?= returnVerlatendeReserveringen() ?></p></div> 
                <div class="stats-container__item"><span>Totaal aantal verdient deze week </span><p>€<?=returnGeldVerdientWeek()?></p></div>
                <div class="stats-container__item">Geld grafiek</div>
                <div class="stats-container__item"></div>
            </div>
        </div>
    </body>
</html>




