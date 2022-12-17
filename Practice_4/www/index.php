<?php
function openmysqli(): mysqli {
    $connection = new mysqli('data_base', 'user', 'password', 'appDB');
    return $connection;
}
function outputStatus($status, $message)
{
    echo "{status: " . $status . ",\nmessage: ". $message . '};';
}
try {
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            addUser();
            break;
        case 'DELETE':
            removeUser();
            break;
        case 'PATCH':
            updateUserPassword();
            break;
        case 'GET':
            getUserByID();
            break;
        default:
            outputStatus('Erorr', 'Invalid Mode');
    }
}
catch (Exception $e) {
    $message = $e->getMessage();
    outputStatus('403', $message);
};

function addUser() {
    $data = json_decode(file_get_contents('php://input'), True);
    
    if (!isset($data['login']) || !isset($data['password'])) {
        throw new Exception("No input provided");
    }
    $mysqli = openMysqli();
    $usrLogin = $data['login'];
    $usrPass = $data['password'];
    $result = $mysqli->query("SELECT * FROM users WHERE login = '{$usrLogin}';");
    if ($result->num_rows === 1) {
        $message = 'User '. $usrLogin . ' already exists';
        outputStatus('Erorr', $message);
    } else {
        $usrPass = generatePass($usrLogin, $usrPass);
        $query = "INSERT INTO users (login, password)
        VALUES ('" . $usrLogin . "', '" . $usrPass . "');";
        $mysqli->query($query);
        $mysqli->close();
        $message = 'Added user ' . $usrLogin;
        outputStatus('201', $message);
    }
}

function removeUser()
{
    if (!isset($_GET['id'])) {
        throw new Exception("No input provided");
    }
    $mysqli = openMysqli();
    $usrID = $_GET['id'];
    $result = $mysqli->query("SELECT * FROM users WHERE ID = '{$usrID}';");
    if ($result->num_rows === 1) {
        $query = "DELETE FROM users WHERE ID = '" . $usrID . "';";
        $mysqli->query($query);
        $mysqli->close();
        $message = 'Removed user ' . $usrID;
        outputStatus('201', $message);
    } else {
        $message = 'User ' . $usrID . ' does not exist';
        outputStatus('403', $message);
    }
}

function updateUserPassword()
{
    $data = json_decode(file_get_contents('php://input'), true);
    if (!isset($data['login']) || !isset($data['password'])) {
        throw new Exception("No input provided");
    }
    $mysqli = openMysqli();
    $usrLogin = $data['login'];
    $usrPass = $data['password'];
    $result = $mysqli->query("SELECT * FROM users WHERE login = '{$usrLogin}';");
    if ($result->num_rows === 1) {
        $usrPass = generatePass($usrLogin, $usrPass);
        $query = "UPDATE users SET password = '" . $usrPass . "' WHERE login = '" . $usrLogin . "';";
        $mysqli->query($query);
        $mysqli->close();
        $message = 'Changed password for ' . $usrLogin;
        outputStatus('201', $message);
    } else {
        $message = $usrLogin . ' does not exist';
        outputStatus('403', $message);
    }
}

function getUserByID()
{
    if (!isset($_GET['id'])) {
        $mysqli = openMysqli();
        $result = $mysqli->query("SELECT * FROM users;");
        echo "{\nstatus: Complete\n";
        foreach ($result as $info) {
            echo"Login: '" . $info['login'] . "', password: '" . $info['password'] . "';\n";
        }
        echo "}";
        $mysqli->close();
    }
    else {
        $mysqli = openMysqli();
        $usrID = $_GET['id'];
        $result = $mysqli->query("SELECT * FROM users WHERE ID = '{$usrID}';");
        if ($result->num_rows === 1) {
            foreach ($result as $info) {
                echo "{status: 200, Login: '" . $info['login'] . "', password: '" . $info['password'] . "'};";
            }
            $mysqli->close();
        } else {
            $message = 'User ID '. $usrID . ' does not exist';
            outputStatus('403', $message);
        }
    }
}

function generatePass($usrLogin, $usrPass) {
    $cmd = "htpasswd -nb {$usrLogin} {$usrPass}";
    exec($cmd, $output);
    $str = implode('', $output);
    $str = preg_replace('/^' . $usrLogin . ':/', '', $str);
    return $str;
}
?>