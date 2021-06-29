<?php
    require(__DIR__."/../../assets/template/dashboard_template.html");
    require(__DIR__."/camping_php/camping_sql.php");
?>

<style>
        #main{
            width: auto;
            height: 100%;
            background-color: var(--main-background);
        }

        #camping-container{
            background-color: var(--main-background);
            height: 70%;
            max-width: 70%;
            padding: 15px;
            margin-left: 15%;

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

        #camping-container__camping-table tr:nth-child(odd){
            background-color: #f5f5f5;
        }
</style>

<body>
    <div id="main">
        <div id="camping-container">
            <div id="camping-container__options">
                <div id="camping-container__options__content">
                    <input type="text">
                    <input type="datetime">
                    <input type="datetime">
                    <button>Check</button>
                </div>
            </div>
            <div id="camping-container__camping-table">
                <table id="camping-table">
                    <tr><th>#</th><th>Grootte</th><th>Elektriciteit</th><th>Beschikbaar?</th></tr>
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