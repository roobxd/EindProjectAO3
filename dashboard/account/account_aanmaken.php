<?php
    require_once(__DIR__."/account_php/account_sql.php");
    if(checkPermission(2) == 0){
        exit("Geen toegang");
    };
    require_once(__DIR__."/../../assets/template/dashboard_template.html");

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
<head></head>
<body>
    <div id="main">
        <form id="account-form" action="account_php/toevoegen.php" method="POST">
            <h1>Account aanmaken</h1>
            Gebruikersnaam
            <p><input type="text" name="gebruikersnaam"></p>
            Email
            <p><input type="email" name="email"></p>
            Wachtwoord
            <p><input type="password" name="wachtwoord"></p>
            Machtigingsniveau
            <p><input type="number" name="rechten"></p>
            <input type="submit" name="toevoegen" value="Opslaan">
        </form>
    </div>
</body>
</html>