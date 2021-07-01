<?php
    require_once(__DIR__."/../../assets/template/dashboard_template.html");
    require_once(__DIR__."/account_php/account_sql.php");
?>

<html>
    <style>
        #main{
            width: auto;
            height: 100%;
            background-color: var(--main-background);
        }

        #account-container{
            background-color: var(--main-background);
            height: 70%;
            max-width: 70%;
            padding: 15px;
            margin-left: 15%;
            text-align: center;
            justify-content: center;

        }


        #account-container__account-table table{
            border-collapse: collapse;
            min-width: inherit;
            max-height: inherit;
            box-sizing: border-box;
            margin: 0 auto;
            background-color: var(--main-light);
            box-shadow: 3px 3px 4px rgba(0,0,0,0.4);
            border-radius: 15px;

        }

        #account-container__account-table th{
            padding: 10px;
            text-align: left;
            background-color: var(--accent-green);
            color: #ffffff;
        }

        #account-container__account-table td{
            padding: 10px;
            text-align: left;
            word-wrap: break-word;
        }

        #account-container__account-table tr:nth-child(even){
            background-color: #f5f5f5;
        }
        #account-container__options__content{
            background: var(--main-light);
            box-shadow: 3px 3px 4px rgba(0,0,0,0.4);
            border-radius: 15px;
            margin-bottom: 20px;
            padding: 15px;
            display: inline-block;
        }

    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="text/javascript">
            $(document).ready(function() {
                $("#account-filter").on("keyup", function() {
                    const value = $(this).val().toLowerCase();
                    $("#account-table tr").not("thead tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });

                $("#bulk_verwijderen").on("click", function () {
                    const checkedAccounts = $(".account_box:checked").map(function(){
                        return this.value;
                    }).get();
                    const checkedAccountJSON = JSON.stringify(checkedAccounts);
                    $.ajax({
                        method: "POST",
                        url: "account_php/verwijderen.php",
                        data: {bulk_delete: checkedAccountJSON},
                    }).done(function() {
                        location.reload();
                    })
                });

                $("#aanmaken").on("click", function () {
                    location.replace("account_aanmaken.php");
                })

                $(".verwijderen").on("click", function () {
                    const account_id = JSON.stringify([$(this).val()]);
                    $.ajax({
                        method: "POST",
                        url: "account_php/verwijderen.php",
                        data: {single_delete: account_id},
                    }).done(function() {
                        location.reload();
                    })

                })

                $(".bewerken").on("click", function () {
                    const account_id = $(this).val();
                    location.replace("account_bewerken.php?account_id="+account_id);
                })
            });
    </script> 
    <body>
        <div id="main">
            <div id="account-container">
                <div id="account-container__options">
                    <div id="account-container__options__content">
                        <input id="account-filter" type="text">
                        <button id="aanmaken">Aanmaken</button>
                        <button id="bulk_verwijderen">Verwijderen</button>
                    </div>
                </div>
                <div id="account-container__account-table">
                    <table id="account-table">
                        <thead><tr><th></th><th>#</th><th>Gebruikersnaam</th><th>Email</th><th>Machtigingsniveau</th><th>Wachtwoord</th><th>Acties</th></tr></thead>
                        <?php
                            foreach(returnAccounts() as $account){
                                echo "<tr>";
                                echo "<td> <input type='checkbox' class='account_box' value=".$account->gebruiker_id."> </td>";
                                foreach($account->return_small_result() as $result){
                                    echo "<td>".$result."</td>";
                                }
                                echo "<td>**********</td>";
                                echo "<td> <button class='bewerken' value=".$account->gebruiker_id.">Bewerken</button> <button class='verwijderen' value=".$account->gebruiker_id.">Verwijderen</button>";
                                echo "</tr>";
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </body>
</htm>
