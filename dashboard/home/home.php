<?php

?>

<html>
    <head>
        <script src="https://kit.fontawesome.com/f9714cf77e.js" crossorigin="anonymous"></script>
    </head>
    <style>

        :root {
            --accent-green: #72c975;
            --main-dark: #444444;
            --main-light: #ffffff;
            --main-background: #e2e2e2;
            --main-light-gray: #f3f3f3;
            --accent-yellow: #F7EF99;
        }
        body{
            justify-content: center;
            font-family: sans-serif;
        }

        #nav-menu__redirect{
            text-align: center;
            background-color: var(--main-light);
            display: fixed;
        }

        .nav-menu__redirect__item{
            display: inline-block;
            padding: 25px;
            font-size: 1rem;
            font-weight: bold;
        }

        .nav-menu__redirect__item a{
            text-decoration: none; 
            color: var(--main-dark); 
        }

        .nav-menu__redirect__item a:hover .nav-menu__redirect__item__content{color: var(--accent-green);}


    </style>
    <body>
        <div id="nav-menu__redirect">
            <div class="nav-menu__redirect__logo">
                <img src="../../assets/img/logo.png" style="max-width: 50%; height: auto;">
            </div>
            <div class="nav-menu__redirect__item">
                <a href="../home/home.php">
                    <div class="nav-menu__redirect__item__content"><i class="fas fa-home fa-fw"></i><span>Home</span></div>
                </a>
            </div>
            <div class="nav-menu__redirect__item">
                <a href="../reservering/reserveringen.php">
                    <div class="nav-menu__redirect__item__content"><i class="far fa-calendar-minus"></i><span>Reserveringen</span></div>
                </a>
            </div>
            <div class="nav-menu__redirect__item">
                <a href="../account/accounts.php">
                    <div class="nav-menu__redirect__item__content"><i class="far fa-user"></i><span>Accounts</span></div>
                </a>
            </div>
            <div class="nav-menu__redirect__item">
                <a href="../camping/camping_plekken.php">
                    <div class="nav-menu__redirect__item__content"><i class="fas fa-campground"></i><span>Camping Plekken</span></div>
                </a>
            </div>
            <div class="nav-menu__redirect__item">
                <a href="../stats/statistieken.php">
                    <div class="nav-menu__redirect__item__content"><i class="far fa-chart-bar"></i><span>Omzet en Statistieken</span></div>
                </a>
            </div>
        </div>
    </body>
</html>
