<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

use App\Kernel;
use App\Http\Request;
require_once __DIR__ . "/../vendor/autoload.php";

$app = new Kernel();
$request = new Request();
try {
    $response = $app->handle($request);
    $response->send();
} catch (\Exception $e) {
    echo json_encode(['status' =>'Internal error', 'payload'=> '{}', 'message' => $e->getMessage()]);
}
