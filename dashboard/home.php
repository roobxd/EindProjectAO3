<?php
    require("../assets/template/dashboard_template.html");
?>

<html>
    <head>
    </head>
        <style>
            #stat-grid{
                display: inline-grid;
                grid-template-columns: auto auto auto;
                grid-gap: 50px;
            }
            .stat-item{
                background-color: white;
                box-shadow: 2px 2px 3px rgba(0,0,0,0.4);
            }

            .stat-full-item{
                grid-column: 1/4;
                background-color: white;
            }

        </style>
    <body>
        <div id="main">
            <div id="stat-grid">
                <div class="stat-item">
                    Omzet 
                </div>
                <div class="stat-item">
                    Nieuwe reserveringen vandaag
                </div>
                <div class="stat-item">
                    Huidige reserveringen
                </div>
                <div class="stat-full-item">
                    Winst
                </div>
            </div>
        </div>
    </body>
</html>
