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
        <?php
            $direct = '/var/www/html/files/pdf/';
            $file = $direct . basename($_FILES['userfile']['name']);

            echo '<h3>';
            setlocale(LC_ALL, 'en_US.UTF-8');
            $ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
            if ($ext != "pdf") {
                echo "<p class='text'>Данное расширение не является PDF</p>";
            } else {
                if (move_uploaded_file($_FILES['userfile']['tmp_name'], $file)) {
                    exec('file ' . $file, $ext);
                    $status = strripos($ext[0], 'pdf document');
                    if ($status == True){
                        echo "<p class='text'>Файл успешно добавлен!</p>";
                    }
                    else {
                        $temp = array();
                        exec('rm ' . $file, $temp);
                        echo "<p class='text'>Данное расширение не является PDF</p>";
                    }
                    
                }
                else {
                    echo "Ошибочная загадка...\n";
                }
            }

            echo "</h3>";
        ?>
        <a href="workes.php">К списку</a> 
        </section>
        <footer>
            <div class="container">
                <p> 2021 © Student MIREA ALL RIGHTS RESERVED Онлайн-университет "Развитие" </p> 
            </div>
        </footer>
    </body>
</html>