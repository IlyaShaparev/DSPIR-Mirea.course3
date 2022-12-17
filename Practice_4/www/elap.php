<?php
function openmysqli(): mysqli {
    $connection = new mysqli('data_base', 'user', 'password', 'appDB');
    return $connection;
}

function outputStatus($status, $message)
{
    echo "{status: " . $status . ",\nmessage:" . $message . '};';
}

try {
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            addDiscipline();
            break;
        case 'DELETE':
            removeDiscipline();
            break;
        case 'PATCH':
            updateMark();
            break;
        case 'GET':
            getDisciplineByID();
            break;
        default:
            outputStatus('Erorr', 'Invalid Mode');
    }
}
catch (Exception $e) {
    $message = $e->getMessage();
    outputStatus('Erorr', $message);
};

function addDiscipline() {
    $data = json_decode(file_get_contents('php://input'), True);
    
    if (!isset($data['discipline']) || !isset($data['mark'])) {
        throw new Exception("No input provided");
    }
    $mysqli = openMysqli();
    $usrdiscipline = $data['discipline'];
    $usrPass = $data['mark'];
    $result = $mysqli->query("SELECT * FROM elap WHERE discipline = '{$usrdiscipline}';");
    if ($result->num_rows === 1) {
        $message = 'Discipline '. $usrdiscipline . ' already exists';
        outputStatus('403', $message);
    } else {
        $query = "INSERT INTO elap (discipline, mark)
        VALUES '('" . $usrdiscipline . "', '" . $usrPass . "');";
        $mysqli->query($query);
        $mysqli->close();
        $message = 'Added discipline ' . $usrdiscipline;
        outputStatus('200', $message);
    }
}

function removeDiscipline()
{
    if (!isset($_GET['id'])) {
        throw new Exception("No input provided");
    }
    $mysqli = openMysqli();
    $usrID = $_GET['id'];
    $result = $mysqli->query("SELECT * FROM elap WHERE ID = '{$usrID}';");
    if ($result->num_rows === 1) {
        $query = "DELETE FROM elap WHERE ID = '" . $usrID . "';";
        $mysqli->query($query);
        $mysqli->close();
        $message = 'Removed disciplie ' . $usrID;
        outputStatus('201', $message);
    } else {
        $message = 'Discipline ' . $usrID . ' does not exist';
        outputStatus('403', $message);
    }
}

function updateMark()
{
    $data = json_decode(file_get_contents('php://input'), true);
    if (!isset($data['discipline']) || !isset($data['mark'])) {
        throw new Exception("No input provided");
    }
    $mysqli = openMysqli();
    $usrdiscipline = $data['discipline'];
    $usrPass = $data['mark'];
    $result = $mysqli->query("SELECT * FROM elap WHERE discipline = '{$usrdiscipline}';");
    if ($result->num_rows === 1) {
        $query = "UPDATE elap SET mark = '" . $usrPass . "' WHERE discipline = '" . $usrdiscipline . "';";
        $mysqli->query($query);
        $mysqli->close();
        $message = 'Changed mark for ' . $usrdiscipline;
        outputStatus('201', $message);
    } else {
        $message = $usrdiscipline . ' does not exist';
        outputStatus('403', $message);
    }
}

function getDisciplineByID()
{
    if (!isset($_GET['id'])) {
        $mysqli = openMysqli();
        $result = $mysqli->query("SELECT * FROM elap;");
        echo "{\nstatus: 200\n";
        foreach ($result as $info) {
            echo"discipline: '" . $info['discipline'] . "', mark: '" . $info['mark'] . "';\n";
        }
        echo "}";
        $mysqli->close();
    }
    else {
        $mysqli = openMysqli();
        $usrID = $_GET['id'];
        $result = $mysqli->query("SELECT * FROM elap WHERE ID = '{$usrID}';");
        if ($result->num_rows === 1) {
            foreach ($result as $info) {
                echo "{status: 200, discipline: '" . $info['discipline'] . "', mark: '" . $info['mark'] . "'};";
            }
            $mysqli->close();
        } else {
            $message = 'Discipline ID '. $usrID . ' does not exist';
            outputStatus('Erorr', $message);
        }
    }
}

?>