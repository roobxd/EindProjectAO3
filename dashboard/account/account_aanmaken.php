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
            background-color: var(--main-background);
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
<head></head>
<body>
    <div id="main">
        <div id="account-form">
            <form action="account_php/toevoegen.php" method="POST">
                <input type="text" name="gebruikersnaam">
                <input type="email" name="email">
                <input type="password" name="wachtwoord">
                <input type="number" name="rechten">
                <input type="submit" name="toevoegen" value="Opslaan">
            </form>
        </div>
    </div>
</body>
</html>