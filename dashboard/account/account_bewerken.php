<?php
    require_once("../../assets/template/dashboard_template.html");
    require_once("account_php/account_sql.php");
    
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


    </style>
    <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    </head>
    <body>
        <div id="main">
            <div id="account-container">
            <form action="account_php/aanpassen.php" method="POST">
                <input type="text" name="gebruikersnaam" value=<?= $account->gebruikersnaam ?>>
                <input type="text" name="email" value= <?= $account->email ?>>
                <button name="password_reset">Reset Wachtwoord</button>
                <input type="number" name="rechten" value= <?= $account->rechten ?>>
                <input type="submit" name="opslaan" value="Opslaan">
            </form>
            </div>
        </div>
    </body>
</htm>
