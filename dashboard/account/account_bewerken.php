<?php
    require_once(__DIR__."/account_php/account_sql.php");
    if(checkPermission(2) == 0){
        exit("Geen toegang");
    };
    require_once(__DIR__."/../../assets/template/dashboard_template.html");


    
    $account = selectAccount($_GET["account_id"]);

?> 
<html>
    <style>
        #main{
            width: auto;
            height: 100%;
            margin-left: 15%;
            background-color: var(--main-background);
            text-align: center;
        }

        #account-form{
            display: inline-block;
            background-color: var(--main-light);
            box-shadow: 3px 3px 4px rgba(0,0,0,0.4);
            border-radius: 15px;
            width: 65%;
            margin: 2%;
            padding: 15px;
        }

    </style>
    <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    </head>
    <body>
        <div id="main">
            <form id="account-form" action="account_php/aanpassen.php" method="POST">
                <h1>Account bewerken</h1>
                <p><input type="hidden" name="gebruiker_id" value=<?= $account->gebruiker_id ?>></p>
                Gebruikersnaam
                <p><input type="text" name="gebruikersnaam" value=<?= $account->gebruikersnaam ?>></p>
                Email
                <p><input type="text" name="email" value= <?= $account->email ?>></p>
                Rechten
                <p><input type="number" name="rechten" value= <?= $account->rechten ?>></p>
                <p><input type="submit" name="aanpassen" value="Opslaan"></p>
            </form>
        </div>
    </body>
</htm>
