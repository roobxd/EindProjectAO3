<?php
    require(__DIR__."/../../assets/template/dashboard_template.html");
?>

<style>
        #main{
            width: auto;
            height: 100%;
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

        #reserveringen-container__reserveringen-table tr:nth-child(odd){
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
            <div id="reserveringen-container__reserveringen-table">
                <table id="reservering-table">
                    <tr><th>#</th><th>Voornaam</th><th>Tussenvoegsel</th><th>Achternaam</th><th>Begin Datum</th><th>Eind Datum</th><th>Eindbedrag</th><th>Acties</th></tr>
                    <?php
                        foreach(){
                            echo "<tr>";
                            foreach(){

                                echo "<td>".."</td>";
                        
                            }
                            echo "<td>€". ."</td>";
                            echo "</tr>";
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>