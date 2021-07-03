<<<<<<< HEAD
<?php
    require_once(__DIR__."/../../assets/template/dashboard_template.html");
    require_once(__DIR__."/stats_php/statistieken_sql.php");
?> 


=======

<?php
    require_once(__DIR__."/../../assets/template/dashboard_template.html");
?> 
>>>>>>> 7dbae7f1ad79f8d8afc0199d40cda9e81fba4478
<html>
    <style>
        #main{
            width: auto;
            height: 100%;
<<<<<<< HEAD
            margin-left: 15%;
=======
>>>>>>> 7dbae7f1ad79f8d8afc0199d40cda9e81fba4478
            background-color: var(--main-background);
        }

        #stats-container{
<<<<<<< HEAD
            padding: 2%;
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

        .stats-container__item p{
            font-size: 24px;
        }





=======
            display: flex;
        }

        #stats-container__item{
            
        }


>>>>>>> 7dbae7f1ad79f8d8afc0199d40cda9e81fba4478
    </style>
    <head>

    </head>
    <body>
        <div id="main">
            <div id="stats-container">
<<<<<<< HEAD
                <div class="stats-container__item"><span>Totaal aantal verdient deze maand </span><p>€<?=returnGeldVerdientWeek()?></p>Voer winst in deze maand:<input name="winst_number" type="number"><button name="winst_submit">Bevestigen</button></div>
                <div class="stats-container__item"><span>Totaal reserveringen die weg gaan vandaag</span><p><?= returnVerlatendeReserveringen() ?></p></div> 
                <div class="stats-container__item"></div>
                <div class="stats-container__item"><canvas id="opbrengst"></canvas></div>
                <div class="stats-container__item">Totaal actieve reserveringen:</span> <p><?= returnActieveReserveringen() ?></p></div>
            </div>
        </div>
    </body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var ajaxWinst = [];
        $.ajax({
                method: "GET",
                url: "stats_php/get.php",
            }).done(function(data) {
                ajaxWinst = $.parseJSON(data);
                console.log(ajaxWinst);
            });
        $("#winst_submit").on("click", function () {
            $.ajax({
                method: "POST",
                url: "reservering_php/verwijderen.php",
                data: {bulk_delete: checkedReserveringenJSON},
            }).done(function() {
                location.reload();
            })
        });

        const grafiekLabels = ["Januari", "Februari", "Maart", "April", "Mei", "Juni", "Juli", "Augustus", "September", "Oktober", "November", "December"];
        const data = {
            labels: grafiekLabels,
            datasets: [{
                label: 'Winst',
                backgroundColor: 'rgb(255,255,255)',
                borderColor: 'rgb(255, 99, 132)',
                data: ajaxWinst,
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
        });


</script>
</html>




=======
                <div class="stats-container__item"></div>
                <div class="stats-container__item"> </div> 
                <div class="stats-container__item"> </div>        
            </div>
        </div>
    </body>
</htm>
 
>>>>>>> 7dbae7f1ad79f8d8afc0199d40cda9e81fba4478
