<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
      *{
        text-decoration: none;
        margin: 0;
        padding: 0;
      }
      body{
        color: red;
        background-color: RGB(255,255,0);
        font-size: 25px;
      }

      .navbar{
        width:100%;
        background-color: burlywood;
      }

      .navbar .container .content ul{
        list-style: none;
        width:100%;
        display: flex;
        flex-direction: row;
        align-items: space-between;
        justify-content: center;
      }
      li{
        padding: 20px;
      }
      .wrapper {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items:center;
        width:100%;
        padding: 50px;
      }
    </style>
    <title>Ассортимент</title>
</head>
<body>
<nav class="navbar">
        <div class="container">
          <div class="content" id="navbarText">
            <ul class="navbar">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="index.html">Главная</a>
            </li>
              <li class="nav-item">
                <a class="nav-link active" href="products.php">Ассортимент</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="menu.php">Каталог</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.html">О нас</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    <div class="wrapper">
    <h1 class="text-center">Доступные материалы</h1>
    <ol>
    <?php
    $mysqli = new mysqli("my-sql", "user", "password", "appDB");
    $result = $mysqli->query("SELECT name FROM products");
    foreach ($result as $row){
        echo "<li>{$row['name']}</li>";
    }
    ?>
    </ol>
    </div>
</body>
</html>