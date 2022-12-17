<?php

if (!isset($_SESSION["theme"]) ||
    !isset($_SESSION["font"]) ||
    !isset($_SESSION["login"]))
{
    $_SESSION["login"] = ' ';
    $_SESSION["theme"] = 0;
    $_SESSION["font"] = '15px';
}


function connect(): mysqli {
    $connection = new mysqli('mysql', 'user', 'password', 'appDB');
    return $connection;
}

?>