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
            background-color: var(--main-background);
        }

        #account-container{
            background-color: var(--main-background);
            height: 70%;
            max-width: 70%;
            padding: 15px;
            margin-left: 15%;
        }

        #account-form{
            background-color: var(--main-light);
            box-shadow: 3px 3px 4px rgba(0,0,0,0.4);
            border-radius: 15px;
            margin: auto;
            width: 60%;
            height: 80%;
        }

    </style>
    <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    </head>
    <body>
        <div id="main">
            <div id="account-container">
                <div id="account-form">
                    <form action="account_php/aanpassen.php" method="POST">
                        <input type="hidden" name="gebruiker_id" value=<?= $account->gebruiker_id ?>>
                        <input type="text" name="gebruikersnaam" value=<?= $account->gebruikersnaam ?>>
                        <input type="text" name="email" value= <?= $account->email ?>>
                        <button name="password_reset" value=<?= $account->gebruiker_id ?>>Reset Wachtwoord</button>
                        <input type="number" name="rechten" value= <?= $account->rechten ?>>
                        <input type="submit" name="aanpassen" value="Opslaan">
                    </form>
                </div>
            </div>
        </div>
    </body>
</htm>
