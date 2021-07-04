<?php
    require(__DIR__."/camping_php/camping_sql.php");
    if(checkPermission(1) == 0){
        exit("Geen toegang");
    };
    require(__DIR__."/../../assets/template/dashboard_template.html");


?>

<html>
    <style>
            #main{
                width: auto;
                height: 100%;
                margin-left: 15%;
                background-color: var(--main-background);
            }
    
            #camping-container{
                background-color: var(--main-background);
                height: 70%;
                max-width: 70%;
                padding: 15px;
                margin-left: 15%;
                text-align: center;
            }
    
            #camping-container__options__content{
                background: var(--main-light);
                box-shadow: 3px 3px 4px rgba(0,0,0,0.4);
                border-radius: 15px;
                margin-bottom: 20px;
                padding: 15px;
                display: inline-block;
            }

    
            #camping-container__camping-table table{
                border-collapse: collapse;
                min-width: inherit;
                max-height: inherit;
                box-sizing: border-box;
                display: inline-block;
                background-color: var(--main-light);
                box-shadow: 3px 3px 4px rgba(0,0,0,0.4);
                border-radius: 15px;
    
            }
    
            #camping-container__camping-table th{
                padding: 10px;
                text-align: left;
                background-color: var(--accent-green);
                color: #ffffff;
            }
    
            #camping-container__camping-table td{
                padding: 10px;
                text-align: left;
                word-wrap: break-word;
            }
    
            #camping-container__camping-table tr:nth-child(even){
                background-color: #f5f5f5;
            }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function() {
            $("#plek-filter").on("keyup", function() {
                const value = $(this).val().toLowerCase();
                $("#camping-table tr").not("thead tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <body>
        <div id="main">
            <div id="camping-container">
                <div id="camping-container__options">
                    <div id="camping-container__options__content">
                        <input id="plek-filter" placeholder="Zoeken.." type="text">
                    </div>
                </div>
                <div id="camping-container__camping-table">
                    <table id="camping-table">
                        <thead><tr><th>#</th><th>Grootte</th><th>Elektriciteit</th><th>Beschikbaar?</th></tr></thead>
                        <?php
                            foreach(returnPlekken() as $plek){
                                echo "<tr>";
                                foreach($plek->return_result() as $result){
    
                                    echo "<td>".$result."</td>";
    
                                }
                                echo "</tr>";
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>