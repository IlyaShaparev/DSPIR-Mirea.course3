<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@500&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <title> ELAP-home </title>
        <link rel="shortcut icon" href="img/logo_brown.png" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="../css/api.css">
    </head>
    <body>
        <header class="header">
            <div class="container">
                <div class="content-container">
                    <img id="logo" src="../img/logo_brown.png">
                    <p> Онлайн-университет "Развитие" </p>
                    <p> "Обучение не имеет границ" </p>
                    <p> Электронная зачетная книжка студента ОУ "Развитие"</p>
                </div>
            </div>
        </header>
        <section>
            <div class="container">
                <div class="content-container">

                <?php
                    $files = scandir('pdf');
                    if (count($files) <= 2) {
                        echo "<p class='text'>Нет загруженных файлов</p>";
                    } else {
                        echo "<p class='text'>Ваши файлы: </p>";
                        echo"<table>";
                        $i = 1;
                        foreach ($files as $file) {
                            if ($file != "." and $file != "..") {
                            echo "<tr><td>$i</td><td><a  href='./pdf/".$file."'>".$file."</a></td></tr>";
                            $i += 1;
                            }
                        }
                    }
                ?>
                </table>

                <form enctype="multipart/form-data" action="upload.php" method="POST">
                    <div>
                        <input type="hidden" name="max_size" value="2000000"/>
                        <br>
                        <label for="file_field">Отправить ваш файл:</label>
                        <br>
                        <input id="file_field" name="userfile" type="file"/>
                    </div>
                    <br>
                    <input type="submit" value="Отправить файл" id="btnf-api"/>
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