<?php
    require("../../assets/template/dashboard_template.html");
    require("../../assets/php/account_sql.php");
?>

<html>
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

    <script>



    </script>


    <head>

    </head>
    <body>
        <div id="main">
            <div id="reserveringen-container">
                <div id="reserveringen-container__options">
                    <div id="reserveringen-container__options__content">
                        <input type="text">
                        <button id="aanmaken">Aanmaken</button>
                        <button id="bulk_verwijderen">Verwijderen</button>
                    </div>
                </div>
                <div id="reserveringen-container__reserveringen-table">
                    <table>
                        <tr><th></th><th>#</th><th>Gebruikersnaam</th><th>Email</th><th>Wachtwoord</th><th>Acties</th></tr>
                        <?php
                            foreach(returnAccounts() as $account){
                                echo "<tr>";
                                echo "<td> <input type='checkbox'> </td>";
                                foreach($account->return_small_result() as $result){
                                    echo "<td>".$result."</td>";
                                }
                                echo "<td>**********</td>";
                                echo "<td> <input type='button' value='Meer Informatie'><input type='button' value='Verwijderen'><input type='button' value='Aanpassen'></td>";
                                echo "</tr>";
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </body>
</htm>
