<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@500&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <title> ELAP-home </title>
        <link rel="shortcut icon" href="../../img/logo_brown.png" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="../../css/api.css">
    </head>
    <body>
        <header class="header">
            <div class="container">
                <div class="content-container">
                    <img id="logo" src="../../img/logo_brown.png">
                    <p> Онлайн-университет "Развитие" </p>
                    <p> "Обучение не имеет границ" </p>
                    <p> Электронная зачетная книжка студента ОУ "Развитие"</p>
                </div>
            </div>
        </header>
        <section>
            <div class="container">
                <div class="content-container">
                    <p> Ваш результат: </p>
                    <table>
                        <?php
                            include("select.php");
                            drawer(select($_SESSION['sql']))
                        ?>
                    </table>
                    <form class="btn-frst" action="../../admin_profile.html">
                        <button id="btnf"> Назад </button>
                    </form>
                </div>
            </div>  
        </section>
        <footer>
            <div class="container">
                <p> 2021 © Student MIREA ALL RIGHTS RESERVED Онлайн-университет "Развитие" </p> 
            </div>
        </footer>
    </body>
</html>