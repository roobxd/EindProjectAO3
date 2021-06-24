<?php
    require_once("../../assets/template/dashboard_template.html");
    require_once("account_php/account_sql.php");
?>


<html>
    <style>
        #main{
            width: auto;
            height: 100%;
            background-color: var(--main-background);
        }

        #reservering-form{
            padding: 10px;
            background-color: var(--main-light);
        }
    </style>
<head></head>
<body>
    <div id="main">
        <div id="reservering-form">
            <form>
                <input type="text">
                <input type="text">
                <input type="text">

                <input type="number">
                <input type="datetime-local">
                <input type="datetime-local">

                <input type="number">
                <input type="number">

                <input type="checkbox">
                <input type="checkbox">

                <input type="number">

                <input type="checkbox">
                <input type="checkbox">

                <input type="checkbox">
                <input type="checkbox">
                <input type="checkbox">
                <input type="checkbox">

                <input type="checkbox">

            </form>
        </div>
    </div>
</body>
</html>