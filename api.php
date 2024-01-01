<?php
// Turn off all error reporting
error_reporting(0);

// the monandal file
require_once 'monandal.php';

// message to return
$message = array();

$dal = new MonanDAL();

switch($_GET["action"])
{
	case 'getlist':
		$mssv = $_GET["mssv"];
		$message = $dal->get($mssv);
		break;
	
	case 'insert':
		$mssv = $_GET["mssv"];
		$ten = $_GET["ten"];
		$result = $dal->insert($mssv, $ten);
		$message = ["message" => json_encode($result)];
		break;

	case 'delete':
		$mssv = $_GET["mssv"];
		$ma = $_GET["ma"];
		$result = $dal->delete($mssv, $ma);
		$message = ["message" => json_encode($result)];
		break;

	default:
		$message = ["message" => "Unknown method " . $_GET["action"]];
		break;
}

//The JSON message
header('Content-type: application/json; charset=utf-8');

//Clean (erase) the output buffer
ob_clean();

echo json_encode($message);

